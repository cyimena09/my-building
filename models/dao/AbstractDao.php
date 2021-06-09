<?php


abstract class AbstractDao {
    protected $connection;
    protected $table;

    public function __construct($table) {
        $this->table = $table;
        $this->connection = new PDO('mysql:host=localhost;dbname=my-building; charset=utf8', 'root', 'admin');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}