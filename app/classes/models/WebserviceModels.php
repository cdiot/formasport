<?php
namespace Models;

/*
  Script: "WebserviceModels"
  Par: Chris
  Dernière modification: 15 novembre 2020
 */
class WebserviceModels extends Models
{
    /**
     * Retourne liste des formations
     *
     * @return void
     */
    public function getAll():array
    {
        parent::query('SELECT forming_id, forming_title, forming_duration, forming_description FROM trainings;');
        $req  = parent::resultSet(); 
        $data = [];
        $data['success'] = true;
        $data['message'] = 'Accès aux données réussies'; 
        $data['data'] = $req;

        return $data;
    }
}
