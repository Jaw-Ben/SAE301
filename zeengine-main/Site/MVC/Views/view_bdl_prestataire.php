<?php require_once 'view_navbar_bdl.php' ?>
<?php echo $styleNavLinks ?>
<link rel="stylesheet" href="Content/css/bdl.css">
<h2>Liste des prestataires</h2>
    <table class="Tableau" border="0">
  <tr>
    <th>Nom</th>
    <th>Prenom</th>
    <th>Composante</th>
    <th>Renseigner BDL</th>
  </tr>

  <?php 

  $table_prestataire = "";
        
  for($i=0; $i<count($listes); $i++) {
    $table_prestataire .= "  <tr>
                             <td>".$listes[$i]['nom']."</td>
                             <td>".$listes[$i]['prenom']."</td>
                             <td>";
                             if($listes[$i]['composante'] != false) { 
                              $table_prestataire .= $listes[$i]['composante']['nomcomposante'];
                            } 
                            else { $table_prestataire .= "aucun"; }
                            $table_prestataire .= "</td>
                             <td><a href='?controller=form&action=form_bdl'><img class='bdl' src='Content/img/bdl-icon.png' alt='Plus'></a></td>
                             </tr>";
  }
  echo $table_prestataire;
  ?>
  
</table>
</body>
</html>