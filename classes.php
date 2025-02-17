<!--  -->
<?php
include 'principal.php';

?>

<!-- Begin Page Content -->
<div class="container-fluid" style="">

    <div id='mensagem'></div>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Classes</h1>
            <a href="#" data-toggle="modal" data-target="#cad_classe" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-100"></i> </a>
        </div>

        <!-- Content Row -->
        <div id="dados" class="row">

            <?= $administracao->listar_classes(); ?>

        </div>


        <!-- Content Row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<!-- Logout Modal-->
<div class="modal fade" id="cad_classe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header " style="background-color: #880f0f;">
                <h5 class="modal-title" style="color: #fff;" id="exampleModalLabel">Cadastrar Classe</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#fff;">×</span>
                </button>
            </div>
            <form id="classe_submit" method="POST" accept-charset="utf-8">
                <div class="modal-body">

                    <input type="hidden" id="controlador" name="classe_insercao">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="number" readonly="" class="input-xs form-control in" name="codigo" maxlength="70" value="<?=$administracao->ultimo_id_classe(); ?>" placeholder="Codigo" required="" >
                        </div>  
                        <div class="col-md-9">
                            <input type="text" class="input-xs form-control in" name="nome_classe" maxlength="70" value="" placeholder="Nome da Classe" required="" >
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


<script type='text/javascript'>
    /*$(document).ready(function () {

        $('#nome_classe_e').prop('readonly', true);
        
    })*/
</script>
                   

<?php
include 'rodape.php';
?>