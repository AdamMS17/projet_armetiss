<?php

class Participe
{
    private ?int $identifiant_Evenement = null;
    private ?int $identifiant_Personne = null;

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
    public function setIdentifiant_Evenement($identifiant_Evenement)
    {
        $identifiant_Evenement = (int) $identifiant_Evenement;

        if ($identifiant_Evenement > 0)
            $this->identifiant_Evenement = $identifiant_Evenement;
    }

    public function setIdentifiant_Personne($identifiant_Personne)
    {
        $identifiant_Personne = (int) $identifiant_Personne;

        if ($identifiant_Personne > 0)
            $this->identifiant_Personne = $identifiant_Personne;
    }

    //GETTERS
    public function getIdentifiant_Evenement()
    {
        return $this->identifiant_Evenement;
    }

    public function getIdentifiant_Personne()
    {
        return $this->identifiant_Personne;
    }
}
