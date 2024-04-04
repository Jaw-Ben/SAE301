<?php require_once 'view_navbar_mon_espace.php' ?>
<?php echo $styleNavLinks ?>
<link rel="stylesheet" href="Content/css/mon_espace.css">
<h2>Liste des composantes</h2>
    <table class="Tableau" border="0">
  <tr>
    <th>Nom</th>
    <th>Commercial</th>
    <th>Plus</th>
  </tr>

  <?php 

  $table_composante = "";
  if($composantes != false) {
    for($i=0; $i<count($composantes); $i++) {
      $table_composante .= "  <tr>
                          <td>".$composantes[$i]['nomcomposante']."</td>
                          <td>";
                          if($composantes[$i]['commercial'] != false) { 
                            $table_composante .= $composantes[$i]['commercial']['nom'] . " ". $composantes[$i]['commercial']['prenom'];
                          } 
                          else { $table_composante .= "aucun"; }
                          $table_composante .= "</td>
                          <td><img class ='plus' src='Content/img/plus.png' alt='Plus'></td>
                          </tr>";
    }
  }
  echo $table_composante;
  ?>

</table>
</body>
</html>