<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Les Consultations</title>
    <link href="tableau.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php
     require('header.php');
     require('bd_connexion.php');
     ?>
     <br>
    <!-- modifier le css du tableau dans style.scss -->
    <div class="containerTab">
    <table class="tableau">
        <thead>
        <tr>
            <th>Date</th>
            <th>Heure</th>
            <th>Patient</th>
            <th>Medecin</th>
        </tr>
        </thead>
        <tbody>

    <?php
       
        // Préparation de la requête de recherche des patients
        $reqAffichage = $linkpdo->prepare('SELECT datee, heure, idP, idM FROM consultation');

        if ($reqAffichage == false) {
            echo "Erreur dans la préparation de la requête d'affichage.";
        } else {
            // Exécution de la requête
            $reqAffichage->execute();

            if ($reqAffichage == false) {
                echo "Erreur dans l'exécution de la requête d'affichage.";
            } else {
                // Récupération des résultats et affichage dans le tableau
                while ($consultation = $reqAffichage->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>{$medecin['datee']}</td>";
                    echo "<td>{$medecin['heure']}</td>";
                    echo "<td>{$medecin['idP']}</td>";
                    echo "<td>{$medecin['idM']}</td>";
                    echo "</tr>";
                }
            }
        }
                
    ?>

    </tbody>
  </table>

   
</div>
 <!-- modifier le css des boutons dans style.scss -->
 <a href="ajout_consultation.php"><button>Ajouter une consultation</button></a>

</body>
</html>


