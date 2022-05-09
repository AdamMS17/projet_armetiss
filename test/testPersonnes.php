<?php 

    require_once '../modele/managers/PersonnelManager.php';
    require_once '../modele/managers/PersonneManager.php';
    require_once '../modele/Personne.php';
    require_once '../modele/Personnel.php';





    $manPersonnes = new PersonneManager();

    $personnes = $manPersonnes->getPersonnes();



    foreach ($personnes as $personne) {
        echo $personne->getNom();

    }

?>