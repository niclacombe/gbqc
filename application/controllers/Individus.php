<?php 
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  class Individus extends CI_Controller {


    public function __construct(){
      parent::__construct();
      if( is_null($this->session->userdata('indiv')) ){
        redirect('home','refresh');
      }
    }

    public function addIndividu(){
      $this->load->library('form_validation');

      $this->form_validation->set_rules('Prenom', 'Prénom', 'required|min_length[3]');
      $this->form_validation->set_rules('Nom', 'Nom', 'required|min_length[3]');
      $this->form_validation->set_rules('Courriel', 'Courriel', 'required|valid_email|is_unique[Individus.Courriel]');

      $this->form_validation->set_rules('MotDePasse', 'Username', 'required|min_length[8]');
      $this->form_validation->set_rules('MDPValid', 'Username', 'required|matches[MotDePasse]');

      if ($this->form_validation->run() == FALSE){
        $this->template->load('individus/register');
        return;
      }
      else{
        $this->load->model('individus_model');

        $this->load->library('encryption');

        $_POST['MotDePasse'] = $this->encryption->encrypt( $_POST['MotDePasse'] );

        $result = $this->individus_model->addIndividu();

        $sendEmail = $this->sendEmail($_POST['Courriel'], 'validate', false);

        $data = array(
          'msg' => array(
            'register_success' => "Merci! Un courriel a été envoyé à l'adresse <em>" .$_POST['Courriel'] ."</em>.<br>Veuillez consulter vos courriels pour activer votre compte."
          )
        );
      }

      $this->template->load('home/home', $data);
    }

    public function register(){
      $this->template->load('individus/register');
    }

    public function validate($email){
      $this->load->model('individus_model');

      $this->individus_model->validateUser($email);

      $data = array(
        'msg' => array(
          'validate_success' => "Votre compte est maintenant validé. Bienvenue!"
        )
      );

      $indiv = $this->individus_model->getUserByEmail($email);
      $data = array(
        'indiv'  => $indiv,
        'logged_in' => TRUE
      );

      $this->session->set_userdata($data);

      $this->template->load('home/home', $data);

    }

    public function sendEmail($email, $message, $home = true){
      $this->load->library('email');

      $vMessages = array(
        'validate' => 'Bonjour,<br>Merci de vous êtes inscris à Guildball Québec. Pour valider votre compte, veuillez cliquer sur <a href="' .site_url('Individus/validate/' . $email) .'">CE LIEN</a>.',
      );

      $config = array(
        'mailtype' => 'html',
      );

      $this->email->initialize($config);

      $this->email->from('gbqc@niclacombe.ca', 'Nicolas Lacombe');
      $this->email->to($email);

      $this->email->subject('Inscription à Guildball Québec');
      $this->email->message($vMessages[$message]);

      $this->email->send();


      if(!$home){
        return true;
      } else {
        $data = array(
          'msg' => array(
            'validate_email' => 'Courriel de validation renvoyé'
          )
        );
        $this->template->load('home/home', $data);
      }
    }
  }
?>