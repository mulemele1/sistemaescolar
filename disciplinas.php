<!--  -->
<?php
include 'principal.php';
$q=@$_GET['q'];

?>

<!-- Begin Page Content -->
<div class="container-fluid" style="">

    <div id='mensagem'></div>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Disciplinas</h1>
            <a href="#" data-toggle="modal" data-target="#cad_disciplina" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-100"></i> </a>
        </div>

        <!-- Content Row -->
        <div id="dados" class="row">

            <?= $administracao->listar_disciplinas($q); ?>

        </div>


        <!-- Content Row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<!-- Logout Modal-->
<div class="modal fade" id="cad_disciplina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header " style="background-color: #880f0f;">
                <h5 class="modal-title" style="color: #fff;" id="exampleModalLabel">Cadastrar Disciplina</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#fff;">×</span>
                </button>
            </div>
            <form id="disciplina_submit" method="POST" accept-charset="utf-8">
                <div class="modal-body">

                    <input type="hidden" id="controlador" name="disciplina_insercao">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="number" readonly="" class="input-xs form-control in" name="codigo" maxlength="70" value="<?=$administracao->ultimo_id_disciplina(); ?>" placeholder="Codigo" required="" >
                        </div>  
                        <div class="col-md-9">
                            <input type="text" class="input-xs form-control in" name="nome_disciplina" maxlength="70" value="" placeholder="Nome do Disciplina" required="" >
                        </div> 

                    </div> 
                    <div class="row" hidden="">
                        <div class="col-md-6">
                            <select name="nr_turma" id="nr_turma" required="" class="input-xs form-control in" style="">
                                <!-- <option value="">Selecione o turma</option> -->
                                <?=$administracao->q_turmas($q)?>
                            </select>
                        </div>  

                        <div class="col-md-3">
                            <input type="" class="input-xs form-control in" name="carga_horaria" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="1" placeholder="Carga Horaria" >
                        </div> 

                        <div class="col-md-3">
                            <input type="" class="input-xs form-control in" name="creditos" maxlength="1" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="1" placeholder="Créditos" >
                        </div> 

                    </div> 
                    <div class="row" hidden="">
                        <div class="col-md-5">
                            
                            <select name="sessao" required="" class="input-xs form-control in" style="">
                                <option value="0"><?=$administracao->formato_turma($q) ?></option>
                                <?=$administracao->select_sessoes($q) ?>
                            </select>
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

<?php
include 'rodape.php';
?>