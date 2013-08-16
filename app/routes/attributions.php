<?php

$app->path("attributions", function($request) use($app) {
    return $app->template("attributions")->set(array("app" => $app));
});
