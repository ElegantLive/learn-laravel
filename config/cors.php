<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */

    'supportsCredentials'    => false,
    'allowedOrigins'         => ['*'],
    'allowedOriginsPatterns' => [],
    'allowedHeaders'         => ['Content-Type', 'X-Requested-With', 'token', 'Origin', 'Accept', 'current-version'],
    'allowedMethods'         => ['POST', 'GET', 'OPTION', 'PATCH', 'PUT', 'DELETE'],
    'exposedHeaders'         => [],
    'maxAge'                 => 0,
];
