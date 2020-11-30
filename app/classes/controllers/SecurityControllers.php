<?php
namespace Controllers;

use \Renderer;
use \Http;

/*
  Script: "controllers"
  Par:     Chris
  Dernière modification: 23 novembre 2020
 */
class SecurityControllers extends Controllers
{
    public function login()
    {
        $pageTitle   = 'Me connecter';
        $data = [
            'lastname'      => '',
            'password'      => '',
            'lastnameError' => '',
            'passwordError' => '',
        ];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'lastname'      => Http::validData($_POST['lastname']),
                'password'      => Http::validData($_POST['password']),
                'lastnameError' => '',
                'passwordError' => '',
            ];

            // Vérifie la valeur des données
            if (empty($data['lastname'])) {
                $data['lastnameError'] = '<p class="guest-timeslot unavailable">Veuillez entrer votre nom.</p>';
            } 
            if (empty($data['password'])) {
                $data['passwordError'] = '<p class="guest-timeslot unavailable">Veuillez entrer votre mot de passe.</p>';
            }
            
            if (empty($data['lastnameError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->userModel->login($data['lastname'], $data['password']);
                // On créer la session
                if ($loggedInUser) {
                    $this->createSession($loggedInUser);
                } else { 
                    $data['passwordError'] = '<p class="guest-timeslot unavailable">Le mot de passe ou le nom d\'utilisateur est incorrect. Veuillez réessayer.</p>';
                    Http::redirect('securitycontrollers', 'login');
                }
            }
        }  
        Renderer::render('security/loginPage', 'security', compact('pageTitle', 'data'));  
    }

    public function createSession($user) 
    {
        $_SESSION['id'] = $user->instructor_id;
        $_SESSION['lastname'] = $user->instructor_lastname;
        $_SESSION['email'] = $user->instructor_email;
        Http::redirect('meetingcontrollers', 'findAll');
    }

    public function logout()
    {
        $pageTitle   = 'Me déconnecter';
        unset($_SESSION);
        session_destroy();
        Http::redirect('securitycontrollers', 'login');
        Renderer::render('security/logoutPage', 'security', compact('pageTitle'));
    }

