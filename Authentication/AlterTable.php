<?php

/* a class for manipulate a database table */
/* contains simple functions for simple querys */

require_once("User.php");

class AlterTable {

    protected $tableName;
    protected $connection;

    public function __construct($tableName, Connection $connection) {
        if ($connection == NULL) {
            echo "Connect to a database first pls ty!";
            die();
        }
        else {
            $this->connection = $connection->createConnection();
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        $this->tableName = $tableName;
    }
    
    /*execute a user query */
    public function select($query) {
        return $data = $this->connection->query($query)->fetch();
    }

    public function getAll() {
        $query = "SELECT * FROM $this->tableName";
        return $this->connection->query($query)->fetch();
    }

    public function deleteAll() :void {
        $query = "DELETE FROM $this->tableName";
        $this->connection->query($query);
    }

    public function getRecord($attribute, $value) {
        $query = "SELECT * FROM $this->tableName WHERE $attribute = '$value'";
        //echo $query;
        if ($this->connection->query($query) != false)
            return $this->connection->query($query)->fetch();
    }

    public function deleteRecord($attribute, $value) :void {
        $query = "DELETE FROM $this->tableName WHERE $attribute = '$value'";
        $this->connection->query($query);

    }

    public function insert(Array $data) :void {
        $attributes = implode(",", array_keys($data));
        $values  = implode(",", $this->formatValues(array_values($data)));
        $query = "INSERT INTO $this->tableName ($attributes) VALUES ($values)";
        $this->connection->query($query);
    }

    /*generate data in form of ('column1 = 'value1', column2 = 'value2')
    so they can be used on an update request*/
    private function generateData(Array $data) {
        $columnValues = array();
        for ($i=0; $i<count($data); $i++)
            array_push($columnValues, sprintf("%s='%s'", array_keys($data)[$i], array_values($data)[$i]));
        return implode(",", $columnValues);
        
    }
    public function update(Array $data, $attribute, $value) :void {
        $columnValues = $this->generateData($data);
        $query = "UPDATE $this->tableName SET $columnValues WHERE $attribute = '$value'";
        $this->connection->query($query);
    }
    
    /*generate data in a form of ['$value1', 'value2',...] so they can be used in an insert request*/
    private function formatValues($values) {
        $formatedValues = array();
        foreach($values as $value) {
            array_push($formatedValues, sprintf("'%s'", $value));
        }
        return $formatedValues;
    }
}
?>