<?php
namespace Controllers;

use \Renderer;
use \Http;

/*
  Script: "MeetingControllers"
  Par: Chris
  Dernière modification: 23 novembre 2020
 */
class MeetingControllers extends Controllers
{
    protected $modelName = MeetingModels::class;

    public function __construct() {
        parent::__construct();
        
        Http::isLoggedIn(); 
    }

    public function findAll()
    {
        $pageTitle = 'Accueil | Toutes les réunions ';
        $profil    = $this->userModel->findByEmail($_SESSION['email']);
        $meetings  = $this->model->findAll();

        Renderer::render('meeting/homePage', '', compact('pageTitle', 'profil', 'meetings'));
    }

    public function findWithInvite()
    { 
        $pageTitle = 'Accueil | Réunions Invités ';
        $profil    = $this->userModel->findByEmail($_SESSION['email']);
        $meetings  = $this->guestModel->findAll($_SESSION['id']);

        Renderer::render('meeting/homePage', '', compact('pageTitle', 'profil', 'meetings'));
    }

    public function findWithOrganisator()
    {
        $pageTitle = 'Accueil | Réunions Organisateur ';
        $profil    = $this->userModel->findByEmail($_SESSION['email']);
        $meetings  = $this->model->findAllByOrganizer($_SESSION['id']);

        Renderer::render('meeting/homePage', '', compact('pageTitle', 'profil', 'meetings'));
    }

    public function find()
    {
        $pageTitle = 'Consulter une réunion';
        $profil    = $this->userModel->findByEmail($_SESSION['email']);
        // Vérifie qu'un id est passé en parametre
        $meetingId = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
        if (empty($meetingId)) {
            Http::redirect('meetingcontrollers', 'findAll');
        } else {
            // Stock en session l'id de la réunion parcouru pour le script des commentaires
            $_SESSION['meetingId'] = $meetingId;
        }

        // Récupére les informations de la réunion passé en paramètre
        $meetings  = $this->model->find($meetingId);
        $guests    = $this->guestModel->find($meetingId);
        $timeSlots = $this->timeSlotModel->find($meetingId);
        $availabilityDates = $this->presenceModel->getList($_SESSION['id'], $meetingId);

        Renderer::render('meeting/meetingPage', '', compact('pageTitle', 'profil', 'meetings', 'guests', 'timeSlots', 'availabilityDates'));
    }

    public function presence() 
    {
        $pageTitle = 'Indiquer votre presence';
        $profil    = $this->userModel->findByEmail($_SESSION['email']);
        $meetingId = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
        if (!$meetingId) {
            $error['emptyError'] = '<p class="guest-timeslot unavailable">Veuillez préciser la réunion à consulter !</p>';
        }
        $availabilityDates = $this->presenceModel->getList($_SESSION['id'], $meetingId);

        $error = [
            'fieldsError' => '',
            'emptyError'  => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $error = [
                'fieldsError' => '',
                'emptyError'  => ''
            ];

            $instructorId = $_SESSION['id'];
            $presence     = Http::validData(filter_input(INPUT_POST, 'presence', FILTER_VALIDATE_INT));
            $timeSlotId   = Http::validData(filter_input(INPUT_POST, 'timeSlot', FILTER_VALIDATE_INT));

            // Vérifie la valeur des données
            if (!isset($presence) || empty($instructorId) || empty($timeSlotId)) {
                $error['fieldsError'] = '<p class="guest-timeslot unavailable">Le formulaire a été mal rempli !</p>';
            }
            if (!empty($presence)){
                //$stok is checked and value = 1
                $response = 1;
            } else {
                $response = 0;
            }


            if (!$error['emptyError'] && !$error['fieldsError']) {
                // Met à jour ou Ajoute la réponse de l'invité
                $existPresence = $this->presenceModel->get($instructorId, $timeSlotId);
                if ($existPresence == true) {
                    $presence  = $this->presenceModel->update($instructorId, $response, $timeSlotId);
                } else {
                    $presence  = $this->presenceModel->add($instructorId, $response, $timeSlotId);
                }             
                echo "Votre réponse à bien était prise en compte!";
                Http::redirect('meetingcontrollers', 'findAll');
            }
        }
        Renderer::render('meeting/presencePage', '', compact('pageTitle', 'profil', 'availabilityDates', 'error'));
    }

