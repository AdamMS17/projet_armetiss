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
    //setter
    public function setIdentifiant($identifiantPersonne)
    {
    $id = (int) $identifiantPersonne;

        if ($id > 0)
        $this->identifiantPersonne = $id;
    }

    public function setNumTel2($numeroTel2Membre)
    {
        if (is_string($numeroTel2Membre))
            $this->numeroTel2Membre = $numeroTel2Membre;
    }
    public function setCom($commentaireMembre)
    {
        if (is_string($commentaireMembre))
            $this->commentaireMembre = $commentaireMembre;
    }

    public function setActif($actifMembre)
    {
        if ($actifMembre==0){
            $this->actifMembre = 1;
        }else{
            $this->actifMembre = 0; 
        }
    }

    public function setInscriptionPaye($inscriptionPayeMembre)
    {
        if ($inscriptionPayeMembre==0){
            $this->inscriptionPayeMembre = 1;
        }else{
            $this->inscriptionPayeMembre = 0; 
        }
    }
    public function setMontant($montantCalculerMembre)
    {
            $this->montantCalculerMembre += $montantCalculerMembre;
    }
    //getter
    public function getId()
    {
      return $this->identifiantPersonne;
    }
    public function getNumTel2()
    {
      return $this->numeroTel2Membre;
    }
    public function getCom()
    {
        return $this->commentaireMembre;
    } 
    public function getActif()
    {
        return $this->actifMembre;
    }
    public function getInscriptionPaye()
    {
        return $this->inscriptionPayeMembre;
    }
    public function getMontant()
    {
        return $this->montantCalculerMembre;
    }
}
?>