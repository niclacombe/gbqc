<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
  <a class="navbar-brand js-scroll-trigger" href="<?= site_url(); ?>">
    <span class="d-none d-lg-block">
      <img class="img-fluid img-profile mx-auto mb-2" src="<?= site_url() . 'assets/img/gbqc.svg'; ?>" alt="">
    </span>
  </a>  

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
      <ul class="navbar-nav">
        <?php if($this->session->userdata('logged_in') == true && $this->session->userdata('indiv')->Etat == 'ACTIF'): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" href="#">
              Parties <span class="fas fa-dice"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="<?= site_url('matches/view_addMatch'); ?>">Inscrire une partie</a>
              <a class="dropdown-item" href="#">Mes parties</a>
              <a class="dropdown-item" href="#">Rechercher une partie</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" href="#">
              Événements <span class="fas fa-calendar-alt"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Mes événements</a>
              <a class="dropdown-item" href="#">Rechercher un événement</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" href="#">
              Joueurs <span class="fas fa-users"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Classement</a>
              <a class="dropdown-item" href="#">Rechercher un joueur</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Paramètres <span class="fas fa-cogs"></span></a>
          </li>
        <?php endif; ?>
        <?php if($this->session->userdata('logged_in') == true) : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('home/logout'); ?>">Déconnexion <span class="fas fa-sign-out-alt"></span></a>
          </li>
        <?php endif; ?>
      </ul>
      
    </div>
  
</nav>