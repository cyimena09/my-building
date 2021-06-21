<?php


class AddressController extends AbstractController {

    public function __construct() {
        $this->dao = new AddressDao();
    }

    public function update($id, $data) {
        $authenticatedUser = $this->isLogged();
        $idAddress = $data['idAddress'];
        $this->dao->updateAddress($idAddress, $data);
    }

}