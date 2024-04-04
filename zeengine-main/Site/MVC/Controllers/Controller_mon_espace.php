<?php

class Controller_mon_espace extends Controller {

    public function action_default() {
        $this->action_mon_espace();
    }

    public function action_mon_espace() {
        session_start();
        $m = Model::getModel();

        $role = $m->getUserRole($_SESSION['mail']);

        $classesVisibles = array();

        switch ($role) {
            case 'admin':
                $classesVisibles = array('MonEspace', 'Clients', 'Composantes', 'Interlocuteurs', 'Prestataires', 'Gestionnaires');
                $clients = $m->getAllClients();
                for($i = 0; $i < count($clients);$i++) {
                    $clients[$i]['composante'] = $m->getComposanteClient($clients[$i]['id_client']);
                }
                break;

            case 'gestionnaire':
                $classesVisibles = array('MonEspace', 'Clients', 'Interlocuteurs', 'Prestataires');
                $clients = $m->getAllClients();
                for($i = 0; $i < count($clients);$i++) {
                    $clients[$i]['composante'] = $m->getComposanteClient($clients[$i]['id_client']);
                }
                break;
    
            case 'commercial':
                $classesVisibles = array('MonEspace', 'Clients', 'Composantes', 'Interlocuteurs', 'Prestataires');
                $clients = $m->getClientCommercial($_SESSION['id']);
                for($i = 0; $i < count($clients);$i++) {
                    $clients[$i]['composante'] = $m->getComposanteClient($clients[$i]['id_client']);
                }
                break;

            case 'interlocuteur':
                $classesVisibles = array('MonEspace', 'Prestataires');
                $clients = $m->getClientInterlocuteur($_SESSION['id']);
                for($i = 0; $i < count($clients);$i++) {
                    $clients[$i]['composante'] = $m->getComposanteClient($clients[$i]['id_client']);
                }
                break;

            case 'prestataire':
                $classesVisibles = array('MonEspace', 'Clients', 'Composantes');
                $clients = $m->getClientPrestataire($_SESSION['id']);
                if ($clients == false) {
                    break;
                }
                for($i = 0; $i < count($clients);$i++) {
                    $clients[$i]['composante'] = $m->getComposanteClient($clients[$i]['id_client']);
                }
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
            "clients" => $clients
        ];

        $this->render("mon_espace_client", $data);
    }

    public function action_composante() {
        session_start();
        $m = Model::getModel();

        $role = $m->getUserRole($_SESSION['mail']);

        $classesVisibles = array();

        switch ($role) {
            case 'admin':
                $classesVisibles = array('MonEspace', 'Clients', 'Composantes', 'Interlocuteurs', 'Prestataires', 'Gestionnaires');
                $composantes = $m->getAllComposantes();
                for($i = 0; $i < count($composantes);$i++) {
                    $composantes[$i]['commercial'] = $m->getCommercialComposante($composantes[$i]['id_composante']);
                }
                break;

            case 'gestionnaire':
                $classesVisibles = array('MonEspace', 'Clients', 'Interlocuteurs', 'Prestataires');
                break;
    
            case 'commercial':
                $classesVisibles = array('MonEspace', 'Clients', 'Composantes', 'Interlocuteurs', 'Prestataires');
                $composantes = $m->getComposanteCommercial($_SESSION['id']);
                if($composantes == false) {
                    break;
                }
                for($i = 0; $i < count($composantes);$i++) {
                    $composantes[$i]['commercial'] = $m->getCommercialComposante($composantes[$i]['id_composante']);
                }
                break;

            case 'interlocuteur':
                $classesVisibles = array('MonEspace', 'Prestataires');
                break;

            case 'prestataire':
                $classesVisibles = array('MonEspace', 'Clients', 'Composantes');
                $composantes = $m->getComposantePrestataire($_SESSION['id']);
                if ($composantes == false) {
                    break;
                }
                for($i = 0; $i < count($composantes);$i++) {
                    $composantes[$i]['commercial'] = $m->getCommercialComposante($composantes[$i]['id_composante']);
                }
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
            "composantes" => $composantes
        ];

        $this->render("mon_espace_composante", $data);
    }

