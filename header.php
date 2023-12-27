<!-- header.php -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Cabinet médical</title>
        <!-- Lien boostrap pour certains éléments utilisés dans les pages, appel fais dans le header 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
         -->
        <link href="style.css" rel="stylesheet">
    </head>
    
    <body>
        <!--Mise en place de l'entête de la page avec un menu horizontal -->
        <!-- On créer une class pour le header afin que les style boostrap ne s'appliquent pas sur le header quand il sera appelé dans d'autres classes -->
        <header class="custom-header">
        <nav>
            <div class="wrapper">
                <div class="logo">
                    <a href="#">MedicoGest</a>
                </div>
                <input type="radio" name="slider" id="menu-btn">
                <input type="radio" name="slider" id="close-btn">
                <ul class="nav-links">
                <label for="close-btn" class="btn close-btn"><i class="fas fa-times"></i></label>
                <li>
                    <a href="#" class="desktop-item">Usagers</a>
                    <input type="checkbox" id="showDrop">
                    <label for="showDrop" class="mobile-item">Usagers</label>
                    <ul class="drop-menu">
                    <li><a href="affichage_patient.php">Voir la liste</a></li>
                    <li><a href="ajout_patient.php">Ajouter usager</a></li>
                    </ul>
                </li>
                <li>
                <li>
                    <a href="#" class="desktop-item">Médecins</a>
                    <input type="checkbox" id="showDrop">
                    <label for="showDrop" class="mobile-item">Médecins</label>
                    <ul class="drop-menu">
                    <li><a href="affichage_medecin.php">Voir la liste</a></li>
                    <li><a href="ajout_medecin.php">Ajouter médecin</a></li>
                    </ul>
                </li>
                <li>
                <li>
                    <a href="#" class="desktop-item">Consultations</a>
                    <input type="checkbox" id="showDrop">
                    <label for="showDrop" class="mobile-item">Consultations</label>
                    <ul class="drop-menu">
                    <li><a href="affichage_consultation.php">Voir la liste</a></li>
                    <li><a href="ajout_consultation.php">Ajouter consultation</a></li>
                    </ul>
                </li>
                <li><a href="#">Statistiques</a></li>
                </ul>
                <label for="menu-btn" class="btn menu-btn"><i class="fas fa-bars"></i></label>
            </div>
        </nav>

     </header>
    </body>
</html>
