@extends('admin::layouts.master')

@section('page_title')
    {{ __('ggphp::usps.admin.system.tracking-title') }}
@stop

@section('css')
    <style type="text/css">
        .sale-container .sale-section .section-content .row .title {
            width: 325px;
            text-transform: capitalize;
        }
        .sale-container .sale-section {
            padding: 0 30px;
        }
        .sale-container .track-details {
            background-color: #efefef;
            padding: 12px;
            margin-bottom: 20px;
        }
    </style>
@stop

@section('content-wrapper')

    <div class="content full-page">
        <div class="page-header">
            <div class="page-title">
                <h1>
                    <i class="icon angle-left-icon back-link" onclick="window.location = history.length > 1 ? document.referrer : '{{ route('admin.dashboard.index') }}'"></i>

                    {{ __('ggphp::usps.admin.system.tracking-title') }} #{{ $trackingId }}
                </h1>
            </div>
        </div>

        <div class="page-content">
            <div class="sale-container">

                @if(! isset($trackings['status']))
                    <div class="track-details">
                        <div class="track-body">
                            <accordian :title="'{{ __('ggphp::usps.admin.system.track-summary') }}'" :active="true">
                                <div slot="body" class="body-section">

                                    @if(! empty($trackings['TrackSummary']))
                                        <div class="sale-section">
                                            <div class="section-content">
                                                <div class="row">
                                                    <span class="title">
                                                        {{ __('ggphp::usps.admin.system.event') }}
                                                    </span>
                                                    <span class="value">
                                                        {{ $trackings['TrackSummary']['Event'] ?? '' }}
                                                    </span>
                                                </div>

                                                <div class="row">
                                                    <span class="title">
                                                        {{ __('ggphp::usps.admin.system.date-time') }}
                                                    </span>
                                                    <span class="value">
                                                        {{ $trackings['TrackSummary']['EventDate'] ?? '' }} {{ $trackings['TrackSummary']['EventTime'] ?? '' }}
                                                    </span>
                                                </div>

                                                <div class="row">
                                                    <span class="title">
                                                        {{ __('ggphp::usps.admin.system.city') }}
                                                    </span>
                                                    <span class="value">
                                                        {{ $trackings['TrackSummary']['EventCity'] ?? '' }}
                                                    </span>
                                                </div>

                                                <div class="row">
                                                    <span class="title">
                                                        {{ __('ggphp::usps.admin.system.zip-code') }}
                                                    </span>
                                                    <span class="value">
                                                        {{ $trackings['TrackSummary']['EventZIPCode'] ?? '' }}
                                                    </span>
                                                </div>

                                                <div class="row">
                                                    <span class="title">
                                                        {{ __('ggphp::usps.admin.system.country') }}
                                                    </span>
                                                    <span class="value">
                                                        {{ $trackings['TrackSummary']['EventCountry'] ?? '' }}
                                                    </span>
                                                </div>

                                                <div class="row">
                                                    <span class="title">
                                                        {{ __('ggphp::usps.admin.system.firm-name') }}
                                                    </span>
                                                    <span class="value">
                                                        {{ $trackings['TrackSummary']['FirmName'] ?? '' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <p>{{ __('ggphp::usps.admin.system.no-data') }}</p>
                                    @endif

                                </div>
                            </accordian>
                            <accordian :title="'{{ __('ggphp::usps.admin.system.tracking-detail') }}'" :active="false">
                                <div slot="body" class="body-section">

                                    @if (! empty($trackings['TrackDetail']))
                                        @foreach ($trackings['TrackDetail'] as $key => $event)
                                            <div class="sale-section">
                                                <div class="secton-title">
                                                    <span>{{ __('ggphp::usps.admin.system.event') }} {{ $key }}:</span>
                                                </div>

                                                <div class="section-content">
                                                    <div class="row">
                                                        <span class="title">
                                                            {{ __('ggphp::usps.admin.system.event') }}
                                                        </span>
                                                        <span class="value">
                                                            {{ $event['Event'] ?? '' }}
                                                        </span>
                                                    </div>

                                                    <div class="row">
                                                        <span class="title">
                                                            {{ __('ggphp::usps.admin.system.date-time') }}
                                                        </span>
                                                        <span class="value">
                                                            {{ $event['EventDate'] ?? '' }} {{ $event['EventTime'] ?? '' }}
                                                        </span>
                                                    </div>

                                                    <div class="row">
                                                        <span class="title">
                                                            {{ __('ggphp::usps.admin.system.city') }}
                                                        </span>
                                                        <span class="value">
                                                            {{ $event['EventCity'] ?? '' }}
                                                        </span>
                                                    </div>

                                                    <div class="row">
                                                        <span class="title">
                                                            {{ __('ggphp::usps.admin.system.zip-code') }}
                                                        </span>
                                                        <span class="value">
                                                            {{ $event['EventZIPCode'] ?? '' }}
                                                        </span>
                                                    </div>

                                                    <div class="row">
                                                        <span class="title">
                                                            {{ __('ggphp::usps.admin.system.country') }}
                                                        </span>
                                                        <span class="value">
                                                            {{ $event['EventCountry'] ?? '' }}
                                                        </span>
                                                    </div>

                                                    <div class="row">
                                                        <span class="title">
                                                            {{ __('ggphp::usps.admin.system.firm-name') }}
                                                        </span>
                                                        <span class="value">
                                                            {{ $event['FirmName'] ?? '' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>{{ __('ggphp::usps.admin.system.no-data') }}</p>
                                    @endif

                                </div>
                            </accordian>
                        </div>
                    </div>
                @else
                    <div class="message">
                        <p>{{ $trackings['message'] }}<p>
                    </div>
                @endif

            </div>
        </div>
    </div>
@stop
