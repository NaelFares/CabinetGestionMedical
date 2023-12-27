<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Connexion</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </head>
    <body>

<div class="titre">
    <span>MedicoGest</span>
</div>

<div class="logo">
    <img src="image/LogoMedicoGest.png" />
</div>

<div class="container mt-5">
    <div class="row d-flex justify-content-center justify-align-content-center ">
        <div class="col-md-6">
        <div class="container-fluid d-flex align-items-center justify-content-center h-100" id="form1">
            <div class="card px-5 py-5 ">
                <div class="form-data" v-if="!submitted">
                    <div class="forms-inputs mb-4"> 
                        <span>Nom d'utilisateur</span> 
                    <input autocomplete="off" type="text" v-model="email" v-bind:class="{'form-control':true, 'is-invalid' : !validEmail(email) && emailBlured}" v-on:blur="emailBlured = true">
                        <div class="invalid-feedback">A valid user is required!</div>
                    </div>
                    <div class="forms-inputs mb-4"> 
                        <span>Mot de passe</span> 
                    <input autocomplete="off" type="password" v-model="password" v-bind:class="{'form-control':true, 'is-invalid' : !validPassword(password) && passwordBlured}" v-on:blur="passwordBlured = true">
                        <div class="invalid-feedback">Password must be 8 character!</div>
                    </div>
                    <div class="mb-3"> <button v-on:click.stop.prevent="submit" class="btn btn-dark w-100">Connexion</button> </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>

<style>

/* Style appliqué uniquement à la page d'accueil */

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

body {
    background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(44,117,255,1) 0%, rgba(55,218,252,1) 100%);
    display : flex;
    flex-direction : column;
    align-items: center;
}

.card {
    border: none;
    height: auto; /* Ajuster la hauteur automatiquement en fonction du contenu */
    width: 900px;
    min-width: 600px;
    max-width: 2000px; /* Définir une largeur maximale pour la carte */
    margin: 0 auto; /* Centrer la carte */
    justify-content: center;
    margin-bottom: 5rem;
}

.forms-inputs {
    position: relative;
    margin-bottom: 20px; /* Ajouter une marge entre les champs de saisie */
}

.forms-inputs span {
    position: absolute;
    top: -18px;
    left: 10px;
    background-color: #fff;
    padding: 5px 10px;
    font-size: 15px;
}

.forms-inputs input {
    width: 100%;
    padding: 10px;
    border: 2px solid #eee;
    box-sizing: border-box; /* Inclure le rembourrage et la bordure dans la largeur totale */
}

.forms-inputs input:focus {
    box-shadow: none;
    outline: none;
    border: 2px solid #2c75ff;
}

.btn {
    height: 50px;
}

.success-data {
    display: flex;
    flex-direction: column;
}

.bxs-badge-check {
    font-size: 90px;
}

.titre {
    margin-top: 4rem;
    color: white;
    font-size: 5rem;
    font-family: 'Lato', sans-serif;
    font-weight: bold;
}

.logo {
    display : flex;
    justify-content: center ;
}

.logo img{
    width: 50%;
}

</style>
