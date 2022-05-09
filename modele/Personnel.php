<?php
class Personnel{
    private $identifiantPersonne;
    private $identifiantRole;

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
        return $this->identifiant_Personne;
    }
    public function getRole()
    {
       return $this->identifiant_Role;
    }
}



?>