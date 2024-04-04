<?php

class Model
{
    /**
     * Attribut contenant l'instance PDO
     */
    private $bd;

    /**
     * Attribut statique qui contiendra l'unique instance de Model
     */
    private static $instance = null;

    /**
     * Constructeur : effectue la connexion à la base de données.
     */
    private function __construct()
    {
        include "credentials.php";
        $this->bd = new PDO($dsn, $login, $mdp);
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bd->query("SET nameS 'utf8'");
    }

    /**
     * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
     */
    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function addEncryptedPassword($nom, $prenom, $mail,$telephone, $pwd) {
            $requete = $this->bd->prepare('INSERT INTO personne (nom, prenom, mail, telephone, motdepasse) VALUES (:nom, :prenom, :mail, :telephone, :password)');
            $requete->bindValue(':nom', $nom);
            $requete->bindValue(':prenom', $prenom);
            $requete->bindValue(':mail', $mail);
            $requete->bindValue(':telephone', $telephone);
            $requete->bindValue(':password', $pwd);
            $requete->execute();
            return $requete->rowCount();
    }

    public function getEncryptedPassword($nom) {
        $requete = $this->bd->prepare('SELECT motdepasse FROM personne WHERE nom = :nom');
        $requete->bindValue(':nom', $nom);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

}
?>