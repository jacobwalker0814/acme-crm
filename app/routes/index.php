<?php

// Simply route a request to root to our index template
$app->path("/", function($request) use($app) {
    return $app->getView("index");
});

