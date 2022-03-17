<?php

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
        $sql = "INSERT INTO activite(nom,HeureDebut,HeureFin,jour)
                VALUES (:nom,:HeureDebut,:HeureFin,:jour)";
        try {
            $requete = $this->getConnexion()->prepare($sql);

            $requete->bindParam(':nom', $activite->getNom());
            $requete->bindParam(':HeureDebut', $activite->getHeureDebut());
            $requete->bindParam(':HeureFin', $activite->getHeureFin());
            $requete->bindParam(':jour', $activite->getJour());
            $requete->execute();
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            // $this->_vue = new Vue('Erreur');
            // $this->_vue->generer(array('msgErreur' => $msgErreur));
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
            $HeureDebut = $activite->getHeureDebut();
            $HeureFin = $activite->getHeureFin();

            $sql = "UPDATE activite SET
                    nom='$nom', jour='$jour',
                    HeureFin='$HeureFin', HeureDebut='$HeureDebut'
                    WHERE id='$id'";

            $requete = $this->getConnexion()->prepare($sql);
            $requete->execute();
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            // $this->_vue = new Vue('Erreur');
            // $this->_vue->generer(array('msgErreur' => $msgErreur));
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
            // $this->_vue = new Vue('Erreur');
            // $this->_vue->generer(array('msgErreur' => $msgErreur));
        } finally {
            $requete->closeCursor();
        }
    }
}