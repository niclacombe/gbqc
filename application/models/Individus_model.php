
<?php
class Individus_model extends CI_Model{

  public function getUserByEmail($email){

    $this->db->where('Courriel', $email);    

    $query = $this->db->get('Individus');

    return $query->row();
  }
}