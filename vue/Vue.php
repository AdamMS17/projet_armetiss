<?php
class Vue{
    private $_fichier;
    private $_titre;

    public function __construct($action)
    {
        $this->_fichier = '../vue/vue'.$action.'.php';
        $this->_titre = $action;
    }

    public function generer($donnees){
        //contenu spécifique
        $contenu = $this->genererFichier($this->_fichier, $donnees);
        //gabarit
        $vue = $this->genererFichier('../vue/gabarit.php', array('_titre' => $this->_titre, 'contenu' => $contenu));

        echo $vue;
    }

    //génération du fichier vue et retour du résultat
    public function genererFichier($fichier, $donnees){
        if(file_exists($fichier))
        {
            extract($donnees);

            ob_start();
                require $fichier;
            return ob_get_clean();
        }
        else throw new Exception('Fichier '.$fichier.' introuvable');
    }
}
