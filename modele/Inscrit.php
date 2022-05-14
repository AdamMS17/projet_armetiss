<?php

class Inscrit
{
    private ?int $identifiant_Activite = null;
    private ?String $identifiant_Personne = null;
    private ?float $montant = null;

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

    //SETTERS
    public function setIdentifiant_Activite($identifiant_Activite)
    {
        $identifiant_Activite = (int) $identifiant_Activite;

        if ($identifiant_Activite > 0)
            $this->identifiant_Activite = $identifiant_Activite;
    }

    public function setIdentifiant_Personne($identifiant_Personne)
    {
        $identifiant_Personne = (int) $identifiant_Personne;

        if ($identifiant_Personne > 0)
            $this->identifiant_Personne = $identifiant_Personne;
    }

    public function setMontant($montant)
    {
        if (is_float($montant))
            $this->montant = $montant;
    }

    //GETTERS
    public function getIdentifiant_Activite()
    {
        return $this->identifiant_Activite;
    }

    public function getIdentifiant_Personne()
    {
        return $this->identifiant_Personne;
    }

    public function getMontant()
    {
        return $this->montant;
    }
}
