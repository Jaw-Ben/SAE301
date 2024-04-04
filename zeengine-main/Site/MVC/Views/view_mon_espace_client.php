<?php require_once 'view_navbar_mon_espace.php' ?>
<?php echo $styleNavLinks ?>
<link rel="stylesheet" href="Content/css/mon_espace.css">
<h2>Liste des clients</h2>
    <table class="Tableau" border="0">
  <tr>
    <th>Nom</th>
    <th>Telephone</th>
    <th>Composante</th>
    <th>Plus</th>
  </tr>
  <?php 

  $table_client = "";
  if($clients != false) {
    for($i=0; $i<count($clients); $i++) {
      $table_client .= "  <tr>
                          <td>".$clients[$i]['nomclient']."</td>
                          <td>".$clients[$i]['telclient']."</td>
                          <td>".$clients[$i]['composante']['nomcomposante']."</td>
                          <td><img class ='plus' src='Content/img/plus.png' alt='Plus'></td>
                          </tr>";
    }
  }
  echo $table_client;
  ?>

</table>
</body>
</html>