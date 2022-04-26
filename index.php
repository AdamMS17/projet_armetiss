<?php
    require_once('controleur/controleurLogin.php');
    require_once('controleur/controleurAccueil.php');

    session_start();

    //$login = new ControleurLogin();
    $accueil = new ControleurAccueil();
?>