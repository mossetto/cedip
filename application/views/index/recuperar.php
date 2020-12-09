<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cuenta - Seguridad Informática - Sistemas de Seguridad</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(PATH_LOGIN)?>/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(PATH_LOGIN)?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Oxygen&display=swap" rel="stylesheet">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(PATH_LOGIN)?>/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(PATH_LOGIN)?>/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(PATH_LOGIN)?>/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url(PATH_LOGIN)?>/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(PATH_LOGIN)?>/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(PATH_LOGIN)?>/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url(PATH_LOGIN)?>/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(PATH_LOGIN)?>/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(PATH_LOGIN)?>/css/main.css">
<!--===============================================================================================-->
<style>
	    *{
        font-family: 'Oxygen', sans-serif;
    }
</style>
</head>
<body style="background-color: #999999;">
		<!-- Notificacion -->
		<div class="notificacion" id="notificación" onclick="cerrar(this)">
			<h3>Te enviamos un email</h3>
			<p>Enviamos un email de recuperación, revisalo para recuperar la contraseña. Gracias</p>
			<button>Aceptar</button>
		</div>
		<script>
			function cerrar(notificacion){
				notificacion.style.display="none";
			}
		</script>
		<!-- Fin notificacion -->
	<div class="limiter">
		<div class="container-login100">


			<div class="wrap-login100 ">
				<div class="wrap-bar">
					<img src="<?= base_url(PATH_LOGIN)?>/images/logo-blanco.png" alt="">
				</div>
				<form class="login100-form validate-form p-l-50 p-r-50 p-t-72 p-b-50">
					<span class="login100-form-title p-b-59">
						Recuperar contraseña
					</span>

					<div class="wrap-input100 validate-input" data-validate="Revisa este campo">
						<span class="label-input100">Ingresa el D.N.I. del titular</span>
						<input class="input100" type="email" name="name" placeholder="D.N.I. del titular">
						<span class="focus-input100"></span>
					</div>


					<div class="wrap-input100 validate-input" data-validate="Revisa este campo">
						<span class="label-input100">Ingresa tu email.</span>
						<input class="input100" type="email" name="name" placeholder="Email registrado">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-m w-full p-b-33">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<!-- <label class="label-checkbox100" for="ckb1">
								<span class="txt1">
									I agree to the
									<a href="#" class="txt2 hov1">
										Terms of User
									</a>
								</span>
							</label> -->
						</div>

						
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								<b>RECUPERAR</b>
							</button>
							
						</div>
						<a href="<?= base_url(); ?>index.php/index/login">Iniciar sesión</a>
						<a href="<?= base_url(); ?>index.php/index/registro">Registrarme</a>
					</div>
				</form>
			</div>
			<div class="login100-more" style="background-image: url('<?= base_url(PATH_LOGIN)?>/images/bg-01.jpg');"></div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="<?= base_url(PATH_LOGIN)?>/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url(PATH_LOGIN)?>/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url(PATH_LOGIN)?>/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url(PATH_LOGIN)?>/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url(PATH_LOGIN)?>/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url(PATH_LOGIN)?>/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url(PATH_LOGIN)?>/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url(PATH_LOGIN)?>/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url(PATH_LOGIN)?>/js/main.js"></script>

</body>
</html>