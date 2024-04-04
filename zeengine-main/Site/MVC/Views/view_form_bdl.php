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
                <p id="menu"><?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom'] ?></p>   
                <ul id="menuDeroulant">
                    <li><a href="">Documentation</a></li>
                    <li><a href="">Assistance</a></li>
                    <li><a href="?controller=home&action=profil">Mon profil</a></li>
                    <li><a href="?controller=home&action=se_deconnecter">Se déconnecter</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class='container'>
    <h1>BDL</h1>
    <form action='maj_bdl.php' method='post'>
    <div class='card'><span class='label'>Année :</span><input id ='annee' class='text' type = 'text' ></div>
    <div class='card'><span class='label'>Mois :</span><input id ='mois' class='text' type ='text' ></div>
    <div class='card'><span class='label'>Interlocuteur :</span><input id ='interlocuteur' class='text' ></div>
    <div class='card'><span class='label'>Prestataire :</span><input id ='prestataire' class='text' ></div>
    <div class='card'><span class='label'>Commentaire :</span><input id ='commentaire' class='text' ></div>
    <div class='card'><span class='label'>Composante :</span><input id ='composante' class='text' ></div>
    <input class ='formulaire' type ='submit'>
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