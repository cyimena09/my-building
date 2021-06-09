<?php


class MessageDao extends AbstractDao {

    public function __construct() {
        // call parent constructor (AbstractDAO)
        parent::__construct('message');
    }

    public function getMessages() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->instantiateAll($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function getMessageById($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE idMessage = ?");
            $statement->execute([
                $id
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $this->instantiate($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function createMessage($data) {
        if (empty($data['subject']) ||
            empty($data['message']) ||
            empty($data['authorId'])) {

            return false;
        }

        $message = $this->instantiate($data);

        // on ajoute la date de création et de mise à jour qui sont identique lors de la création
        $currentDate = date('Y-m-d H:i:s');

        $message->dateCreation = $currentDate;
        $message->lastUpdate = $currentDate;

        if ($message) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (subject, message, date_creation, last_update, authorId) 
                                VALUES (?, ?, ?, ?, ?)"
                );
                $statement->execute([
                    htmlspecialchars($message->__get('subject')),
                    htmlspecialchars($message->__get('message')),
                    htmlspecialchars($message->__get('dateCreation')),
                    htmlspecialchars($message->__get('lastUpdate')),
                    htmlspecialchars($message->__get('authorId'))
                ]);
                return true;
            } catch (PDOException $e) {
                print $e->getMessage();
                return false;
            }
        }
    }

    public function instantiate ($result) {
        return new Message(
            !empty($result['idTicket']) ? $result['idTicket'] : 0,
            $result['subject'],
            $result['message'],
            !empty($result['date_creation']) ? $result['date_creation'] : null,
            !empty($result['last_update']) ? $result['last_update'] : null,
            $result['authorId']);
    }

    public function instantiateAll($results) {
        $productList = array();
        foreach ($results as $result) {
            array_push($productList, $this->instantiate($result));
        }
        return $productList;
    }

}