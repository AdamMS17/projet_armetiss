<?php

class Evenement
{
    private ?int $id = null;
    private ?String $nom = null;
    private ?String $date = null;
    private ?String $heureDebut = null;
    private ?String $heureFin = null;
    private ?float $cout = null;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            //Removes suffix from db field's name
            if(str_ends_with($key,"_Evenement"))
                $key = substr($key, 0, -10);

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
