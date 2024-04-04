<?php require_once 'view_navbar_gestion.php' ?>
<?php echo $styleNavLinks ?>
<link rel="stylesheet" href="Content/css/gestion.css">
<h2>Composantes</h2>
    <h3><a href="?controller=form&action=form_add&form=composante"><span class="nouveau">Nouveau</span></a></h3>
    <table class="Tableau" border="0">
        <tr>
          <th>Nom</th>
          <th>Commercial</th>
          <th>Modifier</th>
          <th>Supprimer</th>
          <th>Plus</th>
        </tr>
        <?php 

        $table_composante = "";
        
        for($i=0; $i<count($composantes); $i++) {
          $table_composante .= "  <tr>
                              <td>".$composantes[$i]['nomcomposante']."</td>
                              <td>";
                              if($composantes[$i]['commercial'] != false) { 
                                $table_composante .= $composantes[$i]['commercial']['nom'] . " ". $composantes[$i]['commercial']['prenom'];
                              } 
                              else { $table_composante .= "aucun"; }
                              $table_composante .= "</td>
                              <td><a href='?controller=form&action=form_update&form=composante&id=".$composantes[$i]['id_composante']."'><img class ='modifier' src='Content/img/modifier.png' alt='Modifier'></a></td>
                              <td><a href='?controller=set&action=remove&id=".$composantes[$i]['id_composante']."'><img class ='supprimer' src='Content/img/supprimer.png' alt='Supprimer'></a></td>
                              <td><img class ='plus' src='Content/img/plus.png' alt='Plus'></td>
                              </tr>";
        }
        echo $table_composante;
        ?>
    </table>
</body>
</html>