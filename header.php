<!-- header.php -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Cabinet médical</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <!--Mise en place de l'entête de la page avec un menu horizontal -->
        <header>
          <nav class="navbar navbar-expand-lg bg-bluenav border-body navletters" data-bs-theme="dark">
            <div class="container-fluid" >
                <a class="navbar-brand" href="#">MedicoGest</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">

                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Usagers</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="affichage_patient.php">Voir la liste</a></li>
                    <li><a class="dropdown-item" href="ajout_patient.php">Ajouter un usager</a></li>
               </ul>
               </li>

               <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Médecins</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="affichage_medecin.php">Voir la liste</a></li>
                    <li><a class="dropdown-item" href="ajout_medecin.php">Ajouter un médecin</a></li>
               </ul>
               </li>

               <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Consultations</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Voir la liste</a></li>
                    <li><a class="dropdown-item" href="ajout_consultation.php">Ajouter une consultation</a></li>
               </ul>
               </li>
                 <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Statistiques</a>
                </li>
                </ul>
                </div>
            </div>
        </nav>
     </header>

    
    </body>
</html>