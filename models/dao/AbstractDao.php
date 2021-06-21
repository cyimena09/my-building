<?php


abstract class AbstractDao {
    protected $connection;
    protected $table;

    public function __construct($table) {
        $this->table = $table;
        $this->connection = new PDO('mysql:host=localhost;dbname=my-building; charset=utf8', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getDataByFilter($filter, $value) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} a  WHERE {$filter} = ?");
            $statement->execute([
                $value
            ]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
           return $this->instantiateAll($result);

        } catch (PDOException $e) {
            print $e->getMessage();
            return null;
        }
    }

    public function instantiate($result) {
        var_dump('no override');
        return null;
    }

    public function instantiateAll($results) {
        $list = array();
        foreach ($results as $result) {
            array_push($list, $this->instantiate($result));
        }
        return $list;
    }

}