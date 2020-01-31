<div class="container-fluid p-0">

  <section class="resume-section p-3 p-lg-5 d-flex align-items-center">
    
    <div class="login-form col-5 col-md-5">
      <?= form_open('home/login'); ?>
        <div class="form-group">
          <?php if(isset($error['no_indiv'])) : ?>
            <label for="Courriel" class="error">Cet utilisateur n'existe pas.</label>
          <?php endif; ?>
          <input type="email" class="form-control" name="Courriel" placeholder="Courriel">
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
          <a href="<?= site_url('home/register'); ?>">S'inscrire</a>
        </div>
        <div class="col-12 col-md-6">
          <a href="<?= site_url('home/resetpw'); ?>">Réinitialiser mon<br>mot de passe</a>
        </div>
      </div> 
    </div>
    
  </section>

</div>