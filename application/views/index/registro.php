<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$form = array(
	'dni' => array(
		'type' => 'text',
		'class' => 'input100',
		'name' => 'dni',
		'placeholder' => 'D.N.I.',
		'value' => null,
		'required' => true
	),
	'email' => array(
		'type' => 'email',
		'class' => 'input100',
		'name' => 'email',
		'placeholder' => 'Ingresa tu email',
		'value' => null,
		'required' => true
	),
	'email2' => array(
		'type' => 'email',
		'class' => 'input100',
		'name' => 'email2',
		'placeholder' => 'Reingresa tu email',
		'value' => null,
		'required' => true
	),
	'password' => array(
		'type' => 'password',
		'class' => 'input100',
		'name' => 'password',
		'placeholder' => 'Ingresa la contraseña',
		'value' => null,
		'required' => true
	),
	'password2' => array(
		'type' => 'password',
		'class' => 'input100',
		'name' => 'password2',
		'placeholder' => 'Reingresa la contraseña',
		'value' => null,
		'required' => true
	)
);
$form_attributes = array(
	'role' => 'form',
	'autocomplete' => 'off',
	'class' => 'login100-form validate-form p-l-50 p-r-50 p-t-72 p-b-50'
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cedip - Centro Médico</title>
	<link rel="shortcut icon" href="<?= base_url(PATH_ONEPAGE)?>/images/favicon.png">
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
* {
	font-family: 'Oxygen', sans-serif;
}
</style>
</head>
<body style="background-color: #999999;">

<?php
if (is_null($message) <> 1){
	if ($message){
?>
		<!-- Notificacion -->
		<div class="notificacion" id="notificación" onclick="cerrar(this)">
			<h3><?= $message_title; ?></h3>
			<p><?= $message_text; ?></p>
			<button>Aceptar</button>
		</div>
		<script>
			function cerrar(notificacion){
				notificacion.style.display="none";
			}
		</script>
		<!-- Fin notificacion -->
<?php
	}
}
?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 ">
				<div class="wrap-bar">
					<img src="<?= base_url(PATH_LOGIN)?>/images/logo-blanco.png" alt="">
				</div>				
				<?= form_open('',$form_attributes); ?>
					<span class="login100-form-title p-b-59">
						Registro
					</span>
					<div class="wrap-input100 validate-input" data-validate="Revisa este campo">
						<span class="label-input100">D.N.I. del titular del servicio</span>
						<?= form_input($form['dni']); ?>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Revisa este campo">
						<span class="label-input100">Ingresa tu email</span>
						<?= form_input($form['email']); ?>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Revisa este campo">
						<span class="label-input100">Repite tu email</span>
						<?= form_input($form['email2']); ?>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Revisa este campo">
						<span class="label-input100">Repite la contraseña</span>
						<?= form_input($form['password']); ?>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Revisa este campo">
						<span class="label-input100">Contraseña</span>
						<?= form_input($form['password2']); ?>
						<span class="focus-input100"></span>
					</div>
					<div class="flex-m w-full p-b-33">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						</div>
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								<b>Registrarse</b>
							</button>
						</div>
						<a href="<?= base_url(); ?>index.php/index/login">Ingresar</a>
					</div>
				<?= form_close(); ?>
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