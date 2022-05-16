<?php
require_once('DBManager.php');

class PayementManager extends DBManager
{
    public function insererPayement(Activite $activite, Membre $membre)
    {
        $sql= "INSERT INTO `paiement` (`identifiant_Personne`, `date_Paiement`, `montant_Paiement`, `identifiant_Activite`, `identifiant_Evenement`) 
        VALUES ('identifiant_membre', '2022-04-15', '70', 'identifiant_activite', NULL);"; //a modifier requete avec les bons param
        $sqlVerif="SELECT identifiant_Personne, identifiant_Activite FROM paiement WHERE identifiant_Personne=1 AND identifiant_Activite=1 ";   
            try {
            $con = $this->getConnexion();
            $requete = $con->prepare($sql);             //sert a la requete pour inserer dans la db
            $requeteVerif = $con->prepare($sqlVerif);   //sert a la requete pour verifier qu'un paiement a été ajouté pour un utilisateur dans une activité
            $requeteVerif->execute();
            $verification=$requeteVerif->fetch();
            $requete->bindParam('identifiant_membre',$membre->getId());
            $requete->bindParam('identifiant_activite',$activite->getId());
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

    public function listerImpayes()
    {
        $sql="SELECT montant FROM inscrit WHERE identifiant_Activite = 1";// a modifier pour reprendre l'id de l'url
        try {
            $con = $this->getConnexion();
            $totalAct = $con->prepare($sql);
            $totalAct->execute();
            $total=$totalAct->fetch();
            $vraiTotal=(int)$total[0];//sert a cast en int le cout de l'activite
        } 
            catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        }
        
        $sqlPersonnes="SELECT identifiant_Personne, montant_Paiement FROM paiement WHERE identifiant_Activite=1 AND montant_Paiement < ? ";
        try{
            $con = $this->getConnexion();
            $personnes=$con()->prepare($sqlPersonnes);
            $personnes->execute([$vraiTotal]);// on passe la valeur du montant de l'activite a la requete sql
            $impayes= $personnes->fetch();
        }
        catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));   
        }

        if ($impayes==true) {                      //si le boolean est true, execute l'affichage. il et true s'il trouve des impayes
            foreach ($impayes as $key) {
                $sqlAffichage="SELECT nom_Personne,prenom_Personne FROM personne WHERE identifiant_Personne= ? ";
                $con = $this->getConnexion();
                $affichageNom=$con()->prepare($sqlAffichage);
                $affichageNom->execute([$key[0]]);//on passe l'id des impayés
                $affichage=$affichageNom->fetchAll();
                foreach($affichage as $personne){
                    echo($personne[0]);           //affichage des noms
                    echo ("\t");
                    echo($personne[1]);           //affichage des prénoms
                }
                echo("\t");
                echo($key[1]);
                echo("<br>");
            }
            //l'affichage est bug pour le moment, a corriger après
        }
        else{
            echo "Tout le monde est en ordre pour cette activité!";
        }
    }

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