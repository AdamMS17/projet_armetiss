<?php

class Seance
{
    private ?int $identifiant_Actvite = null;
    private ?String $date_Seance = null;
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
    public function setIdentifiant_Activite($id)
    {
        $id = (int) $id;

        if ($id > 0)
            $this->identifiant_Actvite = $id;
    }

    public function setDate_Seance($date)
    {
        $date = strtotime($date);
        $this->date_Seance = date('Y-m-d', $date);
    }

    public function setIdentifiant_Personne($id)
    {
        $id = (int) $id;

        if ($id > 0)
            $this->identifiant_Personne = $id;
    }

    //GETTERS
    public function getIdentifiant_Activite()
    {
        return $this->identifiant_Actvite;
    }

    public function getDate_Seance()
    {
        return $this->date_Seance;
    }

    public function getIdentifiant_Personne()
    {
        return $this->identifiant_Personne;
    }
}
