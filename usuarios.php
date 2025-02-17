 <!--  -->
<?php 
  include 'principal.php';

?>
  
        <!-- Begin Page Content -->
        <div class="container-fluid">
           <div id='mensagem'></div>
          <!-- DataTales Example -->
          <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Usuários do sistema</h1>
            <a href="#" data-toggle="modal" data-target="#cad_usuario" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-100"></i> </a>
        </div>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="dataTable" cellspacing="0">
                  <thead >
                    <tr class="filters">
                      <th>Usuário</th>
                      <th>Nome</th>
                      <th>Nível de Acesso</th>
                      <th>Estado</th>
                      <th>Acções</th>
                    </tr>
                </thead>
                <tbody id="searchable" class="searchable">
                    <?php
                        echo $usuario->listar_usuarios();
                    ?>

                </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

  <!-- Footer -->
<?php 
  include 'rodape.php';
?>
  
<!-- Logout Modal-->
<div class="modal fade" id="cad_usuario" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header " style="background-color: #880f0f;">
                <h5 class="modal-title" style="color: #fff;" id="exampleModalLabel">Cadastrar Usuários</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#fff;">×</span>
                </button>
            </div>
            <form id="regForm" name="regForm"  method="POST" accept-charset="utf-8">
                <input type="hidden" id="controlador" name="Usuario_insercao">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <label>Nome</label>
                            <input type="text" autofocus="" class="input-xs form-control in" id="nome" name="nome" maxlength="70" value="" placeholder="Nome" required="" >
                        </div> 

                    </div> 
                    <div class="row">
                        <div class="col-md-6">
                            <label>Usuário</label>
                            <input type="text" class="input-xs form-control in" id="usuario" name="usuario" maxlength="70" value="" placeholder="Usuário" required="" >
                        </div>  
                        <div class="col-md-6">
                            <label>Nivel de acesso</label>
                            <select class="input-xs form-control in" id="id_nivel_acesso" name="id_nivel_acesso" required="">
                                <option value="">Selecione</option>
                                <?=$usuario->select_nivel_acesso();  ?>
                            </select>
                        </div> 

                    </div>  
                    <div class="row">
                        <div class="col-md-6">
                            <label>Senha</label>
                            <input type="password" class="input-xs form-control in" id="senha" name="senha" maxlength=""  value="" placeholder="Senha" required="" >
                        </div> 

                       
                    </div>  

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" id="ok" name="ok" type="submit" data-dismiss=""><i class="fas fa-save"></i> Cadastrar</button>
                </div>
            </form> 
        </div>
    </div>
</div>


<script type="text/javascript">
   
</script>