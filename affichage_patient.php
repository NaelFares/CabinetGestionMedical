<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Les Patients</title>
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

    <!-- modifier le css des tableaux dans style.scss -->
    <div class="container">
        <table class="responsive-table">
            <thead>
            <tr>
                <th>Civilité</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse</th>
                <th>Code Postal</th>
                <th>Ville</th>
                <th>Date de naissance</th>
                <th>Lieu de naissance</th>
                <th>N° sécurité sociale</th>
            </tr>
            </thead>
            <tbody>

    <?php
        // Préparation de la requête de recherche des patients
        $reqAffichage = $linkpdo->prepare('SELECT civilite, nom, prenom, adresse, ville, cp, date_naissance, lieu_naissance, num_secu_sociale FROM patient');

        if ($reqAffichage == false) {
            echo "Erreur dans la préparation de la requête de recherche.";
        } else {
            // Exécution de la requête
            $reqAffichage->execute();

            if ($reqAffichage == false) {
                echo "Erreur dans l'exécution de la requête d'affichage.";
            } else {
                // Récupération des résultats et affichage dans le tableau
                while ($patient = $reqAffichage->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<th scope=\"row\">{$patient['civilite']}</th>";
                    echo "<td>{$patient['nom']}</td>";
                    echo "<td>{$patient['prenom']}</td>";
                    echo "<td>{$patient['adresse']}</td>";
                    echo "<td>{$patient['cp']}</td>";
                    echo "<td>{$patient['ville']}</td>";
                    echo "<td>{$patient['date_naissance']}</td>";
                    echo "<td>{$patient['lieu_naissance']}</td>";
                    echo "<td>{$patient['num_secu_sociale']}</td>";
                    echo "</tr>";
                }
            }
        }    ?>
        
        </tbody>
    </table>
    <a href="ajout_patient.php"><button>Ajouter un patient</button></a>

</div>
</body>
</html>


