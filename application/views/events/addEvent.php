<div class="container-fluid p-0 addMatch">

  <section class="resume-section p-3 p-lg-5 d-flex flex-column align-items-start">
    
    <h2>Ajouter un événement</h2>

    <div class="addEvent__form col-12 col-md-6">
      <?= form_open('events/addEvent'); ?>
        <div class="form-row">
          <div class="col">
            <label for="Nom">Nom <?= form_error('Nom', '<span class="form-error"> - ', '</span>'); ?></label>
            <input type="hidden" class="form-control" name="IdCreateur" value="<?= $this->session->userdata('indiv')->Id; ?>">
            <input type="text" class="form-control" name="Nom" value="">
          </div>

          <div class="col">            
            <label for="Type">Type d'événement <?= form_error('IdIndiv2', '<span class="form-error"> - ', '</span>'); ?></label>
            <select name="Type" class="form-control">
              <option value="">Choisir un type d'événement</option>
              <option value="LIGUE">Ligue</option>
              <option value="TOURNA">Tournoi</option>
            </select>
          </div>          
        </div>
        <div class="form-row pt-3">          
          <div class="col">
            <div>
              <label for="DateDebut">Date du début de l'événement <?= form_error('DateDebut', '<span class="form-error"> - ', '</span>'); ?></label>
              <input type="date" class="form-control" name="DateDebut" placeholder="">
            </div>
          </div>
          <div class="col">
            <div class="DateFin">
              <label for="DateFin"> Date de fin de l'événement <?= form_error('DateFin', '<span class="form-error"> - ', '</span>'); ?></label>
                <input type="date" class="form-control" name="DateFin" placeholder="">
              </div>            
          </div>
        </div>
        <div class="form-row">          
          <div class="col">
            <label for="IdIndividus[]">Joueurs participants <?= form_error('Score1', '<span class="form-error"> - ', '</span>'); ?></label>
            <select name="IdIndividus[]" id="IdIndividus" multiple="multiple" class="form-control select-chosen">
              <?php foreach($individus as $individu) : ?>
                <option value="<?= $individu->Id ?>"><?= $individu->Prenom .' ' .strtoupper($individu->Nom); ?></option>
              <?php endforeach; ?>              
            </select>
          </div>
          <div class="col">
            <label for="">Liste des participants</label>
            <ul id="indivList" class="list-unstyled"></ul>
          </div>
        </div>


        <button class="mt-3 btn btn-primary">Ajouter l'événement</button>
      <?= form_close(); ?>
    </div>
    
    
  </section>

</div>