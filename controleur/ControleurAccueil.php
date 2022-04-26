<?php
require_once('vue/Vue.php');
require_once('modele/managers/ActiviteManager.php');
require_once('modele/Activite.php');
require_once('modele/managers/EvenementManager.php');
require_once('modele/Evenement.php');
require_once('modele/managers/SeanceManager.php');
require_once('modele/Seance.php');

class ControleurAccueil
{
    private $_vue;

    public function __construct()
    {
        //if (isset($_SESSION['utilisateur'])) {

            //todo menu

            //if ($_SESSION['utilisateur']->isAdmin()) {
                if (!empty($_GET['ajoutActivite'])) {
                    $this->ajoutActivite();
                } else if (!empty($_GET['ajoutEvenement'])) {
                    $this->ajoutEvenement();
                } else if (!empty($_GET['modActivite'])) {
                    $this->modifActivite();
                } else if (!empty($_GET['modEvenement'])) {
                    $this->modifEvenement();
                } else if (!empty($_GET['suppActivite'])) {
                    $this->suppActivite();
                } else if (!empty($_GET['suppEvenement'])) {
                    $this->suppEvenement();
                } else $this->accueilAdmin();
            //}
        //} else $this->login();
    }

    public function login()
    {
        header("Location:login");
    }

    private function ajoutActivite()
    {
        //AJOUT D'UNE ACTIVITE
        $_vue = new Vue('AjoutActivite');

        $_vue->generer(array());

        if (!empty($_POST["enregistrementActivite"])) {
            try {
                $am = new ActiviteManager;
                $data = array(
                    'nom' => $_POST['nom'], 'jour' => $_POST['jour'], 'heureDebut' => $_POST['heureDebut'],
                    'heureFin' => $_POST['heureFin']
                );
                $a = new Activite($data);
                $derniereActiviteID = $am->insert($a);

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
            
                //todo redirection


            } catch (Exception $e) {
                $msgErreur = $e->getMessage();
                $_vue = new Vue('Erreur');
                $_vue->generer(array('msgErreur' => $msgErreur));
            }
        }
    }

    private function modifActivite()
    {
        //MODIFICATION D'UNE ACTIVITE
        $_vue = new Vue('ModificationActivite');
        $am = new ActiviteManager;
        $a = $am->getActivite($_GET['modActivite']);
        $_vue->generer(array('activite' => $a));

        if (!empty($_POST["modificationActivite"])) {
            try {

                $data = array(
                    'identifiant' => $_GET['modActivite'], 'nom' => $_POST['nom'], 'jour' => $_POST['jour'],
                    'heureDebut' => $_POST['heureDebut'], 'heureFin' => $_POST['heureFin']
                );
                $a = new Activite($data);
                $am->update($a);


                //todo redirection

            } catch (Exception $e) {
                $msgErreur = $e->getMessage();
                $_vue = new Vue('Erreur');
                $_vue->generer(array('msgErreur' => $msgErreur));
            }
        }
    }

    private function suppActivite()
    {
        try {
            $am = new ActiviteManager;
            $am->delete($_GET['suppActivite']);

            //todo redirection

        } catch (Exception $e) {
            $msgErreur = $e->getMessage();
            $_vue = new Vue('Erreur');
            $_vue->generer(array('msgErreur' => $msgErreur));
        }
    }

    private function ajoutEvenement()
    {
        //AJOUT D'UN EVENEMENT
        $_vue = new Vue('AjoutEvenement');

        $_vue->generer(array());

        if (!empty($_POST["enregistrementEvenement"])) {
            try {
                $em = new EvenementManager;
                $data = array(
                    'nom' => $_POST['nom'], 'date' => $_POST['date'], 'heureDebut' => $_POST['heureDebut'],
                    'heureFin' => $_POST['heureFin'], 'cout' => $_POST['cout']
                );
                $e = new Evenement($data);
                $em->insert($e);


                //todo redirection


            } catch (Exception $e) {
                $msgErreur = $e->getMessage();
                $_vue = new Vue('Erreur');
                $_vue->generer(array('msgErreur' => $msgErreur));
            }
        }
    }

    private function modifEvenement()
    {
        //MODIFICATION D'UN EVENEMENT
        $_vue = new Vue('ModificationEvenement');
        $em = new EvenementManager;
        $e = $em->getEvenement($_GET['modEvenement']);
        $_vue->generer(array('evenement' => $e));

        if (!empty($_POST["modificationEvenement"])) {
            try {
                $data = array(
                    'identifiant' => $_GET['modEvenement'], 'nom' => $_POST['nom'], 'date' => $_POST['date'],
                    'heureDebut' => $_POST['heureDebut'], 'heureFin' => $_POST['heureFin'],
                    'cout' => $_POST['cout']
                );
                $e = new Evenement($data);
                $_SESSION['Ev'] = $e;
                $em->update($e);

                //todo redirection


            } catch (Exception $e) {
                $msgErreur = $e->getMessage();
                $_vue = new Vue('Erreur');
                $_vue->generer(array('msgErreur' => $msgErreur));
            }
        }
    }

    private function suppEvenement()
    {
        try {

            $em = new EvenementManager;
            $em->delete($_GET['suppEvenement']);

            //todo redirection  


        } catch (Exception $e) {
            $msgErreur = $e->getMessage();
            $_vue = new Vue('Erreur');
            $_vue->generer(array('msgErreur' => $msgErreur));
        }
    }

    private function accueilAdmin()
    {
        $am = new ActiviteManager;
        $em = new EvenementManager;
        $activites = $am->getActivites();
        $evenements = $em->getEvenements();

        $_vue = new Vue('AccueilAdmin');
        $_vue->generer(array('activites' => $activites, 'evenements' => $evenements));
    }
}
