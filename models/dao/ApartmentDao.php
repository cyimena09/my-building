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

    /**
     * Récupère les appartements d'un immeuble, retourne également le nombre de locataire par appartement
     * @param $id
     * @return array
     */
    public function getApartmentsByBuildingId($id) {
        try {
            $statement = $this->connection->prepare("SELECT a.idApartment, a.name, a.fkOwner, a.fkBuilding, COUNT(u.idUser) AS nbTenants
                                                                FROM {$this->table} a LEFT JOIN user u ON u.fkApartment = a.idApartment 
                                                                WHERE a.fkBuilding = ? 
                                                                GROUP BY a.idApartment");
            $statement->execute([
                $id
            ]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $apartments = $this->instantiateAll($result);

            foreach ($apartments as $apartment) {
                if ($apartment->nbTenants == null) {
                    $apartment->nbTenants = 0;
                }
            }
            return $apartments;
        } catch (PDOException $e) {
            //print $e->getMessage();
            return null;
        }
    }

    public function getApartmentsByFilter($filter, $value) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE {$filter} = ?");
            $statement->execute([
                $value
            ]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->instantiateAll($result);
        } catch (PDOException $e) {
            //print $e->getMessage();
            return null;
        }
    }

    public function createApartment($data) {
        if (empty($data['name']) ||
            empty($data['idBuilding'])) {

            return false;
        }

        $apartment = new Apartment(null, $data['name'], null, $data['idBuilding']);

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
        $apartment =  new Apartment(
            !empty($result['idApartment']) ? $result['idApartment'] : 0,
            $result['name'],
            !empty($result['fkOwner']) ? $result['fkOwner'] : null,
            $result['fkBuilding']);

        if(!empty($result['nbTenants'])) {
            $apartment->nbTenants = $result['nbTenants'];
        }
        return $apartment;
    }

}