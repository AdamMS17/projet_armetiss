<?php 

require_once '../modele/managers/PersonnelManager.php';
require_once '../modele/managers/PersonneManager.php';
require_once '../modele/Personne.php';
require_once '../modele/Personnel.php';



//creation de responsable
if (isset($_POST['action']) && $_POST['action'] === 'create') {
    
    extract($_POST);    

    $personneMan = new PersonneManager();
    $personnelMan = new PersonnelManager();
   

    $nvPersonne = new Personne(0,$login,$nom,$prenom,$mdp,$ville,$rue,$numero,$numtel,$datenaissance,$email);
    $personneMan->insert($nvPersonne);

    $responsable = new Personnel($nvPersonne->getId(),1);

    $personnelMan->insert($responsable);
    





}



?>