<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Les Consultations</title>
    <link href="style.scss" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
     require('header.php');
     require('bd_connexion.php');
     ?>

    <!-- modifier le css du tableau dans style.scss -->
    <div class="container">
    <table class="responsive-table">
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

    <!-- modifier le css des boutons dans style.scss -->
  <a href="ajout_consultation.php"><button>Ajouter une consultation</button></a>

</div>
</body>
</html>


