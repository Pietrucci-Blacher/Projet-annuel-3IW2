<?php return [
  'database' => [
    'db_name' => 'aaaaa',
    'db_user' => 'root',
    'db_pwd' => 'ccccce',
    'db_driver' => 'mysql',
    'db_port' => '3306',
    'db_host' => 'eeee',
    'db_prefix' => 'aaaaaa',
  ],
  'app' => [
    'app_name' => 'toto',
    'app_email' => 'toto',
    'app_description' => 'Ma mega application',
    'app_setup' => true,
    'app_forbiddenCrawl' => [
      0 => '/public/',
      1 => '/setup/',
      2 => '/admin/',
    ],
  ],
  'sites_key' => [
    'yandex-verification' => 'yandex-verification',
    'alexaVerifyID' => 'alexaVerifyID',
    'p:domain_verify' => 'p:domain_verify',
  ],
  'development' => [
    'dev_debug' => true,
  ],
];