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
            //print $e->getMessage();
            return false;
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
            //print $e->getMessage();
            return false;
        }
    }

    public function createApartment($data) {
        if (empty($data['name']) ||
            empty($data['idBuilding'])) {

            return false;
        }

        $apartment = new Apartment(null, $data['name'], null, null, null, $data['idBuilding']);

        if ($apartment) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (name, fkBuilding) VALUES (?, ?)"
                );
                $statement->execute([
                    htmlspecialchars($apartment->__get('name')),
                    htmlspecialchars($apartment->__get('building')),
                ]);

                return true;
            } catch (PDOException $e) {
                //print $e->getMessage();
                return false;
            }
        }
    }

    /**
     * @param $id
     * @param $data array
     * @return false
     */
    public function updateApartment($id, $data) {
        if (empty($id || empty($data))) {
            return false;
        }

        try {
            $statement = $this->connection->prepare(
                "UPDATE {$this->table} SET name = ?, fkOwner = ? WHERE idApartment = ?");
            $statement->execute([
                htmlspecialchars($data['name']),
                isset($data['owner']) ? $data['owner'] : null,
                htmlspecialchars($id)
            ]);

            return true;
        } catch (PDOException $e) {
            //print $e->getMessage();
            return false;
        }
    }

    public function deleteApartment($id) {
        if (empty($id)) {
            return false;
        }

        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE idApartment = ?");
            $statement->execute([
                $id
            ]);

            return true;
        } catch (PDOException $e) {
            //print $e->getMessage();
            return false;
        }
    }

    /**
     * Méthode à utiliser lorsque l'on récupère les données depuis la db
     * sinon utiliser la méthode d'instanciation classique  ex : '$object = new Object()'
     * @param $result
     * @return Apartment
     */
    public function instantiate($result) {
        // récupération de la résidence
        $building = new Building($result['fkBuilding'], null, null, null);
        // récupération du propriétaire
        $userDao = new UserDao();
        $owner = $userDao->getUserById($result['fkOwner']);
        // récupération des locataires
        $tenants = $userDao->getDataByFilter('fkApartment', $result['idApartment']);
        // nombre de locataire
        $nbTenants = count($tenants);

        return new Apartment(
            $result['idApartment'],
            $result['name'],
            $owner,
            $tenants,
            $nbTenants,
            $building);
    }

}