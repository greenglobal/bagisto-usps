<?php

use USPS\RatePackage;

    if (! function_exists('uspsCalculateShippingRates')) {
        function uspsCalculateShippingRates($data)
        {
            $services = explode(',', core()->getConfigData('sales.carriers.uspsrate.allowed_methods'));
            foreach ($services as $key => $service) {

                if (count($services) > 1 && $service == 'ALL')
                    continue;

                $rate = new \USPS\Rate(core()->getConfigData('sales.carriers.uspsrate.user_ID') ?? '');
                $rate->setTestMode(!core()->getConfigData('sales.carriers.uspsrate.production_mode') ?? false);
                $package = new RatePackage();
                $package->setService($service);

                // Set first class mail type
                if (! empty($firstClass = core()->getConfigData('sales.carriers.uspsrate.first_class_mail_type')))
                    $package->setFirstClassMailType($firstClass);

                $package->setZipOrigination($data['zip_origination']);
                $package->setZipDestination($data['zip_destination']);
                $weightUnit = core()->getConfigData('general.general.locale_options.weight_unit') ?? '';
                $pounds = $weightUnit != 'kgs' ? $data['package']['weight'] : 0;

                // Convert kilogram to ounces
                $ounces = $weightUnit == 'kgs' ? $data['package']['weight'] / 0.0283495 : 0;

                // Set weight
                $package->setPounds($pounds);
                $package->setOunces($ounces);

                // Set container and size
                $package->setContainer(core()->getConfigData('sales.carriers.uspsrate.container') ?? '');
                $size = core()->getConfigData('sales.carriers.uspsrate.size') ?? RatePackage::SIZE_REGULAR;
                $package->setSize($size);

                if ($size == RatePackage::SIZE_LARGE) {
                    $package->setField('Width', $data['package']['width']);
                    $package->setField('Length', $data['package']['length']);
                    $package->setField('Height', $data['package']['height']);
                }

                // Set machinable
                $package->setField('Machinable', core()->getConfigData('sales.carriers.uspsrate.machinable') ?? true);

                // Add the package to the rate stack
                $rate->addPackage($package);

                // Perform the request and print out the result
                $rate->getRate();

                $response = $rate->getArrayResponse();
                $rateDetails = [];

                if (! empty($response['RateV4Response']['Package']['Postage'])) {
                    $postage = $response['RateV4Response']['Package']['Postage'];
                    if (! empty($postage['MailService'])) {
                        $rateDetails[] = $response['RateV4Response']['Package']['Postage'];
                    } else {
                        $rateDetails = array_merge($rateDetails, $postage);
                    }
                }
            }

            if (count($services) == 1 && empty($rateDetails)) {
                if (! empty($response['RateV4Response']['Package']['Error'])) {
                    $rateDetails['message'] = $response['RateV4Response']['Package']['Error']['Description'] ?? '';
                } elseif (! empty($response['Error']['Description'])) {
                    $rateDetails['message'] = $response['Error']['Description'] ?? '';
                } else {
                    $rateDetails['message'] = 'Not calculate shipping rates';
                }
            }

            return $rateDetails;
        }
    }

    if (! function_exists('uspsTrackById')) {
        function uspsTrackById($trackingIds)
        {
            // Initiate and set the username provided from usps
            $tracking = new \USPS\TrackConfirm(core()->getConfigData('sales.carriers.uspsrate.user_ID') ?? '');

            // During test mode this seems not to always work as expected
            $tracking->setTestMode(!core()->getConfigData('sales.carriers.uspsrate.production_mode') ?? false);

            // Add the package id to the track confirm lookup class
            foreach ($trackingIds as $key => $trackingId)
                $tracking->addPackage($trackingId);

            // Perform the call
            $tracking->getTracking();

            // Check if it was completed
            $trackReplyDetails = [];

            if ($tracking->isSuccess()) {
                $response = $tracking->getArrayResponse();

                if (! empty($response['TrackResponse']['TrackInfo']['Error'])) {
                    $trackReplyDetails = [
                        'status' => false,
                        'message' => ($response['TrackResponse']['TrackInfo']['Error'] ?? '')
                    ];
                } else {
                    $trackReplyDetails = $response['TrackResponse']['TrackInfo'] ?? [];
                }

            } else {
                $trackReplyDetails = ['status' => false, 'message' => $tracking->getErrorMessage()];
            }

            return $trackReplyDetails;
        }
    }
?>
