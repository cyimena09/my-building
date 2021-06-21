<?php


class RequestDao extends AbstractDao {

    public function __construct() {
        // call parent constructor (AbstractDAO)
        parent::__construct('request');
    }

    public function getRequests() {
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

    public function getRequestById($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE idRequest = ?");
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

    public function createRequest($data) {
        if (empty($data['idBuilding']) ||
            empty($data['idApartment']) ||
            empty($data['idUser'])) {

            return false;
        }

        $request = new Request(null, $data['isOwnerRequest'], $data['idApartment'], $data['idUser'] );

        if ($request) {
            try {

                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (isOwnerRequest, fkApartment, fkUser) 
                                VALUES (?, ?, ?)"
                );
                $statement->execute([
                    htmlspecialchars($request->__get('isOwnerRequest')),
                    htmlspecialchars($request->__get('apartment')),
                    htmlspecialchars($request->__get('user'))
                ]);

                return true;
            } catch (PDOException $e) {
                //print $e->getMessage();
                return false;
            }
        }
    }

    public function deleteRequest($id) {
        if (empty($id)) {
            return false;
        }

        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE idRequest = ?");
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
     * @return Request
     */
    public function instantiate($result) {
        return new Request(
            !empty($result['idRequest']) ? $result['idRequest'] : 0,
            $result['isOwnerRequest'],
            $result['fkApartment'],
            $result['fkUser']
        );
    }

}