<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Authentification</title>
    </head>
    <body>


        <?php
            include("header.php");
            require("bd_connexion.php");

            // Préparation de la requête de test de présence d'un contact
            $reqExisteDeja = $linkpdo->prepare('SELECT COUNT(*) FROM patient WHERE nom = :nom AND prenom = :prenom');

            if($reqExisteDeja == false) {
                echo "Erreur de préparation de la requête.";
            } else {

                // Liaison des paramètres
                //PDO::PARAM_STR : C'est le type de données que vous spécifiez pour le paramètre. Ici, on indique que :nom doit être traité comme une chaîne de caractères (string). Cela permet à PDO de s'assurer que la valeur est correctement échappée et protégée contre les injections SQL
                $reqExisteDeja->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
                $reqExisteDeja->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);

                // Exécution de la requête
                $reqExisteDeja->execute();

                if($reqExisteDeja == false) {
                    echo "Erreur dans l'exécution de la requête.";
                } else {

                    // Récupération du résultat
                    $nbContacts = $reqExisteDeja->fetchColumn();

                    // Vérification si le contact existe déjà
                    if ($nbContacts > 0) {
                        echo "Ce patient existe déjà.";
                    } else {
                        /// Préparation de la requête d'insertion
                        $req = $linkpdo->prepare('INSERT INTO patient(civilite, nom, prenom, adresse, ville, cp, date_naissance, lieu_naissance, num_secu_sociale) VALUES (:civilite, :nom, :prenom, :adresse, :ville, :cp, :date_naissance, :lieu_naissance, :num_secu_sociale)');

                        if($req == false) {
                            echo "Erreur dans la préparation de la requête d'insertion.";
                        } else {

                            /// Exécution de la requête d'insertion
                            $req->execute(array(
                                'civilite' => $_POST['civilite'],
                                'nom' => $_POST['nom'],
                                'prenom' => $_POST['prenom'],
                                'adresse' => $_POST['adresse'],
                                'ville' => $_POST['ville'],
                                'cp' => $_POST['cp'],
                                'date_naissance' => $_POST['date_naissance'],
                                'lieu_naissance' => $_POST['lieu_naissance'],
                                'num_secu_sociale' => $_POST['num_secu_sociale'],
                            ));

                            $req->debugDumpParams();

                            echo "Le patient a été ajouté avec succès.";
                        }
                    }   
                }  
            }
        ?>



    </body>
</html>