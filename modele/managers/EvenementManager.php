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
        return $this->getByIdName('evenement', 'Evenement', $id, 'identifiant_Evenement');
    }


    public function insert(Evenement $evenement)
    {
        $sql = "INSERT INTO evenement(nom_Evenement,date_Evenement,heureDebut_Evenement,heureFin_Evenement,cout_Evenement)
                VALUES (:nom,:date,:heureDebut,:heureFin,:cout)";
        try {
            $requete = $this->getConnexion()->prepare($sql);
            $date=$evenement->getDate();
            $nom=$evenement->getNom();
            $heureDebut=$evenement->getHeureDebut();
            $heureFin=$evenement->getHeureFin();
            $cout=$evenement->getCout();
            $requete->bindParam(':date', $date);
            $requete->bindParam(':nom', $nom);
            $requete->bindParam(':heureDebut', $heureDebut);
            $requete->bindParam(':heureFin', $heureFin);
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

            $sql = "UPDATE evenement SET date_Evenement='$date',
                    nom_Evenement='$nom', heureDebut_Evenement='$HeureDebut',
                    heureFin_Evenement='$HeureFin', cout_Evenement='$cout'
                    WHERE identifiant_Evenement='$id'";

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
        $sql = "DELETE FROM evenement WHERE identifiant_Evenement=$id";
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