<?php


class MessageDao extends AbstractDao {
    public function __construct()
    {
        // call parent constructor (AbstractDAO)
        parent::__construct('animals');
    }

    // fetch all animals
    public function getAnimals()
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->createAll($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    /**
     * Retourne les données de la table animal,
     * sans tenir compte des relations avec les autres tables
     * @param $id
     * @return Animal
     */
    public function getAnimalById($id)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $statement->execute([
                $id
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $this->create($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
}