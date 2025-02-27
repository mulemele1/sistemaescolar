<?php
  if(!isset($_SESSION))
{
   session_start();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<title>Sigma V1</title>
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
					<span class="login100-form-title p-b-10">
						Seja bem vindo
					</span>
					<span class="login100-form-title ">
						<p class="" style="color: #880f0f;"><b><i>S</i>igma V1</b></p>
		                    
					</span>
					<?php
		                        if(isset($_SESSION['loginErro'])){
		                            echo $_SESSION['loginErro'];
		                            unset($_SESSION['loginErro']);
		                        }
		                    ?>
					<div class="wrap-input100 validate-input" data-validate = "Digite o usuário">
						<input class="" type="hidden" name="valida_login">
						<input class="input100" type="text" name="usuario">
						<span class="focus-input100" data-placeholder="Usuário"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Digite a senha">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="senha">
						<span class="focus-input100" data-placeholder="Senha"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Esqueceste a sua senha?
						</span>

						<a class="txt2" href="recuperacao-de-senha.php">
							Clique aqui
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

	<script type="text/javascript">
		setTimeout(function(){
	    	$("#erro").slideUp(1200);
	    },1200);
	</script>

</body>
</html>
