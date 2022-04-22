<?php 

require "../modele/PersonneManager.php";

function verifierConnexion($identifiant,$mdp)
{
    $res = null;
    $personne = new PersonneManager();

    if (!$personne->getPersonneAvecMdp($identifiant,$mdp)) {
        $res = "identifiant/mdp incorrect";
    }

    return $res;
}


/*****************************************************/

if (isset($_SESSION["sessionUtilisateur"])) {
    // pas complet ?  
    header("Location : ");
}


if (isset($_POST["submitConnexion"]) 
    && isset($_POST["identifiant"])
    && isset($_POST["mdp"])) {
    


    $personne = verifierConnexion(htmlspecialchars($identifiant),htmlspecialchars($mdp));
    
    if($personne){
        $_SESSION["sessionUtilisateur"] = $personne;
    }



    
}








