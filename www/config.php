<?php

return [
    'database' => [
        'dbname' => 'chiperz',
        'dbuser' => 'admin59789',
        'dbpwd' => '14LNhCcIl7XlafU1',
        'dbdriver' => 'mysql',
        'dbport' => '3306',
        'dbhost' => 'localhost',
        'dbprefixe' => 'chiperz_'
    ],
    'captcha' => [
        'sitekey' => '10000000-ffff-ffff-ffff-000000000001',
    ],
    'app' => [
        'name' => 'Chiperz',
        'description' => 'Ma mega application',
        'routing' => 'routes.yml',
        'setup' => false,
        'forbiddenCrawl' => [
            '/public/',
            '/setup/',
            '/admin/'
        ]
    ],
    'developpement'=> [
        'debug' => true,
    ],
];
