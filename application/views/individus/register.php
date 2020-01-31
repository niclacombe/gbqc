<div class="container-fluid p-0">

  <section class="resume-section p-3 p-lg-5 d-flex align-items-center">
    
    <div class="login-form">
      <?= form_open('individus/register'); ?>
        <div class="form-row col-12 col-md-6">          
          <div class="col">
            <input type="text" class="form-control" name="Prenom" placeholder="Prénom">
          </div>
          <div class="col">
            <input type="text" class="form-control" name="Nom" placeholder="Nom">
          </div>
        </div>

        <button class="btn btn-primary">S'inscrire</button>
      <?= form_close(); ?>
    </div>
    
  </section>

</div>