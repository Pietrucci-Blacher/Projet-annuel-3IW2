return [
    'database' => [
        'dbname' => 'mvcdocker2',
        'dbuser' => 'root',
        'dbpwd' => 'mysql',
        'dbdriver' => 'mysql',
        'dbport' => '3306',
        'dbhost' => 'mvcdocker2',
        'dbprefixe' => 'esgi_'
    ],
    'captcha' => [
        'sitekey' => '10000000-ffff-ffff-ffff-000000000001',
    ],
    'app' => [
      'name' => 'Chiperz',
      'description' => 'Ma mega application',
      'routing' => 'routes.yml'
    ],
    'developpement'=> [
        'debug' => true,
    ],
];
