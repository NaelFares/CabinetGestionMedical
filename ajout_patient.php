<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Ajout d'un patient</title>
        <link href="style.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       
    </head>
    <body>

        <?php require('header.php');?>

<div>
    <div class="row justify-content-center">
        <div class=" col-lg-7 col-md-8">
            <div class="card p-9">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h2 class="heading text-center">Ajouter un patient</h2>
                    </div>
                </div>
                <form onsubmit="event.preventDefault()" class="form-card" method="POST" action="ajout_patient.php">
                    <div class="row justify-content-center form-group">
                        <div class="col-12 px-auto">
                            <fieldset>
                                <div class="custom-control custom-radio custom-control-inline"> 
                                    <input id="customRadioInline1" type="radio" name="civilite" value="Madame" class="custom-control-input" checked="true"> 
                                    <label for="customRadioInline1" class="custom-control-label label-radio">Madame</label> 
                                </div>
                                <div class="custom-control custom-radio custom-control-inline"> 
                                    <input id="customRadioInline2" type="radio" name="civilite" value="Monsieur" class="custom-control-input"> 
                                    <label for="customRadioInline2" class="custom-control-label label-radio">Monsieur</label> 
                                </div>
                             </fieldset>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="input-group"> <input type="text" name="nom" required> <label>Nom</label> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="input-group"> <input type="text" name="prenom" required> <label>Prénom</label> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="input-group"> <input type="text" name="adresse" required> <label>Adresse</label> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group"> <input type="text" minlength="5" maxlength="5"  name="cp" required> <label>Code Postal</label> </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group"> <input type="text" name="ville" required> <label>Ville</label> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    <div class="input-group"> <input type="date"  name="date_naissance" required> <label>Date de naissance</label> </div>
                                </div>
                                <div class="col-8">
                                    <div class="input-group"> <input type="text" name="lieu_naissance" required> <label>Lieu de naissance</label> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="input-group"> <input type="text" name="num_secu_sociale" minlength="13" maxlength="13" required> <label>Numéro de sécurité sociale </label> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="col-12">
                                 <input type="submit" name="ajouter_patient" value="Ajouter" class="btn-ajouter">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


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
                            'civilite' => $_POST['civilite'],
                            'nom' => $_POST['nom'],
                            'prenom' => $_POST['prenom'],
                            'adresse' => $_POST['adresse'],
                            'ville' => $_POST['ville'],
                            'cp' => $_POST['cp'],
                            'date_naissance' => $_POST['date_naissance'],
                            'lieu_naissance' => $_POST['lieu_naissance'],
                            'num_secu_sociale' => $_POST['num_secu_sociale']
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


<script>
        $(document).ready(function(){


//For Date formatted input
var expDate = document.getElementById('exp');
expDate.onkeyup = function (e) {
    if (this.value == this.lastValue) return;
    var caretPosition = this.selectionStart;
    var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
    var parts = [];
    
    for (var i = 0, len = sanitizedValue.length; i < len; i += 2) {
        parts.push(sanitizedValue.substring(i, i + 2));
    }
    
    for (var i = caretPosition - 1; i >= 0; i--) {
        var c = this.value[i];
        if (c < '0' || c > '9') {
            caretPosition--;
        }
    }
    caretPosition += Math.floor(caretPosition / 2);
    
    this.value = this.lastValue = parts.join('/');
    this.selectionStart = this.selectionEnd = caretPosition;
}
	
	// Radio button
	$('.radio-group .radio').click(function(){
	    $(this).parent().parent().find('.radio').removeClass('selected');
	    $(this).addClass('selected');
	});
})
</script>