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

      $complimentaryPlayers = $query2->result();

      if( !empty($complimentaryPlayers) ){
        foreach ($complimentaryPlayers as $cp) {
          array_push($return, $cp);
        }
      }

      return $return;

    }

    public function getJoueurById($idJoueur){
      $this->db->where('Id', $idJoueur);

      $query = $this->db->get('Joueurs');

      return $query->row();
    }

   
 
 }
 
 /* End of file Joueurs_model.php */
 /* Location: ./application/models/Joueurs_model.php */ ?>