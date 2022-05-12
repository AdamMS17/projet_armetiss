<?php
class Personnel{
    private $identifiant_Personne;
    private $identifiant_role;

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
    public function setIdentifiant_Personne($identifiantPersonne)
    {
    $id = (int) $identifiantPersonne;

        if ($id > 0)
        $this->identifiant_Personne = $id;
    }

    public function setIdentifiant_role($identifiantRole)
    {
        $role = (int) $identifiantRole;

        if ($role > 0)
        $this->identifiant_role = $role;
    }


    //getter
    public function getId()
    {
        return $this->identifiant_Personne;
    }
    public function getRole()
    {
       return $this->identifiant_role;
    }
}



?>