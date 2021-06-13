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
        if (empty($data['name']) ||
            empty($data['fkBuilding'])) {

            return false;
        }

        $building = new Building($data['fkBuilding'], null);
        $apartment = new Apartment(null, $data['name'], null, $building);

        if ($apartment) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (name, fkBuilding) VALUES (?, ?)"
                );
                $statement->execute([
                    htmlspecialchars($apartment->__get('name')),
                    htmlspecialchars($apartment->__get('building')->id),
                ]);
                return true;
            } catch (PDOException $e) {
                print $e->getMessage();
                return false;
            }
        }
    }

    /**
     * Méthode à utiliser lorsque l'on récupère les données depuis la db
     * sinon utiliser la méthode d'instanciation classique  ex : '$object = new Object()'
     * @param $result
     * @return Apartment
     */
    public function instantiate($result) {
        return new Apartment(
            !empty($result['idApartment']) ? $result['idApartment'] : 0,
            $result['name'],
            !empty($result['fkOwner']) ? $result['fkOwner'] : null,
            $result['fkBuilding']
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