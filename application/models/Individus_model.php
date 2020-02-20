
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

  public function getUser($idIndiv){
    $this->db->where('Id', $idIndiv);
    $this->db->order_by('Nom', 'ASC');

    $query = $this->db->get('Individus');

    return $query->row();
  }

  public function getMatchesFromIndiv($idIndiv, $idEvent = null){

    $where = "(IdIndiv1 = $idIndiv OR IdIndiv2 = $idIndiv)";

    if(!is_null($idEvent)){
      $where .= " AND IdEvent = $idEvent";
    }

    $this->db->where($where);

    $query = $this->db->get('Matches');

    return $query->result();
  }

  
}