<?php

class Controller_form extends Controller {

    public function action_default() {
        $this->action_form_add();
    }

    public function action_form_add(){
        session_start();
        $m = Model::getModel();
        if($_GET['form'] == 'client') {

            $composantes = $m->getAllComposantes();

            $data = [
                "titre" => $_GET['form'],
                "nom" => $_SESSION['nom'],
                "prenom" => $_SESSION['prenom'],
                "composantes" => $composantes
            ];
            $this->render('form_add_client', $data);
            exit;
        }
        elseif($_GET['form'] == 'composante') {
            $data = [
                "titre" => $_GET['form'],
                "nom" => $_SESSION['nom'],
                "prenom" => $_SESSION['prenom']
            ];
            $this->render('form_add_composante', $data);
            exit;
        }
        elseif($_GET['form'] == 'composante') {
            $data = [
                "titre" => $_GET['form'],
                "nom" => $_SESSION['nom'],
                "prenom" => $_SESSION['prenom']
            ];
            $this->render('form_add_composante', $data);
            exit;
        }
        elseif($_GET['form'] == 'prestataire') {
            $data = [
                "titre" => $_GET['form'],
                "nom" => $_SESSION['nom'],
                "prenom" => $_SESSION['prenom']
            ];
            $this->render('form_add_prestataire', $data);
            exit;
        }
        elseif($_GET['form'] == 'commercial') {
            $data = [
                "titre" => $_GET['form'],
                "nom" => $_SESSION['nom'],
                "prenom" => $_SESSION['prenom']
            ];
            $this->render('form_add_commercial', $data);
            exit;
        }
        elseif($_GET['form'] == 'interlocuteur') {
            $data = [
                "titre" => $_GET['form'],
                "nom" => $_SESSION['nom'],
                "prenom" => $_SESSION['prenom']
            ];
            $this->render('form_add_interlocuteur', $data);
            exit;
        }
        else {
            $data = [
                "titre" => $_GET['form'],
                "nom" => $_SESSION['nom'],
                "prenom" => $_SESSION['prenom']
            ];
            $this->render('form_add_gestionnaire', $data);
            exit;
        }  
    }

    public function action_form_update(){
        session_start();
        $m = Model::getModel();
        if($_GET['form'] == 'client'){

            $in_database = false;
            if (isset($_GET["id"])) {
                $m = Model::getModel();
                $in_database = $m->getClientInformationById($_GET["id"]);
            }

            if ($in_database) {
                //Récupération des informations du prix nobel
                $composantes = $m->getAllComposantes();

                //Préparation de $data
                $data = [
                    "ligneInfo" => $in_database,
                    "titre" => $_GET['form'],
                    "nom" => $_SESSION['nom'],
                    "prenom" => $_SESSION['prenom'],
                    "composantes" => $composantes
                ];
                $this->render("form_update_client", $data);
            } else {
                $this->action_error("L'utilisateur n'existe pas !");
            }
        }
        elseif($_GET['form'] == 'commercial'){
            $in_database = false;
            if (isset($_GET["id"]) and preg_match("/^[1-9]\d*$/", $_GET["id"])) {
                $m = Model::getModel();
                $in_database = $m->isInDataBaseById($_GET["id"]);
            }

            if ($in_database) {
                //Récupération des informations du prix nobel
                $informations = $m->getUserInformationById($_GET["id"]);

                //Préparation de $data
                $data = [];
                foreach ($informations as $c => $v) {
                    if ($v === null) {
                        $data[$c] = "";
                    } else {
                        $data[$c] = $v;
                    }
                }
                $this->render("form_update_commercial", $data);
            } else {
                $this->action_error("L'utilisateur n'existe pas !");
            }
        }
        elseif($_GET['form'] == 'composante'){
            $in_database = false;
            if (isset($_GET["id"]) and preg_match("/^[1-9]\d*$/", $_GET["id"])) {
                $m = Model::getModel();
                $in_database = $m->isInDataBaseById($_GET["id"]);
            }

            if ($in_database) {
                //Récupération des informations du prix nobel
                $informations = $m->getUserInformationById($_GET["id"]);

                //Préparation de $data
                $data = [];
                foreach ($informations as $c => $v) {
                    if ($v === null) {
                        $data[$c] = "";
                    } else {
                        $data[$c] = $v;
                    }
                }
                $this->render("form_update_composante", $data);
            } else {
                $this->action_error("L'utilisateur n'existe pas !");
            }
        }
        elseif($_GET['form'] == 'prestataire'){
            $in_database = false;
            if (isset($_GET["id"]) and preg_match("/^[1-9]\d*$/", $_GET["id"])) {
                $m = Model::getModel();
                $in_database = $m->isInDataBaseById($_GET["id"]);
            }

            if ($in_database) {
                //Récupération des informations du prix nobel
                $informations = $m->getUserInformationById($_GET["id"]);

                //Préparation de $data
                $data = [];
                foreach ($informations as $c => $v) {
                    if ($v === null) {
                        $data[$c] = "";
                    } else {
                        $data[$c] = $v;
                    }
                }
                $this->render("form_update_prestataire", $data);
            } else {
                $this->action_error("L'utilisateur n'existe pas !");
            }
        }
        else {
            $in_database = false;
            if (isset($_GET["id"]) and preg_match("/^[1-9]\d*$/", $_GET["id"])) {
                $m = Model::getModel();
                $in_database = $m->isInDataBaseById($_GET["id"]);
            }

            if ($in_database) {
                //Récupération des informations du prix nobel
                $informations = $m->getUserInformationById($_GET["id"]);

                //Préparation de $data
                $data = [];
                foreach ($informations as $c => $v) {
                    if ($v === null) {
                        $data[$c] = "";
                    } else {
                        $data[$c] = $v;
                    }
                }
                $this->render("form_update_gestionnaire", $data);
            } else {
                $this->action_error("L'utilisateur n'existe pas !");
            }
        }
    }

    public function action_form_bdl() {
        session_start();
        $this->render("form_bdl");
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