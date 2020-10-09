<?php

namespace GGPHP\Shipping\Carriers;

use Webkul\Checkout\Models\CartShippingRate;
use Webkul\Checkout\Facades\Cart;
use Webkul\Shipping\Carriers\AbstractShipping;

/**
 * Class Rate.
 *
 */
class USPS extends AbstractShipping
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code = 'uspsrate';

    /**
     * Returns rate for uspsrate
     *
     * @return array
     */
    public function calculate()
    {
        $data = ['status' => false];

        if (! $this->isAvailable()) {
            $data['message'] = 'Unavailable shipping method';

            return $data;
        }

        $cart = Cart::getCart();

        if (empty($cart->shipping_address)) {
            $data['message'] = 'No shipping address';

            return $data;
        }

        // Get shipping address
        $zipOrigination = core()->getConfigData('sales.shipping.origin.zipcode') ?? '';
        $zipDestination = $cart->shipping_address->postcode ?? '';

        if (empty($zipOrigination)) {
            $data['message'] = 'No Zip/Postal code in dashboard configuration';

            return $data;
        }

        $shippingInfo = [
            'zip_origination' => $zipOrigination,
            'zip_destination' => $zipDestination,
        ];
        $defaultAmount = $this->getConfigData('default_rate') ?? 0;

        foreach ($cart->items as $item) {
            if ($item->product->getTypeInstance()->isStockable()) {
                $defaultAmount = $defaultAmount + ($defaultAmount * $item->quantity);
                $shipping = $item->child->product->product ?? $item->product;

                $shippingInfo['package'] = [
                    'weight' => ($shippingInfo['package']['weight'] ?? 0) + ((int) ($shipping->weight ?? 0) * $item->quantity),
                    'length' => ($shippingInfo['package']['length'] ?? 0) + ((int) ($shipping->depth ?? 0) * $item->quantity),
                    'width' => ($shippingInfo['package']['width'] ?? 0) + ((int) ($shipping->width ?? 0) * $item->quantity),
                    'height' => ($shippingInfo['package']['height'] ?? 0) + ((int) ($shipping->height ?? 0) * $item->quantity),
                ];
            }
        }

        // Get shipping rates
        $rateDetails = uspsCalculateShippingRates($shippingInfo);

        // Check calling api status
        if (isset($rateDetails['status']) && !$rateDetails['status'])
            return $rateDetails;

        $services = [];

        if (! empty($rateDetails['MailService']))
            $rateDetails = [$rateDetails];

        foreach ($rateDetails as $rateDetail) {
            if (! empty($rateDetail['MailService'])) {
                $mailService = str_replace([
                    '&lt;sup&gt;&#8482;&lt;/sup&gt;',
                    '&lt;sup&gt;&#174;&lt;/sup&gt;'
                ], '', $rateDetail['MailService']);
                $object = new CartShippingRate;
                $object->carrier = 'uspsrate';
                $object->carrier_title = $this->getConfigData('title');
                $object->method = 'uspsrate_' . (str_replace([' ', '-'], '_', $mailService) ?? '');
                $object->method_title = $mailService;
                $object->method_description = $mailService;
                $object->price += $rateDetail['Rate'] ?? core()->convertPrice($defaultAmount);
                $object->base_price += $rateDetail['Rate'] ?? $defaultAmount;
                $services[] = $object;
                unset($object);
            }
        }

        $data['status'] = true;
        $data['services'] = $services;

        return $data;
    }
}
