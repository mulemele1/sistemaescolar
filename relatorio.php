
         <!--  -->
<?php 
  include 'principal.php';
?>

        <!-- Begin Page Content -->
        <div class="container-fluid" style="">
          <?php
            
            if(isset($_SESSION['mensagem'])){
                echo $_SESSION['mensagem'];
                unset($_SESSION['mensagem']);
            }
          ?>
      <?php 
        if($_SESSION['usuarioNivelAcesso'] > 4){
      ?>
          <p class="alert alert-success text-center">
            Seja vem vindo
          </p>
      <?php 
        }else{        
       ?>
         
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-12"><p class="alert alert-info text-center">Seja bem Vindo <b><?=$_SESSION['usuarioNome']  ?></b></p></div>
      <?php if ($_SESSION['usuarioNivelAcesso']==1): ?>
                            <h1>Relatorios</h1>
                            <br><br><br><br><br><br><br><br><br><br><br>
        <?php endif ?>  
    </div>
    <div class="row">
            <?php if ($_SESSION['usuarioNivelAcesso']==1): ?>
           
            <?php endif ?>
            <!--Pending Requests Card Example 
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pedidos pendentes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>-->

    <!-- Content Row -->
          <?php  
            }        
           ?>
      </div>
      <!-- End of Main Content -->

  <!-- Footer -->
<?php 
  include 'rodape.php';
?>