<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Les Medecins</title>
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
            <th>Civilité</th>
            <th>Nom</th>
            <th>Prénom</th>
        </tr>
        </thead>
        <tbody>

    <?php
       
        // Préparation de la requête de recherche des patients
        $reqAffichage = $linkpdo->prepare('SELECT civilite, nom, prenom FROM medecin');

        if ($reqAffichage == false) {
            echo "Erreur dans la préparation de la requête de recherche.";
        } else {
            // Exécution de la requête
            $reqAffichage->execute();

            if ($reqAffichage == false) {
                echo "Erreur dans l'exécution de la requête d'affichage.";
            } else {
                // Récupération des résultats et affichage dans le tableau
                while ($medecin = $reqAffichage->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<th scope=\"row\">{$medecin['civilite']}</th>";
                    echo "<td>{$medecin['nom']}</td>";
                    echo "<td>{$medecin['prenom']}</td>";
                    echo "</tr>";
                }
            }
        }
                
    ?>

    </tbody>
  </table>
  <a href="ajout_medecin.php"><button>Ajouter un medecin</button></a>

</div>
</body>
</html>


