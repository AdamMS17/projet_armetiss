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
    

    $data = array(  "identifiant_Personne" => 0,
                    "login_Personne" => $login,
                    "nom_Personne" => $nom,
                    "prenom_Personne" => $prenom,
                    "motDePasse_Personne" => $mdp,
                    "ville_Personne"=>$ville,
                    "rue_Personne"=>$rue,
                    "numero_Personne"=>$numero,
                    "numeroTel_Personne"=>$numtel,
                    "dateNaiss_Personne"=>$datenaissance,
                    "email_Personne"=>$email);
    var_dump($data);


    $nvPersonne = new Personne($data);
    var_dump($nvPersonne);
    $personneMan->insert($nvPersonne);

    $dataResponsable = array($nvPersonne->getId(),2); // 2 => id pour Responsable 
    $responsable = new Personnel($dataResponsable);

    $personnelMan->insert($responsable);
    





}


//recup les responsables 

if (isset($_POST['action']) && $_POST['action'] === 'fetch') {

   
    $personneMan = new PersonneManager();
    $responsables = $personneMan->getPersonnes();
    $output = '';
    

    //verifier si il y a un responsable PAS FAIT !!!
    if (true) {
        $output .= '
            <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Login</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Numéro de Téléphone</th>
                    <th scope="col">Date de Naissance</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
        ';
        foreach ($responsables as $res) {
            $id = $res->getId();
            $login = $res->getLogin();
            $nom = $res->getNom();
            $prenom = $res->getPrenom();
            $numero = $res->getNumeroTel();
            $datenaiss = $res->getDateNaiss();
            $email = $res->getEmail();

            $output .= "
                <tr>
                <th scope=\"row\">$id</th>
                <td>$login</td>
                <td>$nom</td>
                <td>$prenom</td>
                <td>$numero</td>
                <td>$datenaiss</td>
                <td>$email</td>
                <td>
                    <a href=\"#\" class=\"text-info me-2 infoBtn\" title=\"Voir info\"><i class=\"fas fa-info-circle\"></i></a>
                    <a href=\"#\" class=\"text-primary me-2 editBtn\" title=\"Editer\"><i class=\"fas fa-edit\"></i></a>
                    <a href=\"#\" class=\"text-danger me-2 deleteBtn\" title=\"Supprimer\"><i class=\"fas fa-trash-alt\"></i></a>
                </td>

            </tr>
            
            ";
            
            
        }

        $output .= "</tbody></table>";

        echo $output;
    }
    else {
        echo "<h3>Aucuns Responsables</h3>";
    }

}



?>