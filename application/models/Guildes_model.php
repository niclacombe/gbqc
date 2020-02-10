<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guildes_model extends CI_Model {

  public function getGuildes(){

    $query = $this->db->get('Guildes');

    return $query->result();

  }

  public function getGuilde($idGuilde){

    $this->db->where('Id', $idGuilde);
    $query = $this->db->get('Guildes');

    return $query->row();
  }

}

/* End of file Guild_model.php */
/* Location: ./application/models/Guild_model.php */ ?>