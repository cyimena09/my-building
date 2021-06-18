<?php


abstract class AbstractDao {
    protected $connection;
    protected $table;

    public function __construct($table) {
        $this->table = $table;
        $this->connection = new PDO('mysql:host=localhost;dbname=my-building; charset=utf8', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function instantiate($result) {
        var_dump('no override');
        return null;
    }

    public function instantiateAll($results) {
        $productList = array();
        foreach ($results as $result) {
            array_push($productList, $this->instantiate($result));
        }
        return $productList;
    }

}