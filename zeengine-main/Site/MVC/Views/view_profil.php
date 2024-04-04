<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Content/css/profil.css">
    <title>Accueil</title>
</head>
<body>
    <a class="logo-container" href="?controller=home&action=accueil"><img class='logo' src="Content/img/rubik.png" alt="Logo" onmouseover='changeImage()' onmouseout="restoreImage()"></a>
    <nav class="navbar">
        <ul>
            <li>
                <img class='cercle' src="Content/img/profile.png" alt="cercle">
                <p id="menu"><?php echo $userInfo['prenom'] . ' ' . $userInfo['nom'] ?></p>   
                <ul id="menuDeroulant">
                    <li><a href="https://chat.whatsapp.com/J9RxjnDQzIv7WWfeNtaSlv">Assistance</a></li>
                    <li><a href="?controller=home&action=profil">Mon profil</a></li>
                    <?php if($_SESSION['role'] == 'prestataire' || $_SESSION['role'] == 'interlocuteur') { echo '<li><a href="?controller=home&action=form_update_password">Changer de mot de passe</a></li>'; }?>
                    <li><a href="?controller=home&action=se_deconnecter">Se déconnecter</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class='container'>
    <h1>Mon profil</h1>
    <div class='card'><span class='label'>Nom :</span><?php echo $userInfo['nom'] ?></div>
    <div class='card'><span class='label'>Prénom :</span><?php echo $userInfo['prenom'] ?></div>
    <div class='card'><span class='label'>Email :</span><?php echo $userInfo['mail'] ?></div>
    <div class='card'><span class='label'>Numéro de téléphone :</span><?php echo $userInfo['telephone'] ?></div>
    <div class='card'><span class='label'>Rôle :</span><?php echo $userInfo['role'] ?></div>
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