<!--  -->
<?php
include 'principal.php';

$q=@$_GET['q'];
$q2=@$_GET['q2'];
$q3=@$_GET['q3'];
?>

<!-- Begin Page Content -->
<div class="container-fluid" style="background-color: #fff; font-family: 'Times New Roman', serif;">

    <div id='mensagem'></div>

        <!-- Page Heading -->
        <p class="h3 mb-0 text-center"><b><?=$q2 ?></b></p>
        <p class="h3 mb-0 text-center"><b><?=@$_SESSION['nome_disciplina'].' '.@$_SESSION['nome_classe'].' '.@$_SESSION['nome_turma'] ?><?php if($_SESSION['usuarioNivelAcesso'] == 6){echo @$q3;} ?></b></p>
       

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php
          if ($_SESSION['usuarioNivelAcesso'] == 5) {
          ?>
            <div class="col-lg-2 p-0 m-0">
                <a href="#" data-toggle="modal" data-target="#adicionar_pergunta" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-100"></i>
                    Adicionar pergunta
                </a>
            </div>
        <?php } ?>
        </div>

        <!-- Content Row -->
        <div id="dados" class="row" >
            <?php 
              if ($_SESSION['usuarioNivelAcesso']==6) {
                echo $teste->listar_perguntas_alunos($q);
              }else{
                echo $teste->listar_perguntas($q);;
              }
             ?>
            
            
        </div>
        <!-- Content Row -->

</div>
    <!-- /.container-fluid -->


            <div class="modal fade" id="adicionar_pergunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                      <div class="modal-header " style="background-color: #880f0f;" hidden>
                        <h5 class="modal-title" style="color: #fff;" id="exampleModalLabel">Cadastrar Disciplina</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color:#fff;">×</span>
                        </button>
                    </div>
                      <form id="criar_nova_pergunta" method="POST" accept-charset="utf-8">
                          <div class="modal-body">

                              <input type="hidden" id="controlador" name="nova_pergunta">
                              <div class="row">
                                  <div class="col-md-4" hidden>
                                      <input type="text" class="input-xs form-control in" readonly="" name="nr_teste" maxlength="70" value="<?=$q; ?>" placeholder="" required=""  >
                                  </div>  
                                  <div class="col-md-9">
                                    <label for=""> Tipo d pergunta</label>
                                    <select id="tipo_pergunta" name="tipo_pergunta" class="input-xs form-control in">
                                        <option value="1">Aberta</option>
                                        <option value="2">Múltipla escolha</option><!-- 
                                        <option value="3 ">Verdade & Falso</option> -->
                                    </select>
                                  </div>  
                                  <div class="col-md-3">
                                    <label for=""> Nota</label>
                                      <input type="number" class="input-xs form-control in" name="nota" value="" placeholder="Ex: 5" >
                                  </div> 
                              </div> 
                              <div class="row">
                                  <div class="col-md-12">
                                    <label for=""> Pergunta / Afirmação</label>
                                      <textarea type="text" class="input-xs form-control in" placeholder="Digite a pergunta ou afirmação aqui" name="pergunta" value="" placeholder="" required=""></textarea>
                                  </div> 

                              </div>
                              <div id="opcoes" class="row">
                                    <div class="col-12 text-center">
                                        <label for="" class="text-info"> <b>Opções</b></label>
                                    </div>
                                  <div class="col-md-6">
                                        <div class="input-group">

                                            <div class="input-group-append">
                                              <input type="text" class="input-xs form-control in" value="a)" size="1" readonly=""> 
                                            </div>
                                            <input type="text" class="input-xs form-control in" name="a" value="" placeholder="" >
                                        </div>
                                  </div> 

                                  <div class="col-md-6">
                                        <div class="input-group">

                                            <div class="input-group-append">
                                              <input type="text" class="input-xs form-control in" value="b)" size="1" readonly=""> 
                                            </div>
                                            <input type="text" class="input-xs form-control in" name="b" value="" placeholder="" >
                                        </div>
                                  </div> 

                                  <div class="col-md-6">
                                        <div class="input-group">

                                            <div class="input-group-append">
                                              <input type="text" class="input-xs form-control in" value="c)" size="1" readonly=""> 
                                            </div>
                                            <input type="text" class="input-xs form-control in" name="c" value="" placeholder="" >
                                        </div>
                                  </div> 

                                  <div class="col-md-6">
                                    <div class="input-group">

                                        <div class="input-group-append">
                                          <input type="text" class="input-xs form-control in" value="d)" size="1" readonly=""> 
                                        </div>
                                        <input type="text" class="input-xs form-control in" name="d" value="" placeholder="" >
                                    </div>                                      
                                  </div> 
                                  <div class="col-md-3">
                                    <label for=""> Opção Corecta</label>
                                    <select name="opcao_correcta" class="input-xs form-control in">
                                          <option value=""></option>
                                          <option value="a">a</option>
                                          <option value="b">b</option>
                                          <option value="c">c</option>
                                          <option value="d">d</option>
                                    </select>
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
</script>


