<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Ajout d'une consultation</title>
        <link href="style.css" rel="stylesheet">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
       
    </head>
    <body>

        <?php require('header.php');?>

<div>
    <!--Debut du formulaire-->
    <div class="row justify-content-center">
        <div class=" col-lg-7 col-md-8">
            <div class="card p-9">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h2 class="heading text-center">Ajouter une consultation</h2>
                        <h4 class="errormessage text-center">
                        <?php

                        //print_r($_POST);

                        require('bd_connexion.php');
                        // Préparation de la requête de test de présence d'un medecin
                        $reqExisteDeja = $linkpdo->prepare('SELECT COUNT(*) FROM consultation WHERE date_heure = :date_heure AND idP = :idP AND idM = :idM');

                        //Test de la requete de présence d'un medecin => die si erreur
                        if($reqExisteDeja == false) {
                            die("Erreur de préparation de la requête de test de présence d'une consultation.");
                        } else {

                            // Liaison des paramètres
                            //PDO::PARAM_STR : C'est le type de données que vous spécifiez pour le paramètre. 
                            //Ici, on indique que :nom doit être traité comme une chaîne de caractères (string). 
                            //Cela permet à PDO de s'assurer que la valeur est correctement échappée et protégée contre les injections SQL
                            $reqExisteDeja->bindParam(':date_heure', $_POST['date_heure'], PDO::PARAM_STR);
                            $reqExisteDeja->bindParam(':idP', $_POST['idP'], PDO::PARAM_STR);
                            $reqExisteDeja->bindParam(':idM', $_POST['idM'], PDO::PARAM_STR);


                            // Exécution de la requête
                            $reqExisteDeja->execute();

                            //Vérification de la bonne exécution de la requete ExisteDéja
                            //Si oui on arrete et on affiche une erreur
                            //Si non on execute la requete
                            if($reqExisteDeja == false) {
                                die("Erreur dans l'exécution de la requête de test de présence d'une consultation.");
                            } else {

                                // Récupération du résultat
                                $nbConsultations = $reqExisteDeja->fetchColumn();

                                // Vérification si le patient existe déjà
                                if ($nbConsultations > 0) {
                                    echo "Cette consultation existe déjà dans la base de données.";
                                } else {
                                    // Préparation de la requête d'insertion
                                    $req = $linkpdo->prepare('INSERT INTO consultation(date_heure, idP, idM) VALUES(:date_heure, :idP, :idM)');

                                    // Vérification du fonctionnement de la requete d'insertion
                                    if($req == false) {
                                        die('Probleme de la préparation de la requete d\'insertion');
                                    }

                                    if (empty($_POST['date_heure']) || empty($_POST['idP']) || empty($_POST['idM'])) {
                                        echo "Champs manquants.";
                                    } else {

                                            // Exécution de la requête d'insertion
                                            $req->bindParam(':date_heure', $_POST['date_heure'], PDO::PARAM_STR);
                                            $req->bindParam(':idP', $_POST['idP'], PDO::PARAM_STR);
                                            $req->bindParam(':idM', $_POST['idM'], PDO::PARAM_STR);
                                            $req->execute();

                                                //Permet de voir comment les requetes SQL agisse sur phpMyAdmin
                                                //$req->debugDumpParams();

                                                echo "La consultation a été ajoutée avec succès.";
                                        }
                                    }   
                                } }      
                            ?></h4>

                    </div>
                </div>
                <form class="form-card" method="post" action="ajout_consultation.php">
                    
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="input-group"> <input type="date" name="date" required> <label>Date</label> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="input-group"> <input type="time" name="heure" required> <label>Heure</label> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                        <label> Choisissez un patient</label>
                            <div class="input-group">
                                <select name="combo_idP" required>
                                    <?php
                                    $reqPatients = $linkpdo->prepare('SELECT idP, civilite, nom, prenom FROM patient');
                                    $reqPatients->execute();
                                    while ($patient = $reqPatients->fetch(PDO::FETCH_ASSOC)) {
                                        $idPatient = $patient['id'];
                                        $civilitePatient = $patient['civilite'];
                                        $nomPatient = $patient['nom'];
                                        $prenomPatient = $patient['prenom'];
                                        echo "<option value=\"$idPatient\">$civilitePatient $nomPatient $prenomPatient</option>";}
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                        <label> Choisissez un medecin</label>
                            <div class="input-group">
                                <select name="combo_idM" required>
                                <?php
                                $reqMedecins = $linkpdo->prepare('SELECT idM, civilite,nom, prenom FROM medecin');
                                $reqMedecins->execute();
                                while ($medecin = $reqMedecins->fetch(PDO::FETCH_ASSOC)) {
                                    $idMedecin = $medecin['id'];
                                    $civiliteMedecin = $medecin['civilite'];
                                    $nomMedecin = $medecin['nom'];
                                    $prenomMedecin = $medecin['prenom'];
                                    echo "<option value=\"$idMedecin\">$civiliteMedecin $nomMedecin $prenomMedecin</option>";}
                                 ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="col-12">
                                 <input type="submit" name="ajouter_consultation" value="Ajouter" class="btn-ajouter">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!--Fin du formulaire-->

</div>


<!--Serveur-->

                
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