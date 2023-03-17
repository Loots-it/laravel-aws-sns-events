<?php

return [
    'topics' => [
        // Add your sns topics here in the following format:
        // TopicArn -> EventClass that should be dispatched
    ],

    'cert_client' => [
        'active' => true,
        'cache_prefix' => 'loots_it_aws_sns',
        'cache_store' => env('CERT_CLIENT_CACHE_STORE', env('CACHE_DRIVER', 'file')),
    ],
];