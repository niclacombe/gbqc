<?php 
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  class Individus extends CI_Controller {

    public function addIndividu(){
      $this->load->library('form_validation');

      $this->form_validation->set_rules('Prenom', 'Prénom', 'required|min_length[3]');
      $this->form_validation->set_rules('Nom', 'Nom', 'required|min_length[3]');
      $this->form_validation->set_rules('Courriel', 'Courriel', 'required|valid_email|is_unique[Individus.Courriel]');

      $this->form_validation->set_rules('MotDePasse', 'Username', 'required|min_length[8]');
      $this->form_validation->set_rules('MDPValid', 'Username', 'required|matches[MotDePasse]');

      if ($this->form_validation->run() == FALSE){
        $this->template->load('individus/register');
      }
      else{
        $this->load->model('individus_model');

        $this->load->library('encryption');

        $_POST['MotDePasse'] = $this->encryption->encrypt( $_POST['MotDePasse'] );

        $result = $this->individus_model->addIndividu();
        
        if($result){
          $data = array(
            'msg' => array(
              'register_success' => "Merci! Un courriel a été envoyé à l'adresse <em>" .$_POST['MotDePasse'] ."</em>.<br>Veuillez consulter vos courriels pour activer votre compte.";
            )
          );
        else{
          $data = array(
            'error' => array(
              'register_failed' => "Une erreur est survenu à la création de votre compte. Veuillez contactez l'administrateur.";
            )
          );
        }
      }

      $this->template->load('home/home', $data);
    }

    public function register(){
      $this->template->load('individus/register');
    }
  }
?>