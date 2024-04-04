<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Content/css/form_add.css">
    <title>Add</title>
</head>
<body>
    <a class="logo-container" href="?controller=home&action=accueil"><img class='logo' src="Content/img/rubik.png" alt="Logo" onmouseover='changeImage()' onmouseout="restoreImage()"></a>
    <nav class="navbar">
        <ul>
            <li>
                <img src="Content/img/profile.png" alt="cercle">
                <p id="menu"><?= $prenom." ".$nom ?></p>   
                <ul id="menuDeroulant">
                    <li><a href="">Assistance</a></li>
                    <li><a href="?controller=home&action=profil">Mon profil</a></li>
                    <li><a href="?controller=home&action=se_deconnecter">Se déconnecter</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="form-container">
        
        <form class="profile-form">
            <div class="input-group">
            <h1>Ajouter <?=$titre ?></h1> 
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" class="input-field">
            </div>
            <div class="input-group">
                <label for="prenom">Numéro de rue :</label>
                <input type="text" id="Tel" name="Tel" class="input-field">
            </div>
            <div class="input-group">
                <label for="prenom">Nom de rue :</label>
                <input type="text" id="Tel" name="Tel" class="input-field">
            </div>
            <div class="input-group">
                <label for="prenom">Code Postale :</label>
                <input type="text" id="Tel" name="Tel" class="input-field">
            </div>
            <div class="input-group">
                <label for="prenom">Ville :</label>
                <input type="text" id="Tel" name="Tel" class="input-field">
            </div>
            <div class="input-group">
                <label for="prenom">Commercial :</label>
                <input type="text" id="Tel" name="Tel" class="input-field">
            </div>
            <div class="input-group">
                <button type="submit" class="submit-btn">Soumettre</button>
             </div>
        </form>
    </div>
</body>
<script>
    const boutonMenu = document.getElementById('menu');
    const menuDeroulant = document.getElementById('menuDeroulant');
    const li = document.querySelector('li');
    const module = document.querySelector('.module');

    boutonMenu.addEventListener('click', function() {
        if (menuDeroulant.style.display === 'none') {
            menuDeroulant.style.display = 'block';
            li.style.background = 'white';
        } else {
             menuDeroulant.style.display = 'none';
             li.style.background = 'none';
        }
    });

    function changeImage() {
        document.querySelector('.logo').src = 'Content/img/return-back.png';
    }

    function restoreImage() {
        document.querySelector('.logo').src = 'Content/img/rubik.png';
    }
</script>
</html>