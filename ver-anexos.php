<!--  -->
<?php
include 'principal.php';

$q=@$_GET['q'];
$q2=@$_GET['q2'];
$q3=@$_GET['q3'];
?>

<!-- Begin Page Content -->
<div class="container-fluid" style="font-family: 'Times New Roman', serif;">

    <div id='mensagem'></div>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="col-lg-10 p-0 m-0 align-items-start">
                <h1 class="h3 mb-0 text-gray-800"><?=$q2 ?></h1>
            </div>
          <?php
            if ($_SESSION['usuarioNivelAcesso'] == 5) {
          ?>
            <div class="col-lg-2 p-0 m-0 text-right">
                <a href="#" data-toggle="modal" data-target="#adicionar_anexo" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-100"></i> </a>
            </div>
        <?php } ?>  
        </div>
        
        <!-- Content Row -->
        <div id="dados" class="row" >
            <?php 
              if ($_SESSION['usuarioNivelAcesso']==6) {
                echo $trabalho->listar_anexos_alunos($q);
              }else{
                echo $trabalho->listar_anexos($q);;
              }
             ?>
            
            
        </div>
        <!-- Content Row -->

</div>
    <!-- /.container-fluid -->


            <div class="modal fade" id="adicionar_anexo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header " style="background-color: #880f0f;" hidden>
                        <h5 class="modal-title" style="color: #fff;" id="exampleModalLabel">Adicionar anexo</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color:#fff;">×</span>
                        </button>
                    </div>
                      <form id="criar_novo_anexo" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                          <div class="modal-body">

                              <input type="hidden" id="controlador" name="novo_anexo">
                              <div class="row" hidden="">
                                  <div class="col-md-4" hidden>
                                      <input type="text" class="input-xs form-control in" readonly="" name="nr_trabalho" maxlength="70" value="<?=$q; ?>" placeholder="" required=""  >
                                  </div>  
                                  
                                  
                              </div> 
                              <div class="row">
                                  <div class="col-md-12">
                                    <label for="">Nome do ficheiro</label>
                                      <input type="text" class="input-xs form-control in"  name="nome_anexo" placeholder="Nome do ficheiro" required="">
                                  </div> 
                                  <div class="col-md-12">
                                      <label for="file" id="testo_label" style="border-style: dashed; background-color: #F5F5F5; cursor: pointer; width: 100%; height: 70px; padding: 20px" class="text-center"><b class="">Clique e selecione um ficheiro aqui <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i></b></label>
                                        <input type="file" class="file form-control in" id="file" hidden="" name="anexo" required="">
                                  </div>

                              </div>
                              
                          </div>
                          <div class="modal-footer">
                              <button class="btn btn-primary btn-sm" id="ok" name="ok" type="submit"><i class="fas fa-save"></i> Criar</button>
                          </div> 
                      </form> 
                  </div>
              </div>
          </div>


<?php
include 'rodape.php';
?>

<script type="text/javascript" charset="utf-8">
    
    $(document).ready(function(){
        
        $("#opcoes").hide();
            
    });
    $("#tipo_pergunta").change(function() {
        if ($(this).val()=="1") {
            $("#opcoes").hide();
        }else{
            $("#opcoes").show();
        }
    });
    $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('#testo_label').text(fileName +  '" foi selecionado.')
    });
</script>


