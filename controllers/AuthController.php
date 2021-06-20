<?php


class AuthController extends AbstractController {

    public function __construct() {
       $this->dao = new UserDao();
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
        $roleDao = new RoleDao();
        $roles = $roleDao->getRoles();

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
        $buildingDao = new buildingDao();
        $apartmentDao = new ApartmentDao();

        if ($authenticatedUser->building->id != null) {
            //var_dump($authenticatedUser);
            // récupération de l'appartement ou vit l'utilisateur

            $building = $buildingDao->getBuildingById($authenticatedUser->building->id);

            $apartment = $apartmentDao->getApartmentById($authenticatedUser->apartment->id);
            // affectation
            $authenticatedUser->building = $building;
            $authenticatedUser->apartment = $apartment;
        }

        // recupérations des propriétés de l'utilisateur
        if ($authenticatedUser->role->name === RoleEnum::PROPRIETAIRE ||
            $authenticatedUser->role->name === RoleEnum::PROPRIETAIRE_RESIDENT) {
            $apartmentsOwned = $apartmentDao->getApartmentsByFilter('fkOwner', $authenticatedUser->id);

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
        $buildingDao = new BuildingDao();
        $roleDao = new RoleDao();
        $rolesInDb = $roleDao->getRoles();


        foreach ($rolesInDb as $roleInDb) {
            if ($roleInDb->id == $role && $roleInDb->name == RoleEnum::LOCATAIRE) {
                $buildings = $buildingDao->getBuildings();
                include ('../views/auth/section-tenant.php');
            } elseif ($roleInDb->id == $role && $roleInDb->name == RoleEnum::PROPRIETAIRE) {
                $buildings = $buildingDao->getBuildings();
                include '../views/auth/section-owner.php';
            } elseif ($roleInDb->id == $role && $roleInDb->name == RoleEnum::PROPRIETAIRE_RESIDENT) {
                $buildings = $buildingDao->getBuildings();
                include ('../views/auth/section-tenant.php');
                include ('../views/auth/section-owner.php');
            }
        }
    }

}