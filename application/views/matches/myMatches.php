<div class="container-fluid p-0">

  <section class="resume-section p-3 p-lg-5 ">
    <h2>Mes parties</h2>
    <div class="col-8 myMatches slick-results">
      <?php foreach($fmtMatches as $m): ?>        
        <div class="col-4 mr-2 p-0 myMatches__item d-flex">
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
              <?php if(!is_null($m['ListIndiv1'])): ?><a href="#" class="displayList" data-List="<?= $m['ListIndiv1']; ?>"><?php endif; ?>
                <img class="guildIcon" src="<?= site_url() . 'assets/img/guildes/' . strtolower($m['IdGuilde1']->Nom) .'.svg'; ?>" alt="<?= $m['IdGuilde1']->Nom; ?>">
              <?php if(!is_null($m['ListIndiv1'])): ?></a><?php endif; ?>
              <h4 class="indivName">
                <?= $m['IdIndiv1']->Prenom[0] .'. ' .$m['IdIndiv1']->Nom; ?>
              </h4>
              <h4 class="score"><?= $m['Score1']; ?></h4>
            </div>

            <hr width="75%">
            
            <div class="myMatches__item__result__line d-flex justify-content-between">
              <?php if(!is_null($m['ListIndiv2'])): ?><a href="#" class="displayList"  data-List="<?= $m['ListIndiv2']; ?>"><?php endif; ?>
              <img class="guildIcon" src="<?= site_url() . 'assets/img/guildes/' . strtolower($m['IdGuilde2']->Nom) .'.svg'; ?>" alt="<?= $m['IdGuilde2']->Nom; ?>">
              <?php if(!is_null($m['ListIndiv2'])): ?></a><?php endif; ?>
              <h4 class="indivName"><?= $m['IdIndiv2']->Prenom[0] .'. ' .$m['IdIndiv2']->Nom; ?></h4>
              <h4 class="score"><?= $m['Score2']; ?></h4>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    
  </section>

</div>