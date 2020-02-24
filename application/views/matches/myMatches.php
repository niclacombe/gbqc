<div class="container-fluid p-0">

  <section class="resume-section p-3 p-lg-5 ">
    <h2>Mes parties</h2>
    <div class="col-12 myMatches slick-results">
      <?php foreach($fmtMatches as $m): ?>        
        <div class="mr-2 p-0 myMatches__item d-flex">
          <div class="myMatches__item__date">
            <h4>
                <?php setlocale(LC_TIME, "fr_CA"); ?>
                <?= strftime('%e %h', strtotime($m['DateJoue'])); ?>
                <br>
                <?= strftime('%Y', strtotime($m['DateJoue'])); ?>
              </h4>
          </div>
          <div class="myMatches__item__result d-flex flex-column align-items-center">

            <div class="myMatches__item__result__line d-flex justify-content-between">
              <?php if(!is_null($m['ListIndiv1'])): ?><a href="#" class="displayList " data-toggle="modal" data-target="#<?= $m['Id'] . '-1';?>"><?php endif; ?>
                <img class="guildIcon" src="<?= site_url() . 'assets/img/guildes/' . strtolower($m['IdGuilde1']->Nom) .'.svg'; ?>" alt="<?= $m['IdGuilde1']->Nom; ?>">
              <?php if(!is_null($m['ListIndiv1'])): ?></a><?php endif; ?>
              <h4 class="indivName">
                <?= $m['IdIndiv1']->Prenom[0] .'.&nbsp;' .$m['IdIndiv1']->Nom; ?>
              </h4>
              <h4 class="score"><?= $m['Score1']; ?></h4>
            </div>

            <hr width="75%">
            
            <div class="myMatches__item__result__line d-flex justify-content-between">
              <?php if(!is_null($m['ListIndiv2'])): ?><a href="#" class="animated infinite jello delay-4s displayList" data-toggle="modal" data-target="#<?= $m['Id'] . '-2';?>"><?php endif; ?>
              <img class="guildIcon" src="<?= site_url() . 'assets/img/guildes/' . strtolower($m['IdGuilde2']->Nom) .'.svg'; ?>" alt="<?= $m['IdGuilde2']->Nom; ?>">
              <?php if(!is_null($m['ListIndiv2'])): ?></a><?php endif; ?>
              <h4 class="indivName"><?= $m['IdIndiv2']->Prenom[0] .'.&nbsp;' .$m['IdIndiv2']->Nom; ?></h4>
              <h4 class="score"><?= $m['Score2']; ?></h4>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div> 

    <?php foreach($fmtMatches as $m): ?>
      <?php if (!is_null($m['ListIndiv1'])) : ?>
        <!-- Modal -->
        <div class="modal fade" id="<?= $m['Id'] . '-1';?>" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Liste de <?= $m['IdIndiv1']->Prenom[0] .'. ' .$m['IdIndiv1']->Nom; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <ul class="list-unstyled">
                  <?php foreach ($m['ListIndiv1'] as $j) : ?>
                    <li><?= $j->Nom; ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <?php if (!is_null($m['ListIndiv2'])) : ?>
        <!-- Modal -->
        <div class="modal fade" id="<?= $m['Id'] . '-2';?>" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Liste de <?= $m['IdIndiv2']->Prenom[0] .'. ' .$m['IdIndiv2']->Nom; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <ul class="list-unstyled">
                  <?php foreach ($m['ListIndiv2'] as $j) : ?>
                    <li><?= $j->Nom; ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </section>
</div>