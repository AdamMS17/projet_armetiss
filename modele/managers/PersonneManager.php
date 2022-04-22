<?php
require_once('DBManager.php');
class PersonneManager extends DBManager
{

    public function __construct()
    {
    }

    function insert(Personne $personne)
    {
        try {
            $cnx=$this->getConnexion();
            $requete =  $cnx->prepare("INSERT INTO personne(login_Personne,nom_Personne,prenom_Personne,motDePasse_Personne,ville_Personne,rue_Personne,numero_Personne,numeroTel_Personne,dateNaiss_Personne,email_Personne) VALUES (:login,:nom,:prenom,:mdp,:ville,:rue,:numero,:numeroTel,:dateNaiss,:email)");
            $requete->bindParam(':login', $personne->getLogin());
            $requete->bindParam(':nom', $personne->getNom());
            $requete->bindParam(':prenom', $personne->getPrenom());
            $requete->bindParam(':mdp', $personne->getMDP());
            $requete->bindParam(':ville', $personne->getVille());
            $requete->bindParam(':rue', $personne->getRue());
            $requete->bindParam(':numero', $personne->getNumero());
            $requete->bindParam(':numeroTel', $personne->getNumeroTel());
            $requete->bindParam(':dateNaiss', $personne->getDateNaiss());
            $requete->bindParam(':email', $personne->getEmail());
            $requete->execute();
            $id = $cnx->lastInsertId();
            $personne->setIdentifiant($id);
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage();
            $this->_vue = new Vue('Erreur');
            $this->_vue->generer(array('msgErreur' => $msgErreur));
        } finally {
            $requete->closeCursor();
        }
    }

    function update(Personne $Personne)
    {
        try{
            $cnx=$this->getConnexion();
            $requete =  $cnx->prepare("UPDATE personne SET login_Personne=:login, nom_Personne=:nom, prenom_Personne=:prenom, motDePasse_Personne=:mdp, ville_Personne=:ville, rue_Personne=:rue, numero_Personne=:numero, numeroTel_Personne=:numeroTel, dateNaiss_Personne=:dateNaiss, email_Personne=:email WHERE id=:id ");
            $requete->bindParam(':login', $personne->getLogin());
            $requete->bindParam(':nom', $personne->getNom());
            $requete->bindParam(':prenom', $personne->getPrenom());
            $requete->bindParam(':mdp', $personne->getMDP());
            $requete->bindParam(':ville', $personne->getVille());
            $requete->bindParam(':rue', $personne->getRue());
            $requete->bindParam(':numero', $personne->getNumero());
            $requete->bindParam(':numeroTel', $personne->getNumeroTel());
            $requete->bindParam(':dateNaiss', $personne->getDateNaiss());
            $requete->bindParam(':email', $personne->getEmail());
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
    function getPersonnes()
    {
        $cnx=$this->getConnexion();
        return $this->getAll('personne', 'Personne');
    }
    function getPersonne(int $id)
    {
        $this->getConnexion();
        return $this->getByIdName('personne', 'Personne', $id, 'identifiant_Personne');
    }
    
    function login(String $login,String $mdp){
        try{
            $cnx=$this->getConnexion();
            $requete = $cnx->prepare("SELECT * FROM utilisateur WHERE identifiant=:login AND mdp=:mdp");
            $requete->bindParam(':login', $login);
            $requete->bindParam(':mdp', $mdp);
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
    }/*
    function getUtilisateurByLogin(String $login){
        $scoreQuizzManager= new ScoreQuizzManager();
        $db = new DBManager();
        $cnx = $db->connexionDB($db);
        $requete =  $cnx->prepare("SELECT * FROM utilisateur WHERE identifiant=:login");
        $requete->bindParam(':login', $login);
        $requete->execute();
        $resultat = $requete->fetch();
        $utilisateur= new Utilisateur($resultat['id'],$resultat['nom'],$resultat['prenom'],$resultat['mdp'],$resultat['identifiant'],$resultat['admin']);
        $utilisateur->essai=count($scoreQuizzManager->getAllByPlayer($resultat['id']));
        $utilisateur->score=$scoreQuizzManager->score($resultat['id']);
        return $utilisateur;
    }
    function isExist(String $login){
        $db = new DBManager();
        $cnx = $db->connexionDB($db);
        $requete = $cnx->prepare("SELECT * FROM utilisateur WHERE identifiant=:login");
        $requete->bindParam(':login', $login);
		$requete->execute();
		$tbResult = $requete->fetch();
		$userexist = $requete->rowCount();

        return $userexist>=1;
    }*/
}
?>