<?php

/*
  Script: "Renderer"
  Par: Chris
  Dernière modification:  09 novembre 2020
 */
class Renderer 
{
    /**
     * @var string
     */
    const DEFAULT_TEMPLATE = "default";

  /**
  * Affiche la vue demandée dans $path en injectant les variables contenues dans $variables
  *
  * @param string $path
  * @param string $template
  * @param array $variables
  *
  * @return void
  */
  public static function render(string $path, string $template, array $variables = []): void {
    extract($variables); 

    ob_start();
    require('app/pages/'.$path.'.php');
    $pageContent = ob_get_clean();
    
    if (empty($template)) {
      $template = self::DEFAULT_TEMPLATE;
    }
    require_once('app/pages/templates/'. $template .'.php');
  }
}