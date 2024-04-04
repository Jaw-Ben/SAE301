<?php require_once 'view_navbar_mon_espace.php' ?>
<?php echo $styleNavLinks ?>
<link rel="stylesheet" href="Content/css/mon_espace_crud.css">
</head>
<body>
    <h2>Liste des interlocuteurs</h2>
    <h3><a href="?controller=form&action=form_add&form=interlocuteur"><span class="nouveau">Nouveau</span></a></h3>
    <table class="Tableau" border="0">
        <tr>
          <th>Nom</th>
          <th>Prenom</th>
          <th>Client</th>
          <th>Plus</th>
        </tr>

        <?php 

        $table_interlocuteur = "";
        if($interlocuteurs != false) {
          for($i=0; $i<count($interlocuteurs); $i++) {
            $table_interlocuteur .= "<tr>
                          <td>".$interlocuteurs[$i]['nom']."</td>
                          <td>".$interlocuteurs[$i]['prenom']."</td>
                          <td>";
                          if($interlocuteurs[$i]['client'] != false) { 
                            $table_interlocuteur .= $interlocuteurs[$i]['client']['nomclient'];
                          } 
                          else { $table_interlocuteur .= "aucun"; }
                          $table_interlocuteur .= "</td>
                          <td><img class ='plus' src='Content/img/plus.png' alt='Plus'></td>
                          </tr>";
          }
        }
        echo $table_interlocuteur;
        ?>
    </table> 
</body>
</html>