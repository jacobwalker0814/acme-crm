<?php

// Hook in Composer's autoloader
require_once __DIR__ . "/../vendor/autoload.php";

// Constant used in App to easily path fromt his point
define("ACME_CRM_APP_DIR", __DIR__);

// Instantiate the Bullet app
$app = new \Acme\CRM\App(__DIR__ . "/config/config.ini");

// Include all of our configured routes
foreach(glob(__DIR__ . "/routes/*php") as $route) {
    require_once $route;
}

// Serve our custom content on a 404
$app->on(404, function(\Bullet\Request $request, \Bullet\Response $response) use($app) {
        $response->content($app->template('404')->layout(false)->content());
});
