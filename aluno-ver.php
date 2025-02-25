<?php
require_once("principal.php");
$q=$_GET['q'];
$rs=$aluno->pegar_dados_alunos($q);
$rs2=$aluno->q_matricula($q);

$idade_min=Date("Y")-65;
$idade_min=$idade_min."-01-01";
$idade_max=Date('Y')-20;
$idade_max=$idade_max."-12-31";
$validade_min=Date("Y")-4;
$validade_min=$validade_min."-01-01";
$validade_max=Date('Y')+4;
$validade_max=$validade_max."-12-31";
?>
<div class="container-fluid">

    <div id='mensagem'></div>

    <div class="row-fluid">

        <div class="card shadow mb-4">
            <div class='card-header  d-flex flex-row align-items-center justify-content-between'>
                <h6 class='m-0 font-weight-bold text-primary'>Visualizando dados do Aluno</h6><span id="editar" class='col p-0 m-0 font-weight-bold text-primary py-1 text-right'><a class='text-warning' title='Editar'><i class='fas fa-pen fa-fw'></i></a></span>
            </div> 

            <div class="panel-body">

                <div class="col-12">

                    <form  class="form-horizontal" method="POST" id="actualizar_aluno" enctype="multipart/form-data">

                        <div class="row" style="">

                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

                                <div class="row">

                                    <div class="col-12">

                                        <img id="output" src="<?=$rs['url_foto']; ?>" class="img-responsive col-12" ></img>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-12">

                                        <div class="col-12">

                                            <label for="url_foto" class="custom-file-label">Selecione a Foto</label>

                                            <input type="file" accept="image/*" value="" class="form-control custom-file-input in" id="url_foto" name="url_foto" onchange="loadFile(event)">

                                        </div>

                                    </div>

                                </div>

                            </div>



                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 " >

                                <div class="row">

                                    <div class="col-12">
                                        <label style="margin-bottom: 0px;">Dados Pessoais</label>
                                        <hr style="width: 100% !important; height: 1px; background-color: #880f0f">
                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                                        <label># Aluno</label>
                                        <input type="text" autofocus="" readonly="" class="input-xs form-control in " name="nr_aluno" id="nr_aluno" maxlength="20" data-validate="Este campo é obrigatório" value="<?=$rs['nr_aluno']; ?>" placeholder="Nº do Aluno" required="" >

                                    </div>

                                    <div class="col-xs-12 col-sm-8 col-md-5 col-lg-5">

                                        <label>Nome</label>
                                        <input type="text" autofocus="" class="input-xs form-control in" name="nome_aluno" maxlength="70" value="<?=$rs['nome_aluno']; ?>" placeholder="Nome" required="" >

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                        <label>Apelido</label>
                                        <input type="text" class="input-xs form-control in" name="apelido_aluno" value="<?=$rs['apelido_aluno']; ?>" maxlength="50" placeholder="Apelido" required="" >

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <label>Data de nascimento</label>
                                        <input type="text" onfocus="(this.type = 'date')" min="<?=$idade_min; ?>" max="<?=$idade_max; ?>" class="input-xs form-control in" id="dob" name="data_nascimento_aluno" value="<?=$rs['data_nascimento_aluno']; ?>" placeholder="Data de nascimento" rnb equired="" max="">

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <label>Tipo de documento</label>
                                        <select class="input-xs form-control in" name="tipo_documento" required="">

                                            <option <?=($rs['tipo_documento'] == "" ? "selected": ''); ?> value="">Tipo de documento</option>

                                            <option <?=($rs['tipo_documento'] == "Bilhete de identidade" ? "selected": ''); ?> value="Bilhete de identidade" >Bilhete de identidade</option> 

                                            <option <?=($rs['tipo_documento'] == "Passaporte" ? "selected": ''); ?> value="Passaporte" >Passaporte</option> 

                                        </select>

                                    </div>


                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <label>Número do documento</label>
                                        <input type="text" class="input-xs form-control in" name="nr_documento" value="<?=$rs['nr_documento']; ?>" maxlength="13" placeholder="Número do documento" required="">

                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">

                                        <label>Local de Emissão</label>
                                        <select class="input-xs form-control in" name="local_de_emissao" required="">

                                            <option >Emitido em</option> 

                                            <option <?=($rs['local_de_emissao'] == "Beira" ? "selected": ''); ?> value="Beira" >Beira</option>
                                            <option <?=($rs['local_de_emissao'] == "Chimoio" ? "selected": ''); ?> value="Chimoio" >Chimoio</option> 
                                            <option <?=($rs['local_de_emissao'] == "Maputo" ? "selected": ''); ?> value="Maputo" >Maputo</option> 
                                            <option <?=($rs['local_de_emissao'] == "Matola" ? "selected": ''); ?> value="Matola" >Matola</option> 
                                            <option <?=($rs['local_de_emissao'] == "Gaza" ? "selected": ''); ?> value="Gaza" >Gaza</option>
                                            <option <?=($rs['local_de_emissao'] == "Inhambane" ? "selected": ''); ?> value="Inhambane" >Inhambane</option> 
                                            <option <?=($rs['local_de_emissao'] == "Quelimane" ? "selected": ''); ?> value="Quelimane" >Quelimane</option> 
                                            <option <?=($rs['local_de_emissao'] == "Tete" ? "selected": ''); ?> value="Tete" >Tete</option> 
                                            <option <?=($rs['local_de_emissao'] == "Nampula" ? "selected": ''); ?> value="Nampula" >Nampula</option>
                                            <option <?=($rs['local_de_emissao'] == "Lichinga" ? "selected": ''); ?> value="Lichinga" >Lichinga</option> 
                                            <option <?=($rs['local_de_emissao'] == "Pemba" ? "selected": ''); ?> value="Pemba" >Pemba</option>


                                        </select>

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <label>Validade</label>
                                        <input type="text" class="input-xs form-control in" id="validade" min="<?=$validade_min; ?>" max="<?=$validade_max; ?>" name="validade_documento_inicial_aluno" value="<?=$rs['validade_documento_inicial_aluno']; ?>" placeholder="Documento Validade " onfocus="(this.type = 'date')" required="">

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <label>Sexo</label>
                                        <select class="input-xs form-control in" name="sexo_aluno" required="">

                                            <option <?=($rs['sexo_aluno'] == "" ? "selected": ''); ?> value="" >Sexo</option>

                                            <option <?=($rs['sexo_aluno'] == "Masculino" ? "selected": ''); ?> value="Masculino" >Masculino</option> 

                                            <option <?=($rs['sexo_aluno'] == "Femenino" ? "selected": ''); ?> value="Femenino" >Femenino</option> 

                                        </select>

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <label>Nacionalidade</label>
                                        <select class="input-xs form-control in" name="nacionalidade_aluno" required="">

                                            <option <?=($rs['nacionalidade_aluno'] == "" ? "selected": ''); ?> value="">Nacionalidade</option>

                                            <option <?=($rs['nacionalidade_aluno'] == "Moçambicana" ? "selected": ''); ?> value="Moçambicana">Moçambicana</option>

                                            <option <?=($rs['nacionalidade_aluno'] == "Angolana" ? "selected": ''); ?> value="Angolana">Angolana</option>

                                            <option <?=($rs['nacionalidade_aluno'] == "Zimbabweana" ? "selected": ''); ?> value="Zimbabweana">Zimbabweana</option>

                                            <option <?=($rs['nacionalidade_aluno'] == "Brasileira" ? "selected": ''); ?> value="Brasileira">Brasileira</option>

                                            <option <?=($rs['nacionalidade_aluno'] == "Sul Africana" ? "selected": ''); ?> value="Sul Africana">Sul Africana</option>

                                            <option <?=($rs['nacionalidade_aluno'] == "Sul Africana" ? "selected": ''); ?> value="Sul Africana">Sul Africana</option>

                                        </select>

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <label>Naturalidade</label>
                                        <input type="text" class="input-xs form-control in" name="naturalidade_aluno" maxlength="50" value="<?=$rs['naturalidade_aluno']; ?>" placeholder="Naturalidade" required="">

                                    </div>

                                    <div class="col-12">
                                        <label style="margin-bottom: 0px;">Morada</label>
                                        <hr style="width: 100% !important; height: 1px; background-color: #880f0f">
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <label>Bairro</label>
                                        <input type="text" class="input-xs form-control in" id="bairro" name="bairro" maxlength="100" value="<?=$rs['bairro']; ?>" placeholder="Bairro" required="">

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <label>Quarteirão</label>
                                        <input type="text" class="input-xs form-control in" id="quarteirao" maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="quarteirao" value="<?=$rs['quarteirao']; ?>" placeholder="Quarteirão">

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <label>Casa</label>
                                        <input type="text" class="input-xs form-control in" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="6" id="casa" name="casa" value="<?=$rs['casa']; ?>" placeholder="Casa" >

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <label>Rua/Avenida</label>
                                        <input type="text" class="input-xs form-control in" name="rua_avenida" maxlength="100" value="<?=$rs['rua_avenida']; ?>" placeholder="Rua/Avenida" required="">

                                    </div>

                                    <div class="col-12">
                                        <label style="margin-bottom: 0px;">Contactos</label>
                                        <hr style="width: 100% !important; height: 1px; background-color: #880f0f">
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                        <label>Email</label>
                                        <input type="email" class="input-xs form-control in" id="email" name="email" value="<?=$rs['email']; ?>" placeholder="Email" maxlength="100">

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                        <label>Celular</label>
                                        <input type="text" class="input-xs form-control in" id="telefone" name="telefone" value="<?=$rs['telefone']; ?>" placeholder="Celular" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required="" maxlength="9">

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                        <label>Celular alternativo</label>
                                        <input type="text" class="input-xs form-control in" id="telefone_alternativo" name="telefone_alternativo" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?=$rs['telefone_alternativo']; ?>" placeholder="Celular alternativo" maxlength="9">

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                        <label>Turma</label>
                                        <select class="input-xs form-control in" name="classe_turma">
                                            <option value="<?=@$rs2['nr_turma'] ?>"> <?=@$rs2['nome_classe'].' '.@$rs2['nome_turma'] ?></option>
                                            <?=$administracao->select_classe_turma() ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                                        <button class="btn btn-success btn-icon-split" type="submit" id="editar_aluno" name="editar_aluno">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            <span class="text">Gravar</span>
                                        </button>

                                    </div>

                                </div>



                            </div>



                        </div>	

                        <br>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>









<?php
include_once("rodape.php");
?>

<script type="text/javascript">

    var loadFile = function (event) {

        var output = document.getElementById('output');

        output.src = URL.createObjectURL(event.target.files[0]);

    };



    $(document).ready(function () {

        $('.form-control').attr('disabled', true);
        $('#editar_aluno').hide();
        
    })

    $('#editar').click(function(event) {
        $(this).hide();
        $('.form-control').attr('disabled', false);

        $('#editar_aluno').show();

    });

</script>

