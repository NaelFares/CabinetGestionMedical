// Script permettant de selectionner une ligne visuellement et d'ajouter ses informations dans le lien pour modification 
    var ligneSelectionnee = null;

    function selectionnerLigne(ligne) {
        // Réinitialiser la couleur de fond de toutes les lignes
        var lignes = document.getElementsByTagName("tr");
        for (var i = 0; i < lignes.length; i++) {
            lignes[i].style.backgroundColor = "";
        }

        // Mettre en surbrillance la ligne sélectionnée
        ligne.style.backgroundColor = "#32aafe";

        // Activer le bouton de modification
        var boutonModification = document.getElementById("boutonModification");
        boutonModification.removeAttribute("disabled");

        // Activer le bouton de suppression
        var boutonSuppression = document.getElementById("boutonSuppression");
        boutonSuppression.removeAttribute("disabled");

        // Stocker la ligne sélectionnée
        ligneSelectionnee = ligne;
    }

    function envoyerVersPageModification() {

        if (ligneSelectionnee != null ) {
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

            // Construire l'URL avec les paramètres
            var url = "modification_patient.php?" +
            "civilite=" + civilite +
            "&nom=" + nom +
            "&prenom=" + prenom +
            "&adresse=" + adresse +
            "&cp=" + cp +
            "&ville=" + ville +
            "&date_naissance=" + date_naissance +
            "&lieu_naissance=" + lieu_naissance +
            "&num_secu_sociale=" + num_secu_sociale;

            // Rediriger vers la page de modification avec les paramètres dans l'URL
            window.location.href = url; 
        }
    }

    function envoyerVersPageSuppression() {

        if (ligneSelectionnee != null ) {
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

            // Construire l'URL avec les paramètres
            var url = "suppression_patient.php?" +
            "civilite=" + civilite +
            "&nom=" + nom +
            "&prenom=" + prenom +
            "&adresse=" + adresse +
            "&cp=" + cp +
            "&ville=" + ville +
            "&date_naissance=" + date_naissance +
            "&lieu_naissance=" + lieu_naissance +
            "&num_secu_sociale=" + num_secu_sociale;

            // Rediriger vers la page de modification avec les paramètres dans l'URL
            window.location.href = url; 
        }
    }

      // Gestionnaire d'événement pour le clic sur le document
      document.addEventListener("click", function(event) {
        var elementClic = event.target;
        
        // Vérifier si l'élément cliqué n'est pas une ligne du tableau
        if (!elementClic.closest('tr')) {
            // Réinitialiser la sélection
            if (ligneSelectionnee) {
                ligneSelectionnee.style.backgroundColor = "";
                ligneSelectionnee = null;

                // Désactiver le bouton de modification
                var boutonModification = document.getElementById("boutonModification");
                boutonModification.setAttribute("disabled", "true");

                // Désactiver le bouton de suppression
                var boutonSuppression = document.getElementById("boutonSuppression");
                boutonSuppression.setAttribute("disabled", "true");
            }
        }
    });
