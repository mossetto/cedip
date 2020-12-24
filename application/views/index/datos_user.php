<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$form = array(
	'dni' => array(
		'value' => $dni
	),
	'nombre' => array(
		'type'  => 'text',
		'class' => 'form-control form-control-line',
		'name' => 'nombre',
		'placeholder' => 'Nombre',
		'value' => $nombre,
		'required' => true
	),
	'apellido' => array(
		'type'  => 'text',
		'class' => 'form-control form-control-line',
		'name' => 'apellido',
		'placeholder' => 'Apellido',
		'value' => $apellido,
		'required' => true
	),
	'correo' => array(
		'type'  => 'email',
		'class' => 'form-control form-control-line',
		'name' => 'correo',
		'id' => 'example-email',
		'placeholder' => 'Carga tu email',
		'value' => $correo,
		'required' => true
	),
	'telefono' => array(
		'type'  => 'number',
		'class' => 'form-control form-control-line',
		'name' => 'telefono',
		'placeholder' => 'Teléfono de contacto',
		'value' => $telefono,
		'required' => true
	),
	'direccion' => array(
		'type'  => 'text',
		'class' => 'form-control form-control-line',
		'name' => 'direccion',
		'placeholder' => 'Tu domicilio',
		'value' => $direccion,
		'required' => true
	),
	'pass_web' => array(
		'type'  => 'password',
		'class' => 'form-control form-control-line',
		'name' => 'pass_web',
		'placeholder' => 'Tu Contraseña',
		'value' => $pass_web,
		'required' => true
	),
	'pass_web2' => array(
		'type'  => 'password',
		'class' => 'form-control form-control-line',
		'name' => 'pass_web2',
		'placeholder' => 'Repite la nueva contraseña',
		'value' => $pass_web,
		'required' => true
	),	
);
$form_attributes = array(
	'role' => 'form',
	'autocomplete' => 'off',
	'class' => 'form-horizontal form-material'
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="Cuenta - Seguridad Electronica - Sistemas de Seguridad">
	<meta name="Cuenta - Seguridad Electronica - Sistemas de Seguridad" content="Cuenta - Seguridad Electronica - Sistemas de Seguridad">
	<meta name="robots" content="noindex,nofollow">
	<title>Cedip - Centro Médico - Cuenta</title>
	<link rel="canonical" href="https://www.wrappixel.com/templates/materialpro-lite/" />
	<link rel="shortcut icon" href="<?= base_url(PATH_ONEPAGE)?>/images/favicon.png">
	<!-- Bootstrap Core CSS -->
	<link href="<?= base_url(PATH_PANEL)?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="<?= base_url(PATH_PANEL)?>/css/style.css" rel="stylesheet">
	<link href="<?= base_url(PATH_PANEL)?>/css/colors/blue.css" id="theme" rel="stylesheet">
</head>
<body class="fix-header fix-sidebar card-no-border">
	<div class="preloader">
		<svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
	</div>
	<div id="main-wrapper">
		<header class="topbar">
			<nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
				<div class="navbar-header">
					<a class="navbar-brand">
							<img src="<?= base_url(PATH_PANEL)?>/images/logo.png" alt="homepage" class="light-logo" />
						</b><span></span>
					</a>
				</div>
				<div class="navbar-collapse">
					<ul class="navbar-nav mr-auto mt-md-0">
						<!-- This is  -->
						<li class="nav-item">
							<a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)">
								<i class="mdi mdi-menu"></i>
							</a>
						</li>
					</ul>
					<ul class="navbar-nav my-lg-0">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="pages-profile.html"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $form['nombre']['value']." ".$form['apellido']['value']; ?></a>
							<a href="<?= base_url(); ?>index.php/index/logout" class="btn waves-effect waves-light btn-danger">Salir</a>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<aside class="left-sidebar">
			<div class="scroll-sidebar">
				<nav class="sidebar-nav">
					<ul id="sidebarnav">
						<li>
							<a class="waves-effect waves-dark" href="<?= base_url(); ?>index.php/index/estudios" aria-expanded="false">
								<i class="mdi mdi-table"></i><span class="hide-menu">Mis estudios</span>
							</a>
						</li>
						<li>
							<a class="waves-effect waves-dark" href="<?= base_url(); ?>index.php/index/user" aria-expanded="false">
								<i class="mdi mdi-account-check"></i><span class="hide-menu">Mis datos</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</aside>
		<div class="page-wrapper">
			<div class="container-fluid">
				<div class="row page-titles">
					<div class="col-md-5 col-8 align-self-center">
						<h3 class="text-themecolor m-b-0 m-t-0">Mis datos</h3>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Cuenta</a></li>
							<li class="breadcrumb-item active">Mis datos</li>
						</ol>
					</div>
				</div>
				<!-- Row -->
				<div class="row">
					<!-- Column -->
					<div class="col-lg-4 col-xlg-3 col-md-5">
						<div class="card">
							<div class="card-block">
								<center class="m-t-30"> <img src="<?= base_url(PATH_PANEL)?>/images/users/1.jpg" class="img-circle"
										width="150" />
									<h4 class="card-title m-t-10"><?= $form['nombre']['value']." ".$form['apellido']['value']; ?></h4>
									<h6 class="card-subtitle">Titular</h6>
									<div class="row text-center justify-content-md-center">
										<div class="col-12"><a >
													<h4 class="card-title m-t-10"># <?= $form['dni']['value']; ?></h4>
													<h6 class="card-subtitle">Número de Cliente</h6>
											</a></div>
									</div>
								</center>
							</div>
						</div>
					</div>
					<!-- Column -->
					<!-- Column -->
					<div class="col-lg-8 col-xlg-9 col-md-7">
						<div class="card">
							<div class="card-block">
								<?= form_open('',$form_attributes); ?>
									<div class="form-group">
										<label class="col-md-12">Nombre</label>
										<div class="col-md-12">
											<?= form_input($form['nombre']); ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-12">Apellido</label>
										<div class="col-md-12">
											<?= form_input($form['apellido']); ?>
										</div>
									</div>
									<div class="form-group">
										<label for="example-email" class="col-md-12">Email</label>
										<div class="col-md-12">
											<?= form_input($form['correo']); ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-12">Número de contacto</label>
										<div class="col-md-12">
											<?= form_input($form['telefono']); ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-12">Domicilio</label>
										<div class="col-md-12">
											<?= form_input($form['direccion']); ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-12">Nueva contraseña</label>
										<div class="col-md-12">
											<?= form_input($form['pass_web']); ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-12">Repite la nueva contraseña</label>
										<div class="col-md-12">
											<?= form_input($form['pass_web2']); ?>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<button class="btn btn-success">Actualizar datos</button>
										</div>
									</div>
