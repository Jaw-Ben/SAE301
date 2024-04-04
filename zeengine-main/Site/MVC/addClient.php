<?php

// Inclure la classe Model
include_once("models/Model.php");

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nomClient = $_POST["nomClient"];
    $telClient = $_POST["telClient"];

    // Créer une instance du modèle
    $model = Model::getModel();

    // Ajouter une entrée dans la table Client
    $requete = $model->bd->prepare("INSERT INTO Client (nomClient, telClient) VALUES (:nomClient, :telClient)");
    $requete->bindValue(":nomClient", $nomClient);
    $requete->bindValue(":telClient", $telClient);

    try {
        $requete->execute();
        echo "L'entrée a été ajoutée avec succès dans la table Client.";
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de l'entrée dans la table Client: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un client</title>
</head>
<body>

<h2>Ajouter un client</h2>

<form method="post" action="">
    <label for="nomClient">Nom du client:</label>
    <input type="text" id="nomClient" name="nomClient" required><br>

    <label for="telClient">Téléphone du client:</label>
    <input type="text" id="telClient" name="telClient" required><br>

    <input type="submit" value="Ajouter">
</form>

</body>
</html>
