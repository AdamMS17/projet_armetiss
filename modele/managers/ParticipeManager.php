<?php

require_once('DBManager.php');

class ParticipeManager extends DBManager
{
    private $_vue;
    public function getParticipes()
    {
        $this->getConnexion();
        return $this->getAll('participe', 'Participe');
    }

    public function getParticipesByIdPersonne($id)
    {
        $var = [];
        $requete = $this->getConnexion()->prepare(
            'SELECT * FROM participe WHERE identifiant_Personne=' . $id
        );
        $requete->execute();
        while ($data = $requete->fetch(PDO::FETCH_ASSOC))
            $var[] = new Participe($data);

        return $var;
    }

    public function insert(Participe $participe)
    {
        $sql = "INSERT INTO participe(identifiant_Personne, identifiant_Evenement)
                VALUES (:idP,:idE)";
        try {
            $con = $this->getConnexion();
            $requete = $con->prepare($sql);
            $idE = $participe->getIdentifiant_Evenement();
            $idP = $participe->getIdentifiant_Personne();
            $requete->bindParam(':idE', $idE);
            $requete->bindParam(':idP', $idP);
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
