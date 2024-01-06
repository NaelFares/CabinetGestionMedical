document.addEventListener('DOMContentLoaded', function () {
    var patientSelect = document.querySelector('.patient-select');
    var medecinSelect = document.getElementById('medecin-select');

    patientSelect.addEventListener('change', function () {
        var selectedPatientId = patientSelect.value;

        // Utilisation de fetch pour simplifier la requête AJAX
        fetch('selectMedecinParPatient.php', {
            method: 'POST',
            headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            },
            body: 'patientId=' + selectedPatientId
        })
        .then(response => response.text())
        .then(options => {
            // Mettre à jour le contenu du deuxième sélecteur avec les nouvelles options
            medecinSelect.innerHTML = options;
        })
        .catch(error => console.error('Erreur lors de la requête AJAX:', error));
    });
});

