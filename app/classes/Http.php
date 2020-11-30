<?php

/*
  Script: "Http"
  Par: Chris
  Dernière modification: 09 novembre 2020
 */
class Http
{
    /**
     * Retourne les comptes de l'utilisateur connecter, classés par $item.
     *
     * @return bool retourne true si la session existe.
     */
    public static function isLoggedIn():bool 
    {
        if (isset($_SESSION["id"])) {
            return true;
        } else  {
            Http::redirect('securitycontrollers','login');  
        }
    }
    /**
     * Redirection des utilisateurs vers $url
     *
     * @param  string $controller
     * @param  string $task
     * @return void
     */
    public static function redirect(string $controller,string $task): void
    {
        header("refresh:2;url=index.php?controller=$controller&task=$task");
        exit();
    }
    /**
     * Redirection des utilisateurs vers $url
     *
     * @return mixed
     */
    public static function validData($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
