
<?php
class Individus_model extends CI_Model{

  public function getUserByEmail($email){

    $this->db->where('Courriel', $email);    

    $query = $this->db->get('Individus');

    return $query->row();
  }

  public function addIndividu(){
    $data = array(
      'Prenom' => $this->input->post('Prenom'),
      'Nom' => $this->input->post('Nom'),
      'Courriel' => $this->input->post('Courriel'),
      'MotDePasse' => $this->input->post('MotDePasse'),
      'Etat' => 'ATTENT',
      'DateInscription' => date('Y-m-d H:i:s', time()),
    );

    $this->db->insert('Individus', $data);
  }

  public function validateUser($email){

    $data = array(
      'Etat' => 'ACTIF',
    );

    $this->db->where('Courriel', $email);
    $this->db->update('Individus', $data);
  }

  public function getUsers(){

    $this->db->where('Etat', 'ACTIF');
    $this->db->order_by('Nom', 'ASC');

    $query = $this->db->get('Individus');

    return $query->result();

  }
}