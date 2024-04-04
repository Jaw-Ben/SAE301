<?php require_once 'view_navbar_mon_espace.php' ?>
<?php echo $styleNavLinks ?>
<link rel="stylesheet" href="Content/css/mon_espace_crud.css">
</head>
<body>
    <h2>Liste des gestionnaires</h2>
    <h3><a href="?controller=form&action=form_add&form=gestionnaire"><span class="nouveau">Nouveau</span></a></h3>
    <table class="Tableau" border="0">
        <tr>
          <th>Nom</th>
          <th>Prenom</th>
          <th>Modifier</th>
          <th>Supprimer</th>
          <th>Plus</th>
        </tr>

        <?php 

        $table_gestionnaire = "";
        if($gestionnaires != false) {
          for($i=0; $i<count($gestionnaires); $i++) {
            $table_gestionnaire .= "<tr>
                          <td>".$gestionnaires[$i]['nom']."</td>
                          <td>".$gestionnaires[$i]['prenom']."</td>
                          <td><a href='?controller=form&action=form_update&form=gestionnaire&id=".$gestionnaires[$i]['id_personne']."'><img class ='modifier' src='Content/img/modifier.png' alt='Modifier'></a></td>
                          <td><a href='?controller=set&action=remove&id=".$gestionnaires[$i]['id_personne']."'><img class ='supprimer' src='Content/img/supprimer.png' alt='Supprimer'></a></td>
                          <td><img class ='plus' src='Content/img/plus.png' alt='Plus'></td>
                          </tr>";
          }
        }
        echo $table_gestionnaire;
        ?>
    </table> 
</body>
</html>