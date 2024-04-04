<?php require_once 'view_navbar_mon_espace.php' ?>
<?php echo $styleNavLinks ?>
<link rel="stylesheet" href="Content/css/mon_espace.css">
<h2>Liste des prestataires</h2>
    <table class="Tableau" border="0">
  <tr>
    <th>Nom</th>
    <th>Prenom</th>
    <th>Client</th>
    <th>Plus</th>
  </tr>

  <?php 

  $table_prestataire = "";
  if($prestataires != false) {
    for($i=0; $i<count($prestataires); $i++) {
      $table_prestataire .= "  <tr>
                          <td>".$prestataires[$i]['nom']."</td>
                          <td>".$prestataires[$i]['prenom']."</td>
                          <td>";
                          if($prestataires[$i]['client'] != false) { 
                            $table_prestataire .= $prestataires[$i]['client']['nomclient'];
                          } 
                          else { $table_prestataire .= "aucun"; }
                          $table_prestataire .= "</td>
                          <td><img class ='plus' src='Content/img/plus.png' alt='Plus'></td>
                          </tr>";
    }
  }
  echo $table_prestataire;
  ?>
  
</table>
</body>
</html>