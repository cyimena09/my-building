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
     * Récupères tous les immeubles et leurs appartements
     */
    public function getBuildingsWithApartments() {
        $apartmentDao = new ApartmentDao();

        // Etape 1 : on récupère tous les immeubles
        $buildings = $this->getBuildings();

        foreach ($buildings as $building) {
            $apartments = $apartmentDao->getApartmentsByBuildingId($building->id);
            $building->apartments = $apartments;
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

    public function instantiate ($result) {
        return new Building(
            !empty($result['idBuilding']) ? $result['idBuilding'] : 0,
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