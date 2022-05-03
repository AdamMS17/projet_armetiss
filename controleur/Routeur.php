<?php
require('vue/Vue.php');

class Routeur
{

    private $_controleur;
    private $_vue;

    public function routeReq()
    {
        try {
            //charge automatiquement les classes du dossier modele
            spl_autoload_register(function ($class) {
                if (str_contains($class, 'Manager'))
                    require_once('modele/managers/' . $class . '.php');
                else
                    require_once('modele/' . $class . '.php');
            });

            $url = array();

            if (isset($_GET['url'])) {
                //récupération de tous les paramètres dans l'url
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                //construction du nom de fichier a appeler
                $controleur = ucfirst(strtolower($url[0]));
                $ClasseControleur = "Controleur" . $controleur;
                $FichierControleur = "controleur/" . $ClasseControleur . ".php";

                if (file_exists($FichierControleur)) {
                    require_once($FichierControleur);
                    $this->_controleur = new $ClasseControleur($url);
                } else throw new Exception('Page introuvable');
            } else {
                require_once('controleur/ControleurAccueil.php');
                $this->_controleur = new ControleurAccueil($url);
            }
        } catch (Exception $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        }
    }
}
