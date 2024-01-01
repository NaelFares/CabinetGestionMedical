<?php
require('module/verificationUtilisateur.php');
?>

<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Les Medecins</title>
        <link href="style/tableau.css" rel="stylesheet">
        <link href="style/style.css" rel="stylesheet">
        <script src="js/selectionDeLigne.js"></script>
    </head>
    <body>

        <?php
        require('module/header.php');
        require('module/bd_connexion.php');
        ?>

        <!--Espace vide pour permettre de placer le header en haut de page-->
        <div class="vide-haut-page"> </div>

        <div class="containerExterieur">
        <div class="containerTab">
            <table class="tableau">
                <thead>
                    <tr>
                        <th class="col-civilite">Civilité</th>
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
                                echo "<tr onclick=\"js/selectionnerLigne(this)\">"; // Appel de la fonction js de selection de ligne
                                echo "<td>{$medecin['civilite']}</td>";
                                echo "<td>{$medecin['nom']}</td>";
                                echo "<td>{$medecin['prenom']}</td>";
                                echo "</tr>";
                            }
                        }
                    }
                            
                ?>
                </tbody>
            </table>
        </div>
        </div>
        
        <div class="button-sous-tableau">
            <a href="ajout_medecin.php"><button class="button-ajout">Ajouter un medecin</button></a>
            <a href="" class="lien-modif-supp" id="boutonModification" onclick="envoyerVersPageModification()" disabled >Modifier un medecin</a>
            <a href="suppression_medecin.php" class="lien-modif-supp" id="boutonSuppression" onclick="envoyerVersPageSuppression()" disabled >Supprimer un medecin</a>
        </div>
    </body>
</html>

<style>
.tableau {
    border-collapse: collapse;
    background-color: white;
    width: 900px /* Pour ne pas avoir la scrollbar en bas*/
}
</style>