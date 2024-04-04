<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href='Content/css/connexion.css'>
    <title>Connexion à l'extranet</title>
</head>
<header>
    <div class='header'>
        <h1>SAS Perform Vision</h1>
    </div>
</header>
<body>
    <div class='formulaire'>
        <form action="?controller=connexion&action=check_connection" role="form" method="post">
            <label id="seconnecter">Se connecter</label><br/>
            <label>Identifiant</label><br/>
                <input type="text" name="mail" placeholder="Adresse e-mail"><br/>
                <p class="erreur"><?php if(isset($identifiant_err)) {echo $identifiant_err . "<img src='Content/img/erreur.png' alt='erreur'>";} ?></p>
            <label>Mot de passe</label><br/>
                <input type="password" name="password" placeholder="Mot de passe"><br/>
                <p class="erreur"><?php if(isset($motdepasse_err)) {echo $motdepasse_err . "<img src='Content/img/erreur.png' alt='erreur'>";} ?></p>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>