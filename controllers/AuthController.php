<?php


class AuthController extends AbstractController {

    public function __construct() {
       $this->dao = new UserDao();
        $this->buildingDao = new buildingDao();
        $this->apartmentDao = new ApartmentDao();
        $this->roleDao = new RoleDao();
    }

    /**
     * Page d'accueil et de connexion de l'application
     */
    public function index() {
        include ('../views/header.php');
        include ('../views/auth/login.php');
        include ('../views/footer.php');
    }

    public function registerView() {
        $roles = $this->roleDao->getRoles();
        $views = '../views/auth/register.php';
        include ('../views/header.php');
        include ('../views/auth/register.php');
        include ('../views/footer.php');
    }

    public function register($id, $data) {
        $lastInserted = $this->dao->createUser($data);

        if (!isset($lastInserted) || empty($lastInserted)) {
            return http_response_code(401);
        }

        $requestDao = new RequestDao();
        // on encode toutes les requetes dans la db
        for ($i = 0; $i < count($data['request']); $i++) {
            $data['request'][$i]['idUser'] = $lastInserted;

            if (!$requestDao->createRequest($data['request'][$i])) {
                return http_response_code(401);
            }
        }
    }

    public function login($id, $data) {
        $authenticatedUser = $this->dao->verify($data); // retourne 'false' si 'data' ne matche avec aucun utilisateur

        if ($authenticatedUser) {
            $url = $data['route'] ? $data['route'] : '/auth/accountView';
            header("Location:{$url}");
        } else {
            $errorMessage = 'Email ou mot de passe incorrect !';
            include ('../views/header.php');
            include ('../views/auth/login.php');
            include ('../views/footer.php');
        }
    }

    public function logout() {
        // on supprime le cookie
        if (isset($_COOKIE['session_token'])) {
            unset($_COOKIE['session_token']);
            setcookie('session_token', null, -1, '/');
        }

        include ('../views/header.php');
        include ('../views/auth/login.php');
        include ('../views/footer.php');
    }

    public function accountView() {
        $authenticatedUser = $this->isLogged();
        // récupération de la résidence et de l'appartement dans lequel habite l'utilisateur
        if ($authenticatedUser->role->name !== RoleEnum::PROPRIETAIRE) {
            $apartmentRented = $this->apartmentDao->getApartmentById($authenticatedUser->apartment->id);
            if ($apartmentRented->id == null) {
                $apartmentRented = null;
            } else {
                $building = $this->buildingDao->getBuildingById($apartmentRented->building->id);
                $apartmentRented->building = $building;
            }
        }
        // récupération des propriétés de l'utilisateur
        if ($authenticatedUser->role->name !== RoleEnum::LOCATAIRE) {
            $apartmentsOwned = $this->apartmentDao->getDataByFilter('fkOwner', $authenticatedUser->id);
            foreach ($apartmentsOwned as $apart) {
                $building = $this->buildingDao->getBuildingById($apart->building->id);
                $apart->building = $building;
            }
        }

        $content = 'user-account.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function update($id, $data) {
        $authenticatedUser = $this->isLogged();
        $idUser = $data['idUser'];

        if (!$this->dao->updateAccount($idUser, $data)) {
            return http_response_code(401);
        }
    }

    /**
     * Retourne une section du formulaire en fonction du role indiqué par l'utilisateur
     * @param $role
     * @param $data
     */
    public function sectionByRoleView($role, $data) {
        $rolesInDb = $this->roleDao->getRoles();

        foreach ($rolesInDb as $roleInDb) {
            if ($roleInDb->id == $role && $roleInDb->name == RoleEnum::LOCATAIRE) {
                $buildings = $this->buildingDao->getBuildings();
                include ('../views/auth/section-tenant.php');
            } elseif ($roleInDb->id == $role && $roleInDb->name == RoleEnum::PROPRIETAIRE) {
                $buildings = $this->buildingDao->getBuildings();
                include '../views/auth/section-owner.php';
            } elseif ($roleInDb->id == $role && $roleInDb->name == RoleEnum::PROPRIETAIRE_RESIDENT) {
                $buildings = $this->buildingDao->getBuildings();
                include ('../views/auth/section-tenant.php');
                include ('../views/auth/section-owner.php');
            }
        }
    }

}