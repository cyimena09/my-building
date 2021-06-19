<?php


class TicketDao extends AbstractDao {

    public function __construct() {
        // call parent constructor (AbstractDAO)
        parent::__construct('ticket');
    }

    public function getTickets() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} t LEFT JOIN status s on s.idStatus = t.fkStatus ORDER BY last_update DESC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $this->instantiateAll($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function getTicketById($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} t LEFT JOIN status s on s.idStatus = t.fkStatus WHERE idTicket = ?");
            $statement->execute([
                $id
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $this->instantiate($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    /**
     * Récupère les tickets en fonction du filtre appliqué
     * @param $filter string que vous souhaitez filtrer
     * @param $value integer valeur du champ à récupérer
     * @return array
     */
    public function getTicketsByFilter($filter, $value) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} t LEFT JOIN status s on s.idStatus = t.fkStatus WHERE {$filter} = ?");
            $statement->execute([
                $value
            ]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->instantiateAll($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function getTicketsByBuildingId($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} t LEFT JOIN status s on s.idStatus = t.fkStatus WHERE fkBuilding = ? ORDER BY last_update DESC");
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

    public function createTicket($data) {
        if (empty($data['subject']) ||
            empty($data['description']) ||
            empty($data['idBuilding']) ||
            empty($data['idUser'])) {

            return false;
        }

        // on ajoute la date de création et de mise à jour qui sont identique lors de la création
        $currentDate = date('Y-m-d H:i:s');
        $ticket = new Ticket(null, $data['subject'], 3, $data['description'], $currentDate, $currentDate, $data['idUser']);

        var_dump($ticket);
        if ($ticket) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (subject, description, date_creation, last_update, fkUser, fkBuilding, fkStatus) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)"
                );
                $statement->execute([
                    htmlspecialchars($ticket->__get('subject')),
                    htmlspecialchars($ticket->__get('description')),
                    htmlspecialchars($ticket->__get('dateCreation')),
                    htmlspecialchars($ticket->__get('lastUpdate')),
                    htmlspecialchars($ticket->__get('user')),
                    htmlspecialchars($data['idBuilding']),
                    htmlspecialchars($ticket->__get('status')),
                ]);
                return true;
            } catch (PDOException $e) {
                print $e->getMessage();
                return false;
            }
        }
    }

    public function updateStatus($id, $data) {
        if (empty($id) && empty($data)) {
            return false;
        }

        try {
            $statement = $this->connection->prepare(
                "UPDATE {$this->table} SET fkStatus = ? WHERE idTicket = ?");
            $statement->execute([
                htmlspecialchars($data['idStatus']),
                htmlspecialchars($id)
            ]);
            return true;
        } catch (PDOException $e) {
            print $e->getMessage();
            return false;
        }
    }

    public function updateTicket($id, $data) {
        if (empty($id || empty($data))) {
            return false;
        }

        $currentDate = date('Y-m-d H:i:s');

        try {
            $statement = $this->connection->prepare(
                "UPDATE {$this->table} SET subject = ?, description = ?, last_update = ? WHERE idTicket = ?");
            $statement->execute([
                htmlspecialchars($data['subject']),
                htmlspecialchars($data['description']),
                htmlspecialchars($currentDate),
                htmlspecialchars($id)
            ]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function deleteTicket($id) {
        if (empty($id)) {
            return false;
        }

        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE idTicket = ?");
            $statement->execute([
                $id
            ]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function instantiate($result) {
        $status = new Status($result['idStatus'], $result['statusName']);
        return new Ticket(
            !empty($result['idTicket']) ? $result['idTicket'] : 0,
            $result['subject'],
            $status,
            $result['description'],
            !empty($result['date_creation']) ? $result['date_creation'] : null,
            !empty($result['last_update']) ? $result['last_update'] : null,
            $result['fkUser']
        );
    }

}