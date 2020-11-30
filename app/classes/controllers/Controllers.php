<?php
namespace Controllers;
session_start();

use \Models\{
  MeetingModels,
  GuestModels,
  SecurityModels,
  TimeSlotModels,
  PresenceModels,
  CommentModels,
  WebserviceModels
};

/*
  Script "Controllers"
  Par Chris
  Dernière modification : 13 novembre 2020
 */
abstract class Controllers 
{
    public function __construct()
    {
      $this->guestModel = new GuestModels();
      $this->userModel = new SecurityModels();
      $this->model = new MeetingModels();
      $this->timeSlotModel = new TimeSlotModels();
      $this->presenceModel = new PresenceModels();
      $this->commentModel = new CommentModels();  
      $this->apiModel = new WebserviceModels();   
    }
}
