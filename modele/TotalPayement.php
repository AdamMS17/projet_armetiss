<?php
require_once('DBManager.php');
class totalPayement extends DBManager
{
    public function listerTotalPayement()
    {
        
        $sql="SELECT SUM(montant_paiement) FROM paiement WHERE identifiant_Personne=1";//a modifier id pour le reprendre de l'url
        
        try {
            $con = $this->getConnexion();
            $requete = $con->prepare($sql);
            $requete->execute();
            $res = $requete->fetch();
            return $res[0];
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        } 
    }
}
?>