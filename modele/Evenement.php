<?php

class Evenement
{
    private int $id;
    private String $date;
    private String $nom;
    private String $heureDebut;
    private String $heureFin;
    private float $cout;

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

    public function setDate($date)
    {
        $date=strtotime($date);
        $this->date=gmdate('Y-m-d', $date);
    }

    public function setNom($nom)
    {
        if (is_string($nom))
            $this->nom = $nom;
    }

    public function setHeureDebut($heureDebut)
    {
        $heureDebut=strtotime($heureDebut);
        $this->heureDebut=gmdate('H:i', $heureDebut);
    }

    public function setHeureFin($heureFin)
    {
        $heureFin=strtotime($heureFin);
        $this->heureFin=gmdate('H:i', $heureFin);
    }


    public function setCout($cout)
    {
        $cout = (float) $cout;

        if ($cout >= 0)
            $this->cout = $cout;
    }

    //GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    public function getHeureFin()
    {
        return $this->heureFin;
    }

    public function getCout()
    {
        return $this->cout;
    }
}
