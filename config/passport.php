<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Encryption Keys
    |--------------------------------------------------------------------------
    |
    | Passport uses encryption keys while generating secure access tokens for
    | your application. By default, the keys are stored as local files but
    | can be set via environment variables when that is more convenient.
    |
    */

    'private_key' => env('PASSPORT_PRIVATE_KEY'),

    'public_key' => env('PASSPORT_PUBLIC_KEY'),

    'default_client' => [
        'grant_type' => 'password',
        'client_id' => env('PASSPORT_CLIENT_ID', 1),
        'client_secret' => env('PASSPORT_CLIENT_SECRET', 'deO2gwtq35kzs0rTgQwX7SGLSmvb5EliHB3Z7Uj7'),
        'scope' => '*'
    ],
];