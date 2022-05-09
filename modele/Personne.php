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

        public function __construct(array $data)
        {
            $this->hydrate($data);
        }

        public function hydrate(array $data)
        {
            foreach ($data as $key => $value) {
                $method = 'set' . ucfirst($key);
                if (method_exists($this, $method))
                    $this->$method($value);
            }
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
        return $this->identifiant_Personne;
    }
    public function getNom()
    {
        return $this->nom_Personne;
    }
    public function getLogin()
    {
        return $this->login_Personne;
    }
    public function getPrenom()
    {
        return $this->prenom_Personne;
    }
    public function getMDP()
    {
        return $this->motDePasse_Personne;
    }
    public function getVille()
    {
        return $this->ville_Personnne;
    }
    public function getRue()
    {
        return $this->rue_Personne;
    }
    public function getNumero()
    {
        return $this->numero_Personne;
    }
    public function getNumeroTel()
    {
        return $this->numeroTel_Personne;
    }
    public function getDateNaiss()
    {
        return $this->dateNaiss_Personne;
    }
    public function getEmail()
    {
        return $this->email_Personne;
    }
}
?>