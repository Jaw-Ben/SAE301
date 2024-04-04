<?php require_once 'view_navbar_gestion.php' ?>
<?php echo $styleNavLinks ?>
<link rel="stylesheet" href="Content/css/gestion.css">
<h2>Commerciaux</h2>
    <h3><a href="?controller=form&action=form_add&form=commercial"><span class="nouveau">Nouveau</span></a></h3>
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

        $table_commercial = "";
        
        for($i=0; $i<count($commerciaux); $i++) {
          $table_commercial .= "  <tr>
                              <td>".$commerciaux[$i]['nom']."</td>
                              <td>".$commerciaux[$i]['prenom']."</td>
                              <td>";
                              if($commerciaux[$i]['composante'] != false) { 
                                $table_commercial .= $commerciaux[$i]['composante']['nomcomposante'];
                              } 
                              else { $table_commercial .= "aucun"; }
                              $table_commercial .= "</td>
                              <td><a href='?controller=form&action=form_update&form=commercial&id=".$commerciaux[$i]['id_personne']."'><img class ='modifier' src='Content/img/modifier.png' alt='Modifier'></a></td>
                              <td><a href='?controller=set&action=remove&id=".$commerciaux[$i]['id_personne']."'><img class ='supprimer' src='Content/img/supprimer.png' alt='Supprimer'></a></td>
                              <td><img class ='plus' src='Content/img/plus.png' alt='Plus'></td>
                              </tr>";
        }
        echo $table_commercial;
        ?>
    </table>
</body>
</html>