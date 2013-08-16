<?php

namespace Acme\CRM;

class ViewHelper
{
    /**
     * @var App
     */
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * Returns an html class to add to a nav link for the given route
     *
     * @param string $route
     *
     * @return string
     */
    public function getNavClass($route)
    {
        return $route == $this->app->request()->url() ? "active" : "";
    }
}
