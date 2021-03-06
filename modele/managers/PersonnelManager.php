<?php
require_once('DBManager.php');
class PersonnelManager extends DBManager
{

    public function __construct()
    {
    }

    function insert(Personnel $personnel)
    {
        try {
            $cnx=$this->getConnexion();
            $requete =  $cnx->prepare("INSERT INTO personnel(identifiant_Personne,identifiant_Role) VALUES (:personne,:role)");
            $requete->bindParam(':personne', $personnel->getId());
            $requete->bindParam(':role', $personnel->getRole());
            $requete->execute();
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        } finally {
            $requete->closeCursor();
        }
    }

    function update(Personnel $personnel)
    {
        try{
            $cnx=$this->getConnexion();
            $requete =  $cnx->prepare("UPDATE personnel SET identifiant_Role=:role WHERE id=:id ");
            $requete->bindParam(':role', $personnel->getRole());
            $requete->bindParam(':id', $personnel->getId());
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
            $requete=$cnx->prepare("DELETE FROM personnel WHERE id_personne=:id");
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
    function getPersonnels()
    {
        $cnx=$this->getConnexion();
        return $this->getAll('personnel', 'Personnel');
    }
    function getPersonnel(int $id)
    {
        $this->getConnexion();
        return $this->getByIdName('personnel', 'Personnel', $id, 'identifiant_Personne');
    }

    function Exist(int $id){
        try{

            $cnx=$this->getConnexion();
            $requete = $cnx->prepare("SELECT * FROM personnel WHERE id_Personne=:id");
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
?>