<?php
    session_start();
    
    
    define('URL', str_replace("index.php", "",
    (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
 
    require_once('controleur/Routeur.php');
 
    $routeur = new Routeur();
    $routeur->routeReq();
?>