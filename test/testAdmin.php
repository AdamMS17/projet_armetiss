<?php
require_once('../vue/Vue.php');
require_once('../modele/managers/ActiviteManager.php');
require_once('../modele/Activite.php');
require_once('../modele/managers/EvenementManager.php');
require_once('../modele/Evenement.php');
require_once('../modele/managers/SeanceManager.php');
require_once('../modele/Seance.php');

const PAGE = "testAdmin.php";

session_start();

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
            $derniereActiviteID = $am->insert($a);
            /*
            //________________________________________________________________________________
            $sm = new SeanceManager;
            $conversionJoursFrEngl = array(
                'Lundi' => 'Monday', 'Mardi' => 'Tuesday',
                'Mercredi' => 'Wednesday', 'Jeudi' => 'Thursday',
                'Vendredi' => 'Friday', 'Samedi' => 'Saturday',
                'Dimanche' => 'Sunday'
            );
            $conversionJoursEnglEnNum = array(
                'Monday' => 1, 'Tuesday' => 2, 'Wednesday' => 3,
                'Thursday' => 4, 'Friday' => 5, 'Saturday' => 6, 'Sunday' => 7
            );

            $jourFr = $_POST['jour'];
            $jourEngl = $conversionJoursFrEngl[$jourFr];
            $prochainJour = strtotime('next ' . $jourEngl);

            $semaineActuelle = date('W');
            $semaineProchainJour = date('W', $prochainJour);


            $timeslots = array(
                # Timeslot corresponding to Monday 15:00
                array('dow' => $conversionJoursEnglEnNum[$jourEngl]),
            );

            $date = strtotime('today');
            $end_date = strtotime('30 june 2022');
            while ($date <= $end_date) {
                # Convert the loop variable to day of week              
                $date_dow = date('w', $date);

                foreach ($timeslots as $timeslot) {
                    # Check if it matches the one in the timeslot
                    if ($date_dow == $timeslot['dow']) {
                        $dateSeance = date("D, j M Y H:i", $date);
                        $s = new Seance(
                            array(
                                'identifiant_Activite' => (int)$derniereActiviteID,
                                'date_Seance' => $dateSeance
                            )
                        );
                        $sm->insert($s);
                    }
                }
                $date += 86400; # advance one day
            }
            */
            header("location:" . PAGE);
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
            header("location:" . PAGE);
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
                'identifiant' => $_GET['modActivite'], 'nom' => $_POST['nom'], 'jour' => $_POST['jour'],
                'heureDebut' => $_POST['heureDebut'], 'heureFin' => $_POST['heureFin']
            );
            $a = new Activite($data);
            $am->update($a);
            header("location:" . PAGE);
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
        header("location:" . PAGE);
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
                'identifiant' => $_GET['modEvenement'], 'nom' => $_POST['nom'], 'date' => $_POST['date'],
                'heureDebut' => $_POST['heureDebut'], 'heureFin' => $_POST['heureFin'],
                'cout' => $_POST['cout']
            );
            $e = new Evenement($data);
            $_SESSION['Ev']=$e;
            $em->update($e);
            header("location:" . PAGE);
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
        header("location:" . PAGE);
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
