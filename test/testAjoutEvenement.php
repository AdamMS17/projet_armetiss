<?php
    require_once('../vue/Vue.php');
    require_once('../modele/managers/evenementManager.php');
    require_once('../modele/Evenement.php');

    session_start();
    $vue = new Vue('AjoutEvenement');

    $vue->generer(array());

    if (!empty($_POST["enregistrementEvenement"])) {
        try {
            $em = new EvenementManager;
            $data = array(
                'nom' => $_POST['nom'], 'date' => $_POST['date'], 'heureDebut' => $_POST['heureDebut'],
                'heureFin' => $_POST['heureFin'], 'cout' => $_POST['cout']
            );
            $e = new Evenement($data);
            $em->insert($e);

        } catch (Exception $ex) {
            $msgErreur = $ex->getMessage();
            $vue = new Vue('Erreur');
            $vue->generer(array('msgErreur' => $msgErreur));
        }
    }