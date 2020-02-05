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
        return;
      }
      else{
        $this->load->model('individus_model');

        $this->load->library('encryption');

        $_POST['MotDePasse'] = $this->encryption->encrypt( $_POST['MotDePasse'] );

        $result = $this->individus_model->addIndividu();
        
        $message = "Bonjour " .$_POST['Prenom'] .",<br>";
        $message .= 'Merci de vous êtes inscris à SITE_NAME. Pour valider votre compte, veuillez cliquer sur <a href="' .site_url('Individus/validate/' . $_POST['Courriel']) .'">CE LIEN</a>.';

        $sendEmail = $this->sendEmail($_POST['Courriel'], $message);

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

      $this->individus_model->validate($email);

      $data = array(
        'msg' => array(
          'validate_success' => "Votre compte est maintenant validé. Bienvenue!"
        )
      );

      $this->template->load('home/home', $data);

    }

    private function sendEmail($email, $message){
      //var_dump($message); die;
      $this->load->library('email');

      $config = array(
        'mailtype' => 'html',
      );

      $this->email->initialize($config);

      $this->email->from('gbqc@niclacombe.ca', 'Nicolas Lacombe');
      $this->email->to($email);

      $this->email->subject('Inscription à Guildball Québec');
      $this->email->message($message);

      $this->email->send();


      return true;
    }
  }
?>