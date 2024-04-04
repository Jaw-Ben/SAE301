<?php require_once 'view_navbar_gestion.php' ?>
<?php echo $styleNavLinks ?>
<link rel="stylesheet" href="Content/css/gestion.css">
<h2>Prestataires</h2>
    <h3><a href="?controller=form&action=form_add&form=prestataire"><span class="nouveau">Nouveau</span></a></h3>
    <table class="Tableau" border="0">
        <tr>
          <th>Nom</th>
          <th>Prenom</th>
          <th>Composante</th>
          <th>Modifier</th>
          <th>Supprimer</th>
          <th>Plus</th>
        </tr>

        <?php 

        $table_prestataire = "";
        
        for($i=0; $i<count($prestataires); $i++) {
          $table_prestataire .= "  <tr>
                              <td>".$prestataires[$i]['nom']."</td>
                              <td>".$prestataires[$i]['prenom']."</td>
                              <td>";
                              if($prestataires[$i]['composante'] != false) { 
                                $table_prestataire .= $prestataires[$i]['composante']['nomcomposante'];
                              } 
                              else { $table_prestataire .= "aucun"; }
                              $table_prestataire .= "</td>
                              <td><a href='?controller=form&action=form_update&form=prestataire&id=".$prestataires[$i]['id_personne']."'><img class ='modifier' src='Content/img/modifier.png' alt='Modifier'></a></td>
                              <td><a href='?controller=set&action=remove&id=".$prestataires[$i]['id_personne']."'><img class ='supprimer' src='Content/img/supprimer.png' alt='Supprimer'></a></td>
                              <td><img class ='plus' src='Content/img/plus.png' alt='Plus'></td>
                              </tr>";
        }
        echo $table_prestataire;
        ?>
    </table>
</body>
</html>