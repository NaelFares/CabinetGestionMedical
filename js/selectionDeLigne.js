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


    function envoyerVersPageModificationPatient() {

        if (ligneSelectionnee != null ) {
            // Récupérer les données de la ligne sélectionnée
            // Crypter les informations pour + de sécurité 
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
            // on oublie la colonne 9 car il s'agit du nom et prénom du médecin ref qui n'est pas utile ici
            var idM = encodeURIComponent(cells[10].innerText);

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
            "&num_secu_sociale=" + num_secu_sociale +
            "&idM=" + idM;
            

            // Rediriger vers la page de modification avec les paramètres dans l'URL
            window.location.href = url; 
        }
    }

    function envoyerVersPageSuppressionPatient() {

        if (ligneSelectionnee != null ) {
            // Récupérer les données de la ligne sélectionnée
            // Crypter les informations pour + de sécurité 
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
            // on oublie la colonne 9 car il s'agit du nom et prénom du médecin ref qui n'est pas utile ici
            var idM = encodeURIComponent(cells[10].innerText);

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
            "&num_secu_sociale=" + num_secu_sociale +
            "&idM=" + idM;
            

            // Rediriger vers la page de modification avec les paramètres dans l'URL
            window.location.href = url; 
        }
    }

    function envoyerVersPageModificationMedecin() {

        if (ligneSelectionnee != null ) {
            // Récupérer les données de la ligne sélectionnée
            // Crypter les informations pour + de sécurité 
            var cells = ligneSelectionnee.getElementsByTagName("td");
            var civilite = encodeURIComponent(cells[0].innerText);
            var nom = encodeURIComponent(cells[1].innerText);
            var prenom = encodeURIComponent(cells[2].innerText);

            // Construire l'URL avec les paramètres
            var url = "modification_medecin.php?" +
            "civilite=" + civilite +
            "&nom=" + nom +
            "&prenom=" + prenom;
            

            // Rediriger vers la page de modification avec les paramètres dans l'URL
            window.location.href = url; 
        }
    }

    function envoyerVersPageSuppressionMedecin() {

        if (ligneSelectionnee != null ) {
            // Récupérer les données de la ligne sélectionnée
            var cells = ligneSelectionnee.getElementsByTagName("td");
            var civilite = encodeURIComponent(cells[0].innerText);
            var nom = encodeURIComponent(cells[1].innerText);
            var prenom = encodeURIComponent(cells[2].innerText);

            // Construire l'URL avec les paramètres
            var url = "suppression_medecin.php?" +
            "civilite=" + civilite +
            "&nom=" + nom +
            "&prenom=" + prenom;
            // Rediriger vers la page de modification avec les paramètres dans l'URL
            window.location.href = url; 
        }
    }

    function envoyerVersPageModificationConsultation() {

        if (ligneSelectionnee != null ) {
            // Récupérer les données de la ligne sélectionnée
            // Crypter les informations pour + de sécurité 
            var cells = ligneSelectionnee.getElementsByTagName("td");
            var date_consultation = encodeURIComponent(cells[0].innerText);
            var heure_debut = encodeURIComponent(cells[1].innerText);
            var duree = encodeURIComponent(cells[2].innerText);
            var idP = encodeURIComponent(cells[4].innerText);
            var idM = encodeURIComponent(cells[5].innerText);

            // Construire l'URL avec les paramètres
            var url = "modification_consultation.php?" +
            "date_consultation=" + date_consultation +
            "&heure_debut=" + heure_debut +
            "&duree=" + duree +
            "&idP=" + idP +
            "&idM=" + idM;
            
            // Rediriger vers la page de modification avec les paramètres dans l'URL
            window.location.href = url; 
        }
    }

    function envoyerVersPageSuppressionConsultation() {

        if (ligneSelectionnee != null ) {
            // Récupérer les données de la ligne sélectionnée
            // Crypter les informations pour + de sécurité 
            var cells = ligneSelectionnee.getElementsByTagName("td");
            var date_consultation = encodeURIComponent(cells[0].innerText);
            var heure_debut = encodeURIComponent(cells[1].innerText);
            var duree = encodeURIComponent(cells[2].innerText);
            var idP = encodeURIComponent(cells[4].innerText);
            var idM = encodeURIComponent(cells[5].innerText);

            // Construire l'URL avec les paramètres
            var url = "suppression_consultation.php?" +
            "date_consultation=" + date_consultation +
            "&heure_debut=" + heure_debut +
            "&duree=" + duree +
            "&idP=" + idP +
            "&idM=" + idM;
            
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
