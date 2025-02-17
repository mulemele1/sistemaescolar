 <?php

	require_once("principal.php");



?>

<?php 



if(isset ($_POST['cadastrarAluno'])){

    

    $nome 					= $_POST['nome'];

    $apelido 		 		= $_POST['apelido'];

    $dob 					= $_POST['dob'];

    $numeroCedula 			= $_POST['numeroCedula'];

    $sexo 		 			= $_POST['sexo'];

    $pais 		 			= $_POST['pais'];

    $naturalidade 		 	= $_POST['naturalidade'];

    $localResidencia 		= $_POST['localResidencia'];

    $nr_turma 				= $_POST['nr_turma'];

    $pai 					= $_POST['pai'];

    $mae 					= $_POST['mae'];

    $encarregado 			=$_POST['encarregado'];

    $parentescoEncarregado	= $_POST['parentescoEncarregado'];

    $contactoEncarregado 	= $_POST['contactoEncarregado'];



    //upload de Fotos

	$url = "uploads/Fotos/";

    $extensao=explode('.', basename( $_FILES['foto']['name']));

    $extensao=array_pop($extensao);

    $foto = $url .$nome.'_Foto_'. $numeroCedula .'.'. $extensao;

    //upload de Informacoes Medicas

	$url = "uploads/Informacoes Medicas/";

    $extensao=explode('.', basename( $_FILES['infoMedica']['name']));

    $extensao=array_pop($extensao);

    $infoMedica = $url .$nome.'_Informação Medica_'. $numeroCedula .'.'. $extensao;

    //upload de Cartoes de Vacinacao

	$url = "uploads/Cartoes de Vacinacao/";

    $extensao=explode('.', basename( $_FILES['cartaoVacinacao']['name']));

    $extensao=array_pop($extensao);

    $cartaoVacinacao = $url .$nome.'_Cartão de Vacinação_'. $numeroCedula .'.'. $extensao;

    //upload de Cedulas

	$url = "uploads/Cedulas/";

    $extensao=explode('.', basename( $_FILES['cedula']['name']));

    $extensao=array_pop($extensao);

    $cedula = $url .$nome.'_Cédula_'. $numeroCedula .'.'. $extensao;

    	

    	try {

    		move_uploaded_file($_FILES['foto']['tmp_name'], $foto);

    		move_uploaded_file($_FILES['infoMedica']['tmp_name'], $infoMedica);

    		move_uploaded_file($_FILES['cartaoVacinacao']['tmp_name'], $cartaoVacinacao);

    		move_uploaded_file($_FILES['cedula']['tmp_name'], $cedula);		         

            $inserir = mysqli_query($conectar,"INSERT INTO `tabela_aluno`(`nr_turma`, `nome`, `apelido`, `dob`, `numeroCedula`, `sexo`, `pais`, `naturalidade`, `localResidencia`, `pai`, `mae`, `encarregado`, `parentescoEncarregado`, `contactoEncarregado`, `foto`, `infoMedica`, `cartaoVacinacao`, `cedula`, `idNivelAcesso`) VALUES ('$nr_turma','$nome','$apelido', '$dob', '$numeroCedula', '$sexo', '$pais', '$naturalidade', '$localResidencia', '$pai', '$mae', '$encarregado', '$parentescoEncarregado', '$contactoEncarregado', '$foto', '$infoMedica', '$cartaoVacinacao', '$cedula', '4')");



			if($inserir){

				$_SESSION['mensagem'] = "

													<p></p>

													<div class='divH'>

														<div class='alert alert-success' role='alert'>

															<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> 

															Aluno <strong>$nome</strong> cadastrado com sucesso!

														</div>

												   	</div>";

			}else{

					$_SESSION['mensagem'] = "

													<p></p>

													<div class='divH'>

														<div class='alert alert-danger' role='alert'>

															<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> 

															Erro : ".mysqli_error($conectar)."

														</div>

												   	</div>";

			} 

    	} catch (Exception $e) {

    		$_SESSION['mensagem'] = "

													<p></p>

													<div class='divH'>

														<div class='alert alert-danger' role='alert'>

															<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> 

															Erro : ".$e."

														</div>

												   	</div>";

    	}

}



				if(isset($_SESSION['mensagem'])){

					echo $_SESSION['mensagem'];

					unset($_SESSION['mensagem']);

				}

	                  

	            $query=mysqli_query($conectar,"SELECT * FROM tabela_turma ORDER BY nr_turma");

				$idAluno = $_GET['idAluno'];

				//Executa consulta

				$result = mysqli_query($conectar,"SELECT * FROM tabela_aluno WHERE idAluno = '$idAluno' LIMIT 1");

				$resultado = mysqli_fetch_assoc($result);	  

