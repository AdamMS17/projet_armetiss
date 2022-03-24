<?php

abstract class DBManager
{
    private static $connexion;

    private static function setConnexion()
    {
        $database_server = "localhost";
        $database_name = "temp_projet";
        $database_username = "root";
        $database_password = "";

        self::$connexion = new PDO(
            "mysql:host=$database_server;dbname=$database_name",
            $database_username,
            $database_password,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    }

    protected function getConnexion()
    {
        if (self::$connexion == null)
            self::setConnexion();
        return self::$connexion;
    }

    protected function getAll($table, $typeObjetCree)
    {
        $var = [];
        $requete = $this->getConnexion()->prepare('SELECT * FROM ' . $table);
        $requete->execute();
        //Tant que fetch va chercher une autre donnée
        //Chaque donnée est enregistrée dans le tableau sous forme d'objet de type $typeObjetCree
        while ($data = $requete->fetch(PDO::FETCH_ASSOC))
            $var[] = new $typeObjetCree($data);

        return $var;
    }

    protected function getByIdName($table, $typeObjetCree, $id, $idName)
    {
        $requete = $this->getConnexion()->prepare('SELECT * FROM ' . $table . ' WHERE ' . $idName . ' = ' . $id);
        $requete->execute();
        $data = $requete->fetch(PDO::FETCH_ASSOC);

        return (new $typeObjetCree($data));
    }
}
