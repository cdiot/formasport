<?php
namespace Models;

/*
  Script: "SecurityModels"
  Par: Chris
  Dernière modification: 22 novembre 2020
 */
class SecurityModels extends Models
{
    /**
     * Récupére le profil de l'utilisateur
     *
     * @param  string $email
     * @return array
     */
    public function findByEmail(string $email)
    {
        parent::query('SELECT * FROM instructor AS i  
            JOIN instructor_type AS t ON i.instructor_type = t.instructor_type_id
            WHERE instructor_email =:instructor_email;'); 
        parent::bind(':instructor_email', $email);
        $req = parent::resultSet(); 
        return $req;
    }
    /**
     * Récupére la connexion
     *
     * @param  string $lastname
     * @param  string $password
     * @return void
     */
    public function login(string $lastname, string $password)
     {
        parent::query('SELECT * FROM instructor WHERE instructor_lastname = :instructor_lastname');
        parent::bind(':instructor_lastname', $lastname); 
        $row = parent::single();
        $hashedPassword = $row->instructor_password;
        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
     }
    /**
     * Récupére le jeton de réinitialisation
     *
     * @param  string $email
     * @return array
     */
    public function getToken(string $email)
    {
        parent::query('SELECT token_id FROM token WHERE fk_instructor_email = :fk_instructor_email');
        parent::bind(':fk_instructor_email', $email);
        $req = parent::single();
        return $req;
    }  
    /**
     * Ajoute un jeton de réinitialisation
     *
     * @param  int    $recoveryCode
     * @param  string $creationDate
     * @param  string $email
     * @return void
     */
    public function addToken(int $recoveryCode, string $creationDate, string $email):void
    {
        parent::query('INSERT INTO token (token_code, token_creation_date, fk_instructor_email) VALUES (:token_code, :token_creation_date, :fk_instructor_email)');
        parent::bind(':token_code', $recoveryCode);
        parent::bind(':token_creation_date', $creationDate);
        parent::bind(':fk_instructor_email', $email);
        parent::execute();      
    }
    /**
     * Met à jour le jeton de réinitialisation
     *
     * @param  int    $recoveryCode
     * @param  string $creationDate
     * @param  string $email
     * @return void
     */
    public function updateToken(int $recoveryCode, string $creationDate, string $email):void
    {
        parent::query('UPDATE token SET token_code = ?, token_creation_date = ? WHERE fk_instructor_email = ?');
        parent::bind(1, $recoveryCode);
        parent::bind(2, $creationDate);
        parent::bind(3, $email);
        parent::execute();
    }
    /**
     * Supprime le jeton de réinitialisation
     *
     * @param  string $email
     * @return void
     */
    public function deleteToken(string $email):void
    {
        parent::query('DELETE FROM token WHERE fk_instructor_email = ?');
        parent::bind(1, $email);
        parent::execute();
    }
    /**
     * Met à jour le mot de passe
     *
     * @return void
     */
    public function updatePassword($data):void 
    { 
        parent::query('UPDATE instructor SET instructor_password = :instructor_password WHERE instructor_email = :instructor_email');
        parent::bind(':instructor_password', $data['password']);
        parent::bind(':instructor_email', $data['email']);
        parent::execute();
    }
    /**
     * Vérifie la validité du jeton de réinitialisation
     *
     * @param  string $email
     * @param  string $code
     * @return object
     */  
    public function verificationToken(string $email, string $code):object
    {
        parent::query('SELECT token_id FROM token WHERE fk_instructor_email = :fk_instructor_email AND token_code = :token_code;');
        parent::bind(':fk_instructor_email', $email);
        parent::bind(':token_code', $code);
        $req = parent::single();
        return $req;
    }
}
