<?php

$app->path("contacts", function($request) use($app) {
    // Factory for all paths below
    $factory = $app->getFactory("Contact");
    $view    = $app->getView("contacts");

    // Add the list of all contacts to the view. This is done regardless of
    // further pathing because we show the contact list on every page.
    $view->set("contacts", $factory->findAll());

    // GET /contacts : Return general contact list
    $app->get(function($request) use($app, $factory, $view) {
        return $view;
    });

    $app->param('int', function($request, $id) use($app, $factory, $view) {
        $contact = $factory->find($id);
        $view->set("current_contact", $contact);

        // GET /contacts/n : Fetch a particular contact
        $app->get(function($request) use($app, $view) {
            return $view;
        });

        // POST /contacts/n : Update or create contact
        $app->post(function($request) use($app, $view, $contact, $factory) {
            $contact->setData("name", $request->post("input-name"));
            $contact->setData("email", $request->post("input-email"));
            try {
                $contact->save();
                $response = new \Bullet\Response();
                return $response->redirect("/contacts/" . $contact->getData("id"));
            } catch(\Exception $e) {
                $view->set("error", "There was an error saving your contact.");
                return $view;
            }
        });

        // GET /contacts/n/delete : Delete current contact
        // I would rather use HTTP DELETE for this but that isn't supported
        // directly in forms and I needed to wrap things up
        $app->path("delete", function($request) use($app, $view, $contact, $factory) {
            try {
                $contact->delete();
                $response = new \Bullet\Response();
                return $response->redirect("/contacts/");
            } catch(\Exception $e) {
                $view->set("error", "There was an error deleting the contact.");
                return $view;
            }
        });
    });
});
