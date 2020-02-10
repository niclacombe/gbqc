<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matches extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('matches_model');
  }

  public function view_addMatch(){
    $individus = $this->load->model('individus_model');
    $data['individus'] = $this->individus_model->getUsers();

    $this->load->model('guildes_model');
    $data['guildes'] = $this->guildes_model->getGuildes();

    $this->template->load('matches/addMatch', $data);
  }

  public function addMatch(){
    $this->load->library('form_validation');

    $this->form_validation->set_rules('IdIndiv2', 'Joueur 2', 'required');

    $this->form_validation->set_rules('IdGuilde1', 'Guilde du joueur 1', 'required');
    $this->form_validation->set_rules('IdGuilde2', 'Guilde du joueur 2', 'required');

    $this->form_validation->set_rules('Score1', 'Score du joueur 1', 'required|is_natural|greater_than_equal_to[0]|less_than_equal_to[12]');
    $this->form_validation->set_rules('Score2', 'Score du joueur 2', 'required|is_natural|greater_than_equal_to[0]|less_than_equal_to[12]');
    

    if ($this->form_validation->run() == FALSE){
      $this->template->load('matches/addMatch');
      return;
    } else{
      $this->matches_model->addMatch();
    }    
  }

  public function ajax_getJoueurs($idGuilde){
    $this->load->model('joueurs_model');

    $joueurs = $this->joueurs_model->getJoueursByGuilde($idGuilde);
  }



}

/* End of file Matches.php */
/* Location: ./application/controllers/Matches.php */
?>