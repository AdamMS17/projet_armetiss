<?php
    require_once('../vue/Vue.php');
    require_once('../modele/managers/ActiviteManager.php');
    require_once('../modele/Activite.php');

    session_start();

    // //AFFICHAGE
    // $vue = new Vue('AccueilAdmin');
    // $vue->generer(array());

    // $am = new ActiviteManager;
    // $activites;
    // $evenements;

    //AJOUT
    $vue = new Vue('AjoutActivite');

    $vue->generer(array());

    if (!empty($_POST["enregistrementActivite"])) {
        try {
            $am = new ActiviteManager;
            $data = array(
                'nom' => $_POST['nom'], 'jour' => $_POST['jour'], 'heureDebut' => $_POST['heureDebut'],
                'heureFin' => $_POST['heureFin']
            );
            $a = new Activite($data);
            $am->insert($a);

        } catch (Exception $e) {
            $msgErreur = $e->getMessage();
            $vue = new Vue('Erreur');
            $vue->generer(array('msgErreur' => $msgErreur));
        }
    }
