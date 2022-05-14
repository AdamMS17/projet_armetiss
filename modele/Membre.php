<?php
class Membre
{
    private ?int $identifiant = null;
    private ?String $numeroTel2 = null;
    private ?String $commentaire = null;
    private ?bool $actif = null;
    private ?bool $inscriptionPaye = null;
    private ?float $montantCalculer = null;
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {

            //Removes suffix from db field's name
            if (str_ends_with($key, "_Membre"))
                $key = substr($key, 0, -7);
            else if (str_ends_with($key, "_Personne"))
                $key = substr($key, 0, -9);

            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
    }
    public function setIdentifiant($identifiant)
    {
        $id = (int) $identifiant;

        if ($id > 0)
            $this->identifiant = $id;
    }
    public function setNumTel2($numeroTel2)
    {
        if (is_string($numeroTel2))
            $this->numeroTel2 = $numeroTel2;
    }
    public function setCommentaire($commentaire)
    {
        if (is_string($commentaire))
            $this->commentaire = $commentaire;
    }
    public function setActif($actif)
    {
        if ($actif == 0) {
            $this->actif = 1;
        } else {
            $this->actif = 0;
        }
    }
    public function setInscriptionPaye($inscriptionPaye)
    {
        if ($inscriptionPaye == 0) {
            $this->inscriptionPaye = 1;
        } else {
            $this->inscriptionPaye = 0;
        }
    }
    public function setMontantCalculer($montantCalculer)
    {
        $this->montantCalculer += $montantCalculer;
    }
    public function getId()
    {
        return $this->identifiant;
    }
    public function getNumTel2()
    {
        return $this->numeroTel2;
    }
    public function getCommentaire()
    {
        return $this->commentaire;
    }
    public function getActif()
    {
        return $this->actif;
    }
    public function getInscriptionPaye()
    {
        return $this->inscriptionPaye;
    }
    public function getMontantCalculer()
    {
        return $this->montantCalculer;
    }
}
