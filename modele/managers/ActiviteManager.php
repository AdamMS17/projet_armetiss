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
        return $this->getByIdName('activite', 'Activite', $id, 'id');
    }


    public function insert(Activite $activite)
    {
        $sql = "INSERT INTO activite(nom,heureDebut,heureFin,jour)
                VALUES (:nom,:heureDebut,:heureFin,:jour)";
        try {
            $requete = $this->getConnexion()->prepare($sql);
            $nom = $activite->getNom();
            $hd = $activite->getHeureDebut();
            $hf = $activite->getHeureFin();
            $jour = $activite->getJour();
            $requete->bindParam(':nom', $nom);
            $requete->bindParam(':heureDebut', $hd);
            $requete->bindParam(':heureFin', $hf);
            $requete->bindParam(':jour', $jour);
            $requete->execute();
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
                    nom='$nom', jour='$jour',
                    heureFin='$heureFin', heureDebut='$heureDebut'
                    WHERE id='$id'";

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
        $sql = "DELETE FROM activite WHERE id=$id";
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