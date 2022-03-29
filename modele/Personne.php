<?php
    class Personne{
        private $identifiantPersonne;
        private $loginPersonne;
        private $nomPersonne;
        private $prenomPersonne;
        private $motDePassePersonne;
        private $ruePersonne;
        private $numeroPersonne;
        private $numeroTelPersonne;
        private $dateNaissPersonne;
        private $emailPersonne;

        public function __construct(int $identifiantPersonne,String $loginPersonne,String $nomPersonne,String $prenomPersonne,String $motDePassePersonne,String $villePersonnne,String $ruePersonne,int $numeroPersonne,String $numeroTelPersonne,String $dateNaissPersonne,String $emailPersonne){
                $this->identifiantPersonne = $identifiantPersonne;
                $this->loginPersonne = $loginPersonne;
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
    }
?>