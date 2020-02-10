<div class="container-fluid p-0 addMatch">

  <section class="resume-section p-3 p-lg-5 d-flex flex-column align-items-start">
    
    <h2>Inscrire une partie</h2>

    <div class="login-form addMatch__form col-12 col-md-6">
      <?= form_open('matches/addMatch'); ?>
        <div class="form-row">
          <div class="col">
            <label for="Nom">Joueur 1 </label>
            <input type="hidden" class="form-control" name="IdIndiv1" value="<?= $this->session->userdata('indiv')->Id; ?>">
            <input type="text" disabled="disabled" class="form-control" name="" value="<?= $this->session->userdata('indiv')->Prenom .' ' . strtoupper($this->session->userdata('indiv')->Nom); ?>">
          </div>

          <div class="col">            
            <label for="IdIndiv2">Joueur 2 <?= form_error('IdIndiv2', '<span class="form-error"> - ', '</span>'); ?></label>
            <select name="IdIndiv2" class="select-chosen form-control">
              <?php foreach($individus as $individu) : ?>
                <?php if( $individu->Id != $this->session->userdata('indiv')->Id) : ?>
                  <option value="<?= $individu->Id ?>"><?= $individu->Prenom .' ' .strtoupper($individu->Nom); ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>          
        </div>
        <hr>
        <div class="form-row pt-3">          
          <div class="col">
            <div>
              <label for="IdGuilde1">Guilde du joueur 1 <?= form_error('IdGuilde1', '<span class="form-error"> - ', '</span>'); ?></label>
              <select name="IdGuilde1" class="form-control select_guilde"  data-target="ListIndiv1">
                <option value="">Choisir une guilde</option>
                <?php foreach($guildes as $guilde) : ?>
                  <option value="<?= $guilde->Id; ?>"><?= $guilde->Nom; ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div>
              <label for="ListIndiv1">Liste du joueur 1 <?= form_error('ListIndiv1', '<span class="form-error"> - ', '</span>'); ?></label>
              <select id="ListIndiv1" name="ListIndiv1" multiple class="form-control select_joueurs">
              </select>
            </div>
          </div>
          <div class="col">
            <div>
              <label for="IdGuilde2">Guilde du joueur 2 <?= form_error('IdGuilde2', '<span class="form-error"> - ', '</span>'); ?></label>
              <select name="IdGuilde2" class="form-control select_guilde" data-target="ListIndiv2">
                <option value="">Choisir une guilde</option>
                <?php foreach($guildes as $guilde) : ?>
                  <option value="<?= $guilde->Id; ?>"><?= $guilde->Nom; ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div>
              <label for="ListIndiv2">Liste du joueur 1 <?= form_error('ListIndiv2', '<span class="form-error"> - ', '</span>'); ?></label>
              <select id="ListIndiv2" name="ListIndiv2" multiple class="form-control select_joueurs">
              </select>
            </div>
            
          </div>
        </div>
        <hr>
        <div class="form-row">          
          <div class="col">
            <label for="Score1">Score du joueur 1 <?= form_error('Score1', '<span class="form-error"> - ', '</span>'); ?></label>
            <input type="number" class="form-control" name="Score1" min="0" max="12" step="1">
          </div>
          <div class="col">
            <label for="Score2">Score du joueur 2 <?= form_error('Score2', '<span class="form-error"> - ', '</span>'); ?></label>
            <input type="number" class="form-control" name="Score2" min="0" max="12" step="1">
          </div>
        </div>

        <button class="mt-3 btn btn-primary">S'inscrire</button>
      <?= form_close(); ?>
    </div>
    
    
  </section>

</div>

<script>
  $(function(){
    $('.select_guilde').on('change',function(){
      var target = $(this).attr('data-target'),
          idGuilde = $(this).find('option :selected').val();

      getJoueurs(idGuilde, target);
    });

    getJoueurs(idGuilde, target){
      $.ajax({
        'url' : '',
        'method' : POST,
        'data' : {

        },
        'success' : function(data){
          console.log(data);
        },
        'error' : function(err){
          console.log(err);
        }
      });
    }
  });
</script>