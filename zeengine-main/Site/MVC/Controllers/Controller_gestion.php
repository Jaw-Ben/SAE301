<?php

class Controller_gestion extends Controller {

    public function action_default() {
        $this->action_gestion();
    }

    public function action_gestion() {
        session_start();
        $m = Model::getModel();

        $role = $m->getUserRole($_SESSION['mail']);
        $clients = $m->getAllClients();
        for($i = 0; $i < count($clients);$i++) {
            $clients[$i]['composante'] = $m->getComposanteClient($clients[$i]['id_client']);
        }
        $classesVisibles = array();

        switch ($role) {
            case 'admin':
                $classesVisibles = array('Gestion', 'Clients', 'Composantes', 'Prestataires', 'Commerciaux');
                break;

            case 'gestionnaire':
                $classesVisibles = array('Gestion', 'Clients', 'Composantes', 'Prestataires', 'Commerciaux');
                break;
    
            default:
                $notif_perm = "<p>Accès interdit ! Vous n'avez pas les permissions nécessaires.<br><br>Rôle d'accès : gestionnaire</p>";

                $data = [
                    "notif_perm" => $notif_perm
                ];

                $this->render("accueil", $data);
                exit;
        }

        $AfficherNavLinks = '<style>';
        foreach ($classesVisibles as $classe) {
            $AfficherNavLinks .= ".$classe { display: inline; }";
        }
        $AfficherNavLinks .= '</style>';

        $data = [
            "styleNavLinks" => $AfficherNavLinks,
            "clients" => $clients
        ];

        $this->render("gestion_client", $data);
    }

    public function action_composante() {
        session_start();
        $m = Model::getModel();

        $role = $m->getUserRole($_SESSION['mail']);
        $composantes = $m->getAllComposantes();
        for($i = 0; $i < count($composantes);$i++) {
            $composantes[$i]['commercial'] = $m->getCommercialComposante($composantes[$i]['id_composante']);
        }

        $classesVisibles = array();

        switch ($role) {
            case 'admin':
                $classesVisibles = array('Gestion', 'Clients', 'Composantes', 'Prestataires', 'Commerciaux');
                break;

            case 'gestionnaire':
                $classesVisibles = array('Gestion', 'Clients', 'Composantes', 'Prestataires', 'Commerciaux');
                break;
    
            default:
                $notif_perm = "<p>Accès interdit ! Vous n'avez pas les permissions nécessaires.<br><br>Rôle d'accès : gestionnaire</p>";

                $data = [
                    "notif_perm" => $notif_perm
                ];

                $this->render("accueil", $data);
                exit;
        }

        $AfficherNavLinks = '<style>';
        foreach ($classesVisibles as $classe) {
            $AfficherNavLinks .= ".$classe { display: inline; }";
        }
        $AfficherNavLinks .= '</style>';

        $data = [
            "styleNavLinks" => $AfficherNavLinks,
            "composantes" => $composantes
        ];

        $this->render("gestion_composante", $data);
    }

    public function action_prestataire() {
        session_start();
        $m = Model::getModel();

        $role = $m->getUserRole($_SESSION['mail']);
        $prestataires = $m->getAllPrestataires();
        for($i = 0; $i < count($prestataires);$i++) {
            $prestataires[$i]['composante'] = $m->getComposantePrestataire($prestataires[$i]['id_personne']);
        }

        $classesVisibles = array();

        switch ($role) {
            case 'admin':
                $classesVisibles = array('Gestion', 'Clients', 'Composantes', 'Prestataires', 'Commerciaux');
                break;

            case 'gestionnaire':
                $classesVisibles = array('Gestion', 'Clients', 'Composantes', 'Prestataires', 'Commerciaux');
                break;
    
            default:
                header("HTTP/1.1 403 Forbidden");
                echo "Accès interdit. Vous n'avez pas les permissions nécessaires.";
                exit;
        }

        $AfficherNavLinks = '<style>';
        foreach ($classesVisibles as $classe) {
            $AfficherNavLinks .= ".$classe { display: inline; }";
        }
        $AfficherNavLinks .= '</style>';

        $data = [
            "styleNavLinks" => $AfficherNavLinks,
            "prestataires" => $prestataires
        ];

        $this->render("gestion_prestataire", $data);
    }

    public function action_commercial() {
        session_start();
        $m = Model::getModel();

        $role = $m->getUserRole($_SESSION['mail']);
        $commerciaux = $m->getAllCommercials();
        for($i = 0; $i < count($commerciaux);$i++) {
            $commerciaux[$i]['composante'] = $m->getComposanteCommercial($commerciaux[$i]['id_personne']);
        }

        $classesVisibles = array();

        switch ($role) {
            case 'admin':
                $classesVisibles = array('Gestion', 'Clients', 'Composantes', 'Prestataires', 'Commerciaux');
                break;

            case 'gestionnaire':
                $classesVisibles = array('Gestion', 'Clients', 'Composantes', 'Prestataires', 'Commerciaux');
                break;
    
            default:
                header("HTTP/1.1 403 Forbidden");
                echo "Accès interdit. Vous n'avez pas les permissions nécessaires.";
                exit;
        }

        $AfficherNavLinks = '<style>';
        foreach ($classesVisibles as $classe) {
            $AfficherNavLinks .= ".$classe { display: inline; }";
        }
        $AfficherNavLinks .= '</style>';

        $data = [
            "styleNavLinks" => $AfficherNavLinks,
            "commerciaux" => $commerciaux
        ];

        $this->render("gestion_commercial", $data);
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