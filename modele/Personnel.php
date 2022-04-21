<?php
class Personnel{
    private $identifiantPersonne;
    private $identifiantRole;

    public function __construct(int $identifiantPersonne,int $identifiantRole)
    {
        $this->identifiantPersonne = $identifiantPersonne;
        $this->identifiantRole = $identifiantRole;
    }
    //setter
    public function setIdentifiant($identifiantPersonne)
    {
    $id = (int) $identifiantPersonne;

        if ($id > 0)
        $this->identifiantPersonne = $id;
    }

    public function setRole($identifiantRole)
    {
        $role = (int) $identifiantRole;

        if ($role > 0)
        $this->identifiantRole = $role;
    }


    //getter
    public function getId()
    {
        return $this->identifiantPersonne;
    }
    public function getRole()
    {
       return $this->identifiantRole;
    }
}



?>