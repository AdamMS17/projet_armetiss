<?php
require_once('DBManager.php');
class modifierPayement extends DBManager
{
    public function modifierPayement()
    {
        $sql="UPDATE paiement SET `montant_Paiement`=100 WHERE (`identifiant_Personne`=3 AND `identifiant_Activite`=3)"; 
        //a modifier selon les var passes par l'url
        try {
            $con = $this->getConnexion();
            $requete = $con->prepare($sql);
            $requete->execute();
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        } 
    }
}
?>