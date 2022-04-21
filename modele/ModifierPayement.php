<?php
require_once('DBManager.php');
class modifierPayement extends DBManager
{
    public function modifierPayement()
    {
        $sql="UPDATE paiement SET `montant_Paiement`=100 WHERE (`identifiant_Personne`=3 AND `identifiant_Activite`=3)"; //a modifier selon les var passes par l'url
        $sqlVerif="SELECT identifiant_Personne, identifiant_Activite FROM paiement WHERE identifiant_Personne=3 AND identifiant_Activite=3 ";
        try {
            $con = $this->getConnexion();
            $requete = $con->prepare($sql);
            $requeteVerif = $con ->prepare($sqlVerif);
            $requeteVerif->execute();
            $verif=$requeteVerif->fetch();
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        } 
        if ($verif<1) {
           echo("Aucun payement n'a eté trouvé pour cet utilisateur pour cette activité");
        }
        else {
           $requete->execute(); 
        }
    }
}
?>