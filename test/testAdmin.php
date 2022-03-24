<?php
require_once('../vue/Vue.php');
require_once('../modele/managers/ActiviteManager.php');
require_once('../modele/Activite.php');
require_once('../modele/managers/evenementManager.php');
require_once('../modele/Evenement.php');

const PAGE="testAdmin.php";

//________________________________
session_start();
// try {
// } catch (Exception $e) {
//     $msgErreur = $e->getMessage();
//     $vue = new Vue('Erreur');
//     $vue->generer(array('msgErreur' => $msgErreur));
// }
//________________________________
if (!empty($_GET['ajoutActivite'])) {

    //AJOUT D'UNE ACTIVITE
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
            header("location:".PAGE);
        } catch (Exception $e) {
            $msgErreur = $e->getMessage();
            $vue = new Vue('Erreur');
            $vue->generer(array('msgErreur' => $msgErreur));
        }
    }
} else if (!empty($_GET['ajoutEvenement'])) {

    //AJOUT D'UN EVENEMENT
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
            header("location:".PAGE);
        } catch (Exception $ex) {
            $msgErreur = $ex->getMessage();
            $vue = new Vue('Erreur');
            $vue->generer(array('msgErreur' => $msgErreur));
        }
    }
} else if (!empty($_GET['modActivite'])) {
    //MODIFICATION D'UNE ACTIVITE
    $vue = new Vue('ModificationActivite');
    $am = new ActiviteManager;
    $a = $am->getActivite($_GET['modActivite']);
    $vue->generer(array('activite' => $a));

    if (!empty($_POST["modificationActivite"])) {
        try {
            $data = array(
                'id' => $_GET['modActivite'], 'nom' => $_POST['nom'], 'jour' => $_POST['jour'],
                'heureDebut' => $_POST['heureDebut'], 'heureFin' => $_POST['heureFin']
            );
            $a = new Activite($data);
            $am->update($a);
            header("location:".PAGE);
        } catch (Exception $e) {
            $msgErreur = $e->getMessage();
            $vue = new Vue('Erreur');
            $vue->generer(array('msgErreur' => $msgErreur));
        }
    }
} else if (!empty($_GET['suppActivite'])) {
    try {
        $am = new ActiviteManager;
        $am->delete($_GET['suppActivite']);
        header("location:".PAGE);
    } catch (Exception $e) {
        $msgErreur = $e->getMessage();
        $vue = new Vue('Erreur');
        $vue->generer(array('msgErreur' => $msgErreur));
    }
} else if (!empty($_GET['modEvenement'])) {
    //MODIFICATION D'UN EVENEMENT
    $vue = new Vue('ModificationEvenement');
    $em = new EvenementManager;
    $e = $em->getEvenement($_GET['modEvenement']);
    $vue->generer(array('evenement' => $e));

    if (!empty($_POST["modificationEvenement"])) {
        try {
            $data = array(
                'id' => $_GET['modEvenement'], 'nom' => $_POST['nom'], 'date' => $_POST['date'],
                'heureDebut' => $_POST['heureDebut'], 'heureFin' => $_POST['heureFin'],
                'cout' => $_POST['cout']
            );
            $e = new Evenement($data);
            $em->update($e);
            header("location:".PAGE);
        } catch (Exception $e) {
            $msgErreur = $e->getMessage();
            $vue = new Vue('Erreur');
            $vue->generer(array('msgErreur' => $msgErreur));
        }
    }
} else if (!empty($_GET['suppEvenement'])) {
    try {
        $em = new EvenementManager;
        $em->delete($_GET['suppEvenement']);
        header("location:".PAGE);
    } catch (Exception $e) {
        $msgErreur = $e->getMessage();
        $vue = new Vue('Erreur');
        $vue->generer(array('msgErreur' => $msgErreur));
    }
} else {
    //AFFICHAGE
    $am = new ActiviteManager;
    $em = new EvenementManager;
    $activites = $am->getActivites();
    $evenements = $em->getEvenements();

    $vue = new Vue('AccueilAdmin');
    $vue->generer(array('activites' => $activites, 'evenements' => $evenements));
}
