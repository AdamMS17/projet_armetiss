<?php
class Role{
    private $role;
    private $identifiantRole;

    public function __construct(int $role,int $identifiantRole)
    {
        $this->role = $role;
        $this->identifiantRole = $identifiantRole;
    }
    //setter
    public function setIdentifiant($identifiantRole)
    {
        $id = (int) $identifiantRole;

        if ($id > 0)
        $this->identifiantRole = $id;
    }

    public function setRole($role)
    {
        if (is_string($role))
        $this->role = $role;
    }


    //getter
    public function getId()
    {
        return $this->identifiantRole;
    }
    public function getRole()
    {
       return $this->role;
    }
}



?>