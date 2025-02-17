<?php
require_once("principal.php");

?>

<div class="container-fluid">

    <div id='mensagem'></div>

    <div class="row-fluid">

        <div class="card shadow mb-4">

            <div class="card-header py-3">

                <div class="divH m-0 font-weight-bold text-primary"><label>Novo Funcionário</label></div>

            </div>

            <div class="panel-body">

                <div class="col-12">

                    <form class="form-horizontal" method="POST" id="cadastrar_funcionario" enctype="multipart/form-data">

                        <div class="row" style="">

                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

                                <div class="row">

                                    <div class="col-12">

                                        <img id="output" src="img/user.webp" class="img-responsive col-12" ></img>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-12">

                                        <div class="col-12">

                                            <label for="url_foto" class="custom-file-label">Selecione a Foto</label>

                                            <input type="file" accept="image/*" class="form-control custom-file-input in" id="url_foto" name="url_foto" onchange="loadFile(event)">

                                        </div>

                                    </div>

                                </div>

                            </div>



                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 " >

                                <div class="row">

                                    <label class="modal-title" style="margin-bottom: -20px;">Dados Pessoais</label>
                                    <hr style="width: 100% !important; height: 0px; background-color: #880f0f">

                                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

                                        <input type="text" autofocus="" readonly="" class="input-xs form-control in " name="nr_funcionario" maxlength="20" data-validate="Este campo é obrigatório" value="<?=$funcionario->ultimo_id(); ?>" placeholder="Nº do Aluno" required="" >
                                        
                                    </div>

                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">

                                        <input type="text" autofocus="" class="input-xs form-control in" name="nome_funcionario" maxlength="70" value="" placeholder="Nome" required="" >

                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                                        <input type="text" class="input-xs form-control in" name="apelido_funcionario" value="" maxlength="50" placeholder="Apelido" required="" >

                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                        <input type="text" onfocus="(this.type = 'date')" class="input-xs form-control in" id="dob" name="data_nascimento_funcionario" value="" placeholder="Data de nascimento" rnb equired="" max="">

                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                        <input type="text" class="input-xs form-control in" name="nr_documento" value="" maxlength="13" placeholder="Número do documento" required="">

                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                        <select class="input-xs form-control in" name="tipo_documento" required="">

                                            <option readonly="">Tipo de documento</option>

                                            <option value="Bilhete de identidade" >Bilhete de identidade</option> 

                                            <option value="Passaporte" >Passaporte</option> 

                                        </select>

                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">


                                        <select class="input-xs form-control in" name="local_de_emissao" required="">

                                            <option >Emitido em</option> 

                                            <option value="Beira" >Beira</option>
                                            <option value="Chimoio" >Chimoio</option> 
                                            <option value="Maputo" >Maputo</option> 
                                            <option value="Matola" >Matola</option> 
                                            <option value="Gaza" >Gaza</option>
                                            <option value="Inhambane" >Inhambane</option> 
                                            <option value="Quelimane" >Quelimane</option> 
                                            <option value="Tete" >Tete</option> 
                                            <option value="Nampula" >Nampula</option>
                                            <option value="Lichinga" >Lichinga</option> 
                                            <option value="Pemba" >Pemba</option>


                                        </select>

                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                        <input type="text" class="input-xs form-control in" id="validade" name="validade_documento_inicial_funcionario" value="" placeholder="Documento Validade " onfocus="(this.type = 'date')" required="">

                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                        <select class="input-xs form-control in" name="sexo_funcionario" required="">

                                            <option >Sexo</option>

                                            <option value="Masculino" >Masculino</option> 

                                            <option value="Femenino" >Femenino</option> 

                                        </select>

                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                        <select class="input-xs form-control in" name="nacionalidade_funcionario" required="">

                                            <option >Nacionalidade</option>

                                            <option value="Moçambicana">Moçambicana</option>

                                            <option value="Zimbabweana">Angolana</option>

                                            <option value="Zimbabweana">Zimbabweana</option>

                                            <option value="Zimbabweana">Brasileira</option>

                                            <option value="Sul Africana">Sul Africana</option>

                                            <option value="Sul Africana">Sul Africana</option>

                                        </select>

                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                        <input type="text" class="input-xs form-control in" name="naturalidade_funcionario" maxlength="20" value="" placeholder="Naturalidade" required="">

                                    </div>

                                    <label style="margin-bottom: -20px;">Morada</label>
                                    <hr style="width: 100% !important; height: 0px; background-color: #880f0f">
                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                        <input type="text" class="input-xs form-control in" id="bairro" name="bairro" maxlength="25" value="" placeholder="Bairro" required="">

                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                        <input type="text" class="input-xs form-control in" id="quarteirao" maxlength="2" name="quarteirao" value="" placeholder="Quarteirão">

                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                        <input type="text" class="input-xs form-control in" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="6" id="casa" name="casa" value="" placeholder="Casa" >

                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                        <input type="text" class="input-xs form-control in" name="rua_avenida" maxlength="50" value="" placeholder="Rua/Avenida" required="">

                                    </div>

                                    <label style="margin-bottom: -20px;">Contactos</label>
                                    <hr style="width: 100% !important; height: 0px; background-color: #880f0f">
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

                                        <input type="email" class="input-xs form-control in" id="email" name="email" value="" placeholder="Email" maxlength="60">

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

                                        <input type="text" class="input-xs form-control in" id="telefone" name="telefone" value="" placeholder="Celular" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required="" maxlength="9">

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

                                        <input type="text" class="input-xs form-control in" id="telefone_alternativo" name="telefone_alternativo" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="" placeholder="Celular alternativo" maxlength="9">

                                    </div>

                                    <label style="margin-bottom: -20px;">Função</label>
                                    <hr style="width: 100% !important; height: 0px; background-color: #880f0f">
                                    <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
                                        <select name="id_funcao" required="" class="input-xs form-control in">
                                        	<option value="">Selecione a função</option>
                                        	<?=$administracao->select_funcao();  ?>
                                        </select>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                                        <button  class="btn btn-success btn-icon-split" type="submit" name="cadastrar_funcionario">
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

        $('input[id="total_mensalidade"]').attr('readonly', true)

        $('input[id="descontos"]').on('keyup', function () {

            $('input[id="total_mensalidade"]').attr('value', $('input[id="mensalidade"]').val() - $('input[id="descontos"]').val())

        })

    })

</script>

