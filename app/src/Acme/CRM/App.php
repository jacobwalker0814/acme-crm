<?php

namespace Acme\CRM;

class App extends \Bullet\App
{
    protected $connection;

    /**
     * Set up the environment of the app by passing in the path to the config
     * file to use.
     */
    public function __construct($config_path)
    {
        if (!file_exists($config_path)) {
            throw new \LogicException("The file {$config_path} must be present.");
        }

        $config = parse_ini_file($config_path);

        $this->connection = new \PDO("mysql:dbname={$config['database']};host={$config['host']}", $config['username'], $config['password']);

        parent::__construct(array(
            'template' => array(
                'path'         => ACME_CRM_APP_DIR . '/templates/',
                'path_layouts' => ACME_CRM_APP_DIR . '/templates/layouts/',
                'auto_layout'  => 'application'
            )
        ));
    }

    /**
     * Factory function to get a database injected model class
     *
     * @param string $class The name of the model assuming \Acme\CRM\Models
     *                      will be prepended
     *
     * @return \Acme\CRM\Models\AbstractModel
     */
    public function getModel($class)
    {
        $class = "\\Acme\\CRM\\Models\\{$class}";
        if (!class_exists($class)) {
            throw new \LogicException("Requested model class {$class} does not exist.");
        }

        return new $class($this->connection);
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
        return $route == $this->request()->url() ? "active" : "";
    }
}
