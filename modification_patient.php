<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Modification d'un patient</title>
    </head>
    <body>
        <?php

            if (!empty($_GET['nom']) && !empty($_GET['prenom']) && !empty($_GET['adresse']) && !empty($_GET['ville']) && !empty($_GET['cp']) &&  !empty($_GET['date_naissance']) &&  !empty($_GET['lieu_naissance']) &&  !empty($_GET['num_secu_sociale'])) {
            // Récupérez les valeurs des paramètres GET
            $civilite = $_GET['civilite'];
            $nom = $_GET['nom'];
            $prenom = $_GET['prenom'];
            $adresse = $_GET['adresse'];
            $ville = $_GET['ville'];
            $cp = $_GET['cp'];
            $date_naissance = $_GET['date_naissance'];
            $lieu_naissance = $_GET['lieu_naissance'];
            $num_secu_sociale = $_GET[',num_secu_sociale'];
            }
            ?>


            <br>
            <?php
            // Vérifiez si le formulaire a été soumis
            if (!(isset($_POST['valider']) && $_POST['valider'] == 'valider')) {
                ?>
                <form method="post" action="">
                    Civilité : <input type="text" name="civiliteModif" placeholder="Entrer la civilite" value="<?php echo $civilite; ?>"><br><br>
                    Nom : <input type="text" name="nomModif" placeholder="Entrer le nom" value="<?php echo $nom; ?>"><br><br>
                    Prénom : <input type="text" name="prenomModif" placeholder="Entrez le prénom" value="<?php echo $prenom; ?>"><br><br>
                    Adresse : <input type="text" name="adresseModif" placeholder="Entrer l'adresse" value="<?php echo $adresse; ?>" ><br><br>
                    Ville : <input type="text" name= "villeModif" placeholder="Entrer la ville" value="<?php echo $ville; ?>"><br><br>
                    Code postal : <input type="text" name="cpModif" placeholder="Entrer le code postal" value="<?php echo $cp; ?>"><br><br>
                    Date de naissance : <input type="text" name= "date_naissanceModif" placeholder="Entrer la date de naissance" value="<?php echo $date_naissance; ?>"><br><br>
                    Lieu de naissance : <input type="text" name= "lieu_naissanceModif" placeholder="Entrer le lieu de naissance" value="<?php echo $lieu_naissance; ?>"><br><br>
                    Numéro de sécurité sociale : <input type="text" name= "num_secu_socialeModif" placeholder="Entrer le numéro de sécurtité sociale" value="<?php echo $num_secu_sociale; ?>"><br><br>

                    <input type="submit" value="valider" name="valider">
                    <input type="reset" value="vider" name="vider">
                </form>
            <?php
            }
            
           require('bd_connexion.php');

            // Cette ligne jsp
            if (isset($_POST['valider']) && $_POST['valider'] == 'valider' ) {

                // Préparation de la requête d'insertion
                // La prochaine fois utiliser + de parametres dans le where pour éviter de modifier les infos d'un homonyme 
                $reqModification = $linkpdo->prepare('UPDATE patient SET civilite = :nouvelleCivilite, nom = :nouveauNom, prenom = :nouveauPrenom, adresse = :nouvelleAdresse, ville = :nouvelleVille, cp = :nouveauCp, date_naissance = :nouvelleDate_naissance, lieu_naissance = :nouveauLieu_naissance, num_secu_sociale = :nouveauNum_secu_sociale WHERE nom = :nom AND prenom = :prenom');

                if ($reqModification === false) {
                    echo "Erreur de préparation de la requête.";
                } else {
                    $reqModification->bindParam(':nouvelleCivilite', $_POST['civiliteModif'], PDO::PARAM_STR);
                    $reqModification->bindParam(':nouveauNom', $_POST['nomModif'], PDO::PARAM_STR);
                    $reqModification->bindParam(':nouveauPrenom', $_POST['prenomModif'], PDO::PARAM_STR);
                    $reqModification->bindParam(':nouvelleAdresse', $_POST['adresseModif'], PDO::PARAM_STR);
                    $reqModification->bindParam(':nouvelleVille', $_POST['villeModif'], PDO::PARAM_STR);
                    $reqModification->bindParam(':nouveauCp', $_POST['cpModif'], PDO::PARAM_STR);
                    $reqModification->bindParam(':nouvelleDate_naissance', $_POST['date_naissanceModif'], PDO::PARAM_STR);
                    $reqModification->bindParam(':nouveauLieu_naissance', $_POST['lieu_naissanceModif'], PDO::PARAM_STR);
                    $reqModification->bindParam(':nouveauNum_secu_sociale', $_POST['num_secu_socialeModif'], PDO::PARAM_STR);

                    $reqModification->bindParam(':nom', $nom, PDO::PARAM_STR);
                    $reqModification->bindParam(':prenom', $prenom, PDO::PARAM_STR);

                    // Exécution de la requête
                    $reqModification->execute();

                    if($reqModification == false) {
                        echo "Erreur dans l'exécution de la requête de modification.";
                    } else {

                        // Afficher un message de succès
                        echo "Le patient a été modifié avec succès !";
                    }
                }
            }
        ?>

    </body>
</html>