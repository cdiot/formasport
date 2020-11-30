<?php

/*
  Script: "Database"
  Par: Chris
  Dernière modification: 20 octobre 2020
 */
class Database
{
    const DB_HOST = 'mysql:dbname=formasports;host=localhost;charset=utf8';
    const DB_USER = 'root';
    const DB_PASS = '';

    /**
     * Connexion à la base de données.
     *
     * @return PDO
     **/
    public static function getDb(): \PDO
    {
        try {
            $pdo = new PDO(self::DB_HOST, self::DB_USER, self::DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET lc_time_names = \'fr_FR\''
            ]);
            return $pdo;
        } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
        }
    }
}
