
         <!--  -->
<?php 
  include 'principal.php';
?>
        
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Funcionários</h1>
    <a href="funcionario-cadastro.php" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-100"></i> </a>
  </div>

  <!-- Content Row -->
  <div class="row">
    <?=$funcionario->listar_funcionarios(); ?>
  </div>
  <!-- Content Row -->

</div>
<!-- /.container-fluid -->

  <!-- Footer -->
<?php 
  include 'rodape.php';
?>