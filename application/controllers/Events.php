<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('events_model');
  }

  public function index(){
    $data = array(
      'events' => $this->events_model->ongoingEvents(),
      'myEvents' => $this->events_model->myEvents($this->session->userdata('indiv')->Id),
    );

    $this->template->load('events/events',$data);
  }

  public function view_addEvent(){
    $this->load->model('individus_model');
    $data['individus'] = $this->individus_model->getUsers();

    $this->template->load('events/addEvent', $data);
  }

  public function addEvent(){
    $this->load->library('form_validation');

    $this->form_validation->set_rules('Nom', 'Nom', 'required|is_unique[Events.Nom]');
    $this->form_validation->set_rules('Type', 'Type', 'required');
    $this->form_validation->set_rules('DateDebut', 'Date du début', 'required');
    $this->form_validation->set_rules('DateFin', 'Date de fin', 'required|callback__validate_DateFin');

    if( !empty( $_POST['IdIndividus'] ) ){
      $_POST['IdIndividus'] = implode(',', $_POST['IdIndividus']);
    }

    if ($this->form_validation->run() == FALSE){
      $individus = $this->load->model('individus_model');
      $data['individus'] = $this->individus_model->getUsers();
      
      $this->template->load('events/addEvent', $data);
      return;
    } else{
      $individus = $this->load->model('events_model');
      $this->events_model->addEvent();

      redirect('events/myEvents/' . $this->session->userdata('indiv')->Id, 'refresh');
    }   
  }

  public function myEvents($idIndiv = null){
    if(is_null($idIndiv)){
      $idIndiv = $this->session->userdata('indiv')->Id;
    }

    $data = array(
      'mgEvents' => $this->events_model->getMyEvents($idIndiv),
      'partEvents' => $this->events_model->getParticipatingEvents($idIndiv),
    );

    $this->load->model('individus_model');
    $data['individus'] = $this->individus_model->getUsers();

    $this->template->load('events/myEvents', $data);
  }

  public function editEvent($idEvent){
    $_POST['IdIndividus'] = implode(',', $_POST['IdIndividus']);
    $this->events_model->editEvent($idEvent);

    redirect('events/myEvents/' . $this->session->userdata('indiv')->Id, 'refresh');
  }

  function _validate_DateFin($dateFin){
    $valid = true;

    if(strtotime( $dateFin ) < strtotime($this->input->post('DateDebut') ) ){
      $this->form_validation->set_message('_validate_DateFin', 'End date must not be before start date');
      $valid = false;
    }

    return $valid;
  }

  public function ajax_getClassement($idEvent){
    $data = array();

    $event = $this->events_model->getEvent($idEvent);
    //Get Matches FROM Event GROUPED BY Individus (JOIN TABLE Individus)

    if($event->IdIndividus == "" || is_null($event->IdIndividus)){
      $data['err'][] = array(
        'no_participants' => "Aucun participants dans cet événement."
      );

      return;
    }

    $eventIndividus = explode(',', $event->IdIndividus);

    $this->load->model('individus_model');
    foreach ($eventIndividus as $indiv) {
      $individu = $this->individus_model->getUser($indiv);
      $win = 0;
      $lost = 0;

      $matches = $this->individus_model->getMatchesFromIndiv($indiv, $idEvent);

      foreach ($matches as $m) {
        if( $m->IdIndiv1 == $indiv ){
          if($m->Score1 > $m->Score2){
            $win++;
          } else{
            $lost++;
          }
        } else{
          if($m->Score1 > $m->Score2){
            $lost++;
          } else{
            $win++;
          }
        }
      }

      $data['classement'][] = array(
        'Individu' => $individu->Prenom . ' ' . $individu->Nom,
        'Win' => $win,
        'Lost' => $lost,
        'GP' => count($matches),
      );
    }

    $data['event'] = $event;

    uasort($data['classement'], function($a, $b){
      return $a['Win'] <=> $b['Win'];
    });

    echo json_encode($data['classement']);

  }

}

/* End of file Events.php */
/* Location: ./application/controllers/Events.php */ ?>