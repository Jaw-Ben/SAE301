<?php

class Controller_bdl extends Controller {

    public function action_default() {
        $this->action_bdl();
    }

    public function action_bdl() {
        session_start();
        $m = Model::getModel();

        $role = $m->getUserRole($_SESSION['mail']);

        $classesVisibles = array();

        switch ($role) {
            case 'admin':
                $classesVisibles = array('BDL', 'Prestataires',);
                $listes = $m->getAllPrestataires();
                for($i = 0; $i < count($listes);$i++) {
                    $listes[$i]['composante'] = $m->getComposantePrestataire($listes[$i]['id_personne']);
                }
                break;

            case 'gestionnaire':
                $classesVisibles = array('BDL', 'Prestataires');
                $listes = $m->getAllPrestataires();
                for($i = 0; $i < count($listes);$i++) {
                    $listes[$i]['composante'] = $m->getComposantePrestataire($listes[$i]['id_personne']);
                }
                break;
    
            case 'commercial':
                $classesVisibles = array('BDL', 'Prestataires');
                $listes = $m->getPrestataireCommercial($_SESSION['id']);
                for($i = 0; $i < count($listes);$i++) {
                    $listes[$i]['composante'] = $m->getComposantePrestataire($listes[$i]['id_personne']);
                }
                break;

            case 'interlocuteur':
                $classesVisibles = array('BDL', 'Prestataires');
                $listes = $m->getPrestataireInterlocuteur($_SESSION['id']);
                for($i = 0; $i < count($listes);$i++) {
                    $listes[$i]['composante'] = $m->getComposantePrestataire($listes[$i]['id_personne']);
                }
                break;

            case 'prestataire':
                $classesVisibles = array('BDL', 'Clients');
                $listes = $m->getClientPrestataire($_SESSION['id']);
                for($i = 0; $i < count($listes);$i++) {
                    $listes[$i]['composante'] = $m->getComposanteClient($listes[$i]['id_personne']);
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
            "listes" => $listes
        ];

        $this->render("bdl_prestataire", $data);
    }

    public function action_client() {
        session_start();
        $m = Model::getModel();

        $role = $m->getUserRole($_SESSION['mail']);

        $classesVisibles = array();

        switch ($role) {
            case 'prestataire':
                $classesVisibles = array('BDL', 'Clients');
                $listes = $m->getClientPrestataire($_SESSION['id']);
                if ($listes == false) {
                    break;
                }
                for($i = 0; $i < count($listes);$i++) {
                    $listes[$i]['composante'] = $m->getComposanteClient($listes[$i]['id_personne']);
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
            "listes" => $listes
        ];

        $this->render("bdl_client", $data);
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