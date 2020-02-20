<div class="container-fluid p-0 my-events">

  <section class="resume-section p-3 p-lg-5 d-flex flex-column align-items-start">
    
    <h2>Mes événements</h2>

    <div class="col-12 d-flex">

      <div class="my-events__list p-0 col-xs-12 col-md-6">
        <table class="table table-striped table-responsive">
          <tr>
            <th>Nom</th>
            <th>Type</th>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>Action</th>
          </tr>
          <?php foreach ($mgEvents as $e) : ?>
            <tr>
              <td><?= $e->Nom; ?></td>
              <td><?= $e->Type; ?></td>
              <td><?= $e->DateDebut; ?></td>
              <td><?= $e->DateFin; ?></td>
              <td>
                <button class="btn btn-primary editForms" data-target="<?= $e->Id; ?>"><span class="fas fa-edit"></span></button>
                <button class="btn btn-primary viewEvent" data-idEvent="<?= $e->Id;?>"><span class="fas fa-eye"></span></button>
              </td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <?php foreach ($partEvents as $e) : ?>
            <tr>
              <td><?= $e->Nom; ?></td>
              <td><?= $e->Type; ?></td>
              <td><?= $e->DateDebut; ?></td>
              <td><?= $e->DateFin; ?></td>
              <td><button class="btn btn-primary viewEvent" data-idEvent="<?= $e->Id;?>"><span class="fas fa-eye"></span></button></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>

      <div class="my-events__view pl-4 pr-0 col-xs-12 col-md-6">
        <div class="my-events__view__forms col-12">
          <?php foreach ($mgEvents as $e) : ?>
            <?php echo form_open('events/editEvent/' .$e->Id, array('id' => $e->Id, 'class' => 'manageForm' )); ?>
              <div class="form-row">
                <div class="col">
                  <label for="Nom">Nom <?= form_error('Nom', '<span class="form-error"> - ', '</span>'); ?></label>
                  <input type="text" class="form-control" name="Nom" value="<?= $e->Nom; ?>">
                </div>

                <div class="col">            
                  <label for="Type">Type d'événement <?= form_error('IdIndiv2', '<span class="form-error"> - ', '</span>'); ?></label>
                  <select name="Type" class="form-control">
                    <option value="">Choisir un type d'événement</option>
                    <option <?php if($e->Type == 'LIGUE'): echo 'selected="selected"'; endif; ?> value="LIGUE">Ligue</option>
                    <option <?php if($e->Type == 'TOURNA'): echo 'selected="selected"'; endif; ?> value="TOURNA">Tournoi</option>
                  </select>
                </div>          
              </div>
              <div class="form-row pt-3">          
                <div class="col">
                  <div>
                    <label for="DateDebut">Date du début de l'événement <?= form_error('DateDebut', '<span class="form-error"> - ', '</span>'); ?></label>
                    <input type="date" class="form-control" name="DateDebut" placeholder="" value="<?= $e->DateDebut; ?>">
                  </div>
                </div>
                <div class="col">
                  <div class="DateFin">
                    <label for="DateFin"> Date de fin de l'événement <?= form_error('DateFin', '<span class="form-error"> - ', '</span>'); ?></label>
                      <input type="date" class="form-control" name="DateFin" placeholder="" value="<?= $e->DateFin; ?>">
                    </div>            
                </div>
              </div>
              <div class="form-row">          
                <div class="col">
                  <label for="IdIndividus[]">Joueurs participants <?= form_error('Score1', '<span class="form-error"> - ', '</span>'); ?></label>
                  <select name="IdIndividus[]" data-listId="list-<?= $e->Id; ?>" multiple="multiple" class="event-list form-control select-chosen">
                    <?php $vParticipants = explode(',', $e->IdIndividus); ?>
                    <?php foreach($individus as $individu) : ?>
                      <option <?php if(array_search($individu->Id, $vParticipants) !== FALSE): echo 'selected="selected"'; endif; ?> value="<?= $individu->Id ?>"><?= $individu->Prenom .' ' .strtoupper($individu->Nom); ?></option>
                    <?php endforeach; ?>              
                  </select>
                </div>
                <div class="col">
                  <label for="">Liste des participants</label>
                  <ul id="list-<?= $e->Id; ?>" class="list-unstyled">
                    <?php foreach($individus as $individu) : ?>
                      <?php if(array_search($individu->Id, $vParticipants) !== FALSE): ?>
                        <li><?= $individu->Prenom .' ' .strtoupper($individu->Nom); ?></li>
                      <?php endif; ?>
                    <?php endforeach; ?>    
                  </ul>
                </div>
              </div>


              <button class="mt-3 btn btn-primary">Sauvegarder <span class="fas fa-save"></span></button>
            <?php echo form_close(); ?>
          <?php endforeach; ?>
          
        </div>

        <div id="viewEvent" class="my-events__view__details col-12">
          <h3>NOM DE L'ÉVÉNEMENT</h3>
          <h4>Classement</h4>

          <table class="table table-responsive table-striped">
            <tr>
              <th>Nom</th>
              <th>V</th>
              <th>D</th>
              <th>PJ</th>
            </tr>
            <tr>
              <td>adsf</td>
              <td>fasd</td>
              <td>asdf</td>
              <td>adsf</td>
            </tr>
            <tr>
              <td>adsf</td>
              <td>fasd</td>
              <td>asdf</td>
              <td>adsf</td>
            </tr>
            <tr>
              <td>adsf</td>
              <td>fasd</td>
              <td>asdf</td>
              <td>adsf</td>
            </tr>
            
          </table>
        </div>
      </div>


    </div>
    
  </section>

</div>