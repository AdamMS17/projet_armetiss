<?php

class Membre
{
    private $identifiantPersonne;
    private $numeroTel2Membre;
    private $commentaireMembre;
    private $actifMembre;
    private $inscriptionPayeMembre;
    private $montantCalculerMembre;
    public function __construct(int $identifiantPersonne,String $numeroTel2Membre,String $commentaireMembre,int $actifMembre,int $inscriptionPayeMembre,int $montantCalculerMembre)
    {
        $this->identifiantPersonne = $identifiantPersonne;
        $this->numeroTel2Membre = $numeroTel2Membre;
        $this->commentaireMembre = $commentaireMembre;
        $this->actifMembre = $actifMembre;
        $this->inscriptionPayeMembre = $inscriptionPayeMembre;
        $this->montantCalculerMembre = $montantCalculerMembre;
    }

}
?>