<?php

class Model {

    private $bd;

    private static $instance = null;

    private function __construct() {

        include "Utils/credentials.php";
        $this->bd = new PDO($dsn,$login,$mdp);
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bd->query("SET nameS 'utf8'");
    }

    public static function getModel() {

        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function isInDataBaseById($id) {
        return $this->getUserInformationById($id) !== false;
    }

    public function getUserInformationById($id) {
        $requete = $this->bd->prepare("SELECT * FROM Personne WHERE id_personne = :id");
        $requete->bindValue(":id", $id);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getClientInformationById($id) {
        $requete = $this->bd->prepare("SELECT * FROM Client WHERE id_client = :id");
        $requete->bindValue(":id", $id);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function isInDataBase($mail) {
        return $this->getUserInformation($mail) !== false;
    }

    public function getUserInformation($mail) {
        $requete = $this->bd->prepare("SELECT * FROM PERSONNE WHERE mail = :mail");
        $requete->bindValue(":mail", $mail);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getNbUser() {
        $req = $this->bd->prepare('SELECT COUNT(*) FROM Personne');
        $req->execute();
        $tab = $req->fetch(PDO::FETCH_NUM);
        return $tab[0];
    }

    public function getUserRole($mail) {
        $requete = $this->bd->prepare(' SELECT Personne.id_personne FROM Personne 
                                        JOIN COMMERCIAL ON Personne.id_personne = COMMERCIAL.id_personne 
                                        JOIN GESTIONNAIRE ON Personne.id_personne = GESTIONNAIRE.id_personne
                                        WHERE Personne.mail = :mail');
        $requete->bindValue(':mail', $mail); 
        $requete->execute();
        if($requete->rowCount() == 0) {
            $requete = $this->bd->prepare(' SELECT Personne.id_personne FROM Personne 
                                        JOIN COMMERCIAL ON Personne.id_personne = COMMERCIAL.id_personne 
                                         WHERE Personne.mail = :mail');
            $requete->bindValue(':mail', $mail); 
            $requete->execute();
            if($requete->rowCount() == 0) {
                $requete = $this->bd->prepare(' SELECT Personne.id_personne FROM Personne 
                                        JOIN GESTIONNAIRE ON Personne.id_personne = GESTIONNAIRE.id_personne 
                                        WHERE Personne.mail = :mail');
                $requete->bindValue(':mail', $mail); 
                $requete->execute();
                if($requete->rowCount() == 0) {
                    $requete = $this->bd->prepare(' SELECT Personne.id_personne FROM Personne 
                                                    JOIN INTERLOCUTEUR ON Personne.id_personne = INTERLOCUTEUR.id_personne 
                                                    WHERE Personne.mail = :mail');
                    $requete->bindValue(':mail', $mail); 
                    $requete->execute();
                    if($requete->rowCount() == 0) {
                        $requete = $this->bd->prepare(' SELECT Personne.id_personne FROM Personne 
                                                        JOIN PRESTATAIRE ON Personne.id_personne = PRESTATAIRE.id_personne 
                                                        WHERE Personne.mail = :mail');
                        $requete->bindValue(':mail', $mail); 
                        $requete->execute();
                        if($requete->rowCount() == 0) {
                            echo "Cette personne n'existe pas";
                        } else {$role = 'prestataire';}
                    } else {$role = 'interlocuteur';}
                } else {$role = 'gestionnaire';} 
            } else {$role = 'commercial';} 
        } else {$role = 'admin';}

        return $role;
    }

    public function getAllClients() {
        $requete = $this->bd->prepare('SELECT * FROM Client');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllComposantes() {
        $requete = $this->bd->prepare('SELECT * FROM Composante');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllPrestataires() {
        $requete = $this->bd->prepare('SELECT * FROM Personne JOIN Prestataire ON Personne.id_personne = Prestataire.id_personne');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCommercials() {
        $requete = $this->bd->prepare('SELECT * FROM Personne JOIN Commercial ON Personne.id_personne = Commercial.id_personne');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllInterlocuteurs() {
        $requete = $this->bd->prepare('SELECT * FROM Personne JOIN Interlocuteur ON Personne.id_personne = Interlocuteur.id_personne');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllGestionnaires() {
        $requete = $this->bd->prepare('SELECT * FROM Personne JOIN Gestionnaire ON Personne.id_personne = Gestionnaire.id_personne');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getComposanteClient($id_client) {
        $requete = $this->bd->prepare('SELECT * FROM Composante WHERE id_client = :id_client');
        $requete->bindValue(':id_client', $id_client);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getComposanteCommercial($id_commercial) {
        $requete = $this->bd->prepare('SELECT * FROM Composante JOIN Affecte ON Affecte.id_composante = Composante.id_composante WHERE Affecte.id_personne = :id_commercial');
        $requete->bindValue(':id_commercial', $id_commercial);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getComposantePrestataire($id_prestataire) {
        $requete = $this->bd->prepare(' SELECT * FROM Composante
                                        JOIN Bdl ON Composante.id_composante = Bdl.id_composante
                                        JOIN Prestataire ON Bdl.id_personne_1 = Prestataire.id_personne
                                        WHERE Prestataire.id_personne = :id_prestataire');
        $requete->bindValue(':id_prestataire', $id_prestataire);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommercialComposante($id_composante) {
        $requete = $this->bd->prepare('SELECT * FROM Personne JOIN Affecte ON Personne.id_personne = Affecte.id_personne WHERE Affecte.id_composante = :id_composante');
        $requete->bindValue(':id_composante', $id_composante);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getBdlPrestataire($id_prestataire) {
        $requete = $this->bd->prepare('SELECT * FROM Bdl JOIN Prestataire ON Bdl.id_personne_1 = Prestataire.id_personne WHERE Prestataire.id_personne = :id_prestataire');
        $requete->bindValue(':id_prestataire', $id_prestataire);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPrestataireCommercial($id_commercial) {
        $requete = $this->bd->prepare(' SELECT * FROM Prestataire
                                        JOIN Bdl ON Prestataire.id_personne = Bdl.id_personne_1
                                        JOIN Composante ON Bdl.id_composante = Composante.id_composante
                                        JOIN Affecte ON Composante.id_composante = Affecte.id_composante
                                        WHERE Affecte.id_personne = :id_commercial');
        $requete->bindValue(':id_commercial', $id_commercial);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getInterlocuteurCommercial($id_commercial) {
        $requete = $this->bd->prepare(' SELECT * FROM Interlocuteur
                                        JOIN Represente ON Interlocuteur.id_personne = Represente.id_personne
                                        JOIN Composante ON Represente.id_composante = Composante.id_composante
                                        JOIN Affecte ON Composante.id_composante = Affecte.id_composante
                                        WHERE Affecte.id_personne = :id_commercial');
        $requete->bindValue(':id_commercial', $id_commercial);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getPrestataireInterlocuteur($id_interlocuteur) {
        $requete = $this->bd->prepare(' SELECT * FROM Prestataire
                                        JOIN Bdl ON Prestataire.id_personne = Bdl.id_personne_1
                                        JOIN Composante ON Bdl.id_composante = Composante.id_composante
                                        JOIN Represente ON Composante.id_composante = Represente.id_composante
                                        WHERE Represente.id_personne = :id_interlocuteur');
        $requete->bindValue(':id_interlocuteur', $id_interlocuteur);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getClientCommercial($id_commercial) {
        $requete = $this->bd->prepare(' SELECT * FROM Client
                                        JOIN Composante ON Client.id_client = Composante.id_client
                                        JOIN Affecte ON Composante.id_composante = Affecte.id_composante
                                        WHERE Affecte.id_personne = :id_commercial');
        $requete->bindValue(':id_commercial', $id_commercial);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClientInterlocuteur($id_interlocuteur) {
        $requete = $this->bd->prepare(' SELECT * FROM Client
                                        JOIN Composante ON Client.id_client = Composante.id_client
                                        JOIN Represente ON Composante.id_composante = Represente.id_composante
                                        WHERE Represente.id_personne = :id_interlocuteur');
        $requete->bindValue(':id_interlocuteur', $id_interlocuteur);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getClientPrestataire($id_prestataire) {
        $requete = $this->bd->prepare(' SELECT * FROM Client
                                        JOIN Composante ON Client.id_client = Composante.id_client
                                        JOIN Bdl ON Composante.id_composante = Bdl.id_composante
                                        JOIN Prestataire ON Bdl.id_personne_1 = Prestataire.id_personne
                                        WHERE Prestataire.id_personne = :id_prestataire');
        $requete->bindValue(':id_prestataire', $id_prestataire);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function addClient($nom, $tel, $nomcomposante) {
        $requete1 = $this->bd->prepare('INSERT INTO Client(nomClient, telClient) VALUES (:nom, :tel)');
        $requete1->bindValue(':nom', $nom);
        $requete1->bindValue(':tel', $tel);
        $requete1->execute();
        $requete2 = $this->bd->prepare('SELECT id_client FROM Client WHERE nomclient = :nom');
        $requete2->bindValue(':nom', $nom);
        $requete2->execute();
        $client = $requete2->fetch(PDO::FETCH_ASSOC);
        $requete3 = $this->bd->prepare('UPDATE Composante SET id_client = :id WHERE nomcomposante = :nomcomposante');
        $requete3->bindValue(':id', $client['id_client']);
        $requete3->bindValue(':nomcomposante', $nomcomposante);
        $requete3->execute();
    }

    public function removeClient($id) {
        $req = $this->bd->prepare('SELECT * FROM Composante WHERE id_client = :id');
        $req->bindValue(':id', $id);
        $req->execute();
        $tab = $req->fetch(PDO::FETCH_ASSOC);
        if($tab == false) {
            $requete = $this->bd->prepare('DELETE FROM Client WHERE id_client = :id_client');
            $requete->bindValue(':id_client', $id);
            $requete->execute();
            return false;
        }

        $req1 = $this->bd->prepare('SELECT * FROM Personne JOIN Affecte ON Personne.id_personne = Affecte.id_personne WHERE id_composante = :id');
        $req1->bindValue(':id', $tab['id_composante']);
        $req1->execute();
        $tab1 = $req1->fetch(PDO::FETCH_ASSOC);


        $requete2 = $this->bd->prepare('DELETE FROM Affecte WHERE id_composante = :id_composante');
        $requete2->bindValue(':id_composante', $tab['id_composante']);
        $requete2->execute();

        $requete3 = $this->bd->prepare('DELETE FROM Composante WHERE id_composante = :id_composante');
        $requete3->bindValue(':id_composante', $tab['id_composante']);
        $requete3->execute();

        $requete4 = $this->bd->prepare('DELETE FROM Client WHERE id_client = :id_client');
        $requete4->bindValue(':id_client', $id);
        $requete4->execute();
    }

    public function updateClient($nom, $tel, $nomcomposante) {
        $requete = $this->bd->prepare('UPDATE Client
                                        SET nomClient = :nom,
                                        telClient = :tel
                                        WHERE nomClient = :nom');
        $requete->bindValue(':nom', $nom);
        $requete->bindValue(':tel', $tel);
        $requete->execute();
        $id = $this->bd->prepare('SELECT id_client FROM Client WHERE nomclient = :nom');
        $id->bindValue(':nom', $nom);
        $id->execute();
        $client = $id->fetch(PDO::FETCH_ASSOC);
        $requete = $this->bd->prepare('UPDATE Composante SET id_client = :id WHERE nomcomposante = :nomcomposante');
        $requete->bindValue(':nomcomposante', $nomcomposante);
        $requete->bindValue(':id', $client['id_client']);
        $requete->execute();
    }
}

?>