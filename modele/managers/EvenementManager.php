<?php

require_once('DBManager.php');

class EvenementManager extends DBManager
{
    public function getEvenements()
    {
        $this->getConnexion();
        return $this->getAll('evenement', 'Evenement');
    }

    public function getEvenement($id)
    {
        $this->getConnexion();
        return $this->getByIdName('evenement', 'Evenement', $id, 'id');
    }


    public function insert(Evenement $evenement)
    {
        $sql = "INSERT INTO evenement(nom,date,HeureDebut,HeureFin,cout)
                VALUES (:nom,:date,:HeureDebut,:HeureFin,:cout)";
        try {
            $requete = $this->getConnexion()->prepare($sql);
            $date=$evenement->getDate();
            $nom=$evenement->getNom();
            $heureDebut=$evenement->getHeureDebut();
            $heureFin=$evenement->getHeureFin();
            $cout=$evenement->getCout();
            $requete->bindParam(':date', $date);
            $requete->bindParam(':nom', $nom);
            $requete->bindParam(':HeureDebut', $heureDebut);
            $requete->bindParam(':HeureFin', $heureFin);
            $requete->bindParam(':cout', $cout);
            $requete->execute();
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        } finally {
            $requete->closeCursor();
        }
    }

    function update(Evenement $evenement)
    {
        try {
            $id = $evenement->getId();
            $date = $evenement->getDate();
            $nom = $evenement->getNom();
            $HeureDebut = $evenement->getHeureDebut();
            $HeureFin = $evenement->getHeureFin();
            $cout = $evenement->getCout();

            $sql = "UPDATE evenement SET date='$date',
                    nom='$nom', HeureDebut='$HeureDebut',
                    HeureFin='$HeureFin', cout='$cout'
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
        $sql = "DELETE FROM evenement WHERE id=$id";
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