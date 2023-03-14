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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => '508636168520-sedcjq1iqbiiprq60e0mdbs2t1i87rvd.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://the-syringe.com/auth/google/callback',
    ], 

    'facebook' => [
        'client_id' => env('FACEBOOK_ID','531929842356807'),
        'client_secret' => env('FACEBOOK_SECRET','bdf616b89828f461a41e26a0eb6a0928'),
        'redirect' => env('FACEBOOK_URL','https://the-syringe.com/auth/facebook/callback'),
    ],

    'linkedin' => [
        'client_id' => '77031j3glcm689',
        'client_secret' => '8hmYeGBsAZ7wbVKz',
        'redirect' => 'https://the-syringe.com/auth/linkedin/callback',
    ], 

];
