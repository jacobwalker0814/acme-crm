<?php

$app->path("myapp", function($request) use($app) {
    $app->path("contact", function($request) use($app) {
        // Factory for all paths below
        $factory = $app->getFactory("Contact");
        $view    = $app->getView("contact_list");

        // Add the list of all contacts to the view. This is done regardless of
        // further pathing because we show the contact list on every page.
        $view->set("contacts", $factory->findAll());

        // Return general contact list
        $app->get(function($request) use($app, $factory, $view) {
            return $view;
        });

        // Possibly looking for a specific contact
        $app->path("view", function($request) use($app, $factory, $view) {
            // Handle requests to /myapp/contact/view without an id
            $app->get(function($request) use($app, $factory, $view) {
                return $view;
            });

            $app->param('int', function($request, $id) use($app, $factory, $view) {
                return $view->set("current_contact", $factory->find($id));
            });
        });
    });
});
