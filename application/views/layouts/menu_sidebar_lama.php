<ul class="sidebar navbar-nav">
  <li class="nav-item">
    <a class="nav-link" href="<?php echo base_url('dashboard'); ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-folder"></i>
      <span>Master</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <a class="dropdown-item" href="<?php echo base_url(); ?>pejabat">Pejabat</a>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo base_url(); ?>agenda">
      <i class="fas fa-fw fa-calendar"></i>
      <span>Agenda</span></a>
  </li>
</ul>