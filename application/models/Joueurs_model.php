<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
 
  class Joueurs_model extends CI_Model {
 
    public function getJoueursByGuilde($idGuilde){

      $this->db->where('IdGuilde', $idGuilde);
      $query = $this->db->get('Joueurs');

      $return = $query->result();

      /*GET COMPLIMENTARY PLAYERS*/

      $this->db->where('IdGuilde2', $idGuilde);
      $query2 = $this->db->get('Joueurs');

      $return .= $query2->result();

      return $return;

    }

   
 
 }
 
 /* End of file Joueurs_model.php */
 /* Location: ./application/models/Joueurs_model.php */ ?>