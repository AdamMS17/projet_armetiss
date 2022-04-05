<?php 

require "../modele/PersonneManager.php";

function verfierConnexion()
{
    $res = null;
    $personne = new PersonneManager();

    if (!$personne->getPersonneAvecMdp()) {
        $res = "identifiant/mdp incorrect";
    }
    return $res;
}

function creerSession()
{
    # code...
}