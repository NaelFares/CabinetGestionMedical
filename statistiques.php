<?php
require('module/verificationUtilisateur.php');
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Les Statistiques</title>
    <link href="style/statistiques.css" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
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
                        <th>Tranche d'âge</th>
                        <th>Nombre d'Hommes</th>
                        <th>Nombre de Femmes</th>                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Moins de 25 ans</th>
                        <td>
                            <?php
                                $reqNbHommeMoins25 = $linkpdo->prepare("SELECT count(*) FROM patient WHERE civilite = 'M.' AND TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) < 25 ;");

                                if ($reqNbHommeMoins25 == false) {
                                    echo "Erreur dans la préparation de la requête d'affichage.";
                                } else {
                                    $reqNbHommeMoins25->execute();
                                    
                                    if ($reqNbHommeMoins25 == false) {
                                        echo "Erreur dans l'exécution de la requête d'affichage.";
                                    } else {
                                        $nbHommeMoins25 = $reqNbHommeMoins25->fetchColumn();
                                        echo $nbHommeMoins25;                              
                                    }
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                $reqNbFemmeMoins25 = $linkpdo->prepare("SELECT count(*) FROM patient WHERE civilite = 'Mme' AND TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) < 25 ;");

                                if ($reqNbFemmeMoins25 == false) {
                                    echo "Erreur dans la préparation de la requête d'affichage.";
                                } else {
                                   $reqNbFemmeMoins25->execute();
                                    
                                    if ($reqNbFemmeMoins25 == false) {
                                        echo "Erreur dans l'exécution de la requête d'affichage.";
                                    } else {
                                        $nbFemmeMoins25 = $reqNbFemmeMoins25->fetchColumn();
                                        echo $nbFemmeMoins25;                              
                                    }
                                }
                                
                            ?>
                        </td>
                        
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <th>Entre 25 et 50 ans</th>
                        <td> </td>
                        <td> </td>                            
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <th>Plus de 50 ans</th>
                        <td> 
                            <?php
                                $reqNbHommeplus50 = $linkpdo->prepare("SELECT count(*) FROM patient WHERE civilite = 'M.' AND TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) > 50 ;");

                                if ($reqNbHommeplus50 == false) {
                                    echo "Erreur dans la préparation de la requête d'affichage.";
                                } else {
                                    $reqNbHommeplus50->execute();
                                    
                                    if ($reqNbHommeplus50 == false) {
                                        echo "Erreur dans l'exécution de la requête d'affichage.";
                                    } else {
                                        $nbHommePlus50 = $reqNbHommeplus50->fetchColumn();
                                        echo $nbHommePlus50;                              
                                    }
                                }
                            ?>
                        </td>
                        <td> 
                            <?php
                                $reqNbFemmePlus50 = $linkpdo->prepare("SELECT count(*) FROM patient WHERE civilite = 'Mme' AND TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) > 50 ;");

                                if ($reqNbFemmePlus50 == false) {
                                    echo "Erreur dans la préparation de la requête d'affichage.";
                                } else {
                                   $reqNbFemmePlus50->execute();
                                    
                                    if ($reqNbFemmePlus50 == false) {
                                        echo "Erreur dans l'exécution de la requête d'affichage.";
                                    } else {
                                        $nbFemmePlus50 = $reqNbFemmePlus50->fetchColumn();
                                        echo $nbFemmePlus50;                              
                                    }
                                }
                                
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="containerExterieur">
        <div class="containerTab">
            <table class="tableau">
                <thead>
                    <tr>
                        <th>Medecin</th>
                        <th>Durée totale des consultations (en heures)</th>                    
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Préparation de la requête de recherche des médecins avec la durée totale des consultations
                    $reqAffichage = $linkpdo->prepare('
                        SELECT
                            m.civilite,
                            m.nom,
                            m.prenom,
                            SEC_TO_TIME(SUM(TIME_TO_SEC(c.duree))) AS duree_totale
                        FROM
                            medecin m
                            LEFT JOIN consultation c ON m.idM = c.idM
                        GROUP BY
                            m.idM
                    ');

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
                                echo "<tr>"; // Appel de la fonction js de sélection de ligne
                                $infoMedecin = $medecin['civilite'] . " " . $medecin['nom'] . " " . $medecin['prenom'];
                                echo "<td>{$infoMedecin}</td>";
                                if ($medecin['duree_totale'] == null){
                                    echo "<td>00:00:00</td>";
                                } else {
                                echo "<td>{$medecin['duree_totale']}</td>";
                                }
                                echo "</tr>";
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>        
        </div>
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

    
</body>
</html>
