<?php

return [
    [
        'key'    => 'sales.carriers.uspsrate',
        'name'   => 'ggphp::usps.admin.system.usps-rate-shipping',
        'sort'   => 6,
        'fields' => [
            [
                'name'          => 'title',
                'title'         => 'admin::app.admin.system.title',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => true,
                'locale_based'  => true,
            ], [
                'name'          => 'description',
                'title'         => 'admin::app.admin.system.description',
                'type'          => 'textarea',
                'channel_based' => true,
                'locale_based'  => false,
            ], [
                'name'          => 'default_rate',
                'title'         => 'admin::app.admin.system.rate',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => true,
                'locale_based'  => false,
            ], [
                'name'          => 'active',
                'title'         => 'admin::app.admin.system.status',
                'type'          => 'boolean',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'          => 'user_ID',
                'title'         => 'ggphp::usps.admin.system.user-ID',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => true,
                'locale_based'  => true,
            ], [
                'name'          => 'password',
                'title'         => 'ggphp::usps.admin.system.password',
                'type'          => 'password',
                'validation'    => 'required',
                'channel_based' => true,
                'locale_based'  => true,
            ], [
                'name'          => 'production_mode',
                'title'         => 'ggphp::usps.admin.system.production-mode',
                'type'          => 'boolean',
                'channel_based' => true,
                'locale_based'  => true,
            ], [
                'name'          => 'container',
                'title'         => 'ggphp::usps.admin.system.container',
                'type'          => 'select',
                'options'       => [
                    [
                        'title' => 'Variable',
                        'value' => 'VARIABLE',
                    ], [
                        'title' => 'Small Flat-Rate Box',
                        'value' => 'SM FLAT RATE BOX',
                    ], [
                        'title' => 'Medium Flat-Rate Box',
                        'value' => 'MD FLAT RATE BOX',
                    ], [
                        'title' => 'Large Flat-Rate Box',
                        'value' => 'LG FLAT RATE BOX',
                    ], [
                        'title' => 'Flat-Rate Envelope',
                        'value' => 'FLAT RATE ENVELOPE',
                    ], [
                        'title' => 'Small Flat-Rate Envelope',
                        'value' => 'SM FLAT RATE ENVELOPE',
                    ], [
                        'title' => 'Window Flat-Rate Envelope',
                        'value' => 'GIFT CARD FLAT RATE ENVELOPE',
                    ], [
                        'title' => 'Legal Flat-Rate Envelope',
                        'value' => 'LEGAL FLAT RATE ENVELOPE',
                    ], [
                        'title' => 'Padded Flat-Rate Envelope',
                        'value' => 'PADDED FLAT RATE ENVELOPE',
                    ], [
                        'title' => 'Rectangular',
                        'value' => 'RECTANGULAR',
                    ], [
                        'title' => 'Non-rectangular',
                        'value' => 'GIFT CARD FLAT RATE ENVELOPE',
                    ], [
                        'title' => 'Window Flat-Rate Envelope',
                        'value' => 'NONRECTANGULAR',
                    ]
                ],
                'channel_based' => true,
                'locale_based'  => true,
            ], [
                'name'          => 'size',
                'title'         => 'ggphp::usps.admin.system.size',
                'type'          => 'select',
                'options'    => [
                    [
                        'title' => 'Regular',
                        'value' => 'REGULAR',
                    ], [
                        'title' => 'Large',
                        'value' => 'LARGE',
                    ]
                ],
                'channel_based' => true,
                'locale_based'  => true,
            ], [
                'name'          => 'machinable',
                'title'         => 'ggphp::usps.admin.system.machinable',
                'type'          => 'select',
                'options'    => [
                    [
                        'title' => 'Yes',
                        'value' => 'true',
                    ], [
                        'title' => 'No',
                        'value' => 'false',
                    ]
                ],
                'channel_based' => true,
                'locale_based'  => true,
            ], [
                'name'          => 'allowed_methods',
                'title'         => 'ggphp::usps.admin.system.allowed-methods',
                'type'          => 'multiselect',
                'options'    => [
                    [
                        'title' => 'All',
                        'value' => 'ALL',
                    ], [
                        'title' => 'First Class',
                        'value' => 'FIRST CLASS',
                    ], [
                        'title' => 'First Class Commercial',
                        'value' => 'FIRST CLASS COMMERCIAL',
                    ], [
                        'title' => 'First Class HFP Commercial',
                        'value' => 'FIRST CLASS HFP COMMERCIAL',
                    ], [
                        'title' => 'Priority',
                        'value' => 'PRIORITY COMMERCIAL',
                    ], [
                        'title' => 'Priority HFP Commercial',
                        'value' => 'PRIORITY HFP COMMERCIAL',
                    ], [
                        'title' => 'Express',
                        'value' => 'EXPRESS',
                    ], [
                        'title' => 'Express Commercial',
                        'value' => 'EXPRESS COMMERCIAL',
                    ], [
                        'title' => 'Express SH',
                        'value' => 'EXPRESS SH',
                    ], [
                        'title' => 'Express SH Commercial',
                        'value' => 'EXPRESS SH COMMERCIAL',
                    ], [
                        'title' => 'Express HFP',
                        'value' => 'EXPRESS HFP',
                    ], [
                        'title' => 'Express HFP Commercial',
                        'value' => 'EXPRESS HFP COMMERCIAL',
                    ], [
                        'title' => 'Parcel',
                        'value' => 'PARCEL',
                    ], [
                        'title' => 'Media',
                        'value' => 'MEDIA',
                    ], [
                        'title' => 'Library',
                        'value' => 'LIBRARY',
                    ], [
                        'title' => 'Online',
                        'value' => 'ONLINE',
                    ]
                ],
                'channel_based' => true,
                'locale_based'  => true,
            ], [
                'name'          => 'first_class_mail_type',
                'title'         => 'ggphp::usps.admin.system.first-class-mail-type',
                'type'          => 'select',
                'options'       => [
                    [
                        'title' => '',
                        'value' => '',
                    ],
                    [
                        'title' => 'Letter',
                        'value' => 'LETTER',
                    ], [
                        'title' => 'Flat',
                        'value' => 'FLAT',
                    ], [
                        'title' => 'Parcel',
                        'value' => 'PARCEL',
                    ], [
                        'title' => 'Postcard',
                        'value' => 'POSTCARD',
                    ], [
                        'title' => 'Package',
                        'value' => 'PACKAGE',
                    ], [
                        'title' => 'Package Service',
                        'value' => 'PACKAGE SERVICE',
                    ]
                ],
                'channel_based' => true,
                'locale_based'  => true,
            ]
        ]
    ]
];
