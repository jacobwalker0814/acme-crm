<?php

$app->path("myapp", function($request) use($app) {
    $app->path("contact", function($request) use($app) {
        // Ask App for a list of all contacts
        return $app->getView("contact_list");
    });
});
