<?php

use function PHPSTORM_META\type;

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
            }

            /*else if (!empty($_GET['ajoutPersonnel'])) {
                $this->ajouterPersonnel();
            }*/

            //todo Separation RESPONSABLE
            else if (!empty($_GET['ajoutMembre'])) {
                $this->ajouterMembre();
            } else if (!empty($_GET['enregistrementPaiement'])) {
                $this->enregistrerPaiement();
            } else if (!empty($_GET['modificationPaiement'])) {
                $this->modifierPaiement();
            }else if (!empty($_GET['inscriptionMembreActivite'])) {
                $this->inscriptionMembreActivite();
            } else if (!empty($_GET['inscriptionMembreEvenement'])) {
                $this->inscriptionMembreEvenement();
            } else {
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

    //TODO ! CREER VUES !
    private function ajouterPersonnel()
    {
        //AJOUT D'UN MEMBRE DU PERSONNEL
        $_vue = new Vue('AjoutPersonnel');
        $_vue->generer(array());
        //todo
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
        $_vue->generer(array()); //todo
        //membres : voir plus haut avec activites et evenements 
    }

    private function ajouterMembre()
    {
        //AJOUT D'UN MEMBRE
        $_vue = new Vue('AjoutMembre');
        $_vue->generer(array());
        //todo
    }

    private function inscriptionMembreActivite()
    {
        //INSCRIPTION D'UN MEMBRE A UNE ACTIVITE
        $mm = new MembreManager;
        $am = new ActiviteManager;

        $membres = $mm->getMembres();
        $activites = $am->getActivites();

        //On passe à la vue: membres, activites.
        
        $_vue = new Vue('InscriptionMembreActivite');
        $_vue->generer(array(
            'membres' => $membres,
            'activites' => $activites
        ));
        
        if (!empty($_POST["inscriptionActivite"])) {
            try {

                $idA = substr(
                    $_POST['activite'],
                    0,
                    strpos($_POST['activite'], ":")
                );

                $im = new InscritManager;
                $data = array(
                    'identifiant_Activite' => $idA,
                    'identifiant_Personne' =>$_POST['personne'],
                    'montant' => (float) $_POST['montant']
                );
                $i = new Inscrit($data);
                $im->insert($i);

                header("location:" . URL);
            } catch (Exception $e) {
                $msgErreur = $e->getMessage();
                $_vue = new Vue('Erreur');
                $_vue->generer(array('msgErreur' => $msgErreur));
            }
        }
    }

    private function inscriptionMembreEvenement()
    {
        //INSCRIPTION D'UN MEMBRE A UN EVENEMENT
        $mm = new MembreManager;
        $em = new EvenementManager;

        $membres = $mm->getMembres();
        $evenements = $em->getEvenements();

        //On passe à la vue: membres, evenements.

        $_vue = new Vue('InscriptionMembreEvenement');
        $_vue->generer(array(
            'membres' => $membres,
            'evenements' => $evenements
        ));

        if (!empty($_POST["inscriptionEvenement"])) {
            try {

                $idE = substr(
                    $_POST['evenement'],
                    0,
                    strpos($_POST['evenement'], ":")
                );

                $pm = new ParticipeManager;
                $data = array(
                    'identifiant_Evenement' => $idE,
                    'identifiant_Personne' =>$_POST['personne']
                );
                $p = new Participe($data);
                $pm->insert($p);

                header("location:" . URL);
            } catch (Exception $e) {
                $msgErreur = $e->getMessage();
                $_vue = new Vue('Erreur');
                $_vue->generer(array('msgErreur' => $msgErreur));
            }
        }
    }

    private function enregistrerPaiement()
    {
        //ENREGISTREMENT D'UN PAIEMENT
        $_vue = new Vue('AjoutPayement');
        $_vue->generer(array());
        //todo
    }
    private function modifierPaiement()
    {
        //MODIFICATION D'UN PAIEMENT
        $_vue = new Vue('ModificationPayement');
        $_vue->generer(array());
    }
    private function consulterAgenda()
    {
    }
}
