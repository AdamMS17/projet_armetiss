<?php
require_once('DBManager.php');
class RoleManager extends DBManager
{

    public function __construct()
    {
    }

    function insert(Role $role)
    {
        try {
            $cnx=$this->getConnexion();
            $requete =  $cnx->prepare("INSERT INTO role (nom_Role) VALUES (:nom)");
            $requete->bindParam(':nom', $role->getRole());
            $requete->execute();
            $id = $cnx->lastInsertId();
            $role->setIdentifiant($id);
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        } finally {
            $requete->closeCursor();
        }
    }

    function update(Role $role)
    {
        try{
            $cnx=$this->getConnexion();
            $requete =  $cnx->prepare("UPDATE role SET nom_Role=:nom WHERE id=:id ");
            $requete->bindParam(':nom', $role->getRole());
            $requete->bindParam(':id', $role->getId());
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
            $requete=$cnx->prepare("DELETE FROM personne WHERE id_personne=:id");
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
    function getRoles()
    {
        $cnx=$this->getConnexion();
        return $this->getAll('role', 'Role');
    }
    function getRole(int $id)
    {
        $this->getConnexion();
        return $this->getByIdName('role', 'Role', $id, 'identifiant_Role');
    }
    function Exist(String $role){
        try{

            $cnx=$this->getConnexion();
            $requete = $cnx->prepare("SELECT * FROM role WHERE nom_Role=:role");
            $requete->bindParam(':role', $role);
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