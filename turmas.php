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
            <div class="col-lg-10 p-0 m-0 align-items-start">
                <h1 class="h3 mb-0 text-gray-800">Turmas</h1>
            </div>
            <div class="col-lg-2 p-0 m-0 text-right">
                <a href="#" data-toggle="modal" data-target="#cad_turma" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-100"></i> </a>
            </div>
            
        </div>

        <!-- Content Row -->
        <div id="dados" class="row">

            <?= $administracao->listar_turmas($q); ?>

        </div>


        <!-- Content Row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<!-- Logout Modal-->
<div class="modal fade" id="cad_turma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class='modal-dialog ' role='document'>
        <div class='modal-content'>
            <div class='modal-header ' style='background-color: #880f0f;'>
                <h5 class='modal-title' style='color: #fff;' id='exampleModalLabel'>Cadastrar Turma</h5>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true' style='color:#fff;'>×</span>
                </button>
            </div>
            <form id='turma_submit' method='POST' accept-charset='utf-8'>
                <div class='modal-body'>

                    <input type='hidden' id='controlador' name='turma_insercao'>
                    <div class='row'>
                        <div class='col-md-3'>
                            <input type='number' readonly='' class='input-xs form-control in' name='codigo' maxlength='70' value='<?=$administracao->ultimo_id_turma(); ?>' placeholder='Codigo' required='' >
                        </div>  
                        <div class='col-md-9'>
                            <input type='text' class='input-xs form-control in' required='' name='nome_turma' maxlength='70' value='' placeholder='Nome do Turma' required='' >
                        </div> 

                    </div> 
                    <div class='row' hidden="">
                        <div class='col-md-9'>
                            <select name='classe_turma' id='classe_turma' required='' class='input-xs form-control in' style=''>
                                <!-- <option value=''>Selecione a classe</option> -->
                                <?=$administracao->pesquisa_classes($q) ?>
                            </select>
                        </div>  

                        <div class='col-md-3'>
                            <input type='' class='input-xs form-control in' required='' value="1" id='duracao_turma' name='duracao_turma' maxlength='1' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='' placeholder='Duração' >
                        </div>  
                    </div> 
                    <div class='row' hidden="">
                        <div class='col-md-9'>
                            <select name='formato_turma' required='' id='formato_turma' class='input-xs form-control in' style=''>
                                <!-- <option value=''>Selecione o formato do ensino</option>
                                <option value='Modular'>Modular</option>
                                <option value='Semestral'>Semestral</option> -->
                                <option value='Trimestral'>Trimestral</option>
                            </select>
                        </div>  

                        <div class='col-md-3'>
                            <input type='text' required='' class='input-xs form-control in' name='numero_sessoes_formato' id='numero_sessoes_formato' maxlength='2' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='' placeholder='Sessões' >
                        </div>  
                    </div> 
                </div>
                <div class='modal-footer'>
                    <button class='btn btn-primary btn-sm' id='ok' name='ok' type='submit' data-dismiss=''><i class='fas fa-save'></i> Cadastrar</button>
                </div> 
            </form> 
        </div>
    </div>
</div>

<?php
include 'rodape.php';
?>

<script type="text/javascript" charset="utf-8">
    $("#formato_turma").change(function() {
        if ($(this).val()=="Modular") {
            $("#numero_sessoes_formato").prop('readonly', false)
            $("#numero_sessoes_formato").val("")
        }else if($(this).val()=="Semestral"){
            $("#numero_sessoes_formato").prop('readonly', true)
            $("#numero_sessoes_formato").val(parseInt($("#duracao_turma").val())*2)
        }else if($(this).val()=="Trimestral"){
            $("#numero_sessoes_formato").prop('readonly', true)
            $("#numero_sessoes_formato").val("3")
        }
    });
    $(document).ready(function(){
        
            $("#formato_turma").prop('disabled', false)
            if ($("#formato_turma").val()=="Modular") {
                $("#numero_sessoes_formato").prop('readonly', false)
                $("#numero_sessoes_formato").val("")
            }else if($("#formato_turma").val()=="Semestral"){
                $("#numero_sessoes_formato").prop('readonly', true)
                $("#numero_sessoes_formato").val(parseInt($("#duracao_turma").val())*2)
            }else if($("#formato_turma").val()=="Trimestral"){
                $("#numero_sessoes_formato").prop('readonly', true)
                $("#numero_sessoes_formato").val("3")
            }
        
    })
    $("#duracao_turma").on('input', function(event) {
        if ($(this).val()>0) {
            $("#formato_turma").prop('disabled', false)
        }else{
            $("#formato_turma").prop('disabled', true)
        }
    });
</script>