<?php

require_once('DBManager.php');

class ActiviteManager extends DBManager
{
    public function getActivites()
    {
        $this->getConnexion();
        return $this->getAll('activite', 'Activite');
    }

    public function getActivite($id)
    {
        $this->getConnexion();
        return $this->getByIdName('activite', 'Activite', $id, 'identifiant_Activite');
    }


    public function insert(Activite $activite)
    {
        $sql = "INSERT INTO activite(nom_Activite,heureDebut_Activite,heureFin_Activite,jour_Activite)
                VALUES (:nom,:heureDebut,:heureFin,:jour)";
        try {
            $con = $this->getConnexion();
            $requete = $con->prepare($sql);
            $nom = $activite->getNom();
            $hd = $activite->getHeureDebut();
            $hf = $activite->getHeureFin();
            $jour = $activite->getJour();
            $requete->bindParam(':nom', $nom);
            $requete->bindParam(':heureDebut', $hd);
            $requete->bindParam(':heureFin', $hf);
            $requete->bindParam(':jour', $jour);
            $requete->execute();

            return $con->lastInsertId();
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        } finally {
            $requete->closeCursor();
        }
    }

    function update(Activite $activite)
    {
        try {
            $id = $activite->getId();
            $nom = $activite->getNom();
            $jour = $activite->getJour();
            $heureDebut = $activite->getHeureDebut();
            $heureFin = $activite->getHeureFin();

            $sql = "UPDATE activite SET
                    nom_Activite='$nom', jour_Activite='$jour',
                    heureFin_Activite='$heureFin', heureDebut_Activite='$heureDebut'
                    WHERE identifiant_Activite='$id'";

            $requete = $this->getConnexion()->prepare($sql);
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
        $sql = "DELETE FROM activite WHERE identifiant_Activite=$id";
        try {
            $requete = $this->getConnexion()->prepare($sql);
            $requete->execute();
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        } finally {
            $requete->closeCursor();
        }
    }
}