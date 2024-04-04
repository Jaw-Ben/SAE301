<?php
// Fonction Optimisée
function sommeOptimisee($n) {
    return $n * ($n + 1) / 2;
}

// Fonction Peu Optimisée
function sommePeuOptimisee($n) {
    $somme = 0;
    for ($i = 1; $i <= $n; $i++) {
        $somme += $i;
    }
    return $somme;
}

// Test des fonctions
$n = 10000; // Vous pouvez changer cette valeur pour tester avec différents nombres

// Mesure du temps pour la fonction optimisée
$debut = microtime(true);
$resultatOptimise = sommeOptimisee($n);
$fin = microtime(true);
$tempsOptimise = $fin - $debut;

// Mesure du temps pour la fonction peu optimisée
$debut = microtime(true);
$resultatPeuOptimise = sommePeuOptimisee($n);
$fin = microtime(true);
$tempsPeuOptimise = $fin - $debut;

// Affichage des résultats
echo "  <style>
.Tableau {
    width: 98%;
    border-collapse: collapse;
    margin-right: 20px;
    margin-left: 20px;
  }
  
  th, td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #f2f2f2;
  }
  
  th {
    background-color: #f2f2f2;
  }
        </style>
";
echo "<h1>Optimisation d'une fonction</h1>";
echo "<table border='0'><tr><th>Fonction</th><th>Résultat</th><th>Temps en seconde</th></tr>";
echo "<tr><td>Fonction non optimisée</td><td>" . $resultatPeuOptimise . "</td><td>" . $tempsPeuOptimise . "</td></tr>";
echo "<tr><td>Fonction optimisée</td><td>" . $resultatOptimise . "</td><td>" . $tempsOptimise . "</td></tr>";
echo "</table>";
?>