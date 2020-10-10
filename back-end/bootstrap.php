<?php 
require_once __DIR__."/vendor/autoload.php";

$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$app = new \Slim\App($config);


require_once __DIR__."/src/Routes/web.php";
require_once __DIR__."/src/Routes/api.php";

$app->run();