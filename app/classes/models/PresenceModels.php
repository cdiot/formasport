<?php
namespace Models;

/*
  Script: "PresenceModels"
  Par: Chris
  Dernière modification: 24 novembre 2020
 */
class PresenceModels extends Models
{
    /**
     * Retourne la liste des créneaux horaires disponible pour un invité
     *
     * @param  int $guestId
     * @param  int $meetingId
     * @return array
     */ 
    public function getList(int $guestId, int $meetingId):array
    {
        parent::query('SELECT ts.meeting_time_slot_id, TIME(ts.meeting_time_slot_start) AS meeting_start, TIME(ts.meeting_time_slot_end) AS meeting_end
            FROM meeting AS m
            JOIN meeting_guest AS g ON m.meeting_id=g.fk_meeting_id 
            JOIN meeting_time_slot AS ts ON m.meeting_id = ts.fk_meeting_id 
            WHERE g.fk_instructor_id = ? AND meeting_id = ?
            GROUP BY meeting_start >= now()');
        parent::bind(1, $guestId);
        parent::bind(2, $meetingId);
        $req = parent::resultSet();
        return $req;
    }
    /**
     * Vérifie si un invité à deja indiqué pour un créneaux horaires sa disponible
     *
     * @param  int $instructorId
     * @param  int $timeSlotId
     * @return array
     */ 
    public function get(int $instructorId, int $timeSlotId):array
    {
        parent::query('SELECT meeting_guest_presence_id
            FROM meeting_guest_presence
            WHERE fk_instructor_id = ? AND 	fk_meeting_time_slot_id = ?');
        parent::bind(1, $instructorId);
        parent::bind(2, $timeSlotId);
        $req = parent::resultSet();
        return $req;
    }
    /**
     * Ajoute la réponse concernant la présence d'un invité
     *
     * @param  int    $instructorId
     * @param  int    $response
     * @param  int    $timeSlotId
     * @return void
     */
    public function add(int $instructorId, int $response, int $timeSlotId):void
    {
        parent::query('INSERT INTO meeting_guest_presence (fk_instructor_id,meeting_guest_presence_response,fk_meeting_time_slot_id) 
            VALUES (:instructor_id,:response,:time_slot_id)');
        parent::bind(':instructor_id', $instructorId);
        parent::bind(':response',      $response);
        parent::bind(':time_slot_id',  $timeSlotId);
        parent::execute();
    }
    /**
     * Modifie la réponse concernant la présence d'un invité
     *
     * @param  int    $instructorId
     * @param  int    $response
     * @param  int    $timeSlotId
     * @return void
     */
    public function update(int $instructorId, int $response, int $timeSlotId):void
    {
        parent::query('UPDATE meeting_guest_presence SET fk_instructor_id = ?, meeting_guest_presence_response = ? WHERE fk_meeting_time_slot_id = ?');
        parent::bind(1, $instructorId);
        parent::bind(2, $response);
        parent::bind(3, $timeSlotId);
        parent::execute();
    }
}