    public function add()
    {
        $pageTitle   = 'Création de réunion';
        $profil      = $this->userModel->findByEmail($_SESSION['email']);
        $listinviter = $this->guestModel->getList();

        $error = [
            'formatError' => '',
            'lenghtError' => '',
            'fieldsError' => '',
            'guestError'  => '',
            'dateError'   => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $organizerId = $_SESSION['id'];
            $object      = Http::validData(filter_input(INPUT_POST, 'object', FILTER_SANITIZE_SPECIAL_CHARS));
            $location    = Http::validData(filter_input(INPUT_POST, 'location', FILTER_SANITIZE_SPECIAL_CHARS));
            $description = Http::validData(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS));
            $nbGuest     = Http::validData(filter_input(INPUT_POST, 'nbGuest', FILTER_VALIDATE_INT));
            $nbDate      = Http::validData(filter_input(INPUT_POST, 'nbDate', FILTER_VALIDATE_INT));

            // Vérifie la longueur et la valeur des données
            if (empty($object) || empty($location) || empty($description) || empty($nbGuest) || empty($nbDate)) {
                $error['fieldsError'] = '<p class="guest-timeslot unavailable">Votre formulaire a été mal rempli !</p>';
            }
            if (strlen($object) < 6) {
                $error['lenghtError'] = '<p class="guest-timeslot unavailable">L\'objet doit être d\'au moins 6 caractères !</p>';
            } 
            if (str_word_count($description) <= 10) {
                $error['formatError'] = '<p class="guest-timeslot unavailable">La description doit être plus long !</p>';
            }
            if ($nbGuest < 1) {
                $error['guestError']  = '<p class="guest-timeslot unavailable">Au moins un formateur doit être invité à la réunion !</p>';
            }
            if ($nbDate < 1) {
                $error['dateError']   = '<p class="guest-timeslot unavailable">Au moins un créneau doit être disponible pour la réunion !</p>';
            }


            if (!$error['formatError'] && !$error['lenghtError'] && !$error['fieldsError'] && !$error['guestError'] && !$error['dateError']) {
                // Ajout d'une réunion
                $meeting   = $this->model->add($organizerId, $object, $location, $description);
                $meetingId = $this->model->getLastInsert($_SESSION['id']);
                // Ajout des invités
                for ($i = 1; $i < $nbGuest + 1; $i++) {
                     $guestName = $_POST['guest' . $i];
                     $guestId   = $this->guestModel->getUnique($guestName);
                     $guest     = $this->guestModel->add($guestId, $meetingId);
                }
                // Ajout des créneaux
                for ($T = 1; $T < $nbDate + 1; $T++) {
                    $dateStart = Http::validData($_POST['startDate' . $T]);
                    $dateEnd   = Http::validData($_POST['endDate' . $T]);
                    $timeStart = Http::validData($_POST['startTime' . $T]);
                    $timeEnd   = Http::validData($_POST['endTime' . $T]);
                    $start     = $dateStart . " " . $timeStart;
                    $end       = $dateEnd . " " . $timeEnd;
                    if ($start < $end) {
                        $timeSlot  = $this->timeSlotModel->add($start, $end, $meetingId);
                    } else {
                        $error['fieldsError'] = '<p class="guest-timeslot unavailable">Votre formulaire a été mal rempli !</p>';
                        die();
                    }
                }
                echo "Votre réponse à bien était prise en compte!";
                Http::redirect('meetingcontrollers', 'findAll');
            }
        }
        Renderer::render('meeting/addPage', '', compact('pageTitle', 'profil', 'listinviter', 'error'));
    }
}
