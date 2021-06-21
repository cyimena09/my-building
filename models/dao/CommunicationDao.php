<?php


class CommunicationDao extends AbstractDao {

    public function __construct() {
        // call parent constructor (AbstractDAO)
        parent::__construct('communication');
    }

    public function getCommunications() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} ORDER BY last_update DESC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $this->instantiateAll($result);
        } catch (PDOException $e) {
            //print $e->getMessage();
            return false;
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
            //print $e->getMessage();
            return false;
        }
    }

    public function getCommunicationsByBuildingId($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE fkBuilding = ? ORDER BY last_update DESC");
            $statement->execute([
                    $id
                ]
            );
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $this->instantiateAll($result);
        } catch (PDOException $e) {
            //print $e->getMessage();
            return false;
        }
    }

    public function createCommunication($data) {
        if (empty($data['subject']) ||
            empty($data['message']) ||
            empty($data['fkBuilding'])) {

            return false;
        }
        // on récupère la date actuelle qu'on ajoutera a l'objet communcation
        $currentDate = getCurrentDate();
        $communication = new Communication(null, $data['subject'], $data['message'], $currentDate, $currentDate, $data['fkBuilding']);

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
                    htmlspecialchars($communication->__get('building'))
                ]);

                return true;
            } catch (PDOException $e) {
                //print $e->getMessage();
                return false;
            }
        }
    }

    public function updateCommunication($id, $data) {
        if (empty($id) || empty($data)) {
            return false;
        }

        $currentDate = getCurrentDate();

        try {
            $statement = $this->connection->prepare(
                "UPDATE {$this->table} SET subject = ?, message = ?, last_update = ? WHERE idCommunication = ?");
            $statement->execute([
                htmlspecialchars($data['subject']),
                htmlspecialchars($data['message']),
                htmlspecialchars($currentDate),
                htmlspecialchars($id)
            ]);

            return true;
        } catch (PDOException $e) {
            print $e->getMessage();
            return false;
        }
    }

    public function deleteCommunication($id) {
        if (empty($id)) {
            return false;
        }

        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE idCommunication = ?");
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
        return new Communication(
            !empty($result['idCommunication']) ? $result['idCommunication'] : 0,
            $result['subject'],
            $result['message'],
            !empty($result['date_creation']) ? $result['date_creation'] : null,
            !empty($result['last_update']) ? $result['last_update'] : null,
            $result['fkBuilding']);
    }

}