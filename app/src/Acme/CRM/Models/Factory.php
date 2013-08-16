<?php

namespace Acme\CRM\Models;

class Factory
{
    /**
     * Database connection
     *
     * @var \PDO
     */
    protected $connection;

    /**
     * The class name of the model that this factory returns
     *
     * @var string
     */
    protected $model_name;

    /**
     * The table name of the target model
     *
     * @var string
     */
    protected $_table;

    /**
     * The primary key of the target model
     *
     * @var string
     */
    protected $_pk;

    public function __construct(\PDO $connection, $class)
    {
        $this->connection = $connection;

        $class = "\\Acme\\CRM\\Models\\{$class}";
        if (!class_exists($class)) {
            throw new \LogicException("Requested model class {$class} does not exist.");
        }

        $this->model_name = $class;

        // Use reflection to get the values of _table and _pk from class
        // without actually instantiating a new record
        $reflection_class = new \ReflectionClass($this->model_name);
        $properties = $reflection_class->getDefaultProperties();

        if (!isset($properties["_table"])) {
            throw new \LogicException("Class {$this->model_name} must have a property \"_table\"");
        }
        if (!isset($properties["_pk"])) {
            throw new \LogicException("Class {$this->model_name} must have a property \"_pk\"");
        }

        $this->_table = $properties["_table"];
        $this->_pk    = $properties["_pk"];
    }

    public function model()
    {
        return new $this->model_name($this->connection);
    }

    public function find($id)
    {
        return $this->model()->load($id);
    }

    public function findAll()
    {
        $models = array();

        $statement = $this->connection->query("SELECT `{$this->_pk}` FROM `{$this->_table}`");
        foreach($statement->fetchAll(\PDO::FETCH_ASSOC) as $record) {
            $models[] = $this->model()->load($record[$this->_pk]);
        }

        return $models;
    }
}
