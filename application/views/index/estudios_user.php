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
	'fecha1' => array(
		'type'  => 'date',
		'aria-label' => 'First name',
		'class' => 'form-control calendario',
		'placeholder' => 'dd-mm-yyyy',
		'name' => 'fecha1',
		'required' => true
	),
	'fecha2' => array(
		'type'  => 'date',
		'aria-label' => 'First name',
		'class' => 'form-control calendario',
		'placeholder' => 'dd-mm-yyyy',
		'name' => 'fecha2',
		'required' => true
	)
);
$form_attributes = array(
	'role' => 'form',
	'autocomplete' => 'off'
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords"
		content="Cuenta - Seguridad Electronica - Sistemas de Seguridad">
	<meta name="description"
		content="Cuenta - Seguridad Electronica - Sistemas de Seguridad">
	<meta name="robots" content="noindex,nofollow">
	<title>Cedip - Centro Médico - Cuenta</title>
	<link rel="shortcut icon" href="<?= base_url(PATH_ONEPAGE)?>/images/favicon.png">
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
						<!-- Logo icon -->
						<b>
							<img src="<?= base_url(PATH_PANEL)?>/images/logo.png" alt="homepage" class="light-logo" />
						</b>
						<!--End Logo icon -->
						<!-- Logo text -->
					</a>
				</div>
				<div class="navbar-collapse">
					<ul class="navbar-nav mr-auto mt-md-0">
						<!-- This is  -->
						<li class="nav-item"> <a
								class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
								href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
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
			<!-- Sidebar scroll-->
			<div class="scroll-sidebar">
				<!-- Sidebar navigation-->
				<nav class="sidebar-nav">
					<ul id="sidebarnav">
						<li> <a class="waves-effect waves-dark" href="<?= base_url(); ?>index.php/index/estudios" aria-expanded="false"><i
							class="mdi mdi-table"></i><span class="hide-menu">Mis estudios</span></a>
						</li>
						<li> <a class="waves-effect waves-dark" href="<?= base_url(); ?>index.php/index/user" aria-expanded="false"><i
							class="mdi mdi-account-check"></i><span class="hide-menu">Mis datos</span></a>
						</li>
					</ul>
					<div class="text-center m-t-30">

					</div>
				</nav>
				<!-- End Sidebar navigation -->
			</div>
			<!-- End Sidebar scroll-->
		</aside>

		<div class="page-wrapper">

			<div class="container-fluid">

				<div class="row page-titles">
					<div class="col-md-5 col-8 align-self-center">
						<h3 class="text-themecolor m-b-0 m-t-0">Mis estudios</h3>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Cuenta</a></li>
							<li class="breadcrumb-item active">Mis estudios</li>
						</ol>
					</div>
				</div>

				<div class="row">
					<!-- column -->
					<div class="col-lg-12">
						<div class="card">
							<div class="card-block">
								<h4 class="card-title">Descargá desde aquí tus últimos estudios</h4>
								<?= form_open('',$form_attributes); ?>
								<div class="input-group buscar-fecha">
										<div class="input-group-prepend titulo-buscar-fecha">
											<span class="input-group-text">Buscar por fecha</span>
										</div>
										<?= form_input($form['fecha1']); ?>
										<?= form_input($form['fecha2']); ?>
										<div class="input-group-append boton-buscar-fecha">
											<button  type="submit" class="btn btn-primary" type="button">Buscar</button>
										</div>
								</div>
								<?= form_close(); ?>
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>Fecha</th>
												<th>Profesional</th>
												<th>Especialidad</th>
												<th>
													<a class="waves-effect waves-dark">
														<i class="mdi mdi-download"></i> 
													</a>
												</th>
											</tr>
										</thead>
										<tbody>
<?php
	if($historial){
		foreach($historial as $historial_row){
?>

											<tr>
												<td><?= $historial_row->fecha; ?></td>
												<td><?= $historial_row->nombre . " ". $historial_row->apellido; ?></td>
												<td><?= $historial_row->especialidad; ?></td>
												<td>
													<a class="waves-effect waves-dark" href="<?= base_url()."index.php/index/reporte/".$historial_row->codigo; ?>" aria-expanded="false" target="_blank">
													<!--
													<a class="waves-effect waves-dark" href="<?= base_url()."index.php/welcome/reporte_historia_clinica/".$historial_row->codigo; ?>" aria-expanded="false" target="_blank">
													-->
														<i class="mdi mdi-file-pdf"></i>
														<span class="hide-menu">Informe</span>
													</a> <br>
													<a class="waves-effect waves-dark" href="<?= base_url()."index.php/index/images/".$historial_row->codigo; ?>" aria-expanded="false">
														<i class="mdi mdi-image"></i>
														<span class="hide-menu">Imágenes</span>
													</a>
												</td>
											</tr>
<?php
		}
	}else{
?>
								<tr>
									<td colspan="4"><center><h3>No tiene estudios asociados</h3></center></td>
								</tr>
<?php
	}
?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<footer class="footer">© 2021 Cedip Centro Médico
			</footer>

		</div>

	</div>

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