    public function sendMail() 
    {
        $pageTitle   = 'Mot de passe oublié';
        $data = [
            'email'      => '',
            'emailError' => ''
        ];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {    

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email'      => Http::validData($_POST['email']),
                'emailError' => ''
            ];

            // Vérifie la valeur de l'e-mail
            if (empty($data['email'])) {
                $data['emailError'] = '<p class="guest-timeslot unavailable">Veuillez entrer votre adresse email.</p>';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['emailError'] = '<p class="guest-timeslot unavailable">Veuillez respecter le format.</p>';     
            }
             
            if (empty($data['emailError'])) {
                $existEmail = $this->userModel->findByEmail($data['email']);
                if ($existEmail == true) {
                    // Stock l'email en session, génére un code aléatoire 
                    $_SESSION['recoveryEmail'] = $data['email'];
                    $recoveryCode = "";
                    $creationDate =  date('Y-m-d H:i:s');
                    for ($i=0; $i < 8; $i++){
                         $recoveryCode .= mt_rand(0,9);
                    }
                    // Ajoute ou Met à jour le jeton dans la BDD
                    $existRecoveryEmail = $this->userModel->getToken($data['email']);
                    if ($existRecoveryEmail == true) {
                        $this->userModel->updateToken($recoveryCode, $creationDate, $data['email']);
                    } else {
                        $this->userModel->addToken($recoveryCode, $creationDate, $data['email']);
                    }
                } else {
                    $data['emailError'] = '<p class="guest-timeslot unavailable">Veuillez entrer une adresse email existante.</p>';
                }
            } 
            // Ecrit et envoie l'email  
            $header  = "MIME-Version: 1.0\r\n";
            $header .= 'From: "FormaSPORT"<christopher.diot5@gmail.com>'."\n";
            $header .= 'Content-Type:text/html; charset="utf-8"'."\n";
            $header .= 'Content-Transfer-Encoding: 8bit';
            $message = '
              <html>
              <head>
                <title>Récupération de mot de passe - FormaSPORT</title>
                <meta charset="utf-8" />
              </head>
              <body>
                  <div align="center">
                    <p> Cette e-mail fait suite à votre demande de réinitialisation de mots de passe.<br><br>
                          Clickez <a href="https://localhost/formasport/index.php?controller=securitycontrollers&task=verificationCode">Ici</a> pour entrer votre nouveau mots de passe.<br>
                          Voici votre code de récupération: <strong>'.$recoveryCode.'</strong>, valable 24h à compter de la date de réception.<br><br></p>    
                    <p> Ceci est un email automatique, merci de ne pas y répondre.</p>                                        
                  </div>
              </body>
              </html>
              ';
              mail($data['email'], "Récupération de mot de passe - FormaSPORT", $message, $header);
              Http::redirect('securitycontrollers', 'verificationCode');
        }
        Renderer::render('security/sendMailPage', 'security', compact('pageTitle', 'data'));
    }

    public function verificationCode()
    {
        $pageTitle   = 'Vérification du jeton';
        $data = [
            'code'      => '',
            'codeError' => ''
        ];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);        
        
            $data = [
                'code'      => Http::validData($_POST['code']),
                'codeError' => ''
            ];

            // Vérifie la valeur du jeton
            if (empty($data['code'])) {
                $data['codeError'] = '<p class="guest-timeslot unavailable">Veuillez entrer le code de récuperation.</p>';
            }

            if (empty($data['codeError'])) {
                $token = $this->userModel->verificationToken($_SESSION['recoveryEmail'], $data['code']);
                // Stock le jeton en session, le supprime de la BDD et redirige vers 'newPassword'
                if (isset($token)) {
                    $_SESSION['token'] = 1;
                    $this->userModel->deleteToken($_SESSION['recoveryEmail']);
                    Http::redirect('securitycontrollers', 'newPassword');
                } else {
                    $data['codeError'] = '<p class="guest-timeslot unavailable">Code invalide.</p>';
                }
            }
        }
        Renderer::render('security/verificationCodePage', 'security', compact('pageTitle', 'data'));
    } 

    public function newPassword()
    {
        $pageTitle   = 'Nouveau mots de passe';
        $data = [
            'email'                 => '',
            'password'              => '',
            'confirmPassword'       => '',
            'passwordError'         => '',
            'confirmPasswordError'  => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email'                 => $_SESSION['recoveryEmail'],
                'password'              => Http::validData($_POST['password']),
                'confirmPassword'       => Http::validData($_POST['confirmPassword']),
                'passwordError'         => '',
                'confirmPasswordError'  => ''
            ];

            $passwordValidation = "#^[a-zA-Z0-9 -_]$#";

            //  Vérifie la longueur, la valeur du mots de passe
            if (empty($data['password'])) {
                $data['passwordError'] = '<p class="guest-timeslot unavailable">Veuillez entrer le mot de passe.</p>';
            } elseif (strlen($data['password']) < 6) {
                      $data['passwordError'] = '<p class="guest-timeslot unavailable">Le mot de passe doit être au moins de 6 caractères</p>';
            } elseif (preg_match($passwordValidation, $data['password'])) {
                      $data['passwordError'] = '<p class="guest-timeslot unavailable">Le mot de passe doit être plus sécurisé.</p>';
            }
            
            // Vérifie l'égalité entre les mots de passe
            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = '<p class="guest-timeslot unavailable">Veuillez entrer le mot de passe.</p>';
            } elseif ($data['password'] != $data['confirmPassword']) {
                      $data['confirmPasswordError'] = '<p class="guest-timeslot unavailable">Les mots de passe ne correspondent pas, veuillez réessayer.</p>';
            }
          
            if (empty($data['passwordError']) && empty($data['confirmPasswordError'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
              // Met à jour le mot de passe après son hachage
              $this->userModel->updatePassword($data);
                  unset($_SESSION['token']);
                  unset($_SESSION['recoveryEmail']);
                  Http::redirect('securitycontrollers', 'login');
              
            }
        }
        Renderer::render('security/newPasswordPage', 'security', compact('pageTitle', 'data'));
    }
    
    public function error()
    {
        $pageTitle   = 'Erreur 404';

        Renderer::render('security/404Page', 'security', compact('pageTitle'));
    }
}
