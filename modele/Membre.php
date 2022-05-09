<?php

class Membre
{
    private $identifiantPersonne;
    private $numeroTel2Membre;
    private $commentaireMembre;
    private $actifMembre;
    private $inscriptionPayeMembre;
    private $montantCalculerMembre;
   
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
      return $this->identifiant_Personne;
    }
    public function getNumTel2()
    {
      return $this->numeroTel2_Membre;
    }
    public function getCom()
    {
        return $this->commentaire_Membre;
    } 
    public function getActif()
    {
        return $this->actif_Membre;
    }
    public function getInscriptionPaye()
    {
        return $this->inscriptionPaye_Membre;
    }
    public function getMontant()
    {
        return $this->montantCalculer_Membre;
    }
}
?>