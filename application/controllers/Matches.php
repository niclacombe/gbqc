<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matches extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('matches_model');

    /*if( is_null($this->session->userdata('indiv')) ){
      redirect('home','refresh');
    }*/
  }

  public function view_addMatch(){
    $this->load->model('individus_model');
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

    $this->form_validation->set_rules('ListIndiv1[]', 'Liste du joueur 1', 'callback__validate_lists');

    $this->form_validation->set_rules('ListIndiv2[]', 'Liste du joueur 2', 'callback__validate_lists');

    $this->form_validation->set_rules('DateJoue', 'Date Jouée', 'callback__validate_date');

    $_POST['ListIndiv1'] = implode(',',$_POST['ListIndiv1']);
    $_POST['ListIndiv2'] = implode(',',$_POST['ListIndiv2']);
    

    if ($this->form_validation->run() == FALSE){
      $individus = $this->load->model('individus_model');
      $data['individus'] = $this->individus_model->getUsers();

      $this->load->model('guildes_model');
      $data['guildes'] = $this->guildes_model->getGuildes();
      
      $this->template->load('matches/addMatch', $data);
      return;
    } else{
      $individus = $this->load->model('matches_model');
      $this->matches_model->addMatch();

      $individus = $this->load->model('individus_model');
      $data['individus'] = $this->individus_model->getUsers();

      $this->load->model('guildes_model');
      $data['guildes'] = $this->guildes_model->getGuildes();

      redirect('matches/myMatches/' . $this->session->userdata('indiv')->Id, 'refresh');
    }    
  }

  function _validate_lists($list){
    $listLength = count(explode(',', $list) );

    if($listLength != 6){
      $this->form_validation->set_message('_validate_lists', 'This list must be 6 players long.');
      return false;
    } else{
      return true;
    }
  }

  function _validate_date($date){
    if(strtotime($date) > time() ){
      $this->form_validation->set_message('_validate_date', "You can't select a date in the future");
      return false;
    } else{
      return true;
    }
  }

  public function myMatches($idIndividu){
    $return = array();

    $matches = $this->matches_model->getMatchesByIndividu($idIndividu);

    $this->load->model('guildes_model');
    $guildes = $this->guildes_model->getGuildes();

    $this->load->model('individus_model');
    $individus = $this->individus_model->getUsers();

    foreach ($matches as $m) {
      $indiv1 = $individus[array_search($m->IdIndiv1, array_column($individus, 'Id'))];
      $indiv2 = $individus[array_search($m->IdIndiv2, array_column($individus, 'Id'))];

      $guilde1 = $guildes[array_search($m->IdGuilde1, array_column($guildes, 'Id'))];
      $guilde2 = $guildes[array_search($m->IdGuilde2, array_column($guildes, 'Id'))];

      /*TO DO PLAYERS LIST*/

      $return[] = array(
        'Id' => $m->Id,
        'DateJoue' => $m->DateJoue,
        'IdIndiv1' => $indiv1,
        'IdIndiv2' => $indiv2,
        'IdGuilde1' => $guilde2,
        'IdGuilde2' => $guilde1,
        'Score1' => $m->Score1,
        'Score2' => $m->Score2,
      );
    }

    $data = array(
      'fmtMatches' => $return
    );


    

    $this->template->load('matches/myMatches', $data);
  }

  function listGenerator($strList){

  }

  public function ajax_getJoueurs(){
    $this->load->model('joueurs_model');

    $idGuilde = $this->input->post('idGuilde');

    $joueurs = $this->joueurs_model->getJoueursByGuilde($idGuilde);

    echo json_encode($joueurs);
  }



}

/* End of file Matches.php */
/* Location: ./application/controllers/Matches.php */
?>