@extends('shop::layouts.master')

@section('page_title')
    {{ __('ggphp::usps.admin.system.trackings-title') }}
@stop

@section('content-wrapper')

    <div class="main-container-wrapper container">
        <div class="header header-tracking">
            <div class="header-top">
                <h1>
                    {{ __('ggphp::usps.admin.system.trackings-title') }}
                </h1>
            </div>
        </div>

        <div class="content-container">

            @if (! empty($trackings) && ! isset($trackings['status']))
                @foreach ($trackings as $tracking)
                    <div class="sale-container tracking">
                        <div class="tracking-info">
                            <div class="box">
                                <strong class="box-title">{{ __('ggphp::usps.admin.system.tracking-id') }}:</strong>

                                <div class="box-content">
                                    #{{ $tracking['@attributes']['ID'] ?? '' }}
                                </div>
                            </div>

                            <div class="box">
                                <strong class="box-title">{{ __('ggphp::usps.admin.system.order-id') }}:</strong>

                                <div class="box-content">
                                    <a href="{{ route('customer.orders.view', $order->id ?? '') }}">
                                        #{{ $order->id ?? '' }}
                                    </a>
                                </div>
                            </div>

                            <div class="box">
                                <strong class="box-title">
                                    {{ __('shop::app.customer.account.order.view.billing-address') }}
                                </strong>

                                <div class="box-content">
                                    @include ('admin::sales.address', ['address' => $order->billing_address])
                                </div>
                            </div>

                            @if ($order->shipping_address)
                                <div class="box">
                                    <strong class="box-title">
                                        {{ __('shop::app.customer.account.order.view.shipping-address') }}
                                    </strong>

                                    <div class="box-content">
                                        @include ('admin::sales.address', ['address' => $order->shipping_address])
                                    </div>
                                </div>

                                <div class="box">
                                    <strong class="box-title">
                                        {{ __('shop::app.customer.account.order.view.shipping-method') }}
                                    </strong>

                                    <div class="box-content">
                                        {{ $order->shipping_title ?? '' }}
                                    </div>
                                </div>
                            @endif

                            <div class="box">
                                <strong class="box-title">
                                    {{ __('shop::app.customer.account.order.view.payment-method') }}
                                </strong>

                                <div class="box-content">
                                    {{ core()->getConfigData('sales.paymentmethods.' . $order->payment->method . '.title') }}

                                    @php $additionalDetails = \Webkul\Payment\Payment::getAdditionalDetails($order->payment->method); @endphp

                                    @if (! empty($additionalDetails))
                                        <div class="instructions">
                                            <label>{{ $additionalDetails['title'] }}</label>
                                            <p>{{ $additionalDetails['value'] }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="process-bar">
                            <ul class="events">

                                @if (! empty($tracking['TrackSummary']))
                                    <li class="delivered">
                                        <span class="time checked">{{ $tracking['TrackSummary']['EventDate'] . ' ' . $tracking['TrackSummary']['EventTime'] }}</span>
                                        <span class="address checked">
                                            <strong>{{ $tracking['TrackSummary']['Event'] }}</strong>
                                            {{
                                                $tracking['TrackSummary']['EventCity'] ?? '' .
                                                ( $tracking['TrackSummary']['EventZIPCode'] ? (', ' .  $tracking['TrackSummary']['EventZIPCode']) : '') .
                                                ( $tracking['TrackSummary']['EventState'] ? (', ' .  $tracking['TrackSummary']['EventState']) : '') .
                                                ( $tracking['TrackSummary']['EventCountry'] ? (', ' .  $tracking['TrackSummary']['EventCountry']) : '')
                                            }}
                                        </span>
                                    <li>
                                @else
                                    <li>
                                        <span class="time"></span>
                                        <span class="address">
                                            <strong>Delivered</strong>
                                        </span>
                                    </li>
                                @endif

                                @foreach ($tracking['TrackDetail'] as $event)
                                     <li>
                                        <span class="time checked">{{ ($event['EventDate'] ?? '') . ' ' . ($event['EventTime'] ?? '') }}</span>
                                        <span class="address checked">
                                            <strong>{{ $event['Event'] ?? '' }}</strong>
                                            {{
                                                $event['EventCity'] ?? '' .
                                                ($event['EventZIPCode'] ? (', ' . $event['EventZIPCode']) : '') .
                                                ($event['EventState'] ? (', ' . $event['EventState']) : '') .
                                                ($event['EventCountry'] ? (', ' . $event['EventCountry']) : '')
                                            }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="sale-container">
                    <p>{{ $trackings['message'] ?? '' }}</p>
                </div>
            @endif

        </div>
    </div>

@stop
