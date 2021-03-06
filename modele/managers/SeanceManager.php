<?php

require_once('DBManager.php');

class SeanceManager extends DBManager
{
    public function getSeances()
    {
        $this->getConnexion();
        return $this->getAll('seance', 'Seance');
    }

    public function getSeancesByIdActivite($id)
    {
        $var = [];
        $requete = $this->getConnexion()->prepare(
            'SELECT * FROM seance WHERE identifiant_Activite=' . $id
        );
        $requete->execute();
        while ($data = $requete->fetch(PDO::FETCH_ASSOC))
            $var[] = new Seance($data);

        return $var;
    }

    public function getSeancesByIdAnimateur($id)
    {
        $var = [];
        $requete = $this->getConnexion()->prepare(
            'SELECT * FROM seance WHERE identifiant_Personne=' . $id
        );
        $requete->execute();
        while ($data = $requete->fetch(PDO::FETCH_ASSOC))
            $var[] = new Seance($data);

        return $var;
    }

    public function insert(Seance $seance)
    {
        $sql = "INSERT INTO seance(identifiant_Activite,date_Seance)
                VALUES (:identifiant_Activite,:date_Seance)";
        try {
            $requete = $this->getConnexion()->prepare($sql);
            $idActivite = $seance->getIdentifiant_Activite();
            $date = $seance->getDate_Seance();
            $requete->bindParam(':identifiant_Activite', $idActivite);
            $requete->bindParam(':date_Seance', $date);
            $requete->execute();
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        } finally {
            $requete->closeCursor();
        }
    }

    function update(Seance $seance)
    {
        try {
            $idActivite = $seance->getIdentifiant_Activite();
            $date = $seance->getDate_Seance();
            $idPersonne = $seance->getIdentifiant_Personne();

            $sql = "UPDATE seance SET date_Seance='$date',
                    identifiant_Activite='$idActivite', identifiant_Personne='$idPersonne'
                    WHERE identifiant_Activite='$idActivite' AND date_Seance='$date'";

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

    //todo delete
}
