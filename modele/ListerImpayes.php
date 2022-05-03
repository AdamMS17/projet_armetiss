<?php
require_once('DBManager.php');
class listerImpayes extends DBManager
{
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
}

?>