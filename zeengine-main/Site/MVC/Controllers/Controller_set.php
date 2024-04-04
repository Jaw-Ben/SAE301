<?php

class Controller_set extends Controller {

    public function action_default() {
        $this->action_ajouter_client();
    }

    public function action_ajouter_client() {
        session_start();
        $m = Model::getModel();
        if (isset($_POST['nom'], $_POST['tel'], $_POST['nomcomposante'])) {
            $m->addClient($_POST['nom'], $_POST['tel'], $_POST['nomcomposante']);
            $role = $_SESSION['role'];

            $clients = $m->getAllClients();
            for($i = 0; $i < count($clients);$i++) {
                $clients[$i]['composante'] = $m->getComposanteClient($clients[$i]['id_client']);
            }

            switch ($role) {
                case 'admin':
                    $classesVisibles = array('Gestion', 'Clients', 'Composantes', 'Prestataires', 'Commerciaux');
                    break;
    
                case 'gestionnaire':
                    $classesVisibles = array('Gestion', 'Clients', 'Composantes', 'Prestataires', 'Commerciaux');
                    break;
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
            $this->render('gestion_client', $data);
        
        } else {
            $data['message'] = "Le client n'a pas été ajouté !";
            $data['title'] = "Erreur";
            $this->render("message", $data);
        }
    }

    public function action_modifier_client() {
        session_start();
        $m = Model::getModel();
        if (isset($_POST['nom'], $_POST['tel'], $_POST['nomcomposante'])) {
            $m->updateClient($_POST['nom'], $_POST['tel'], $_POST['nomcomposante']);
            $role = $_SESSION['role'];

            $clients = $m->getAllClients();
            for($i = 0; $i < count($clients);$i++) {
                $clients[$i]['composante'] = $m->getComposanteClient($clients[$i]['id_client']);
            }

            switch ($role) {
                case 'admin':
                    $classesVisibles = array('Gestion', 'Clients', 'Composantes', 'Prestataires', 'Commerciaux');
                    break;
    
                case 'gestionnaire':
                    $classesVisibles = array('Gestion', 'Clients', 'Composantes', 'Prestataires', 'Commerciaux');
                    break;
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
            $this->render('gestion_client', $data);
        
        } else {
            $data['message'] = "Le client n'a pas été ajouté !";
            $data['title'] = "Erreur";
            $this->render("message", $data);
        }
    }

    public function action_supprimer_client() {
        session_start();
        $m = Model::getModel();
        if (isset($_GET['id'])) {
            $m->removeClient($_GET['id']);
            $role = $_SESSION['role'];

            $clients = $m->getAllClients();
            for($i = 0; $i < count($clients);$i++) {
                $clients[$i]['composante'] = $m->getComposanteClient($clients[$i]['id_client']);
            }

            switch ($role) {
                case 'admin':
                    $classesVisibles = array('Gestion', 'Clients', 'Composantes', 'Prestataires', 'Commerciaux');
                    break;
    
                case 'gestionnaire':
                    $classesVisibles = array('Gestion', 'Clients', 'Composantes', 'Prestataires', 'Commerciaux');
                    break;
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
            $this->render('gestion_client', $data);
        
        } else {
            $data['message'] = "Le client n'a pas été ajouté !";
            $data['title'] = "Erreur";
            $this->render("message", $data);
        }
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