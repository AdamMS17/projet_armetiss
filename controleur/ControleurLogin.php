<?php
require_once('vue/Vue.php');
require_once('modele/Personne.php');
require_once('modele/managers/PersonneManager.php');

class ControleurLogin
{
    private $_personneManager;
    private $_vue;

    public function __construct()
    {
            $this->login();
    }

    private function login()
    {
        $this->_vue = new Vue('Login');
        $this->_vue->generer(array());
        if (!empty($_POST["logout"]))
            session_unset();
        else
        if (!empty($_POST["login"])) {
            $this->_personneManager = new PersonneManager;
            if ($utilisateur = $this->_personneManager->login($_POST['pseudo'], $_POST['password']))
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
            header("Location:accueil");
        } catch (Exception $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        }
    }
}
