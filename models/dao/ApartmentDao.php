<?php


class ApartmentDao extends AbstractDao {

    public function __construct() {
        // call parent constructor (AbstractDAO)
        parent::__construct('apartment');
    }

    public function getApartments() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->instantiateAll($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function getApartmentById($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE idApartment = ?");
            $statement->execute([
                $id
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $this->instantiate($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function getApartmentsByBuildingId($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE fkBuilding = ?");
            $statement->execute([
                $id
            ]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->instantiateAll($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function createApartment($data) {
        if (empty($data['name'])) {
            return false;
        }

        $apartment = $this->instantiate($data);

        if ($apartment) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (name) VALUES (?)"
                );
                $statement->execute([
                    htmlspecialchars($apartment->__get('name')),
                ]);
                return true;
            } catch (PDOException $e) {
                print $e->getMessage();
                return false;
            }
        }
    }

    public function instantiate ($result) {
        return new Apartment(
            !empty($result['idApartment']) ? $result['idApartment'] : 0,
            $result['name']
        );
    }

    public function instantiateAll($results) {
        $productList = array();
        foreach ($results as $result) {
            array_push($productList, $this->instantiate($result));
        }
        return $productList;
    }

}