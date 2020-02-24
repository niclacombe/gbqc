<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages_model extends CI_Model {

  public function getMessages(){

    $this->db->where('DateLimite >=', date('Y-m-d', time() ) );
    $this->db->where('IdEvent', 'NULL');
    
    $query = $this->db->get('Messages');

    return $query->result();
  }

  public function getMessagesByEvent($idEvent){

    $this->db->select('msg.*');
    $this->db->from('Messages msg');
    $this->db->join('Events eve', 'eve.Id = msd.IdEvent', 'left');
    $this->db->where('msg.DateLimite >=', date('Y-m-d', time() ) );
    $this->db->where('eve.DateFin >=', date('Y-m-d', time() ) );


    return $query->result();
  }

}

/* End of file Messages_model.php */
/* Location: ./application/models/Messages_model.php */ ?>