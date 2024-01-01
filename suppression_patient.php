<?php
require('verificationUtilisateur.php');
?>
<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Suppresion d'un patient</title>
        <link href="style.scss" rel="stylesheet">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
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
        <h1> Supprimer un patient </h1>
        <div class="container">
            <table class="responsive-table">
                <thead>
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
                </thead>

                <tbody>
                    <?php
                    $reqAffichage = $linkpdo->prepare('SELECT civilite, nom, prenom, adresse, ville, cp, date_naissance, lieu_naissance, num_secu_sociale FROM patient');

                    if ($reqAffichage == false) {
                        echo "Erreur dans la préparation de la requête de recherche.";
                    } else {
                        $reqAffichage->execute();

                        if ($reqAffichage == false) {
                            echo "Erreur dans l'exécution de la requête d'affichage.";
                        } else {
                            while ($patient = $reqAffichage->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr onclick=\"selectionnerLigne(this)\">";
                                echo "<th>{$patient['civilite']}</th>";
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
                    }
                    ?>
                </tbody>
            </table>

            <a href="affichage_consultation.php" id="bouttonSupression" name="bouttonSupression"><button>Confirmer la suppression</button></a>
            <a href="affichage_patient.php" id="bouttonAnnuler" name="bouttonAnnuler"><button>Annuler</button></a>
            
        </div>


        <?php
        require('bd_connexion.php');

        // Si le bouton confirmer à été pressé
        if (isset($_POST['bouttonSupression'])) {

            // Préparation de la requête de supression
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
                    // Redirigez l'utilisateur vers la page affichage_patient.php
                    header("Location: affichage_patient.php");
                    exit;
                }
            }
        }
        ?>


    </body>
</html>
