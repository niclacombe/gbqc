<div class="container-fluid p-0 addMatch">

  <section class="resume-section p-3 p-lg-5 d-flex flex-column align-items-start">
    <?php var_dump($this->session->userdata()); ?>
    <h2>Mes partie</h2>
    <div class="col-12 myMatches flickity-results">
      <?php foreach($fmtMatches as $m): ?>
        <div class="col-4 mr-2 p-0 myMatches__item d-flex item">
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
              <img class="guildIcon" src="<?= site_url() . 'assets/img/guildes/' . strtolower($m['IdGuilde1']->Nom) .'.svg'; ?>" alt="<?= $m['IdGuilde1']->Nom; ?>">
              <h4 class="indivName"><?= $m['IdIndiv1']->Prenom[0] .'. ' .$m['IdIndiv1']->Nom; ?></h4>
              <h4 class="score"><?= $m['Score1']; ?></h4>
            </div>
            <div class="myMatches__item__result__line d-flex justify-content-between">
              <img class="guildIcon" src="<?= site_url() . 'assets/img/guildes/' . strtolower($m['IdGuilde2']->Nom) .'.svg'; ?>" alt="<?= $m['IdGuilde2']->Nom; ?>">
              <h4 class="indivName"><?= $m['IdIndiv2']->Prenom[0] .'. ' .$m['IdIndiv2']->Nom; ?></h4>
              <h4 class="score"><?= $m['Score2']; ?></h4>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    
  </section>

</div>