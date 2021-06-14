<?php


class BuildingDao extends AbstractDao {

    public function __construct() {
        // call parent constructor (AbstractDAO)
        parent::__construct('building');
    }

    public function getBuildings() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->instantiateAll($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    /**
     * Récupère tous les buildings avec le nombre d'appartment qu'ils possèdent et leur adresse
     * @return array
     */
    public function getBuildingsWithNbApartmentsAndAddress() {
        try {
            $statement = $this->connection->prepare(
                "SELECT b.idBuilding, b.name, COUNT(a.idApartment) as nbApartments FROM {$this->table} b 
                            INNER JOIN apartment a on a.fkBuilding = b.idBuilding 
                            GROUP BY b.idBuilding");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $buildings =  $this->instantiateAll($result);

            $addressDao = new AddressDao();

            foreach ($buildings as $building) {
                $address = $addressDao->getAddressById($building->id); // récupération de l'addresse
                // affectations
                $building->address = $address;
            }
            return $buildings;
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    /**
     * Récupères tous les immeubles et leurs appartements et son adresse
     */
    public function getBuildingsWithApartments() {
        $apartmentDao = new ApartmentDao();
        $addressDao = new AddressDao();

        // Etape 1 : on récupère tous les immeubles
        $buildings = $this->getBuildings();

        foreach ($buildings as $building) {
            $apartments = $apartmentDao->getApartmentsByBuildingId($building->id); // récupération des appartements
            $address = $addressDao->getAddressById($building->id); // récupération de l'addresse
            // affectations
            $building->apartments = $apartments;
            $building->address = $address;
        }

        return $buildings;
    }

    public function getBuildingById($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE idBuilding = ?");
            $statement->execute([
                $id
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            $building = $this->instantiate($result);

            // on recupère et on ajoute l'adresse au batiment
            $addressDao = new AddressDao();
            $address = $addressDao->getAddressById($building->id);
            $building->address = $address;

            return $building;

        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function createBuilding($data) {
        if (empty($data['name']) ||
            empty($data['street']) ||
            empty($data['houseNumber']) ||
            empty($data['zip']) ||
            empty($data['city']) ||
            empty($data['country'])) {

            return false;
        }

        $building = $this->instantiate($data);

        if ($building) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (name) VALUES (?)"
                );
                $statement->execute([
                    htmlspecialchars($building->__get('name')),
                ]);
                return true;
            } catch (PDOException $e) {
                print $e->getMessage();
                return false;
            }
        }
    }

    public function updateBuilding($id, $data) {
        if (empty($id || empty($data))) {
            return false;
        }

        try {
            $statement = $this->connection->prepare(
                "UPDATE {$this->table} SET name = ? WHERE idBuilding = ?");
            $statement->execute([
                htmlspecialchars($data['name']),
                htmlspecialchars($id)
            ]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function instantiate($result) {
        $building =  new Building(!empty($result['idBuilding']) ? $result['idBuilding'] : 0, $result['name']);

        if(!empty($result['nbApartments'])) {
            $building->nbApartments = $result['nbApartments'];
        }
        return$building;
    }

    public function instantiateAll($results) {
        $productList = array();
        foreach ($results as $result) {
            array_push($productList, $this->instantiate($result));
        }
        return $productList;
    }

}