<?php
    class Personne{
        private $identifiant_Personne ;
        private $login_Personne ;
        private $nom_Personne ;
        private $prenom_Personne ;
        private $motDePasse_Personne ;
        private $ville_Personne ;
        private $rue_Personne ;
        private $numero_Personne ;
        private $numeroTel_Personne ;
        private $dateNaiss_Personne ;
        private $email_Personne ;
        
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
        
        public function setIdentifiant_Personne($identifiantPersonne)
        {
        $id = (int) $identifiantPersonne;

            if ($id > 0)
            $this->identifiant_Personne = $id;
        }

        public function setNom_Personne($nomPersonne)
        {
            if (is_string($nomPersonne))
                $this->nom_Personne = $nomPersonne;
        }
        public function setLogin_Personne($loginPersonne)
        {
            if (is_string($loginPersonne))
                $this->login_Personne = $loginPersonne;
        }
    
        public function setPrenom_Personne($prenomPersonne)
        {
            if (is_string($prenomPersonne))
                $this->prenom_Personne = $prenomPersonne;
        }
    
        public function setMotDePasse_Personne($motDePassePersonne)
        {
            if (is_string($motDePassePersonne))
                $this->motDePasse_Personne = $motDePassePersonne;
        }
        public function setVille_Personne($villePersonnne)
        {
            if (is_string($villePersonnne))
                $this->ville_Personne = $villePersonnne;
        }
        public function setRue_Personne($ruePersonne)
        {
            if (is_string($ruePersonne))
                $this->rue_Personne = $ruePersonne;
        }
        public function setNumero_Personne($numeroPersonne)
        {
            if (is_string($numeroPersonne))
                $this->numero_Personne = $numeroPersonne;
        }
        public function setNumeroTel_Personne($numeroTelPersonne)
        {
            if (is_string($numeroTelPersonne))
                $this->numeroTel_Personne = $numeroTelPersonne;
        }
        public function setDateNaiss_Personne($dateNaissPersonne)
        {
            if (is_string($dateNaissPersonne))
                $this->dateNaiss_Personne = $dateNaissPersonne;
        }
        public function setEmail_Personne($emailPersonne)
        {
            if (is_string($emailPersonne))
                $this->email_Personne = $emailPersonne;
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