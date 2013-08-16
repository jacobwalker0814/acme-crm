<?php

$app->path("attributions", function($request) use($app) {
    return $app->getView("attributions");
});
