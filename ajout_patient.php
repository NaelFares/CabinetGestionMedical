<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Ajout d'un patient</title>
    </head>
    <body>

        <!--A vérifier-->
        <form method="POST" action="ajout_patient.php">
            <!--Squellette html de la page-->
			<fieldset>
				<legend>Saisir les informations d'un patient</legend>
                <!--Civilité-->
                <fieldset>
                    <legend>Civilité</legend>
                    <div>
                        <label for="monsieur">Monsieur</label>
                        <input type="radio" id ="monsieur" name= "civilite" value="" checked /> 
                    </div>

                    <div>
                        <label for="madame">Madame</label>
                        <input type="radio" id ="madame" name= "civilite" value="" checked /> 
                    </div>
                </fieldset>

				<!--Nom-->
                <label for="nom">Nom : </label>
				<input type="text" maxlength="50" id="non" name="nom" value="" required><br>

                <!--Prénom-->
				<label for="prenom">Prenom : </label>
				<input type="text" maxlength="50" id="prenom" name="prenom" value="" required><br>

                <!--Adresse-->
				<label for="adresse">Adresse : </label>
				<input type="text" maxlength="100" id="adresse" name="adresse" value="" required><br>
                
                <!--Ville-->
				<label for="ville">Ville : </label>
				<input type="text" maxlength="50" id="ville" name="ville" value="" required><br>

                <!--Cp-->
				<label for="cp">Code Postal : </label>
				<input type="text" minlength="5" maxlength="5" id="cp" name="cp" value="" required><br>

                <!--Date de naissance-->
				<label for="date_naissance">Date de naissance : </label>
				<input type="date" id="date_naissance" name="date_naissance" value="" required><br>

                <!--Lieu de naissance-->
				<label for="lieu_naissance ">Lieu de naissance : </label>
				<input type="text" maxlength="50" id="lieu_naissance " name="lieu_naissance" value="" required><br>

                <!--Numéro de sécurité sociale-->
				<label for="num_secu_sociale">Numéro de sécurité sociale : </label>
				<input type="text" minlength="13" maxlength="13" id="num_secu_sociale" name="num_secu_sociale" value="" required><br>

                <!--
                    Bouton valider (insère les données saisies dans le formulaire dans la base de données) 
                    Bouton effacer (efface le contenu du formulaire remplie par l'utilisateur si erreur)
                    Bonton Annuler (ferme la page ajout_patient sans enregistrer les données possiblement saisies)
                -->
				<input type="submit" value="Valider" name="">
                <input type="reset" value="Effacer" name="">
                <input type="submit" value="Annuler" name=""> 
            </fieldset>	
		</form>

        <!--Serveur-->
        <?php
            print_r($_POST);

            require('bd_connexion.php');

            // Préparation de la requête de test de présence d'un contact
            $reqExisteDeja = $linkpdo->prepare('SELECT COUNT(*) FROM patient WHERE nom = :nom AND prenom = :prenom');

            //Test de la requete de présence d'un contact => die si erreur
            if($reqExisteDeja == false) {
                die("Erreur de préparation de la requête de test de présence d'un patient.");
            } else {

                // Liaison des paramètres
                //PDO::PARAM_STR : C'est le type de données que vous spécifiez pour le paramètre. 
                //Ici, on indique que :nom doit être traité comme une chaîne de caractères (string). 
                //Cela permet à PDO de s'assurer que la valeur est correctement échappée et protégée contre les injections SQL
                $reqExisteDeja->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
                $reqExisteDeja->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);

                // Exécution de la requête
                $reqExisteDeja->execute();

                //Vérification de la bonne exécution de la requete ExisteDéja
                //Si oui on arrete et on affiche une erreur
                //Si non on execute la requete
                if($reqExisteDeja == false) {
                    die("Erreur dans l'exécution de la requête de test de présence d'un patient.");
                } else {

                    // Récupération du résultat
                    $nbPatients = $reqExisteDeja->fetchColumn();

                    // Vérification si le patient existe déjà
                    if ($nbContacts > 0) {
                        echo "Ce patient existe déjà dans la base de données.";
                    } else {
                        // Préparation de la requête d'insertion
                        $req = $linkpdo->prepare('INSERT INTO patient(nom, prenom, adresse, ville, cp, date_naissance, lieu_naissance, num_secu_sociale) VALUES(:nom, :prenom, :adresse, :ville, :cp, :date_naissance, :lieu_naissance, :num_secu_sociale)');

                        // Vérification du fonctionnement de la requete d'insertion
                        if($req == false) {
                            die('Probleme de la préparation de la requete d\'insertion');
                        } else {
                            echo ('Ok');
                        }

                        // Exécution de la requête d'insertion
                        $req->execute(array(
                            'nom' => $_POST['nom'],
                            'prenom' => $_POST['prenom'],
                            'adresse' => $_POST['adresse'],
                            'ville' => $_POST['ville'],
                            'cp' => $_POST['cp'],
                            'date_naissance' => $_POST['date_naissance'],
                            'lieu_naissance' => $_POST['lieu_naissance'],
                            'num_secu_sociale' => $_POST['num_secu_sociale'],
                        ));
                            //Permet de voir comment les requetes SQL agisse sur phpMyAdmin
                            $req->debugDumpParams();

                            echo "Le patient a été ajouté avec succès.";
                    }
                }   
            }       
        ?>
    </body>
</html>