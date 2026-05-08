<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */
    'termii' => [
        'base_url' => rtrim(env('TERMII_BASE_URL', 'https://api.ng.termii.com'), '/'),
        'key' => env('TERMII_API_KEY', env('TERMII_KEY')),
        'sender_id' => env('TERMII_SENDER_ID', 'Elitewashng'),
        'whatsapp_sender' => env('TERMII_WHATSAPP_SENDER', env('TERMII_SENDER_ID', 'Elitewashng')),
        'whatsapp_device_id' => env('TERMII_WHATSAPP_DEVICE_ID'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
