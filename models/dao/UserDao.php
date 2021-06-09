<?php


class UserDao extends AbstractDao {

    public function __construct() {
        // call parent constructor (AbstractDAO)
        parent::__construct('user');
    }

    public function getUsers() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->instantiateAll($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function getUserById($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE idUser = ?");
            $statement->execute([
                $id
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $this->instantiate($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function createUser($data) {
        if (empty($data['firstName']) ||
            empty($data['lastName']) ||
            empty($data['email']) ||
            empty($data['phone']) ||
            empty($data['gender']) ||
            empty($data['street']) ||
            empty($data['houseNumber']) ||
            empty($data['zip']) ||
            empty($data['city']) ||
            empty($data['country']) ||
            empty($data['role']) ||
            empty($data['password'])) {

            return false;
        }

        // Enregistrement de l'utilisateur

        // todo utiliser instantiate plutot ?
        $user = new User(
                 !empty($data['id']) ? $data['id'] : 0,
                $data['firstName'],
                $data['lastName'],
                $data['email'],
                $data['phone'],
                $data['gender'],
                $data['role'],
                password_hash($data['password'], PASSWORD_DEFAULT));

        if ($user) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (firstname, lastname, email, phone, gender, role, password) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)"
                );
                $statement->execute([
                    htmlspecialchars($user->__get('firstName')),
                    htmlspecialchars($user->__get('lastName')),
                    htmlspecialchars($user->__get('email')),
                    htmlspecialchars($user->__get('phone')),
                    htmlspecialchars($user->__get('gender')),
                    htmlspecialchars($user->__get('role')),
                    htmlspecialchars($user->__get('password'))
                ]);

                // on récupère l'id de l'utilisateur créé et ensuite on insert l'adresse
                $lastInsertedId = $this->connection->lastInsertId();
            } catch (PDOException $e) {
                print $e->getMessage();
                return false;
            }
        }

        // Enregistrement de l'adresse de l'utilisateur

        $data = [
            "street" => $data['street'],
            "houseNumber" => $data['houseNumber'],
            "boxNumber" => $data['boxNumber'],
            "zip" => $data['zip'],
            "city" => $data['city'],
            "country" => $data['country'],
            "userId" => $lastInsertedId
        ];

            $addressDao = new AddressDao();
            try {
                $addressDao->createAddress($data);
            } catch (PDOException $e) {
                print $e->getMessage();
                return false;
            }
            return true; // si on arrive ici c'est que tout s'est bien passé
    }

    public function verify ($data) {
        if (empty($data['email']) || empty($data['password'])) {
            return false;
        }

        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE email = ?");
            $statement->execute([
                $data['email']
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            $user = $this->instantiate($result);

            if ($user) {
                if (password_verify($data['password'], $user->password)) {
                    // ajout du token et suppression du mot de passe par sécurité
                    $user = $this->setToken($user);
                    $user->password = '';

                    return $user;
                }
            }
            return false;
        } catch (PDOException $e) {
            print $e->getMessage();
            return false;
        }
    }

    public function instantiate ($result) {
        return new User(
            !empty($result['idUser']) ? $result['idUser'] : 0,
            $result['firstname'],
            $result['lastname'],
            $result['email'],
            $result['phone'],
            $result['gender'],
            $result['role'],
            $result['password']
        );
    }

    public function instantiateAll($results) {
        $productList = array();
        foreach ($results as $result) {
            array_push($productList, $this->instantiate($result));
        }
        return $productList;
    }

    public function setToken($user) {
        $token = bin2hex(random_bytes(8)) . "." . time(); // on génère un token
        $user->sessionToken = $token; // on ajoute le token à l'utilisateur
        date_default_timezone_set('Europe/Brussels');
        $user->sessionTime = date("Y-m-d H:i:s");
        echo time();
        //créer un cookie avec le token
        setcookie('session_token', $token, time()+60*60*24, "/");

        //update l'utilisateur en DB avec son nouveau token
        $this->updateToken($user);

        return $user;
    }

    public function updateToken ($user) {

        try {
            $statement = $this->connection->prepare("UPDATE {$this->table} SET session_token = ?, session_time = ? WHERE idUser = ?");
            $statement->execute([
                $user->sessionToken,
                $user->sessionTime,
                $user->id
            ]);
            return true;
        } catch (PDOException $e) {
            print $e->getMessage();
            return false;
        }
    }

    public function fetchBySession($session_token) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE session_token = ?");
            $statement->execute([$session_token]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $result['password'] = ''; // on retire le mot de passe

            $user = $this->instantiate($result);

            // on recupère et on ajoute l'adresse de l'utilisateur
            $addressDao = new AddressDao();
            $address = $addressDao->getAddressByUserId($user->id);
            $user->address = $address;

            return $user;

        } catch (PDOException $e) {
            print $e->getMessage();
            return false;
        }
    }

}