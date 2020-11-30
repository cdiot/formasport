<?php
namespace Controllers;

use \Http;

/*
  Script: "WebserviceControllers"
  Par: Chris
  Dernière modification: 23 novembre 2020
 */
class WebserviceControllers extends Controllers
{

    public function getAll()
    {
        $return = $this->apiModel->getAll();
        header('Content-type:application/json;charset=utf-8');
        echo json_encode($return);
    }

    public function login()
    {
        $data = [
            'lastname'      => '',
            'password'      => ''
        ];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'lastname'  => Http::validData($_POST['lastname']),
                'password'  => Http::validData($_POST['password'])
            ];
        
        if (!empty($data['lastname']) && empty(!$data['password'])) {
            $loggedInUser = $this->userModel->login($data['lastname'], $data['password']);
            echo "connexion réussie" ;
        } else {
          echo "Formateur non trouvé.";
        }
        }
    }
}
