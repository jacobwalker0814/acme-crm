<?php

require_once "app/app.php";

$app->path("/", function($request) use($app) {
    return "Hello, world!";
});

echo $app->run(new \Bullet\Request());