<?php
if (is_null($message) <> 1){
	if ($message){
?>
									<label class="col-md-12 text-success">Cambios realizados</label>
<?php
	}else{
?>
									<label class="col-md-12 text-danger">Valores incorrecto, revisa el campo</label>
<?php
	}
}
?>
								<?= form_close(); ?>
							</div>
						</div>
					</div>
					<!-- Column -->
				</div>
			</div>
			<footer class="footer"> © 2021 Cedip Centro Médico
			</footer>
		</div>
	</div>
	<!-- All Jquery -->
	<!-- ============================================================== -->
	<script src="<?= base_url(PATH_PANEL)?>/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap tether Core JavaScript -->
	<script src="<?= base_url(PATH_PANEL)?>/plugins/bootstrap/js/tether.min.js"></script>
	<script src="<?= base_url(PATH_PANEL)?>/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- slimscrollbar scrollbar JavaScript -->
	<script src="<?= base_url(PATH_PANEL)?>/js/jquery.slimscroll.js"></script>
	<!--Wave Effects -->
	<script src="<?= base_url(PATH_PANEL)?>/js/waves.js"></script>
	<!--Menu sidebar -->
	<script src="<?= base_url(PATH_PANEL)?>/js/sidebarmenu.js"></script>
	<!--stickey kit -->
	<script src="<?= base_url(PATH_PANEL)?>/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
	<!--Custom JavaScript -->
	<script src="<?= base_url(PATH_PANEL)?>/js/custom.min.js"></script>
</body>
</html>