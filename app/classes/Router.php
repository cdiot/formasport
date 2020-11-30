<?php

/*
  Script: "Router"
  Par: Chris
  Dernière modification: 13 novembre 2020
 */
class Router
{
    /**
     * @var string
     */
    const DEFAULT_CONTROLLER = "securitycontrollers";

    /**
     * @var string
     */
    const DEFAULT_TASK = "login";

    /**
     * Exécute l'action nécessaire sur le controller voulu ou retourne une page 404
     *
     * @return void
     */
    public static function process()
    {    
        $controllerName = self::getControllerName();
        $taskName = self::getTaskName();

        $controller = new $controllerName();
        $controller->$taskName();    
    }

    /**
     * Retourne la task demandée dans l'url
     *
     * @return string
     */
    private static function getTaskName(): string
    {
        $taskName = filter_input(INPUT_GET, "task", FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$taskName) {
            $taskName = self::DEFAULT_TASK;
        }

        return $taskName;
    }

    /**
     * Retourne le controller demandé dans l'url
     *
     * @return string
     */
    private static function getControllerName(): string
    {
        $controllerName = filter_input(INPUT_GET, "controller", FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$controllerName) {
            $controllerName = self::DEFAULT_CONTROLLER;
        }

        return "Controllers\\" . ucfirst($controllerName);
    }
}