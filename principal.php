<!DOCTYPE html>
<html lang="pt-PT">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistema Integrado de Gestão das Mensalidades V1</title>

 <!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
 <!--  <link href="css/bootstrap.css" rel="stylesheet" />
  Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="css/bootstrap-duallistbox.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="js/jquery.bootstrap-duallistbox.js"></script>
  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link href="css/educate-custon-icon.css" rel="stylesheet">
  <!-- My css -->
  <link href="css/manjolo.css" rel="stylesheet">
  <!-- Alertas Sweets -->
  <link href="css/sweetalert2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
<?php 
if(!isset($_SESSION))
{
   session_start();
}

require_once "includes/Class.class.php";

$professor = new professor;
$administracao = new administracao;
$aluno = new aluno;
$usuario = new usuario;
$funcionario = new funcionario;
$teste = new teste;
$trabalho = new trabalho;

require 'sidebar.php';
date_default_timezone_set('Africa/Johannesburg');
 ?>
    
   

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

    
  <?php 

  require 'navbar.php';

   ?>



     
