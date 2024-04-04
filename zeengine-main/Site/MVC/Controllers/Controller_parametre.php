<?php

class Controller_parametre extends Controller {

    public function action_default() {
        $this->action_parametre();
    }

    public function action_parametre() {
        session_start();
        $m = Model::getModel();

        $role = $m->getUserRole($_SESSION['mail']);

        $classesVisibles = array();

        switch ($role) {
            case 'admin':
                $classesVisibles = array('Parametre', 'Gestion', 'BDL', 'MonEspace');
                break;
    
            default:
                $notif_perm = "<p>Accès interdit ! Vous n'avez pas les permissions nécessaires.<br><br>Rôle d'accès : administrateur</p>";

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
            "styleNavLinks" => $AfficherNavLinks
        ];

        $this->render("parametre", $data);
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