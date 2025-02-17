<?php
require_once("principal.php");

?>

<?php 
if(isset($_POST['nome_aluno'])){
    $foto=null;
    if (isset($_FILES["url_foto"])) {
            function upload_imagem($file)
            {
                if (isset($file)) {
                    $extensao=explode('.', $file["name"]);
                    $novo_nome=rand().'.'.$extensao[1];
                    $foto='uploads/fotos/'.$novo_nome;
                    move_uploaded_file($file['tmp_name'],$foto);
                    return $foto;
                }
            }
            
            $foto=upload_imagem($_FILES["url_foto"]);
            
    }
    $aluno->inserir_aluno($_POST['tipo_documento'], $_POST['nr_documento'], $_POST['local_de_emissao'], $_POST['nome_aluno'], $_POST['apelido_aluno'], $_POST['nacionalidade_aluno'], $_POST['naturalidade_aluno'], $_POST['data_nascimento_aluno'], $_POST['validade_documento_inicial_aluno'], $_POST['sexo_aluno'], $_POST['bairro'], $_POST['quarteirao'], $_POST['casa'], $_POST['rua_avenida'], $_POST['telefone'], $_POST['telefone_alternativo'], $_POST['nome_do_pai'], $_POST['nome_da_mae'], $_POST['email'], $foto);
}
?>

<div class="container-fluid">

    <div id='mensagem'></div>

    <div class="row-fluid">

        <div class="card shadow mb-4">

            <div class="card-header py-3">

                <div class="divH m-0 font-weight-bold text-primary"><label>Formulário de Cadastro de Alunos</label></div>

            </div>

            <div class="panel-body">

                <div class="col-12">

                    <form class="form-horizontal" method="POST" id="cadastrarAluno" enctype="multipart/form-data">

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

                                        <input type="text" autofocus="" readonly="" class="input-xs form-control in " name="nr_aluno" maxlength="20" data-validate="Este campo é obrigatório" value="<?=$aluno->ultimo_id(); ?>" placeholder="Nº do Aluno" required="" >

                                    </div>

                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">

                                        <input type="text" autofocus="" class="input-xs form-control in" name="nome_aluno" maxlength="70" value="" placeholder="Nome" required="" >

                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                                        <input type="text" class="input-xs form-control in" name="apelido_aluno" value="" maxlength="50" placeholder="Apelido" required="" >

                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                        <input type="text" onfocus="(this.type = 'date')" class="input-xs form-control in" id="dob" name="data_nascimento_aluno" value="" placeholder="Data de nascimento" rnb equired="" max="">

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

                                        <input type="text" class="input-xs form-control in" id="validade" name="validade_documento_inicial_aluno" value="" placeholder="Documento Validade " onfocus="(this.type = 'date')" required="">

                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                        <select class="input-xs form-control in" name="sexo_aluno" required="">

                                            <option >Sexo</option>

                                            <option value="Masculino" >Masculino</option> 

                                            <option value="Femenino" >Femenino</option> 

                                        </select>

                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                        <select class="input-xs form-control in" name="nacionalidade_aluno" required="">

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

                                        <input type="text" class="input-xs form-control in" name="naturalidade_aluno" maxlength="20" value="" placeholder="Naturalidade" required="">

                                    </div>

                                    <label class="modal-title" style="margin-bottom: -20px;">Pais</label>
                                    <hr style="width: 100% !important; height: 0px; background-color: #880f0f">

                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"> 

                                        <input type="text" class="input-xs form-control in" name="nome_do_pai" maxlength="70" value="" placeholder="Nome do pai" >

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"> 

                                        <input type="text" class="input-xs form-control in" maxlength="70" name="nome_da_mae" value="" placeholder="Nome da Mãe" >

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

                                    <label style="margin-bottom: -20px;">Detalhes do Turma</label>
                                    <hr style="width: 100% !important; height: 1px; background-color: #880f0f">
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

                                        <select class="input-xs form-control in" name="curso" required="">

                                            <option >Turma</option>

                                            <option value="Teologia">Teologia</option>

                                            <option value="Nutrição">Nutrição</option>

                                            <option value="Contabilidade e Auditoria">Contabilidade e Auditoria</option>

                                            <option value="Informática">Informática</option>

                                        </select>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

                                        <select class="input-xs form-control in" name="regime" required="">

                                            <option >Regime</option>

                                            <option value="Laboral">Laboral</option>

                                            <option value="Pós Laboral">Pós Laboral</option>

                                            <option value="A distância">A distância</option>

                                        </select>

                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

                                        <select class="input-xs form-control in" name="nível" required="">

                                            <option >Nível</option>

                                            <option value="1">1º ano</option>

                                            <option value="2">2º ano</option>

                                            <option value="3">3º ano</option>

                                            <option value="4">4º ano</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                                        <button  class="btn btn-success btn-icon-split" type="submit" name="cadastrarAluno">
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

