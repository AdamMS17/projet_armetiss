<?php

use function PHPSTORM_META\type;

    require_once '../modele/managers/PersonnelManager.php';
    require_once '../modele/managers/PersonneManager.php';
    require_once '../modele/Personne.php';
    require_once '../modele/Personnel.php';





    $manPersonnes = new PersonneManager();

    $personnes = $manPersonnes->getPersonnes();

    foreach ($personnes as $personne) {
        echo $personne->getDateNaiss()."<br>";
    }




    // test personneManager fonc login 
    
    
    if ($data = $manPersonnes->login("Admin","Admin")) {

        $admin = new Personne($data);
    }
    
    echo get_class($admin);




    // test role 

    echo "<br><br>Test role : <br>";


    $allPs = new PersonnelManager(); 
    


    
    foreach ($allPs->getPersonnels() as $personnel ) {
        echo $personnel->getId()."->".$personnel->getRole()."<br>";

    }




    //test insert 
    
    var_dump($data);
    $p1 = new Personne($data);

    echo "num : ".$p1->getNumero();
    //$manPersonnes->insert($p1);



?>