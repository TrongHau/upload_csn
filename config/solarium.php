<?php

return [
    'endpoint' => [
        'localhost' => [
            'host' => env('SOLR_HOST', '127.0.0.1'),
            'port' => env('SOLR_PORT', '8983'),
            'path' => env('SOLR_PATH', '/solr/'),
            'username' => env('SOLR_USERNAME', 'user'),
            'password' => env('SOLR_PASSWORD', 'password'),
            
            'timeout' => 500,
            'core' => env('SOLR_CORE', 'collection1')
        ]
    ]
];