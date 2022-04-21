<?php
    class Personne{
        private $identifiantPersonne;
        private $loginPersonne;
        private $nomPersonne;
        private $prenomPersonne;
        private $motDePassePersonne;
        private $villePersonnne;
        private $ruePersonne;
        private $numeroPersonne;
        private $numeroTelPersonne;
        private $dateNaissPersonne;
        private $emailPersonne;

        public function __construct(int $identifiantPersonne,String $loginPersonne,String $nomPersonne,String $prenomPersonne,String $motDePassePersonne,String $villePersonnne,String $ruePersonne,int $numeroPersonne,String $numeroTelPersonne,String $dateNaissPersonne,String $emailPersonne){
                $this->identifiantPersonne = $identifiantPersonne; //identifiant DB
                $this->loginPersonne = $loginPersonne; //login se connecter
                $this->nomPersonne = $nomPersonne;
                $this->prenomPersonne = $prenomPersonne;
                $this->motDePassePersonne = $motDePassePersonne;
                $this->villePersonnne = $villePersonnne;
                $this->ruePersonne = $ruePersonne;
                $this->numeroPersonne = $numeroPersonne;
                $this->numeroTelPersonne = $numeroTelPersonne;
                $this->dateNaissPersonne = $dateNaissPersonne;
                $this->emailPersonne = $emailPersonne;
        }
        //setter
        public function setIdentifiant($identifiantPersonne)
        {
        $id = (int) $identifiantPersonne;

            if ($id > 0)
            $this->identifiantPersonne = $id;
        }

        public function setNom($nomPersonne)
        {
            if (is_string($nomPersonne))
                $this->nomPersonne = $nomPersonne;
        }
        public function setLogin($loginPersonne)
        {
            if (is_string($loginPersonne))
                $this->loginPersonne = $loginPersonne;
        }
    
        public function setPrenom($prenomPersonne)
        {
            if (is_string($prenomPersonne))
                $this->prenomPersonne = $prenomPersonne;
        }
    
        public function setMDP($motDePassePersonne)
        {
            if (is_string($motDePassePersonne))
                $this->motDePassePersonne = $motDePassePersonne;
        }
        public function setVille($villePersonnne)
        {
            if (is_string($villePersonnne))
                $this->villePersonnne = $villePersonnne;
        }
        public function setRue($ruePersonne)
        {
            if (is_string($ruePersonne))
                $this->ruePersonne = $ruePersonne;
        }
        public function setNumero($numeroPersonne)
        {
            if (is_string($numeroPersonne))
                $this->numeroPersonne = $numeroPersonne;
        }
        public function setNumeroTel($numeroTelPersonne)
        {
            if (is_string($numeroTelPersonne))
                $this->numeroTelPersonne = $numeroTelPersonne;
        }
        public function setDateNaiss($dateNaissPersonne)
        {
            if (is_string($dateNaissPersonne))
                $this->dateNaissPersonne = $dateNaissPersonne;
        }
        public function setEmail($emailPersonne)
        {
            if (is_string($emailPersonne))
                $this->emailPersonne = $emailPersonne;
        }

        //getter
    public function getId()
    {
        return $this->identifiantPersonne;
    }
    public function getNom()
    {
        return $this->nomPersonne;
    }
    public function getLogin()
    {
        return $this->loginPersonne;
    }
    public function getPrenom()
    {
        return $this->prenomPersonne;
    }
    public function getMDP()
    {
        return $this->motDePassePersonne;
    }
    public function getVille()
    {
        return $this->villePersonnne;
    }
    public function getRue()
    {
        return $this->ruePersonne;
    }
    public function getNumero()
    {
        return $this->numeroPersonne;
    }
    public function getNumeroTel()
    {
        return $this->numeroTelPersonne;
    }
    public function getDateNaiss()
    {
        return $this->dateNaissPersonne;
    }
    public function getEmail()
    {
        return $this->emailPersonne;
    }
}
?>