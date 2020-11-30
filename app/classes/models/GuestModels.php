<?php
namespace Models;

/*
  Script: "GuestModels"
  Par: Chris
  Dernière modification: 15 novembre 2020
 */
class GuestModels extends Models
{
    /**
     * Retourne toutes les réunions pour les quelles l'utilisateur connecter est invité
     *
     * @param  int    $guestID
     * @return array 
     */
    public function findAll(int $guestId):array
    {
        parent::query('SELECT i.instructor_civility,i.instructor_firstname, i.instructor_lastname, m.meeting_id, m.meeting_object, m.meeting_location,
            m.meeting_description, date_format(ts.meeting_time_slot_start,"%W %M %e %Y") AS meeting_date
            FROM meeting AS m
            JOIN meeting_guest AS g ON m.meeting_id=g.fk_meeting_id 
            JOIN instructor AS i ON g.fk_instructor_id = i.instructor_id
            JOIN meeting_time_slot AS ts ON m.meeting_id = ts.fk_meeting_id 
            WHERE ts.meeting_time_slot_start >= now()  
            AND g.fk_instructor_id = :guest_id
            GROUP BY m.meeting_id;');
        $req = parent::bind(':guest_id', $guestId);
        $req = parent::resultSet();
        return $req;
    }
    /**
	 * Retourne la liste des invités concernant une réunion
	 *
	 * @param  int    $meetingId
	 * @return array
	 */
    public function find(int $meetingId):array
	{
        parent::query('SELECT * FROM view_guest WHERE meeting_id = ?');
        parent::bind(1, $meetingId);
        $req = parent::resultSet();
        return $req;
    }
    /**
     * Ajoute des invités concernant une réunion 
     *
     * @param  int    $guestId
     * @param  int    $meetingId
     * @return void
     */
    public function add(int $guestId, int $meetingId):void
    {
        parent::query('INSERT INTO meeting_guest (fk_instructor_id, fk_meeting_id) 
            VALUES (:fk_instructor_id, :fk_meeting_id)');
        parent::bind(':fk_instructor_id', $guestId);
        parent::bind(':fk_meeting_id', $meetingId);
        parent::execute(); 
    }
    /**
     * Retourne l'identifiant d'un formateur grace au $firstname spécifié dans la liste déroulante du javascript
     *
     * @param  string $firstname
     * @return string
     */
    public function getUnique(string $firstname):string
    {
        parent::query('SELECT instructor_id FROM instructor where instructor_firstname= :instructor_firstname;');
        parent::bind(':instructor_firstname', $firstname);
        $req   = parent::single();
        $reqId = $req->instructor_id; 
        return $reqId;
    }
    /**
     * Retourne liste deroulante du javascript
     *
     * @return array
     */
    public function getList():array
    {
        parent::query('SELECT instructor_firstname FROM instructor;');
        $req   = parent::resultSet(); 
        $array = [];
        $i = 0;
        // Remplissage du tableau
        foreach ($req as $row) {
            $array[$i]  = $row->instructor_firstname;
            $i++;
        }
        return $array;
    }
}