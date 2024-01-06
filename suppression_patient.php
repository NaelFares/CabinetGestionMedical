
<?php
require('module/verificationUtilisateur.php');
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Modification d'un patient</title>
    <link href="style/style.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>  
</head>

<body>
        
    <?php
    require('module/bd_connexion.php');

    if (!empty($_GET['civilite']) && !empty($_GET['nom']) && !empty($_GET['prenom']) && !empty($_GET['adresse']) && !empty($_GET['cp']) && !empty($_GET['ville']) && !empty($_GET['date_naissance']) && !empty($_GET['lieu_naissance']) && !empty($_GET['num_secu_sociale'])) {
        // Récupérez les valeurs des paramètres GET
        $civilite = $_GET['civilite'];
        $nom = $_GET['nom'];
        $prenom = $_GET['prenom'];
        $adresse = $_GET['adresse'];
        $cp = $_GET['cp'];
        $ville = $_GET['ville'];
        $date_naissance = $_GET['date_naissance'];
        $lieu_naissance = $_GET['lieu_naissance'];
        $num_secu_sociale = $_GET['num_secu_sociale'];
        $idM = $_GET['idM'];
    }
    ?>

    <?php
        $msgErreur = ""; // Déclaration de la variable de message d'erreur

        if (isset($_POST['supprimer_patient'])) {
            // Récupérer les valeurs des paramètres POST
            $civilite = $_POST['civilite'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $adresse = $_POST['adresse'];
            $cp = $_POST['cp'];
            $ville = $_POST['ville'];
            $date_naissance = $_POST['date_naissance'];
            $lieu_naissance = $_POST['lieu_naissance'];
            $num_secu_sociale = $_POST['num_secu_sociale'];
            $idM = $_POST['idM'];

            // Préparation de la requête de suppression
            $reqSuppression = $linkpdo->prepare('DELETE FROM patient WHERE civilite = :civilite AND nom = :nom AND prenom = :prenom AND adresse = :adresse AND cp = :cp AND ville = :ville AND date_naissance = :date_naissance AND lieu_naissance = :lieu_naissance AND num_secu_sociale = :num_secu_sociale');

            if ($reqSuppression === false) {
                echo "Erreur de préparation de la requête.";
            } else {
                // Liaison des paramètres
                $reqSuppression->bindParam(':civilite', $civilite, PDO::PARAM_STR);
                $reqSuppression->bindParam(':nom', $nom, PDO::PARAM_STR);
                $reqSuppression->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                $reqSuppression->bindParam(':adresse', $adresse, PDO::PARAM_STR);
                $reqSuppression->bindParam(':ville', $ville, PDO::PARAM_STR);
                $reqSuppression->bindParam(':cp', $cp, PDO::PARAM_STR);
                $reqSuppression->bindParam(':date_naissance', $date_naissance, PDO::PARAM_STR);
                $reqSuppression->bindParam(':lieu_naissance', $lieu_naissance, PDO::PARAM_STR);
                $reqSuppression->bindParam(':num_secu_sociale', $num_secu_sociale, PDO::PARAM_STR);

                // Exécution de la requête
                $reqSuppression->execute();

                if ($reqSuppression === false) {
                    echo "Erreur dans l'exécution de la requête de suppression : ";
                } else {
                    // Afficher un message de succès
                    $msgErreur = "Le medecin a été supprimé avec succès !";

                    // Vider les valeurs dans les champs de saisie pour éviter les erreurs de récupération de champs vides par $_POST
                    $civilite = null;
                    $nom = null;
                    $prenom = null;
                    $adresse = null;
                    $cp = null;
                    $ville = null;
                    $date_naissance = null;
                    $lieu_naissance = null;
                    $num_secu_sociale = null;
                    $idM = null;
                }
            }
        }
        ?>


    

    <!--Espace vide pour permettre de placer le header en haut de page-->
    <div class="vide-haut-page"> </div>

    <div class="row justify-content-center">
        <div class=" col-lg-7 col-md-8">
            <div class="card p-9">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h2 class="heading text-center">Modifier un patient</h2>
                    </div>
                    <div class="errormessage text-center">
                        <p><?php echo $msgErreur; ?></p>
                    </div>
                </div>
                <!--Ne pas spécifier de action pour que le traitement php se fasse sur la page actuelle-->
                <form class="form-card" method="post" action="">
                    <div class="row justify-content-center form-group">
                        <div class="col-12 px-auto">
                            <fieldset>
                                <div class="custom-control custom-radio custom-control-inline"> 
                                    <input id="customRadioInline1" type="radio" name="civilite" value="Mme" class="custom-control-input" 
                                    <?php echo ($civilite == 'Mme') ? 'checked' : ''; ?> readonly> <!--Vérifie et coche la case correspondant à la civilité-->
                                    <label for="customRadioInline1" class="custom-control-label label-radio">Madame</label> 
                                </div>
                                <div class="custom-control custom-radio custom-control-inline"> 
                                    <input id="customRadioInline2" type="radio" name="civilite" value="M." class="custom-control-input" 
                                    <?php echo ($civilite == 'M.') ? 'checked' : ''; ?> readonly> <!--Vérifie et coche la case correspondant à la civilité-->
                                    <label for="customRadioInline2" class="custom-control-label label-radio">Monsieur</label> 
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="input-group"> <input type="text" name="nom" required value="<?php echo $nom; ?>" readonly> <label>Nom</label> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="input-group"> <input type="text" name="prenom" required value="<?php echo $prenom; ?>" readonly> <label>Prénom</label> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="input-group"> <input type="text" name="adresse" required value="<?php echo $adresse; ?>" readonly> <label>Adresse</label> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group"> <input type="text" minlength="5" maxlength="5" name="cp" required value="<?php echo $cp; ?>" readonly> <label>Code Postal</label> </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group"> <input type="text" name="ville" required value="<?php echo $ville; ?>" readonly> <label>Ville</label> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                      <!--Définit la date max comme la date actuelle, permet d'éviter de mettre une date de naissance antérieure-->
                                    <div class="input-group"> <input type="date" name="date_naissance" required value="<?php echo $date_naissance; ?>" max="<?php echo date('Y-m-d'); ?>" readonly> <label>Date de naissance</label> </div>
                                </div>
                                <div class="col-8">
                                    <div class="input-group"> <input type="text" name="lieu_naissance" required value="<?php echo $lieu_naissance; ?>" readonly> <label>Lieu de naissance</label> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="input-group"> <input type="text" name="num_secu_sociale" minlength="13" maxlength="13" required value="<?php echo $num_secu_sociale; ?>" readonly> <label>Numéro de sécurité sociale </label> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                                <div class="col-12">
                                <label> Choisissez un medecin référent (facultatif) </label>
                                    <div class="input-group">
                                        <select name="idM"> <!--required-->

                                             <?php
                                            //requête pour afficher le médecin référent du patient qu'on modifie à partir de l'Id du médecin récupéré
                                            $reqMedecinRefActuel = $linkpdo->prepare('SELECT civilite,nom, prenom FROM medecin WHERE idM = :idM');
                                            $reqMedecinRefActuel->bindParam(':idM', $idM, PDO::PARAM_INT);
                                            $reqMedecinRefActuel->execute();
                                            //On prend l'enregistrement du medecin actuel
                                            $medecinActuel = $reqMedecinRefActuel->fetch(PDO::FETCH_ASSOC);
                                            //On associe les valeurs à des variables pour les affichées dans l'option
                                            $civiliteMedecinActuel = $medecinActuel['civilite'];
                                            $nomMedecinActuel = $medecinActuel['nom'];
                                            $prenomMedecinActuel = $medecinActuel['prenom'];
                                            echo "<option value=\"$idM\">$civiliteMedecinActuel $nomMedecinActuel $prenomMedecinActuel</option>";
                                            ?>

                                            <option value="Aucun">Aucun</option>

                                            <?php
                                            //requête pour afficher la liste des medecins pour le choix d'un medecin référent
                                            $reqMedecins = $linkpdo->prepare('SELECT idM, civilite,nom, prenom FROM medecin');
                                            $reqMedecins->execute();
                                            while ($medecin = $reqMedecins->fetch(PDO::FETCH_ASSOC)) {
                                                $idMedecin = $medecin['idM'];
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
                                <input type="submit" name="supprimer_patient" value="Supprimer le patient" class="btn">
                                <input type="button" onclick="window.location.href='affichage_patient.php';" value="Annuler" class="">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Fin du formulaire-->
</body>
</html>

