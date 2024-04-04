<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Content/css/accueil.css">
    <title>Accueil</title>
</head>
<body>
    <nav class="navbar">
        <ul>
            <li>
                <img src="Content/img/profile.png" alt="cercle">
                <p id="menu"><?php if(isset($_SESSION['prenom'], $_SESSION['nom'])) { echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']; } ?></p>   
                <ul id="menuDeroulant">
                    <li><a href="https://chat.whatsapp.com/J9RxjnDQzIv7WWfeNtaSlv">Assistance</a></li>
                    <li><a href="?controller=home&action=profil">Mon profil</a></li>
                    <?php if($_SESSION['role'] == 'prestataire' || $_SESSION['role'] == 'interlocuteur') { echo '<li><a href="?controller=home&action=form_update_password">Changer de mot de passe</a></li>'; }?>
                    <li><a href="?controller=home&action=se_deconnecter">Se déconnecter</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="module">
        <a href="?controller=gestion&action=gestion">
            <div id="gestions">
                <img src="Content/img/gestions.png" alt="gestions">
                <p>Gestions</p>
            </div>
        </a>
        <a href="?controller=bdl&action=<?php if($_SESSION['role'] == 'prestataire') { echo 'client'; } else { echo 'bdl'; } ?>">
            <div id="bdl">
                <img src="Content/img/bdl.png" alt="bdl">
                <p>BDL</p>
            </div>
        </a>
        <a href="?controller=mon_espace&action=<?php if($_SESSION['role'] == 'interlocuteur') { echo 'prestataire'; } else { echo 'client'; } ?>">
            <div id="monEspace">
                <img src="Content/img/monespace.png" alt="monEspace">
                <p>Mon espace</p>
            </div>
        </a>
        <a href="?controller=parametre&action=parametre">
            <div id="parametre">
                <img src="Content/img/parametre.png" alt="parametre">
                <p>Paramètre</p>
            </div>
        </a>
    </div>
    <div class="notification"><?php if(isset($notif_perm)) { echo $notif_perm; } ?></div>
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

    const notif = document.querySelector('.notification');
    if (notif.children.length != 0) {
        notif.classList.add('show');

        setTimeout(() => {
            notif.classList.remove('show');
        }, 2000);
    }
</script>
</html>