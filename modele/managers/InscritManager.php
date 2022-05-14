<?php

require_once('DBManager.php');

class InscritManager extends DBManager
{
    private $_vue;
    public function getInscrits()
    {
        $this->getConnexion();
        return $this->getAll('inscrit', 'Inscrit');
    }

    public function insert(Inscrit $inscrit)
    {
        $sql = "INSERT INTO inscrit(identifiant_Activite, identifiant_Personne, montant)
                VALUES (:idA,:idP,:m)";
        try {
            $con = $this->getConnexion();
            $requete = $con->prepare($sql);
            $idA = $inscrit->getIdentifiant_Activite();
            $idP = $inscrit->getIdentifiant_Personne();
            $m = $inscrit->getMontant();
            $requete->bindParam(':idA', $idA);
            $requete->bindParam(':idP', $idP);
            $requete->bindParam(':m', $m);
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
}
