<?php

class Controller_connexion extends Controller {
    
    public function action_default() {
        $this->action_form_connection();
    }

    public function action_form_connection() {
        $m = Model::getModel();

        $data = [
            "nbUser" => $m->getNbUser()
        ];

        $this->render("connexion", $data);
    }

    public function action_check_connection() {

        if(!isset($_POST['password'])) {
            $erreur = [
            "motdepasse_err" => 'Veuillez saisir un mot de passe '
            ];
            $this->render("connexion",$erreur);
            exit;
        }
        if(!isset($_POST['mail'])) {
            $erreur = [
                "identifiant_err" => 'Veuillez saisir un identifiant '
            ];
            $this->render("connexion",$erreur);
            exit;
        }
        
        $m = Model::getModel();

        if(!$m->isInDataBase($_POST["mail"])) {
            $erreur = [
                "identifiant_err" => "L'utilisateur n'existe pas "
            ];
            $this->render("connexion",$erreur);
            exit;
        }
        
        $info = $m->getUserInformation($_POST["mail"]);

        if($_POST["password"] != $info["motdepasse"]) {
            $erreur = [
                "motdepasse_err" => "Le mot de passe est incorrect "
            ];
            $this->render("connexion",$erreur);
            exit;
        }

        session_start();

        $_SESSION['mail'] = $_POST['mail'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['id'] = $info['id_personne'];
        $_SESSION['prenom'] = $info['prenom'];
        $_SESSION['nom'] = $info['nom'];
        $_SESSION['role'] = $m->getUserRole($_SESSION['mail']);

        $data = [
            "userInfo" => $info,
        ];

        $this->render("accueil", $data);
    }

    protected function action_error($message = '')
    {
        $data = [
            'title' => "Error",
            'message' => $message,
        ];
        $this->render("message", $data);
    }

}

?>