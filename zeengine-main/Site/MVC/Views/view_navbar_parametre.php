<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Content/css/navbar.css">
    <title>Mon espace</title>
</head>
<body>
    <header>
        <div class="menu-btn" id="menuBtn">
            <img src="Content/img/hamburger.png" alt="Menu Icon" width="40" height="40">
            <ul class="menu-options">
                <li><a href="?controller=home&action=accueil" class="Accueil">Accueil</a></li>
                <li><a href="" class="Clients">Clients</a></li>
                <li><a href="" class="Prestataires">Prestataires</a></li>
                <li><a href="" class="Interlocuteurs">Interlocuteurs</a></li>
            </ul>
        </div>

        <nav>
                <a class="logo-container" href="?controller=home&action=accueil"><img class='logo' src="Content/img/rubik.png" alt="Logo" onmouseover='changeImage()' onmouseout="restoreImage()"></a>
				<p class="Parametre">Paramètre</p>
				<a href="" class="boutonNav Gestion">Gestion</a>
                <a href="" class="boutonNav BDL">BDL</a>
                <a href="" class="boutonNav MonEspace">Mon espace</a>
        </nav>
        <nav class="navbar">
            <ul>
                <li>
                    <img src="Content/img/profile.png" alt="cercle">
                    <p id="menu"><?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom'] ?></p>   
                    <ul id="menuDeroulant">
                        <li><a href="https://chat.whatsapp.com/J9RxjnDQzIv7WWfeNtaSlv">Assistance</a></li>
                        <li><a href="?controller=home&action=profil">Mon profil</a></li>
                        <li><a href="?controller=home&action=se_deconnecter">Se déconnecter</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <script>
            document.getElementById('menuBtn').addEventListener('click', function() {
                this.classList.toggle('active');
                document.querySelector('.menu-options').classList.toggle('active');
            });

            const boutonMenu = document.getElementById('menu');
            const menuDeroulant = document.getElementById('menuDeroulant');
            const li = document.querySelector('.navbar li');
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
    </header>