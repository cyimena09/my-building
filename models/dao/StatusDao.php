<?php


class StatusDao extends AbstractDao {

    public function __construct() {
        // call parent constructor (AbstractDAO)
        parent::__construct('status');
    }

    public function getStatus() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $this->instantiateAll($result);
        } catch (PDOException $e) {
            //print $e->getMessage();
            return false;
        }
    }

    public function getStatusById($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE idStatus = ?");
            $statement->execute([
                $id
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $this->instantiate($result);
        } catch (PDOException $e) {
            //print $e->getMessage();
            return false;
        }
    }

    public function instantiate($result) {
        return new Status(
            !empty($result['idStatus']) ? $result['idStatus'] : 0,
            $result['statusName']);
    }

}