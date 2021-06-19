<?php


class RoleDao extends AbstractDao {

    public function __construct() {
        // call parent constructor (AbstractDAO)
        parent::__construct('role');
    }

    public function getRoles() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->instantiateAll($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function getRoleById($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE idRole = ?");
            $statement->execute([
                $id
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $this->instantiate($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function instantiate($result) {
        return new Role(
            !empty($result['idRole']) ? $result['idRole'] : 0,
            $result['name']);
    }

}