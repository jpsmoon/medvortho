<?php
use Illuminate\Support\Str;
//access it via config('global.mdcl_provider_types');
return [
    'bill_provider_types' =>['Referring', 'Ordering', 'Supervising'],
    'mdcl_provider_types' => [

        [
            'id' => '1',
            'value' => 'Entity that provides physician network services'
        ],
        [
            'id' => '2',
            'value' => 'Insurer'
        ],
        [
            'id' => '3',
            'value' => 'Self-Insured Employer'
        ],
    ],

    'payer_types' => [
        '1' => "Value1",
        '2' => "Value2",
        '3' => "Value3",
    ],

    'formStatus' => [
        'complete' => "Completed",
        'incomplete' => "Incomplete",
        'accept' => "Accepted",
        'reject' => "Rejected",
        'process' => "Processed",
        'sent' => "Sent",
        'close' => "Closed"
    ]
];