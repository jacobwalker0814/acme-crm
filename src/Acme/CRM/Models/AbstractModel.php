<?php

namespace Acme\CRM\Models;

abstract class AbstractModel
{
    /**
     * @var \PDO
     */
    protected $connection;

    /**
     * Array of data representing the active record
     * @var array
     */
    protected $data;

    /**
     * Array of columns in the active table. Populated in the constructor and
     * used to define INSERT and UPDATE queries.
     *
     * @var array
     */
    protected $columns;

    final public function __construct(\PDO $connection)
    {
        // Ensure that child classes define the table and primary key
        // attributes so we can query appropriately.
        if (!isset($this->_table)) {
            throw new \LogicException("Class " . __CLASS__ . " must have a property \"_table\"");
        }
        if (!isset($this->_pk)) {
            throw new \LogicException("Class " . __CLASS__ . " must have a property \"_pk\"");
        }

        $this->data = array();
        $this->connection = $connection;

        // Next populate our list of columns by running DESCRIBE on the table
        $columns = $this->connection->query("DESCRIBE `{$this->_table}`");
        foreach($columns->fetchAll(\PDO::FETCH_ASSOC) as $column) {
            $this->columns[] = $column['Field'];
        }
    }

    /**
     * Returns the columns in this table that are not the primary key.
     */
    protected function getDataColumns()
    {
        // Make local copy of pk so it can be used in closure
        $pk = $this->_pk;

        return array_filter($this->columns, function($col) use ($pk) {
            return $col !== $pk;
        });
    }

    /**
     * Persist the active record to the database.
     *
     * @return \Acmr\CRM\Modles\AbstractModel
     */
    public function save()
    {
        if (isset($this->data[$this->_pk]) && $this->data[$this->_pk]) {
            // Start an update query
            $query = "UPDATE `{$this->_table}` SET ";
        } else {
            // Start an insert query
            $query = "INSERT INTO `{$this->_table}` SET ";
        }

        foreach($this->getDataColumns() as $column) {
            // Build up our comma seperated list of column setters
            $query .= "`{$column}` = :{$column},";
        }

        // Trim the last comma off
        $query = rtrim($query, ",");

        if (isset($this->data[$this->_pk]) && $this->data[$this->_pk]) {
            // Finish our update query by specifying the ID
            $query .= " WHERE `{$this->_pk}` = :{$this->_pk}";
        } else {
            // Add the pk to our list of columns to insert.
            $query .= ", `{$this->_pk}` = :{$this->_pk}";
        }

        $statement = $this->connection->prepare($query);

        foreach($this->columns as $column) {
            // Bind our data to the column placeholders
            $statement->bindParam(":{$column}", $this->data[$column]);
        }

        try {
            $this->connection->beginTransaction();
            $statement->execute();
            // If we don't already have a primary key then set it
            if (!isset($this->data[$this->_pk]) || !$this->data[$this->_pk]) {
                $this->data[$this->_pk] = $this->connection->lastinsertid();
            }
            $this->connection->commit();
        } catch (\PDOException $e) {
            // Log failure and rethrow a generic exception
            trigger_error($e->getMessage());
            $this->connection->rollback();
            throw new \RunTimeException("Error persisting record.");
        }


        return $this;
    }

    /**
     * Query the database to load the record identified by $id
     *
     * @param int $id
     *
     * @return \Acmr\CRM\Modles\AbstractModel
     */
    public function load($id)
    {
        $statement = $this->connection->prepare("SELECT * FROM `{$this->_table}` WHERE `{$this->_pk}` = :pk");
        $statement->bindParam(":pk", $id, \PDO::PARAM_INT);
        $statement->execute();

        $this->data = $statement->fetch(\PDO::FETCH_ASSOC);

        return $this;
    }

    /**
     * Delete the active record. Will unset local data and delete the record.
     *
     * @return \Acmr\CRM\Modles\AbstractModel
     */
    public function delete()
    {
        if (isset($this->data[$this->_pk]) && $this->data[$this->_pk]) {
            $statement = $this->connection->prepare("DELETE FROM `{$this->_table}` WHERE `{$this->_pk}` = :pk");
            $statement->bindParam(":pk", $this->data[$this->_pk], \PDO::PARAM_INT);
            $statement->execute();
        }

        $this->data = array();

        return $this;
    }

    /**
     * Return data about the active record. Will return all of the data is $key
     * is not provided or false. Otherwise this will return only the requested
     * column.
     *
     * @param mixed $key
     */
    public function getData($key=false)
    {
        return false === $key ? $this->data : $this->data[$key];
    }

    /**
     * Change data about the active record. If an array is provided for the
     * first parameter then the entire dataset is replaced. If the first
     * parameter is not an array then just that specified parameter will be set
     *
     * @param mixed $arr
     * @param mixed $value
     *
     * @return \Acmr\CRM\Modles\AbstractModel
     */
    public function setData($arr, $value=false)
    {
        if (is_array($arr)) {
            $this->data = $arr;
        } else {
            $this->data[$arr] = $value;
        }

        return $this;
    }
}