?>			

<div class="container-fluid">

	<div class="row-fluid">

	    <div class="card shadow mb-4">

	        <div class="card-header py-3">

		            <div class="row">

                <div class="col font-weight-bold text-success"><label>Dados do Aluno</label></div>

                  <div class="col text-right ">

                      <a href="#"><button type='button' class='text-right btn btn-sm btn-success'><span class="fas fa-print"></span> Imprimir</button></a>

                  </div>

                </div>

			</div>



			<div class="panel-body">

				<div class="col-12">

		          	<form class="form-horizontal" role="form" name="cadastrarAluno" enctype="multipart/form-data" method="POST" >

						<div class="row" style="">

							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

								<div class="row">

									<div class="col-12">

										<a href="#"><img id="output" src="<?php echo $resultado['foto']?>" class="img-responsive col-12" ></img></a>

									</div>

								</div>

								<div class="row">

									<div class="col-12">

										<input type="file" hidden="" class="form-control in" name="foto" onchange="loadFile(event)">

									</div>

								</div>

							</div>

							

							<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 " >

								<div class="row">

									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">

									  	<b>Nome:</b> <input type="text" disabled class="input-xs form-control in" name="nome" value="<?php echo $resultado['nome']?>" placeholder="Nome" required="" >

									</div>

									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

									  	<b>Apelido:</b> <input type="text" disabled class="input-xs form-control in" name="apelido" value="<?php echo $resultado['apelido']?>" placeholder="Apelido" required="" >

									</div>

									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

									  	<b>Data de Nascimento:</b> <input type="date" disabled class="input-xs form-control in" id="dob" name="dob" value="<?php echo $resultado['dob']?>"  required="">

									</div>

									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

									  	<b>Cédula/Bolentim Nº:</b> <input type="text" disabled class="input-xs form-control in" name="numeroCedula" value="<?php echo $resultado['numeroCedula']?>" placeholder="Cédula ou Bolentim de Nascimento" required="">

									</div>

									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

									  	<b>Sexo:</b> <select class="input-xs form-control in" disabled name="sexo" required="">

									  		<option >Sexo</option>

									  		<option <?php if (trim($resultado['sexo'])=="Masculino"): ?>

									  			selected=""

									  		<?php endif ?> value="Masculino" >Masculino</option>  

									  		<option <?php if (trim($resultado['sexo'])=="Femenino"): ?>

									  			selected=""

									  		<?php endif ?> value="Femenino" >Femenino</option>

										</select>

									</div>

									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

									  	<b>Nacionalidade:</b> <select class="input-xs form-control in" disabled name="pais" required="">

									  		<option ></option>

										  	<option <?php if (trim($resultado['pais'])=="Moçambicana"): ?>

									  			selected=""

									  		<?php endif ?> value="Moçambicana">Moçambicana</option>

										  	<option <?php if (trim($resultado['pais'])=="Zimbabweana"): ?>

									  			selected=""

									  		<?php endif ?> value="Zimbabweana">Zimbabweana</option>

										  	<option <?php if (trim($resultado['pais'])=="Sul Africana"): ?>

									  			selected=""

									  		<?php endif ?> value="Sul Africana">Sul Africana</option>

										</select>

									</div>

									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

									  	<b>Naturalidade:</b> <input type="text" disabled class="input-xs form-control in" name="naturalidade" value="<?php echo $resultado['naturalidade']?>" placeholder="Naturalidade" required="">

									</div>

									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4"> 

									  	<b>Local de Residência:</b> <input type="text" disabled class="input-xs form-control in" name="localResidencia" value="<?php echo $resultado['localResidencia']?>" placeholder="Local de Residência" required="">

									</div>

									<hr style="width: 100%">

										<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 divin">

											<label for="infoMedica" ><strong>Informação Médica</strong></label> 

										  	<a href="<?php echo $resultado['infoMedica']?>" class="btn btn-success btn-block fas fa-eye"> Visualizar</a>

										</div>

										<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 divin">

											<label for="cartaoVacinacao" ><strong>Cartão Vacinação</strong></label> 

										  	<a href="<?php echo $resultado['cartaoVacinacao']?>" class="btn btn-success btn-block fas fa-eye"> Visualizar</a>

										</div>

										<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 divin">

											<label for="cedula" ><strong>Cédula ou Bolentim</strong></label> 

										  	<a href="<?php echo $resultado['cedula']?>" class="btn btn-success btn-block fas fa-eye"> Visualizar</a>

										</div>

									<hr style="width: 100%">

										<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"> 

										  	<b>Nome do pai:</b> <input type="text" disabled class="input-xs form-control in" name="pai" value="<?php echo $resultado['pai']?>" placeholder="Nome do pai" >

										</div>

										<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"> 

										  	<b>Nome da Mãe:</b> <input type="text" disabled class="input-xs form-control in" name="mae" value="<?php echo $resultado['mae']?>" placeholder="Nome da Mãe" >

										</div>

										<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8"> 

										  	<b>Encarregado: </b><div class="input-group">

						                      	<input type="text" disabled class="input-xs form-control in" name="encarregado" value="<?php echo $resultado['encarregado']?>" placeholder="Encarregado" required="">

						                    <div class="input-group-append">

						                        	<select class="input-xs form-control in" disabled style="border-left-width: 2px" name="parentescoEncarregado" value="" required="">

						                        		<optgroup>

						                        			<option>Parentesco</option>

						                        			<option <?php if (trim($resultado['parentescoEncarregado'])=="Pai"): ?>

													  			selected=""

													  		<?php endif ?> value="Pai">Pai</option>

						                        			<option <?php if (trim($resultado['parentescoEncarregado'])=="Mãe"): ?>

													  			selected=""

													  		<?php endif ?> value="Mãe">Mãe</option>

						                        			<option <?php if (trim($resultado['parentescoEncarregado'])=="Tio(a)"): ?>

													  			selected=""

													  		<?php endif ?> value="Tio(a)">Tio(a)</option>

						                        			<option <?php if (trim($resultado['parentescoEncarregado'])=="Avó"): ?>

													  			selected=""

													  		<?php endif ?> value="Avó">Avó</option>

						                        		</optgroup>

						                        	</select>

						                      	</div>

						                    </div>

										</div>	

										<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

										  	<b>Contacto: </b><input type="text" disabled class="input-xs form-control in" name="contactoEncarregado" value="<?php echo $resultado['contactoEncarregado']?>" placeholder="Contacto" required="">

										</div>									

								</div>

								<div class="row">

										<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

										  	<b>Turma: </b><select class="input-xs form-control in" disabled name="nr_turma" required="">

										  		<?php 

							                      while($linhas=mysqli_fetch_array($query)){ 

							                      	?>

						                        	<option <?php if (trim($resultado['nr_turma'])==trim($linhas['nr_turma'])): ?>

													  			selected=""

													  		<?php endif ?> value = "<?php echo $linhas['nr_turma'] ?>"><?php echo $linhas['nome_turma'] ?></option>;

						                        	<?php

						                      		}



						                      	?>

											</select>

										</div>

										<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 text-right">

											<br>

										 	<button type='button' onclick="Voltar()" class="btn btn-danger"><span class="fas fa-arrow-left"></span> Voltar</button>

										 	<a href="aluno-editar.php?idAluno=<?php echo $resultado['idAluno']; ?>"><button type="button" name="cadastrarAluno" class="btn  btn-success"><span class="fas fa-edit"></span> Editar</button></a>

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

	var loadFile=function(event){

		var output=document.getElementById('output');

		output.src=URL.createObjectURL(event.target.files[0]);

	};

</script>