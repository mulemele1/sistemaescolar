<?php require_once "Class.class.php";
if(isset($_GET['id'])){
	$user = new user;
	$data = $user->get_row($_GET['id']);
	echo json_encode($data);
}