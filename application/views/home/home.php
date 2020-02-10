<div class="container-fluid p-0">

  <section class="resume-section p-3 p-lg-5 d-flex align-items-center">
    
    <?php if(!$this->session->userdata('logged_in')) : ?>
      <div class="login-form col-5 col-md-5">

        <?php if( isset($msg['register_success']) ) :?>
          <h3>
            <?= $msg['register_success']; ?>
          </h3>
        <?php elseif( isset($msg['validate_success'])) :?>
          <h3>
            <?= $msg['validate_success']; ?>
          </h3>
        <?php endif; ?>
        <?php if( isset($error['register_failed']) ) :?>
          <h3>
            <?= $error['register_failed']; ?>
          </h3>
        <?php endif; ?>

        <?= form_open('home/login'); ?>
          <div class="form-group">
            <?php if(isset($error['no_indiv'])) : ?>
              <label for="Courriel" class="error">Cet utilisateur n'existe pas.</label>
            <?php endif; ?>
            <input type="email" class="form-control" name="Courriel" value="<?= set_value('Courriel'); ?>" placeholder="Courriel">
          </div>
          <div class="form-group">
            <?php if(isset($error['wrong_pw'])) : ?>
              <label for="MotDePasse" class="error">Mot de passe incorrect.</label>
            <?php endif; ?>
            <input type="password" class="form-control" name="MotDePasse" placeholder="Mot de passe">
          </div>

          <button class="btn btn-primary">Connexion</button>
        <?= form_close(); ?> 
        <div class="row text-center pt-4">
          <div class="col-12 col-md-6">
            <a href="<?= site_url('individus/register'); ?>">S'inscrire</a>
          </div>
          <div class="col-12 col-md-6">
            <a href="<?= site_url('home/resetpw'); ?>">Réinitialiser mon<br>mot de passe</a>
          </div>
        </div> 
      </div>
    <?php else: ?>
      <div class="col-10 col-md-10">
        <h4>Bienvenue <?= $this->session->userdata('indiv')->Prenom .' ' .$this->session->userdata('indiv')->Nom; ?></h4>
        <?php 
        if( $this->session->userdata('indiv')->Etat != 'ACTIF' ):
          if(isset($msg['validate_email'])){
            echo '<p>' . $msg['validate_email'] . '</p>';
          }
        ?>
          <p>Votre compte n'a pas été activé. Veuillez consulter vos courriels pour l'activer. <a href="<?= site_url('individus/sendEmail/' . $this->session->userdata('indiv')->Courriel) . '/validate' ; ?>">Renvoyer le courriel</a></p>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    
  </section>

</div> 