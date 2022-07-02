<?php

return [
    'database' => [
        'db_name' => 'chiperz',
        'db_user' => 'admin59789',
        'db_pwd' => '14LNhCcIl7XlafU1',
        'db_driver' => 'mysql',
        'db_port' => '3306',
        'db_host' => 'localhost',
        'db_prefix' => 'chiperz_'
    ],
    'app' => [
        'app_name' => 'Chiperz',
        'app_description' => 'Ma mega application',
        'app_routing' => 'routes.yml',
        'app_setup' => false,
        'app_forbiddenCrawl' => [
            '/public/',
            '/setup/',
            '/admin/'
        ]
    ],
    'sites_key' => [
        'yandex-verification' => 'yandex-verification',
        'p:domain_verify' => 'p:domain_verify',
    ],
    'development'=> [
        'dev_debug' => true,
    ],
];