    public function action_prestataire() {
        session_start();
        $m = Model::getModel();

        $role = $m->getUserRole($_SESSION['mail']);

        $classesVisibles = array();

        switch ($role) {
            case 'admin':
                $classesVisibles = array('MonEspace', 'Clients', 'Composantes', 'Interlocuteurs', 'Prestataires', 'Gestionnaires');
                $prestataires = $m->getAllPrestataires();
                if ($prestataires == false) {
                    break;
                }
                for($i = 0; $i < count($prestataires);$i++) {
                    $prestataires[$i]['client'] = $m->getClientPrestataire($prestataires[$i]['id_personne']);
                }
                break;

            case 'gestionnaire':
                $classesVisibles = array('MonEspace', 'Clients', 'Prestataires', 'Interlocuteurs');
                $prestataires = $m->getAllPrestataires();
                if ($prestataires == false) {
                    break;
                }
                for($i = 0; $i < count($prestataires);$i++) {
                    $prestataires[$i]['client'] = $m->getClientPrestataire($prestataires[$i]['id_personne']);
                }
                break;

            case 'commercial':
                $classesVisibles = array('MonEspace', 'Clients', 'Composantes', 'Interlocuteurs', 'Prestataires');
                $prestataires = $m->getPrestataireCommercial($_SESSION['id']);
                if ($prestataires == false) {
                    break;
                }
                for($i = 0; $i < count($prestataires);$i++) {
                    $prestataires[$i]['client'] = $m->getClientPrestataire($prestataires[$i]['id_personne']);
                }
                break;

            case 'interlocuteur':
                $classesVisibles = array('MonEspace', 'Prestataires');
                $prestataires = $m->getPrestataireInterlocuteur($_SESSION['id']);
                if ($prestataires == false) {
                    break;
                }
                for($i = 0; $i < count($prestataires);$i++) {
                    $prestataires[$i]['client'] = $m->getClientPrestataire($prestataires[$i]['id_personne']);
                }
                break;

            case 'prestataire':
                $classesVisibles = array('MonEspace', 'Clients', 'Composantes');
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

        $this->render("mon_espace_prestataire", $data);
    }

    public function action_interlocuteur() {
        session_start();
        $m = Model::getModel();

        $role = $m->getUserRole($_SESSION['mail']);

        $classesVisibles = array();

        switch ($role) {
            case 'admin':
                $classesVisibles = array('MonEspace', 'Clients', 'Composantes', 'Interlocuteurs', 'Prestataires', 'Gestionnaires');
                $interlocuteurs = $m->getAllInterlocuteurs();
                if ($interlocuteurs == false) {
                    break;
                }
                for($i = 0; $i < count($interlocuteurs);$i++) {
                    $interlocuteurs[$i]['client'] = $m->getClientPrestataire($interlocuteurs[$i]['id_personne']);
                }
                break;

            case 'gestionnaire':
                $classesVisibles = array('MonEspace', 'Clients', 'Prestataires', 'Interlocuteurs');
                $interlocuteurs = $m->getAllInterlocuteurs();
                if ($interlocuteurs == false) {
                    break;
                }
                for($i = 0; $i < count($interlocuteurs);$i++) {
                    $interlocuteurs[$i]['client'] = $m->getClientPrestataire($interlocuteurs[$i]['id_personne']);
                }
                break;
        
            case 'commercial':
                $classesVisibles = array('MonEspace', 'Clients', 'Composantes', 'Interlocuteurs', 'Prestataires');
                $interlocuteurs = $m->getInterlocuteurCommercial($_SESSION['id']);
                if ($interlocuteurs == false) {
                    break;
                }
                for($i = 0; $i < count($interlocuteurs);$i++) {
                    $interlocuteurs[$i]['client'] = $m->getClientPrestataire($interlocuteurs[$i]['id_personne']);
                }
                break;

            case 'interlocuteur':
                $classesVisibles = array('MonEspace', 'Prestataires');
                break;
                
            case 'prestataire':
                $classesVisibles = array('MonEspace', 'Clients', 'Composantes');
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
            "interlocuteurs" => $interlocuteurs
        ];

        $this->render("mon_espace_interlocuteur", $data);
    }

    public function action_gestionnaire() {
        session_start();
        $m = Model::getModel();

        $role = $m->getUserRole($_SESSION['mail']);

        $classesVisibles = array();

        switch ($role) {
            case 'admin':
                $classesVisibles = array('MonEspace', 'Clients', 'Composantes', 'Interlocuteurs', 'Prestataires', 'Gestionnaires');
                $gestionnaires = $m->getAllGestionnaires();
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
            "gestionnaires" => $gestionnaires
        ];

        $this->render("mon_espace_gestionnaire", $data);
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