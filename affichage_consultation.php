<?php
require('module/verificationUtilisateur.php');
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Les Consultations</title>
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
            <th>Date</th>
            <th>Heure de début</th>
            <th>Heure de fin</th>
            <th>Durée</th>
            <th>Patient</th>
            <th>Medecin</th>
        </tr>
        </thead>
        <tbody>
             <?php
                // Préparation de la requête de recherche des patients
                $reqAffichage = $linkpdo->prepare('SELECT idM, date_consultation, heure_debut, heure_fin, idP FROM consultation');

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
                            echo "<tr onclick=\"selectionnerLigne(this)\">"; // Appel de la fonction js de selection de ligne
                            echo "<td>{$consultation['date_consultation']}</td>";
                            echo "<td>{$consultation['heure_debut']}</td>";
                            echo "<td>{$consultation['heure_fin']}</td>";

                             // Calcul de la durée
                            $heureDebut = new DateTime($consultation['heure_debut']);
                            $heureFin = new DateTime($consultation['heure_fin']);
                            $difference = $heureDebut->diff($heureFin);

                            // Affichage de la durée
                            echo "<td>{$difference->format('%H:%I:%S')}</td>";

                             // Récupération du nom du patient
                            $reqPatient = $linkpdo->prepare('SELECT nom, prenom FROM patient WHERE idP = :idP');
                            if ($reqPatient == false) {
                                echo "Erreur dans la préparation de la requête du patient.";
                            } else {
                                $reqPatient->bindParam(':idP', $consultation['idP']);
                                $reqPatient->execute();
                                if ($reqPatient == false) {
                                    echo "Erreur dans l'exécution de la requête du patient.";
                                } else {
                                    $patient = $reqPatient->fetch(PDO::FETCH_ASSOC);

                                    // Récupération du nom du médecin
                                    $reqMedecin = $linkpdo->prepare('SELECT nom, prenom FROM medecin WHERE idM = :idM');
                                    if ($reqMedecin == false) {
                                        echo "Erreur dans la préparation de la requête du medecin.";
                                    } else {
                                    $reqMedecin->bindParam(':idM', $consultation['idM']);
                                    $reqMedecin->execute();
                                    if ($reqMedecin == false) {
                                        echo "Erreur dans l'exécution de la requête du medecin.";
                                    } else {
                                        $medecin = $reqMedecin->fetch(PDO::FETCH_ASSOC);

                                        echo "<td>{$patient['nom']} {$patient['prenom']}</td>";
                                        echo "<td>{$medecin['nom']} {$medecin['prenom']}</td>";
                                        echo "</tr>";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }         
            ?>
         </tbody>
      </table>
    </div>
    </div>

    <div class="button-sous-tableau">
            <a href="ajout_consultation.php"><button class="button-ajout">Ajouter une consultation</button></a>
            <a href="" class="lien-modif-supp" id="boutonModification" onclick="envoyerVersPageModification()" disabled >Modifier une consultation</a>
            <a href="" class="lien-modif-supp" id="boutonSuppression" onclick="envoyerVersPageSuppression()" disabled >Supprimer une consultation</a>
            
        </div>
</body>
</html>

<style>
.tableau {
    border-collapse: collapse;
    background-color: white;
    width: 1100px /* Pour ne pas avoir la scrollbar en bas*/
}
</style>