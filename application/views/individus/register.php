<div class="container-fluid p-0">

  <section class="resume-section p-3 p-lg-5 d-flex align-items-center">

    <?= validation_errors('<div class="error col-12 col-md-6">', '</div>'); ?>
    
    <div class="login-form  col-12 col-md-6">
      <?= form_open('individus/addIndividu'); ?>
        <div class="form-row">          
          <div class="col">
            <label for="Prenom">Prénom</label>
            <input type="text" class="form-control" name="Prenom" value="<?= set_value('Prenom'); ?>" placeholder="3 caractères min.">
          </div>
          <div class="col">
            <label for="Nom">Nom</label>
            <input type="text" class="form-control" name="Nom" value="<?= set_value('Nom'); ?>" placeholder="3 caractères min.">
          </div>
        </div>
        <div class="form-row pt-3">          
          <div class="col">
            <label for="Courriel">Courriel</label>
            <input type="email" class="form-control" name="Courriel"  value="<?= set_value('Courriel'); ?>"placeholder="adresse@courriel.com">
          </div>
        </div>
        <hr>
        <div class="form-row">          
          <div class="col">
            <label for="MotDePasse">Mot de passe</label>
            <input type="password" class="form-control" name="MotDePasse" placeholder="8 caractères min.">
          </div>
        </div>
        <div class="form-row pt-3">          
          <div class="col">
            <label for="MDPValid">Confirmation du mot de passe</label>
            <input type="password" class="form-control" name="MDPValid" placeholder="Confirmation du mot de passe">
          </div>
        </div>

        <button class="mt-3 btn btn-primary">S'inscrire</button>
      <?= form_close(); ?>
    </div>
    
  </section>

</div>