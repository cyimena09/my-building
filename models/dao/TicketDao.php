<?php


class TicketDao extends AbstractDao {

    public function __construct() {
        // call parent constructor (AbstractDAO)
        parent::__construct('ticket');
    }

    public function getTickets() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->instantiateAll($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function getTicketById($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE idTicket = ?");
            $statement->execute([
                $id
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $this->instantiate($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function createTicket($data) {
        if (empty($data['description'])) {
            return false;
        }

        $ticket = $this->instantiate($data);

        // on ajoute la date de création et de mise à jour qui sont identique lors de la création
        $currentDate = date('Y-m-d H:i:s');

        $ticket->dateCreation = $currentDate;
        $ticket->lastUpdate = $currentDate;

        if ($ticket) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (description, status, date_creation, last_update) 
                                VALUES (?, ?, ?, ?)"
                );
                $statement->execute([
                    htmlspecialchars($ticket->__get('description')),
                    htmlspecialchars($ticket->__get('status')),
                    htmlspecialchars($ticket->__get('dateCreation')),
                    htmlspecialchars($ticket->__get('lastUpdate'))
                ]);
                return true;
            } catch (PDOException $e) {
                print $e->getMessage();
                return false;
            }
        }
    }

    public function instantiate ($result) {
        return new Ticket(
            !empty($result['idTicket']) ? $result['idTicket'] : 0,
            $result['description'],
            !empty($result['status']) ? $result['status'] : 'O',
            !empty($result['date_creation']) ? $result['date_creation'] : null,
            !empty($result['last_update']) ? $result['last_update'] : null
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