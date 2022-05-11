<?php
class ControleurAccueil
{
    private $_vue;

    public function __construct($url)
    {
        //Je ne veux qu'un parametre dans l'url
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else {
            /*
                Ici, on va vouloir savoir qui sont les utilisateurs,
                pour rendre accessibles les fonctionnalités liées à leur(s) rôle(s).

                Typiquement, l'administrateur pourra tout voir et tout faire.
                C'est à dire, accéder aux accueils animateur, responsable et admin.

                Le responsable accèdera à son acceuil et à celui de l'animateur.
                
                Le membre ne verra que la section profil.

                Tout est contrôlé dans cette classe. Pas de controleur pour chaque fonctionnalité.
            */

            //todo Connexion Bird.
            //if (isset($_SESSION['utilisateur'])) {

            //todo menu et/ou profil


            //todo isAdmin Max.
            //todo ...var session PERMISSION avec numero de rôle
            //todo ...check < ou > et donner l'accès ou pas.
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
            } else if (!empty($_GET['ajoutMembre'])) {
                $this->ajouterMembre();
            }else if (!empty($_GET['enregistrementPaiement'])) {
                $this->enregistrerPaiement();
            }else {
                $this->accueilAdmin();
                //si responsable. //todo
                $this->accueilResponsable();
            }
            //}

            //todo à activer quand la connexion fonctionnera pour la redirection
            //} else $this->login();
        }
    }

    public function login()
    {
        header("Location:login");
    }

//____________________________________________________________
//ADMINISTRATEUR
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

                header("location:" . URL);
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


                header("location:" . URL);
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

            header("location:" . URL);
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

                header("location:" . URL);
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

                header("location:" . URL);
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

            header("location:" . URL);
        } catch (Exception $e) {
            $msgErreur = $e->getMessage();
            $_vue = new Vue('Erreur');
            $_vue->generer(array('msgErreur' => $msgErreur));
        }
    }

     /*
        Ce que voit l'administrateur.
        On passe les activités et les évenements à la vue.
    */
    private function accueilAdmin()
    {
        $am = new ActiviteManager;
        $em = new EvenementManager;
        $activites = $am->getActivites();
        $evenements = $em->getEvenements();

        $_vue = new Vue('AccueilAdmin');
        $_vue->generer(array('activites' => $activites, 'evenements' => $evenements));
    }
//____________________________________________________________
//RESPONSABLE

    /*
        Ce que voit le responsable.
        On passe les membres à la vue.
    */
    private function accueilResponsable()
    {
        //todo managers
        $_vue = new Vue('AccueilResponsable');
        $_vue->generer(array());//todo
        //membres : voir plus haut avec activites et evenements 
    }

    private function ajouterMembre()
    {
        //AJOUT D'UN MEMBRE
        $_vue = new Vue('AjoutMembre');
        $_vue->generer(array());
        //todo
    }

    private function inscriptionActivite()
    {
        //todo
    }

    private function inscriptionEvenement()
    {
        //todo
    }

    private function enregistrerPaiement()
    {
        //ENREGISTREMENT D'UN PAIEMENT
        $_vue = new Vue('AjoutPayement');
        $_vue->generer(array());
        //todo
    }
}
