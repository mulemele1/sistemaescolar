<?php
include_once("conexao.php");

$usuarioLogin=$_SESSION['usuarioLogin'];
$nr_aluno=$_POST['nr_aluno'];
$Ano=date('y');
$Mes=$_POST['Mes'];
$Estado=$_POST['Estado'];
$Recibo=$_POST['recibo'];

if ($Estado==1) {
	if ($_SESSION['usuarioNivelAcesso']=='5' or $_SESSION['usuarioNivelAcesso']=='1') {
		$Estado='';
	}else $_SESSION['mensagem']="								<div class='alert alert-danger' role='alert'>
																	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> 
																	Não tens acesso para efectuar esta operação!
																</div> ";
    
}else {
	$Estado=1;
}

$resultado = mysqli_query($conectar,"SELECT * from mensalidades WHERE nr_aluno='$nr_aluno' && Ano=$Ano LIMIT 1");
if (mysqli_num_rows($resultado) <= 0) {
            $sql = mysqli_query($conectar,"INSERT INTO mensalidades (nr_aluno, Ano,$Mes) VALUES ('$nr_aluno', '$Ano', '1')");
}
	

            if($Estado==''){
            	$sql = mysqli_query($conectar,"UPDATE mensalidades SET $Mes = '$Estado' WHERE mensalidades.nr_aluno = '$nr_aluno' AND Ano=$Ano");
            	$query = mysqli_query($conectar,"DELETE FROM `conf_mensalidades` WHERE `conf_mensalidades`.`nr_aluno` = '$nr_aluno' AND mes='$Mes' AND ano=$Ano");

            	$sql1 = mysqli_query($conectar,"INSERT INTO `notificacoes` (`Titulo`, `Texto`, `id_Usuario`, `id_Destinatario`, `Data`, `Estado`) VALUES ('Mensalidade', 'A sua mensalidade do mes $Mes foi Anulada, para mais detalhes contactar a secretaria!', '$idUsuario', '$nr_aluno', NOW(), '1')");

            }elseif ($Estado==1) {
            	$verificacao = mysqli_query($conectar,"SELECT * from conf_mensalidades WHERE recibo='$Recibo'");
				if (mysqli_num_rows($verificacao) <= 0) {
				$sql = mysqli_query($conectar,"UPDATE mensalidades SET $Mes = '$Estado' WHERE mensalidades.nr_aluno = '$nr_aluno' AND Ano=$Ano");
            	$query = mysqli_query($conectar,"INSERT INTO conf_mensalidades (nr_aluno, mes, idUsuario, recibo, ano, data, usuarioLog) VALUES ('$nr_aluno', '$Mes', '$usuarioLogin','$Recibo', '$Ano', NOW(), '$usuarioLogin')");
            	$sql1 = mysqli_query($conectar,"INSERT INTO `notificacoes` (`Titulo`, `Texto`, `id_Usuario`, `id_Destinatario`, `Estado`) VALUES ('Mensalidade', 'A sua mensalidade do mes $Mes foi confirmada!', '$usuarioLogin', '$nr_aluno', '1')");
            	}else{
            		$_SESSION['mensagem'] ="					
		                                                <div class='alert alert-danger' role='alert'>
																	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> 
																O recibo já foi usado no sistema.
																</div> 
													   	";
            	}
            }

			$nr_turma=$_SESSION['nr_turma'];
            header("Location: mensalidades.php?nr_turma=$nr_turma");
?>