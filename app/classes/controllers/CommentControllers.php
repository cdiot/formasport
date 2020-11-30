<?php
namespace Controllers;

use \Http;

/*
  Script: "CommentControllers"
  Par: Chris
  Dernière modification: 23 novembre 2020
 */
class CommentControllers extends Controllers
{
    public function __construct() {
        parent::__construct();
        http::isLoggedIn(); 
    }

    public function get()
    {
        // Liste des messages
        $this->commentModel->get($_SESSION['meetingId']);   
    }

    public function post()
    {
        // Ecrire un message
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $content      = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
            $createdAt    = date('Y-m-d H:i:s');
            $instructorId = $_SESSION['id'];
            $meetingId    = $_SESSION['meetingId'];

            if(!empty($content) && !empty($createdAt) && !empty($instructorId) && !empty($meetingId)) {
            
            $req = $this->commentModel->post($content, $createdAt, $instructorId, $meetingId);
            echo json_encode(['status'=>'success']);
            }
        }
     
    } 
}