<?php

class Activite
{
    private int $id;
    private String $nom; //todo
    private String $jour;
    private int $heureDebut;
    private int $heureFin;

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
    public function setId($id)
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
        //todo
    }

    public function setHeureDebut($heureDebut)
    {
        //todo
    }

    public function setHeureFin($heureFin)
    {
        //todo
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