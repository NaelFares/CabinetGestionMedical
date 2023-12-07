<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Suppresion d'un patient</title>
    </head>
    <body>

        <?php

        if (!empty($_GET['civilite']) && !empty($_GET['nom']) && !empty($_GET['prenom']) && !empty($_GET['adresse']) && !empty($_GET['ville']) && !empty($_GET['cp']) && !empty($_GET['date_naissance']) && !empty($_GET['lieu_naissance']) && !empty($_GET['num_secu_sociale'])) {
            // Récupérez les valeurs des paramètres GET
            $civilite = $_GET['civilite'];
            $nom = $_GET['nom'];
            $prenom = $_GET['prenom'];
            $adresse = $_GET['adresse'];
            $ville = $_GET['ville'];
            $cp = $_GET['cp'];
            $date_naissance = $_GET['date_naissance'];
            $lieu_naissance = $_GET['lieu_naissance'];
            $num_secu_sociale= $_GET['num_secu_sociale'];
        }
        ?>

        <br>
        <h1> Voulez-vous supprimer le patient ? </h1>
        <table border="1">
            <tr>
                <th>Civilite</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Code Postal</th>
                <th>Date de naissance</th>
                <th>Lieu de naissance</th>
                <th>Numéro de sécurité sociale</th>


            </tr>
            <tr>
                <td><?php echo $civilite; ?></td>
                <td><?php echo $nom; ?></td>
                <td><?php echo $prenom; ?></td>
                <td><?php echo $adresse; ?></td>
                <td><?php echo $ville; ?></td>
                <td><?php echo $cp; ?></td>
                <td><?php echo $date_naissance; ?></td>
                <td><?php echo $lieu_naissance; ?></td>
                <td><?php echo $num_secu_sociale; ?></td>

            </tr>
        </table>

        <br><br>
        <form method="post">
            <input type="submit" name="confirmer" value="Confirmer la suppression">
            <input type="submit" name="annuler" value="Annuler">
        </form>


        <?php
       require('bd_connexion.php');

        // Si le bouton confirmer à été pressé
        if (isset($_POST['confirmer'])) {

            // Préparation de la requête d'insertion
            // La prochaine fois utiliser + de parametres dans le where pour éviter de modifier les infos d'un homonyme 
            $reqSuppression = $linkpdo->prepare('DELETE FROM patient WHERE civilite = :nouvelleCivilite, nom = :nouveauNom, prenom = :nouveauPrenom, adresse = :nouvelleAdresse, ville = :nouvelleVille, cp = :nouveauCp, date_naissance = :nouvelleDate_naissance, lieu_naissance = :nouveauLieu_naissance, num_secu_sociale = :nouveauNum_secu_sociale');

            if ($reqSuppression === false) {
                echo "Erreur de préparation de la requête.";
            } else {  
                $reqSuppression->bindParam(':nouvelleCivilite', $_POST['civiliteModif'], PDO::PARAM_STR);
                $reqSuppression->bindParam(':nouveauNom', $_POST['nomModif'], PDO::PARAM_STR);
                $reqSuppression->bindParam(':nouveauPrenom', $_POST['prenomModif'], PDO::PARAM_STR);
                $reqSuppression->bindParam(':nouvelleAdresse', $_POST['adresseModif'], PDO::PARAM_STR);
                $reqSuppression->bindParam(':nouvelleVille', $_POST['villeModif'], PDO::PARAM_STR);
                $reqSuppression->bindParam(':nouveauCp', $_POST['cpModif'], PDO::PARAM_STR);
                $reqSuppression->bindParam(':nouvelleDate_naissance', $_POST['date_naissanceModif'], PDO::PARAM_STR);
                $reqSuppression->bindParam(':nouveauLieu_naissance', $_POST['lieu_naissanceModif'], PDO::PARAM_STR);
                $reqSuppression->bindParam(':nouveauNum_secu_sociale', $_POST['num_secu_socialeModif'], PDO::PARAM_STR);


                // Exécution de la requête
                $reqSuppression->execute();

                if($reqSuppression == false) {
                    echo "Erreur dans l'exécution de la requête de suppression.";
                } else {
                    // Redirigez l'utilisateur vers la page recherche.php
                    header("Location: recherche.php");
                    exit;
                }
            }
        }
        ?>

    </body>
</html>
