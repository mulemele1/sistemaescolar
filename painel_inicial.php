
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
        <div class="col-xl-4 col-xs-6 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <a href="classes.php" title="">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Classes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$administracao->total_classes(); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
              </a>
            </div>
        </div>
        
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-xs-6 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <a href="alunos.php" title="">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Alunos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$aluno->total_alunos(); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-3x text-gray-300"></i>
                        </div>
                    </div>
                  </a>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-xs-6 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <a href="usuarios.php" title="">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Usuários</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$usuario->total_usuarios(); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-3x text-gray-300"></i>
                        </div>
                    </div>
                  </a>
                </div>
            </div>
        </div>
          
        <?php endif ?>  
    </div>
    <div class="row">
            <?php if ($_SESSION['usuarioNivelAcesso']==1): ?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ganhos (Mensal)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="" readonly="" style="border: 0;" size="5" id="ganhos_mensal" value="" name=""><?=number_format($administracao->coleta_mes('Ago'),2);?> MZN</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-upper case mb-1">Ganhos (Anual) em inscrições</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id=""><input type="" readonly="" style="border: 0;" size="5" id="ganhos_anual" value="" name=""><?=number_format($administracao->coleta_ano(),2); ?>  MZN</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-upper case mb-1">Ganhos (Anual) em Mensalidade</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id=""><input type="" readonly="" style="border: 0;" size="5" id="ganhos_anual" value="" name=""><?=number_format($administracao->coleta_mensalidades(),2); ?> MZN</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-upper case mb-1">Total</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id=""><input type="" readonly="" style="border: 0;" size="5" id="ganhos_anual" value="" name=""><?=number_format($administracao->coleta_mensalidades()+$administracao->coleta_ano(),2); ?> MZN</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php endif ?>
            <!-- Pending Requests Card Example 
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
            </div>-->
          </div>

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