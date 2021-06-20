<?php


class AddressDao extends AbstractDao {

    public function __construct() {
        // call parent constructor (AbstractDAO)
        parent::__construct('address');
    }

    public function getAddress() {
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

    public function getAddressById($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE idAddress = ?");
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
     * Enregistre une adresse et retourne l'id de l'adresse enregistré
     * @param $data
     * @return false|string
     */
    public function createAddress($data) {
        if (empty($data['street']) ||
            empty($data['houseNumber']) ||
            empty($data['zip']) ||
            empty($data['city']) ||
            empty($data['country'])) {

            return false;
        }

        $address = new Address(
            !empty($data['id']) ? $data['id'] : 0,
            $data['street'],
            $data['houseNumber'],
            $data['boxNumber'] ? $data['boxNumber']  : null,
            $data['zip'],
            $data['city'],
            $data['country']);

        if ($address) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (street, house_number, box_number, zip, city, country) 
                                VALUES (?, ?, ?, ?, ?, ?)"
                );
                $statement->execute([
                    htmlspecialchars($address->__get('street')),
                    htmlspecialchars($address->__get('houseNumber')),
                    htmlspecialchars($address->__get('boxNumber')),
                    htmlspecialchars($address->__get('zip')),
                    htmlspecialchars($address->__get('city')),
                    htmlspecialchars($address->__get('country'))
                ]);
                return $lastInsertedId = $this->connection->lastInsertId();
            } catch (PDOException $e) {
                //print $e->getMessage();
                return false;
            }
        }
    }

    public function updateAddress($id, $data) {
        if (empty($id || empty($data))) {
            return false;
        }

        try {
            $statement = $this->connection->prepare(
                "UPDATE {$this->table} SET street = ?, house_number = ?, box_number = ?, zip = ?, city = ?, country = ? WHERE idAddress = ?");
            $statement->execute([
                htmlspecialchars($data['street']),
                htmlspecialchars($data['houseNumber']),
                htmlspecialchars($data['boxNumber']) ? htmlspecialchars($data['boxNumber']) : null,
                htmlspecialchars($data['zip']),
                htmlspecialchars($data['city']),
                htmlspecialchars($data['country']),
                htmlspecialchars($id)
            ]);
        } catch (PDOException $e) {
            //print $e->getMessage();
            return false;
        }
    }

    public function instantiate($result) {
        return new Address(
            !empty($result['idAddress']) ? $result['idAddress'] : 0,
            $result['street'],
            $result['house_number'],
            $result['box_number'],
            $result['zip'],
            $result['city'],
            $result['country']);
    }

}