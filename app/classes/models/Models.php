<?php
namespace Models;

use \PDO;
use \Database;

/*
  Script: "Models"
  Par: Chris
  Dernière modification: 14 novembre 2020
 */
abstract class Models
{
    protected $pdo;
    protected $statement;

	public function __construct()
	{
		$this->pdo = Database::getDb();
    }
    
    // Permet d'écrire des requêtes
    public function query($sql) {
        $this->statement = $this->pdo->prepare($sql);
    }

    // Permet de lier des valeurs
    public function bind($parameter, $value, $type = null) 
    {
        switch (is_null($type)) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        $this->statement->bindValue($parameter, $value, $type);
    }

    // Exécute l'instruction préparée
    public function execute() 
    {
        return $this->statement->execute();
    }

    // Renvoie un tableau
    public function resultSet() 
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }
    
    // Renvoie une ligne spécifique en tant qu'objet
    public function single() 
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    // Obtenir le nombre de lignes
    public function rowCount() 
    {
        return $this->statement->rowCount();
    }
}
