<?php
require('module/verificationUtilisateur.php');
?>

<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Suppression d'une consultation</title>
        <link href="style/style.css" rel="stylesheet">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="miseAJourComboBox.js"></script>
    </head>
    <body>

        <?php 
            require('module/bd_connexion.php');

            if (!empty($_GET['date_consultation']) && !empty($_GET['heure_debut']) && !empty($_GET['duree']) && !empty($_GET['idP']) && !empty($_GET['idM'])) {
                // Récupérez les valeurs des paramètres GET
                $date_consultation = $_GET['date_consultation'];
                $heure_debut = $_GET['heure_debut'];
                $duree = $_GET['duree'];
                $idP = $_GET['idP'];
                $idM = $_GET['idM'];
            }
        ?>

        <?php
                $msgErreur = ""; // Déclaration de la variable de message d'erreur

                if (isset($_POST['supprimer_consultation'])) {
                    $date_consultation = $_POST['date_consultation'];
                    $heure_debut = $_POST['heure_debut'];
                    $duree = $_POST['duree'];
                    $idP = $_POST['idP'];
                    $idM = $_POST['idM'];
                    // Préparation de la requête de suppression
                    // La prochaine fois utiliser + de paramètres dans le where pour éviter de supprimer les infos d'un homonyme 
                    $reqSuppression = $linkpdo->prepare('DELETE FROM consultation WHERE date_consultation = :date_consultation AND heure_debut = :heure_debut AND duree = :duree AND idP = :idP AND idM = :idM');

                    if ($reqSuppression === false) {
                        echo "Erreur de préparation de la requête.";
                    } else {
                        $reqSuppression->bindParam(':date_consultation', $date_consultation, PDO::PARAM_STR);
                        $reqSuppression->bindParam(':heure_debut', $heure_debut, PDO::PARAM_STR);
                        $reqSuppression->bindParam(':duree', $duree, PDO::PARAM_STR);                   
                        $reqSuppression->bindParam(':idM', $idM, PDO::PARAM_INT);
                        $reqSuppression->bindParam(':idP', $idP, PDO::PARAM_INT);

                        // Exécution de la requête
                        $reqSuppression->execute();

                        if($reqSuppression == false) {
                            echo "Erreur dans l'exécution de la requête de suppression.";
                        } else {
                            // Afficher un message de succès
                            $msgErreur = "La consultation a été supprimée avec succès !";

                            // vider les valeurs dans les champs de saisie pour éviter les erreurs de récupération de champs vides par $_POST
                            $date_consultation = null;
                            $heure_debut = null;
                            $duree = null;
                            $idM = null;
                            $idP = null;
                        }
                    }
                }
            ?>

       

        <!--Espace vide pour permettre de placer le header en haut de page-->
        <div class="vide-haut-page"> </div>

        <div>
            <!--Debut du formulaire-->
            <div class="row justify-content-center">
                <div class=" col-lg-7 col-md-8">
                    <div class="card p-9">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <h2 class="heading text-center">Supprimer une consultation</h2>
                                <div class="errormessage text-center">
                                    <p><?php echo $msgErreur; ?></p>
                                </div>
                            </div>
                        </div>
                        <form class="form-card" method="post" action="">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <label>Date</label>
                                        <div class="input-group-date"> 
                                            <input type="date" name="date" required value="<?php echo $date_consultation ?>" min="<?php echo date('Y-m-d'); ?>" readonly>  
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <label> Choisissez un creneau </label>
                                        <div class="input-group">
                                            <select name="heure" required readonly>
                                                <option> <?php echo $heure_debut; ?> </option> 
                                            </select>
                                        </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12">
                                <label> Choisissez une durée</label>
                                    <div class="input-group">
                                        <select name="duree" required readonly>
                                            <option> <?php echo $duree ?> </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <label> Choisissez un patient</label>
                                    <div class="input-group">
                                        <!-- Ajout de la classe 'patient-select' à l'élément select -->
                                        <select name="idP" class="patient-select" required readonly>
                                            <option> <?php echo $idP ?> </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <label> Choisissez un medecin</label>
                                    <div class="input-group">
                                        <!-- Ajout de l'ID 'medecin-select' à l'élément select -->
                                        <select name="idM" id="medecin-select" required readonly>
                                            <option> <?php echo $idM ?> </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="col-12">
                                        <input type="submit" name="supprimer_consultation" value="Supprimer la consultation" class="btn">
                                        <input type="button" onclick="window.location.href='affichage_consultation.php';" value="Annuler" class="">
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