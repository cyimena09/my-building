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
            //print $e->getMessage();
            return false;
        }
    }

    /**
     * Récupère tous les buildings avec le nombre d'appartment qu'ils possèdent et leur adresse
     * @return array
     */
    public function getBuildingsWithNbApartmentsAndAddress() {
        try {
            $statement = $this->connection->prepare(
                "SELECT b.idBuilding, b.name, b.fkAddress, COUNT(a.idApartment) as nbApartments FROM {$this->table} b 
                            LEFT JOIN apartment a on a.fkBuilding = b.idBuilding 
                            GROUP BY b.idBuilding");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $buildings =  $this->instantiateAll($result);

            foreach ($buildings as $building) {
                if ($building->nbApartments == null) {
                    $building->nbApartments = 0;
                }
            }
            return $buildings;
        } catch (PDOException $e) {
            //print $e->getMessage();
            return null;
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
            //$address = $addressDao->getAddressById($building->id); // récupération de l'addresse
            // affectations
            $building->apartments = $apartments;
            //$building->address = $address;
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

            return $this->instantiate($result);
        } catch (PDOException $e) {
            //print $e->getMessage();
            return false;
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
        // Etape 1 : enregistrer l'adresse du batiment
        $dataAddress = [
            "street" => $data['street'],
            "houseNumber" => $data['houseNumber'],
            "zip" => $data['zip'],
            "city" => $data['city'],
            "country" => $data['country'],
        ];
        $addressDao = new AddressDao();
        $addressId = $addressDao->createAddress($dataAddress);

        // Etape 2 : cas ou l'utilisateur est un LOCATAIRE
        $building = new Building(!empty($data['id']) ? $data['id'] : 0, $data['name']);

        // l'appartement, l'adresse et isActive ne sont pas dans le contructor
        $building->address = $addressId;

        if ($building) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (name, fkAddress) VALUES (?, ?)"
                );
                $statement->execute([
                    htmlspecialchars($building->__get('name')),
                    htmlspecialchars($building->__get('address')),
                ]);
                return true;
            } catch (PDOException $e) {
                //print $e->getMessage();
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

            // mise à jour de l'addresse
            $dataAddress = [
                "street" => $data['street'],
                "houseNumber" => $data['houseNumber'],
                "boxNumber" => $data['boxNumber'],
                "zip" => $data['zip'],
                "city" => $data['city'],
                "country" => $data['country'],
            ];

            $addressDao = new AddressDao();
            $addressDao->updateAddress($data['fkAddress'], $dataAddress);

        } catch (PDOException $e) {
            //print $e->getMessage();
            return false;
        }
    }

    public function deleteBuilding($id) {
        if (empty($id)) {
            return false;
        }

        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE idBuilding = ?");
            $statement->execute([
                $id
            ]);
        } catch (PDOException $e) {
            //print $e->getMessage();
            return false;
        }
    }

    public function instantiate($result) {
        $building =  new Building(!empty($result['idBuilding']) ? $result['idBuilding'] : 0, $result['name']);
        // on recupère et on ajoute l'adresse au batiment
        $addressDao = new AddressDao();
        $address = $addressDao->getAddressById($result['fkAddress']);
        $building->address = $address;

        if(!empty($result['nbApartments'])) {
            $building->nbApartments = $result['nbApartments'];
        }
        return $building;
    }

}