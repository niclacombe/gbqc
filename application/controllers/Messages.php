<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {

  public function __construct(){
    parent::__construct();

    if( is_null($this->session->userdata('indiv')) ){
      redirect('home','refresh');
    }
  }

  public function index(){
    $this->load->model('events_model');

    $events = array();
    $eventsMsg = array();

    $partEvents = $this->events_model->getParticipatingEvents( $this->session->userdata('indiv')->Id );
    $mngEvents = $this->events_model->getMyEvents( $this->session->userdata('indiv')->Id );

    foreach ($partEvents as $e) {
      $events[] = $e->Id;
    }

    foreach ($mngEvents as $e) {
      $events[] = $e->Id;
    }

    $this->load->model('messages_model');
    foreach ($events as $e) {
      $eventsMsg[] = $this->messages_model->getMessagesByEvent($e->Id);
    }
    
    $data = array(
      'generalMsg' => $this->messages_model->getMessages(),
      'eventsMsg' => $eventsMsg
    );
  }

}

/* End of file Messages.php */
/* Location: ./application/controllers/Messages.php */ ?>