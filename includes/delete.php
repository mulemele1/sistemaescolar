<?php require_once "Class.class.php";
if(isset($_POST['Usuario_insercao'])){
	$user = new user;
	$user->inserir_usuario($_POST['nome'],$_POST['usuario'],$_POST['id_nivel_acesso'],$_POST['senha']);
}elseif (isset($_POST['cliente_insercao'])) {
	$cliente = new cliente;
	$cliente->inserir_cliente($_POST['nome'],$_POST['morada'],$_POST['nuit'],$_POST['contacto']);
}