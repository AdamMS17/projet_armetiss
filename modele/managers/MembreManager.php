<?php
require_once('DBManager.php');
class MembreManager extends DBManager
{
    function insert(Membre $membre)
    {
        try {
            $cnx=$this->getConnexion();
            $requete =  $cnx->prepare("INSERT INTO membre(id_Personne,numeroTel2_Membre,commentaire_Membre,actif_Membre,inscriptionPaye_Membre,montantCalculer_Membre) VALUES (:id,:tel,:com,:actif,:paye,:montant)");
            $requete->bindParam(':id', $membre->getId());
            $requete->bindParam(':tel', $membre->getNumTel2());
            $requete->bindParam(':com', $membre->getCommentaire());
            $requete->bindParam(':actif', $membre->getActif());
            $requete->bindParam(':paye', $membre->getInscriptionPaye());
            $requete->bindParam(':montant', $membre->getMontantCalculer());
            $requete->execute();
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        } finally {
            $requete->closeCursor();
        }
    }

    function update(Membre $membre)
    {
        try{
            $cnx=$this->getConnexion();
            $requete =  $cnx->prepare("UPDATE personne SET numeroTel2_Membre=:tel, commentaire_Membre=:com, actif_Membre=:actif, inscriptionPaye_Membre=:paye, montantCalculer_Membre=:montant WHERE id=:id ");
            $requete->bindParam(':tel', $membre->getNumTel2());
            $requete->bindParam(':com', $membre->getCommentaire());
            $requete->bindParam(':actif', $membre->getActif());
            $requete->bindParam(':paye', $membre->getInscriptionPaye());
            $requete->bindParam(':montant', $membre->getMontantCalculer());
            $requete->bindParam(':id', $membre->getId());
            $requete->execute();
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        } finally {
            $requete->closeCursor();
        }
    }

    function delete(int $id)
    {
        try{
            $cnx=$this->getConnexion();
            $requete=$cnx->prepare("DELETE FROM membre WHERE id_personne=:id");
            $requete->bindParam(':id', $id);
            $requete->execute();
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        } finally {
            $requete->closeCursor();
        }
    }
    function getMembres()
    {
        $this->getConnexion();
        return $this->getAll('membre', 'Membre');
    }
    function getMembre(int $id)
    {
        $this->getConnexion();
        return $this->getByIdName('membre', 'Membre', $id, 'identifiant_Personne');
    }

    function Exist(int $id){
        try{

            $cnx=$this->getConnexion();
            $requete = $cnx->prepare("SELECT * FROM personne WHERE identifiant_Personne=:id");
            $requete->bindParam(':id', $id);
		    $requete->execute();
		    $tbResult = $requete->fetch();

            return $tbResult;

        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        } finally {
            $requete->closeCursor();
        }
    }
}
