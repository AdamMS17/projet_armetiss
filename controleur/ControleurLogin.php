<?php
class ControleurLogin
{
    private $_personneManager;
    private $_vue;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else {
            $this->login();
        }
    }

    private function login()
    {
        

        //si session ouvert alors pas de page de login 
        if (isset($_SESSION['utilisateur'])) {
            //todo Décommenter quand la déconnexion existera.
            //Pour l'instant. On change de compte en allant sur cette page par l'url.
            //
            //header("Location:accueil");
        }

        
        $this->_vue = new Vue('Login');
        $this->_vue->generer(array());
        
        if (!empty($_POST["logout"]))
            session_unset();
        else
        if (!empty($_POST["loginSubmit"])) {
            $this->_personneManager = new PersonneManager;
            if ($utilisateur = $this->_personneManager->login($_POST['login'], $_POST['password']))
                $this->demarrage($utilisateur);
        }
    }

    public function demarrage($utilisateur)
    {
        try {
            if (isset($_SESSION['utilisateur']))
                if ($_SESSION['utilisateur'] != $utilisateur)
                    session_unset();

            $_SESSION['utilisateur'] = $utilisateur;
            //Redirection vers la page d'accueil.
            header("location:" . URL);
        } catch (Exception $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        }
    }
}
