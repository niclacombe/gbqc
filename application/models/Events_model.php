<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events_model extends CI_Model {

  public function addEvent(){
    $data = array(
      'IdCreateur' => $this->input->post('IdCreateur'),
      'Nom' => $this->input->post('Nom'),
      'Type' => $this->input->post('Type'),
      'DateDebut' => $this->input->post('DateDebut'),
      'DateFin' => $this->input->post('DateFin'),
      'DateCreation' => date('Y-m-d', time()),
      'IdIndividus' => $this->input->post('IdIndividus')
    );

    $this->db->insert('Events', $data);
  }

  public function getEvent($idEvent){

    $this->db->where('Id', $idEvent);
    $query = $this->db->get('Events');

    return $query->row();
  }

  public function getOngoingEvents(){

    $this->db->where('DateDebut <=', date('Y-m-d', time() ) );
    $this->db->where('DateFin >=', date('Y-m-d', time() ) );
    $this->db->order_by('DateDebut', 'ASC');
    $this->db->order_by('Nom', 'ASC');

    $query = $this->db->get('Events');

    return $query->result();
  }

  public function getMyEvents($idIndiv){

    $this->db->where('IdCreateur', $idIndiv );

    $query = $this->db->get('Events');

    return $query->result();

  }

  public function getPastEvents(){

    $this->db->where('DateFin <=', date('Y-m-d', time() ) );
    $this->db->order_by('DateFin', 'DESC');
    $this->db->order_by('Nom', 'ASC');

    $query = $this->db->get('Events');

    return $query->result();
  }

  public function getParticipatingEvents($idIndiv){

    $this->db->like('IdIndividus', ','.$idIndiv . ',', 'BOTH');
    $this->db->or_like('IdIndividus', ','.$idIndiv, 'BOTH');
    $this->db->or_like('IdIndividus', $idIndiv . ',', 'BOTH');
    $this->db->where('IdCreateur !=', $idIndiv);
    $this->db->order_by('DateFin', 'DESC');
    $this->db->order_by('Nom', 'ASC');

    $query = $this->db->get('Events');

    return $query->result();
  }

  public function editEvent($idEvent){
    $data = array(
      'Nom' => $this->input->post('Nom'),
      'Type' => $this->input->post('Type'),
      'DateDebut' => $this->input->post('DateDebut'),
      'DateFin' => $this->input->post('DateFin'),
      'IdIndividus' => $this->input->post('IdIndividus')
    );

    $this->db->where('Id', $idEvent);

    $this->db->update('Events', $data);
  }
  

}

/* End of file Events_model.php */
/* Location: ./application/models/Events_model.php */ ?>