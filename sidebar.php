<!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #06003a;"  id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="painel_inicial.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <!-- <i class="fas fa-laugh-wink"></i> -->
          <i style="font-size:36pt">C</i>
        </div>
        <div class="sidebar-brand-text mx-3">Nhonchane<sup ><i class="rotate-n-15">tn</i></sup></div>
      </a>
      
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="painel_inicial.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Painel principal</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Divider -->
      <!-- Nav Item - Turmas -->

  <?php if($_SESSION['usuarioNivelAcesso'] < 3){ ?>
    <!-- Nav Item - Turmas Centro infantil e externato Nhonchane-->
    <li class="nav-item">
        <a class="nav-link" href="administracao.php">
          <i class="fas fa-fw fa-book"></i>
          <span>Administração</span></a>
      </li>
        
    <li class="nav-item">
        <a class="nav-link" href="classes.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Classes</span></a>
      </li>
      

  <?php } ?>

  <?php if($_SESSION['usuarioNivelAcesso'] <= 3){ ?>

      <!-- Nav Item - Alunos -->
      <li class="nav-item">
        <a class="nav-link" href="alunos.php">
          <i class="fas fa-fw fa-graduation-cap"></i>
          <span>Alunos</span></a>
      </li>
      <!-- Nav Item - Professores -->
      <li class="nav-item" hidden="">
        <a class="nav-link" href="professores.php">
          <i class="fas fa-fw fa-user-tie"></i>
          <span>Professores</span></a>
      </li>

  <?php } ?>

  <?php if($_SESSION['usuarioNivelAcesso'] < 3){ ?>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="mensalidades.php">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Mensalidades</span></a>
      </li>

      <!-- Divider -->
      <li class="nav-item">
        <a class="nav-link" href="despesa.php">
          <i class="fas fa-fw fa-book"></i>
          <span>Despesa</span></a>
      </li>
  
      <!-- Divider -->
      <li class="nav-item">
        <a class="nav-link" href="relatorio.php">
          <i class="fas fa-fw fa-book"></i>
          <span>Relatorio</span></a>
      </li>
      <!-- Nav Item - usuarios -->
      <li class="nav-item">
        <a class="nav-link" href="usuarios.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Usuários</span></a>
      </li>
  <?php } ?>

  <?php if($_SESSION['usuarioNivelAcesso'] < 3){ ?>

      <!-- Nav Item - Funcionários -->
      <li class="nav-item" hidden="">
        <a class="nav-link" href="funcionarios.php">
          <i class="fas fa-fw fa-user-tie"></i>
          <span>Funcionários</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
  <?php } ?>
  
  <?php
    if ($_SESSION['usuarioNivelAcesso'] == 5) {
       echo @$administracao->menu_disciplinas($_SESSION['f_key']);
    }      
    if ($_SESSION['usuarioNivelAcesso'] == 6) {
      
       echo @$administracao-> menu_disciplinas_aluno($_SESSION['f_key']);
    } 
    
  
    
  ?>
      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
     <!-- End of Sidebar -->