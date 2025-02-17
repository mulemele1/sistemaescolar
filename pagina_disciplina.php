
         <!--  -->
<?php 
  include 'principal.php';
?>

        <!-- Begin Page Content -->
        <div class="container-fluid" style="">
          <?php
            $q=$_GET['q'];
            $administracao->get_disciplinas($q);
            if(isset($_SESSION['mensagem'])){
                echo $_SESSION['mensagem'];
                unset($_SESSION['mensagem']);
            }
          ?>
          <div id='mensagem'></div>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $_SESSION['nome_classe'].' '.$_SESSION['nome_turma'].' - '.$_SESSION['nome_disciplina'] ?></h1>
          </div>
          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4" hidden="">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <a href="#" data-toggle="modal" data-target="#novo_teste">
                    <div class="row no-gutters align-items-center text-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Novo Teste</div>
                        
                        <div class="col-auto">
                          <i class="fas fa-plus fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
            
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <a href="testes.php" >
                    <div class="row no-gutters align-items-center text-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Listar Testes</div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <a href="trabalhos.php" >
                    <div class="row no-gutters align-items-center text-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Listar Trabalhos</div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <a href="aulas.php" >
                    <div class="row no-gutters align-items-center text-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Listar Aulas</div>
                        
                        <div class="col-auto">
                          <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
            
          
            <!-- Earnings (Monthly) Card Example -->
           <!--  <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center text-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Novo Trabalho</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-plus fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

            
            <!-- Earnings (Monthly) Card Example -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center text-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Listar Trabalhos</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

          
        

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

  <!-- Footer -->
<?php 
  include 'rodape.php';
?>
