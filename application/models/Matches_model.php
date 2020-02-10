<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matches_model extends CI_Model {

  public function addMatch(){
    $data = array(
      'IdIndiv1' => $this->input->post('IdIndiv1'),
      'IdIndiv2' => $this->input->post('IdIndiv2'),
      'IdGuilde1' => $this->input->post('IdGuilde1'),
      'IdGuilde2' => $this->input->post('IdGuilde2'),
      'Score1' => $this->input->post('Score1'),
      'Score2' => $this->input->post('Score2'),
      'ListIndiv1' => $this->input->post('ListIndiv1'),
      'ListIndiv2' => $this->input->post('ListIndiv2'),
      'DateCreation' => date('Y-m-d H:i:s', time()),
    );

    $this->db->insert('Matches', $data);
  }

  public function getMatchesByIndividu($idIndividu){
    $this->db->where('IdIndiv1', $idIndividu);
    $this->db->or_where('IdIndiv2', $idIndividu);
    $this->db->order_by('DateCreation', 'ASC');

    $query = $this->db->get('Matches');

    return $query->result();
  }
}

/* End of file Matches_model.php */
/* Location: ./application/models/Matches_model.php */ ?>