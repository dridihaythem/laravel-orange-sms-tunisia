<?php

return [
    'enable_log' => env('ORANGE_SMS_TUNISIA_ENABLE_LOG', true),

    'log_table' => env('ORANGE_SMS_TUNISIA_LOG_TABLE', 'orange_sms_tunisia_logs'),

    'authorization_header' => env('ORANGE_SMS_TUNISIA_AUTHORIZATION_HEADER', null),

    'sender' => env('ORANGE_SMS_TUNISIA_SENDER', null),

    'dashboard' => [

        'enable' => env('ORANGE_SMS_TUNISIA_DASHBOARD_ENABLE', true),

        'route' => env('ORANGE_SMS_TUNISIA_DASHBOARD_ROUTE', 'orange-sms-tunisia-dashboard'),

        'middleware' => ['web']

    ]
];
