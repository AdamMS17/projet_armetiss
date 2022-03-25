<?php

class Activite
{
    private ?int $id = null;
    private ?String $nom = null;
    private ?String $jour = null;
    private ?String $heureDebut = null;
    private ?String $heureFin = null;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            //Removes suffix from db field's name
            if(str_ends_with($key,"_Activite"))
                $key = substr($key, 0, -9);

            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
    }

    //SETTERS
    public function setIdentifiant($id)
    {
        $id = (int) $id;

        if ($id > 0)
            $this->id = $id;
    }

    public function setNom($nom)
    {
        if (is_string($nom))
            $this->nom = $nom;
    }

    public function setJour($jour)
    {
        if (is_string($jour))
            $this->jour = $jour;
    }

    public function setHeureDebut($heureDebut)
    {
        $heureDebut = strtotime($heureDebut);
        $this->heureDebut = gmdate('H:i', $heureDebut);
    }

    public function setHeureFin($heureFin)
    {
        $heureFin = strtotime($heureFin);
        $this->heureFin = gmdate('H:i', $heureFin);
    }

    //GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getJour()
    {
        return $this->jour;
    }

    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    public function getHeureFin()
    {
        return $this->heureFin;
    }
}
?>