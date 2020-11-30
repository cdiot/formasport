<?php
namespace Models;

/*
  Script: "TimeSlotModels"
  Par: Chris
  Dernière modification: 14 novembre 2020
 */
class TimeSlotModels extends Models
{
    /**
	 * Retourne la liste des créneaux horaires disponible pour une réunion
	 *
	 * @param  int $meetingId
	 * @return array
	 */
    public function find(int $meetingId):array
	{
        parent::query('SELECT * FROM view_time_slot WHERE meeting_id = ?');
        parent::bind(1, $meetingId);
        $req = parent::resultSet();
        return $req;
    }   
    /**
     * Ajoute les créneaux horaires concernant une réunion
     *
     * @param  string $start
     * @param  string $end
     * @param  int    $meetingId
     * @return void
     */
    public function add(string $start, string $end, int $meetingId):void
    {
        parent::query('INSERT INTO meeting_time_slot (meeting_time_slot_start, meeting_time_slot_end, fk_meeting_id) 
            VALUES (:meeting_time_slot_start, :meeting_time_slot_end, :fk_meeting_id)');
        parent::bind(':meeting_time_slot_start', $start);
        parent::bind(':meeting_time_slot_end', $end);
        parent::bind(':fk_meeting_id', $meetingId);
        parent::execute(); 
    }
}
