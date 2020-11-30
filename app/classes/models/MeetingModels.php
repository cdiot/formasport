<?php
namespace Models;

/*
  Script: "MeetingModels"
  Par: Chris
  Dernière modification: 15 novembre 2020
 */
class MeetingModels extends Models
{
    /**
     * Retourne toutes les réunions
     *
     * @return array
     */
    public function findAll():array
    {
        parent::query('SELECT * FROM view_meeting;');       
        $req = parent::resultSet();
        return $req;
    }
    /**
     * Retourne toutes les réunions pour les quelles l'utilisateur connecter est l'organisateur
     *
     * @param  int    $organizerId
     * @return array
     */
    public function findAllByOrganizer(int $organizerId):array
    {
        parent::query('SELECT i.instructor_civility,i.instructor_firstname, i.instructor_lastname, m.meeting_id, m.meeting_object, m.meeting_location,
            m.meeting_description, date_format(ts.meeting_time_slot_start,"%W %M %e %Y") AS meeting_date
            FROM meeting AS m
            JOIN instructor AS i ON m.meeting_organizer_id = i.instructor_id
            JOIN meeting_time_slot AS ts ON m.meeting_id = ts.fk_meeting_id  
            WHERE ts.meeting_time_slot_start >= now()  
            AND m.meeting_organizer_id = :meeting_organizer_id 
            GROUP BY m.meeting_id;');
        $req = parent::bind(':meeting_organizer_id', $organizerId);
        $req = parent::resultSet();
        return $req;
    }
	/**
	 * Retourne une réunion
	 *
	 * @param  int    $meetingId
	 * @return array
	 */
    public function find(int $meetingId):array
	{
        parent::query('SELECT * FROM view_meeting WHERE meeting_id = ?');
        parent::bind(1, $meetingId);
        $req = parent::resultSet();
        return $req;
	}
    /**
     * Ajoute une réunion
     *
     * @param  int    $organizerId
     * @param  string $object
     * @param  string $location
     * @param  string $description
     * @return void
     */
    public function add(int $organizerId, string $object, string $location, string $description):void
    {
        parent::query('INSERT INTO meeting (meeting_organizer_id,meeting_object,meeting_location,meeting_description) 
            VALUES (:meeting_organizer_id,:meeting_object,:meeting_location,:meeting_description);');
        parent::bind(':meeting_organizer_id', $organizerId);
        parent::bind(':meeting_object', $object);
        parent::bind(':meeting_location', $location);
        parent::bind(':meeting_description', $description);
        parent::execute();
    }  
    /**
     * Retourne la dernière réunion ajouter
     *
     * @param  int    $organizerId
     * @return string
     */
    public function getLastInsert(int $organizerId):string
    {
        parent::query('SELECT max(meeting_id) AS meeting_id FROM meeting WHERE meeting_organizer_id= :meeting_organizer_id;');
        parent::bind(':meeting_organizer_id', $organizerId);
        $req   = parent::single(); 
        $reqId = $req->meeting_id; 
        return $reqId;
    }
}