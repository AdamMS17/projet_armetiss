<?php
class Personnel{
    private $identifiantPersonne;
    private $identifiantRole;

    public function __construct(int $identifiantPersonne,int $identifiantRole)
    {
        $this->identifiantPersonne = $identifiantPersonne;
        $this->identifiantRole = $identifiantRole;
    }
}
?>