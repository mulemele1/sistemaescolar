<!--  -->
<?php
include 'principal.php';

if (isset($_GET['q'])) {
    $q=@$_GET['q'];
    $d=@$_GET['d'];
}else{
    $q=@$_SESSION['nr_disciplina'];
}

?>

<!-- Begin Page Content -->
<div class="container-fluid" style="">

    <div id='mensagem'></div>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="col-lg-10 p-0 m-0 align-items-start">
                <h1 class="h3 mb-0 text-gray-800">Trabalhos</h1>
            </div>
            <div class="col-lg-2 p-0 m-0 text-right">
                <a href="#" data-toggle="modal" data-target="#novo_trabalho" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-100"></i> </a>
            </div>
            
        </div>

        <!-- Content Row -->
        <div id="dados" class="row">
            <?php 
                if (isset($_GET['q'])) {
                    echo $teste->listar_testes_turma($q, $d);
                }else{
                    echo $trabalho->listar_trabalhos($q);
                }
            ?>

        </div>


        <!-- Content Row -->

</div>
    <!-- /.container-fluid -->

<?php
include 'rodape.php';
?>

<script type="text/javascript" charset="utf-8">
    
    $(document).ready(function(){
        
            
    });
</script>