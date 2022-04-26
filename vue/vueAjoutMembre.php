
<?php 
    
    if ($flag) {
        echo "<p>Le membre $pseudo est bien inscrit</p>";
        
        // Changer le lien vers la page Accueil Personnel (Responsable ou Admin)
        echo "<a href=\"vueAccueil.php\">Se connecter</a>";
        exit;
    }
?>

<form action="vueAjoutMembre.php" method="POST"  >
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Ajouter un membre</h1>
            </div>
        </div>
    </div>

    <input type="text" id = "login" name="login" required minlength="4" maxlength="8" placeholder="Login">
    <input type="text" id = "nom" name="nom" required minlength="4" maxlength="8" placeholder="Nom">
    <input type="text" id = "prenom" name = "prenom" required minlength="4" maxlength="8" placeholder="Prénom">
    <input type="password" id = "mdp" name="mdp" required minlength="4" maxlength="8" placeholder="Mot de passe">
    <input type="password" id = "conMdp" name="conMdp" required minlength="4" maxlength="8" placeholder="Confirmez votre mot de passe">
    <input type="text" id = "ville" name="ville" required  placeholder="Ville">
    <input type="text" id = "rue" name="rue" required  placeholder="Rue">
    <input type="text" id = "numeroRue" name="numeroRue" required  placeholder="Numéro">
    <input type="text" id = "codePostal" name="codePostal" required  placeholder="Code Postal">
    <input type="text" id = "numeroTel" name="numeroTel" required  placeholder="Numéro Téléphone">
    <input type="date" id = "dateNaissance" name="dateNaissance" required  placeholder="Date de Naissance" >
    <input type="email" id="email" name="email" required placeholder="E-mail" >


    <input type="submit" class="btn btn-primary"  value="submitAjoutMembre">



</form>