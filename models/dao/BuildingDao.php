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
            print $e->getMessage();
        }
    }

    public function getBuildingById($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $statement->execute([
                $id
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $this->instantiate($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    function instantiateAll($results) {
        $productList = array();

        foreach ($results as $result) {
            array_push($productList, $this->deepCreate($result));
        }
        return $productList;
    }

    // Instantiate a animals
    function instantiate($result) {
        $person = new Person($result['fk_person'], null, null, null, null, null);
        $race = new Race($result['fk_race'], null);

        return new Animal(
            $result['id'],
            $result['name'],
            $result['chip'],
            $result['sex'],
            $result['sterilized'],
            $result['birthDate'],
            $person,
            $race
        );
    }

    /**
     * @param $result
     * @return Animal comprend le propriétaire de l'animal
     */
    public function deepCreate($result)
    {
        $animalId = $result['id']; // identifiant de l'animal

        // get owner
        $ownerId = $result['fk_person']; // owner id
        $personDao = new PersonDao();
        $person = $personDao->getPersonById($ownerId); // get animal owner

        // get race
        $raceId = $result['fk_race']; // race id
        $raceDao = new RaceDao();
        $race = $raceDao->getRaceById($raceId); // get animal race

        // get stays
        $stayDao = new StayDao();
        $stays = $stayDao->getStaysByAnimalId($animalId); // get animal race

        // get vaccines
        $vaccineDao = new VaccineDao();
        $vaccines = $vaccineDao->getVaccinesByAnimalId($animalId); // get animal race

        return new Animal(
            $result['id'],
            $result['name'],
            $result['chip'],
            $result['sex'],
            $result['sterilized'],
            $result['birthDate'],
            $person,
            $race,
            $stays,
            $vaccines
        );
    }
}
