<?php require_once 'view_navbar_gestion.php' ?>
<?php echo $styleNavLinks ?>
<link rel="stylesheet" href="Content/css/gestion.css">
<h2>Clients</h2>
    <h3><a href="?controller=form&action=form_add&form=client"><span class="nouveau">Nouveau</span></a></h3>
    <table class="Tableau" border="0">
        <tr>
          <th>Nom</th>
          <th>Telephone</th>
          <th>Composante</th>
          <th>Modifier</th>
          <th>Supprimer</th>
          <th>Plus</th>
        </tr>

        <?php 

        $table_client = "";
        if ($clients != false) {
        for($i=0; $i<count($clients); $i++) {
          $table_client .= "  <tr>
                              <td>".$clients[$i]['nomclient']."</td>
                              <td>".$clients[$i]['telclient']."</td>
                              <td>";
                              if($clients[$i]['composante'] != false) { 
                                $table_client .= $clients[$i]['composante']['nomcomposante'];
                              }
                              else { $table_client .= "aucun";}
                              $table_client .= "</td>
                              <td><a href='?controller=form&action=form_update&form=client&id=".$clients[$i]['id_client']."'><img class ='modifier' src='Content/img/modifier.png' alt='Modifier'></a></td>
                              <td><a href='?controller=set&action=supprimer_client&id=".$clients[$i]['id_client']."'><img class ='supprimer' src='Content/img/supprimer.png' alt='Supprimer'></a></td>
                              <td><img class ='plus' src='Content/img/plus.png' alt='Plus'></td>
                              </tr>";
        }
        }
        echo $table_client;
        ?>
    </table>
</body>
</html>