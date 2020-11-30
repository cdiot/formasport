<?php
namespace Models;

/*
  Script: "CommentModels"
  Par: Chris
  Dernière modification: 12 novembre 2020
 */
class CommentModels extends Models
{
    protected $pdo;

    /**
     * Retourne get
     *
     * @param  int    $meetingId
     * @return void 
     */
    public function get(int $meetingId):void
    {
        parent::query('SELECT * FROM messages JOIN instructor ON messages.fk_instructor_id = instructor.instructor_id where fk_meeting_id = ? ORDER BY messages_created_at DESC LIMIT 20');
        parent::bind(1, $meetingId);
        $req = parent::resultSet();
        echo json_encode($req);
    }
    /**
     * Retourne post
     *
     * @param  string $content
     * @param  string $createdAt
     * @param  int    $instructorId
     * @param  int    $meetingId
     * @return void 
     */
    public function post(string $content, string $createdAt, int $instructorId, int $meetingId):void
    {
        parent::query('INSERT INTO messages (messages_content, messages_created_at, fk_instructor_id, fk_meeting_id)  
            VALUES (:messages_content,:messages_created_at,:fk_instructor_id,:fk_meeting_id)');
        parent::bind(':messages_content',    $content);
        parent::bind(':messages_created_at', $createdAt);
        parent::bind(':fk_instructor_id',    $instructorId);
        parent::bind(':fk_meeting_id',       $meetingId);
        parent::execute();
    }
}