<?php


class CommunicationDao extends AbstractDao {

    public function __construct() {
        // call parent constructor (AbstractDAO)
        parent::__construct('communication');
    }

    public function getCommunications() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->instantiateAll($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function getCommunicationById($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE idCommunication = ?");
            $statement->execute([
                $id
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $this->instantiate($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function getCommunicationsByBuildingId($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE fkBuilding = ?");
            $statement->execute([
                    $id
                ]
            );
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->instantiateAll($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function createCommunication($data) {
        if (empty($data['subject']) ||
            empty($data['message']) ||
            empty($data['fkBuilding'])) {

            return false;
        }

        $communication = $this->instantiate($data);

        // on ajoute la date de création et de mise à jour qui sont identique lors de la création
        $currentDate = date('Y-m-d H:i:s');

        $communication->dateCreation = $currentDate;
        $communication->lastUpdate = $currentDate;

        if ($communication) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (subject, message, date_creation, last_update, fkBuilding) 
                                VALUES (?, ?, ?, ?, ?)"
                );
                $statement->execute([
                    htmlspecialchars($communication->__get('subject')),
                    htmlspecialchars($communication->__get('message')),
                    htmlspecialchars($communication->__get('dateCreation')),
                    htmlspecialchars($communication->__get('lastUpdate')),
                    htmlspecialchars($communication->__get('idBuilding'))
                ]);
                return true;
            } catch (PDOException $e) {
                print $e->getMessage();
                return false;
            }
        }
    }

    public function instantiate ($result) {
        return new Communication(
            !empty($result['idCommunication']) ? $result['idCommunication'] : 0,
            $result['subject'],
            $result['message'],
            !empty($result['date_creation']) ? $result['date_creation'] : null,
            !empty($result['last_update']) ? $result['last_update'] : null,
            $result['fkBuilding']);
    }

    public function instantiateAll($results) {
        $productList = array();
        foreach ($results as $result) {
            array_push($productList, $this->instantiate($result));
        }
        return $productList;
    }

}