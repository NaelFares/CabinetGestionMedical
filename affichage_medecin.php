<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Les Medecins</title>
    <link href="style.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        require('header.php');
        require('bd_connexion.php');

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
                // Affichage des résultats dans un tableau
    ?>
                <!-- faire le css du tableau -->
                <table border="1">
                    <tr>
                        <th>Civilité</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                    </tr>
    <?php
                // Récupération des résultats et affichage dans le tableau
                while ($medecin = $reqAffichage->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>{$medecin['civilite']}</td>";
                    echo "<td>{$medecin['nom']}</td>";
                    echo "<td>{$medecin['prenom']}</td>";
                    echo "</tr>";
                }
    ?>
                </table>
                <br><br>
                <a href="ajout_medecin.php">Ajouter un medecin</a>
    <?php
            }    
        }
    ?>

    
</body>
</html>


