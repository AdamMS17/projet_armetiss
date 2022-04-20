<?php
require_once('DBManager.php');
class insererPayement extends DBManager
{
    public function insererPayement()
    {
        $sql= "INSERT INTO `paiement` (`identifiant_Personne`, `date_Paiement`, `montant_Paiement`, `identifiant_Activite`, `identifiant_Evenement`) 
        VALUES ('1', '2022-04-15', '70', '1', NULL);"; //a modifier requete avec les bons param
            try {
            $con = $this->getConnexion();
            $requete = $con->prepare($sql);
            $requete->execute();
        } 
            catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        } 
    }
}

?>
