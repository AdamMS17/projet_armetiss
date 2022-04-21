<?php
require_once('DBManager.php');
class totalPayement extends DBManager
{
    public function listerTotalPayement()
    {
        
        $sql="SELECT SUM(montant_paiement) FROM paiement WHERE identifiant_Personne=1";//a modifier id pour le reprendre de l'url
        $sqlVerif="SELECT montant_Paiement FROM paiement WHERE identifiant_Personne=1";
        try {
            $con = $this->getConnexion();
            $requete = $con->prepare($sql);
            $requete->execute();
            $res = $requete->fetch();
            $requeteVerif = $con ->prepare($sqlVerif);
            $requeteVerif->execute();
            $verif=$requeteVerif->fetch();
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        }
        if ($verif<1) {
            $retourErreur="Aucun payement pour cet utilisateur n'a été trouvé.";
            return $retourErreur;
        }
        else {
            return $res[0];
        } 
    }
}
?>