<?php

class Controller_home extends Controller {

    public function action_default() {
        $this->action_accueil();
    }

    public function action_accueil() {
        session_start();
        $m = Model::getModel();

        $data = [
            "userInfo" => $m->getUserInformation($_SESSION['mail'])
        ];
        
        $this->render('accueil', $data);
    }

    public function action_se_deconnecter() {
        session_start();
        session_destroy();
        $m = Model::getModel();

        $data = [
            "nbUser" => $m->getNbUser()
        ];

        $this->render("connexion", $data);
    }

    public function action_profil() {
        session_start();
        $m = Model::getModel();

        $userInfo = $m->getUserInformation($_SESSION['mail']);
        $userInfo['role'] = $_SESSION['role'];

        $data = [
            "userInfo" => $userInfo
        ];
        
        $this->render('profil', $data);
    }

    public function action_form_update_password() {
        session_start();

        $data = [
            "password" => $_SESSION['password'],
            "nom" => $_SESSION['nom'],
            "prenom" => $_SESSION['prenom']
        ];
        $this->render("form_update_password", $data);
    }

    protected function action_error($message = '') {
        $data = [
            'title' => "Error",
            'message' => $message,
        ];
        
        $this->render("message", $data);
    }
}

?>