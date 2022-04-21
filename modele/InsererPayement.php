<?php
require_once('DBManager.php');
class insererPayement extends DBManager
{
    public function insererPayement()
    {
        $sql= "INSERT INTO `paiement` (`identifiant_Personne`, `date_Paiement`, `montant_Paiement`, `identifiant_Activite`, `identifiant_Evenement`) 
        VALUES ('1', '2022-04-15', '70', '1', NULL);"; //a modifier requete avec les bons param
        $sqlVerif="SELECT identifiant_Personne, identifiant_Activite FROM paiement WHERE identifiant_Personne=1 AND identifiant_Activite=1 ";   
            try {
            $con = $this->getConnexion();
            $requete = $con->prepare($sql);             //sert a la requete pour inserer dans la db
            $requeteVerif = $con->prepare($sqlVerif);   //sert a la requete pour verifier qu'un paiement a été ajouté pour un utilisateur dans une activité
            $requeteVerif->execute();
            $verification=$requeteVerif->fetch();
        } 
            catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        }
        if ($verification>=1) {
            echo("Un payement a déja été ajouté pour cet utilisateur a cette activité. Veuillez le modifier");
        }
        else {
            $requete->execute();
        }
    }
}

?>
