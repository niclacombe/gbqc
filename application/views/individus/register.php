<div class="container-fluid p-0">

  <section class="resume-section p-3 p-lg-5 d-flex flex-column">

    <h2>S'inscrire</h2>
    
    <div class="login-form  col-12 col-md-6">
      <?= form_open('individus/addIndividu'); ?>
        <div class="form-row">          
          <div class="col">
            
            <label for="Prenom">Prénom <?= form_error('Prenom', '<span class="form-error"> - ', '</span>'); ?></label>
            <input type="text" class="form-control" name="Prenom" value="<?= set_value('Prenom'); ?>" placeholder="3 caractères min.">
          </div>
          <div class="col">
            <label for="Nom">Nom <?= form_error('Nom', '<span class="form-error"> - ', '</span>'); ?></label>
            <input type="text" class="form-control" name="Nom" value="<?= set_value('Nom'); ?>" placeholder="3 caractères min.">
          </div>
        </div>
        <div class="form-row pt-3">          
          <div class="col">
            <label for="Courriel">Courriel <?= form_error('Courriel', '<span class="form-error"> - ', '</span>'); ?></label>
            <input type="email" class="form-control" name="Courriel"  value="<?= set_value('Courriel'); ?>"placeholder="adresse@courriel.com">
          </div>
        </div>
        <hr>
        <div class="form-row">          
          <div class="col">
            <label for="MotDePasse">Mot de passe <?= form_error('MotDePasse', '<span class="form-error"> - ', '</span>'); ?></label>
            <input type="password" class="form-control" name="MotDePasse" placeholder="8 caractères min.">
          </div>
        </div>
        <div class="form-row pt-3">          
          <div class="col">
            <label for="MDPValid">Confirmation du mot de passe <?= form_error('MDPValid', '<span class="form-error"> - ', '</span>'); ?></label>
            <input type="password" class="form-control" name="MDPValid" placeholder="Confirmation du mot de passe">
          </div>
        </div>

        <button class="mt-3 btn btn-primary">S'inscrire</button>
      <?= form_close(); ?>
    </div>
    
  </section>

</div>