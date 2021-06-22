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
        $building = new Building(null, $data['name'], null, $addressId);

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

            return true;
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

            return true;
        } catch (PDOException $e) {
            //print $e->getMessage();
            return false;
        }
    }

    public function instantiate($result) {
        // récupération des appartements
        $apartmentDao = new ApartmentDao();
        $apartments = $apartmentDao->getDataByFilter('fkBuilding', $result['idBuilding']);
        $nbApartments = count($apartments);
        // récupéraion de l'adresse
        $addressDao = new AddressDao();
        $address = $addressDao->getAddressById($result['fkAddress']);
        // affectations
        $building =  new Building( $result['idBuilding'], $result['name'], $apartments, $address);
        $building->nbApartments = $nbApartments;

        return $building;
    }

}