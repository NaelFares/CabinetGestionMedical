<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Les Patients</title>
    <link href="style.scss" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
     require('header.php');
     require('bd_connexion.php');
     ?>

    <div class="container">
        <table class="responsive-table">
            <thead>
                <tr>
                    <th class="col-civilite">Civilité</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>Code Postal</th>
                    <th class="col-adresse">Ville</th>
                    <th>Date de naissance</th>
                    <th>Lieu de naissance</th>
                    <th>N° sécurité sociale</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $reqAffichage = $linkpdo->prepare('SELECT civilite, nom, prenom, adresse, ville, cp, date_naissance, lieu_naissance, num_secu_sociale FROM patient');

                if ($reqAffichage == false) {
                    echo "Erreur dans la préparation de la requête de recherche.";
                } else {
                    $reqAffichage->execute();

                    if ($reqAffichage == false) {
                        echo "Erreur dans l'exécution de la requête d'affichage.";
                    } else {
                        while ($patient = $reqAffichage->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr onclick=\"selectionnerLigne(this)\">";
                            echo "<th>{$patient['civilite']}</th>";
                            echo "<td>{$patient['nom']}</td>";
                            echo "<td>{$patient['prenom']}</td>";
                            echo "<td>{$patient['adresse']}</td>";
                            echo "<td>{$patient['cp']}</td>";
                            echo "<td>{$patient['ville']}</td>";
                            echo "<td>{$patient['date_naissance']}</td>";
                            echo "<td>{$patient['lieu_naissance']}</td>";
                            echo "<td>{$patient['num_secu_sociale']}</td>";
                            echo "</tr>";
                        }
                    }
                }
                ?>
            </tbody>
        </table>

        <a href="ajout_patient.php"><button>Ajouter un patient</button></a>
        <a href="modification_patient.php" id="boutonModification" onclick="envoyerVersPageModification()" disabled>Modifier un patient</a>
        <a href="suppression_patient.php"><button>Supprimer un patient</button></a>
    </div>

    <script>
        var ligneSelectionnee = null;

        function selectionnerLigne(ligne) {
            // Réinitialiser la couleur de fond de toutes les lignes
            var lignes = document.getElementsByTagName("tr");
            for (var i = 0; i < lignes.length; i++) {
                lignes[i].style.backgroundColor = "";
            }

            // Mettre en surbrillance la ligne sélectionnée
            ligne.style.backgroundColor = "#2c75ff";

            // Activer le bouton de modification
            var boutonModification = document.getElementById("boutonModification");
            boutonModification.removeAttribute("disabled");

            // Stocker la ligne sélectionnée
            ligneSelectionnee = ligne;
        }

        function envoyerVersPageModification() {
            if (ligneSelectionnee) {
                // Récupérer les données de la ligne sélectionnée
                var cells = ligneSelectionnee.getElementsByTagName("td");
                var civilite = encodeURIComponent(cells[0].innerText);
                var nom = encodeURIComponent(cells[1].innerText);
                var prenom = encodeURIComponent(cells[2].innerText);
                var adresse = encodeURIComponent(cells[3].innerText);
                var cp = encodeURIComponent(cells[4].innerText);
                var ville = encodeURIComponent(cells[5].innerText);
                var date_naissance = encodeURIComponent(cells[6].innerText);
                var lieu_naissance = encodeURIComponent(cells[7].innerText);
                var num_secu_sociale = encodeURIComponent(cells[8].innerText);

                // Rediriger vers la page de modification avec les informations de la ligne
                window.location.href = 'modification_patient.php?id=' +
                    '&civilite=' + civilite +
                    '&nom=' + nom +
                    '&prenom=' + prenom +
                    '&adresse=' + adresse +
                    '&cp=' + cp +
                    '&ville=' + ville +
                    '&date_naissance=' + date_naissance +
                    '&lieu_naissance=' + lieu_naissance +
                    '&num_secu_sociale=' + num_secu_sociale;
            }
        }
    </script>
</body>
</html>
