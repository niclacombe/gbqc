<?php 
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  class Home extends CI_Controller {


    public function index($data = array()){
      $this->template->load('home/home', $data);
    }

    public function login(){
      $this->load->model('individus_model');
      $data = array();

      $email = $this->input->post('Courriel');

      $indiv = $this->individus_model->getUserByEmail($email);

      if($indiv){

        $this->load->library('encryption');
        $this->encryption->initialize(
          array('cipher' => 'aes-256')
        );

        $encryptedPW = $this->post->input('MotDePasse');

        if($indiv->MotDePasse === $encryptedPW){
          $data = array(
            'indiv'  => $indiv,
            'logged_in' => TRUE
          );

          $this->session->set_userdata($data);

          $this->template->load('home/home');
        } else{
          //WRONG PW
          $data = array(
            'error' => array(
              'wrong_pw' => true,
            ),
          );
        }
      } else{
        //INDIVIDU N'EXISTE PAS
        
        $data = array(
          'error' => array(
            'no_indiv' => true,
          ),
        );
        
      }

      $this->template->load('home/home', $data);

    }

    public function register(){
      $this->template->load('individus/register');
    }

    public function resetpw(){
      echo '<h1>resetpw</h1>';
    }

    public function logout(){

      sess_destroy();
      redirect('home','refresh');
    }

  }
  
?>