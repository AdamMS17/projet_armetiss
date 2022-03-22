<?php
    require_once('../vue/Vue.php');
    require_once('../modele/managers/ActiviteManager.php');
    require_once('../modele/Activite.php');
    require_once('../modele/managers/evenementManager.php');
    require_once('../modele/Evenement.php');

    session_start();

    //AFFICHAGE
    $am = new ActiviteManager;
    $em = new EvenementManager;
    $activites = $am->getActivites();
    $evenements = $em->getEvenements();

    $vue = new Vue('AccueilAdmin');
    $vue->generer(array('activites' => $activites, 'evenements' => $evenements));

    
