<?php
  if(!isset($_SESSION))
{
   session_start();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<title>Escolas V1 - Recuperação de senhas</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter" >
		<div class="container-login100" >
			<div class="wrap-login100">
				<form name="form_login" class="login100-form validate-form" method="post" action="valida-login.php">
					<span class="login100-form-title p-b-26">
						Recuperação de senha
					</span>
					<span class="login100-form-title p-b-48">
						<p class="" style="color: #880f0f;"><b><i>O</i>MeCRON V1</b></p>
						
					</span>
					<p  class="alert-info text-center">
		                    Após digitar o seu email, receberás um email do sistema no mesmo endereço com a sua senha.
	                   
	                </p>
					<div class="wrap-input100 validate-input" data-validate = "Digite o seu email">
						<input class="input100" type="email" name="email">
						<span class="focus-input100" data-placeholder="Digite o seu email"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Ok
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						
						<a class="txt2" href="index.php">
							Login
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>