<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
	<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Cedip Centro Médico</title>
	<link rel="shortcut icon" href="<?= base_url(PATH_ONEPAGE)?>/images/favicon.png">
	<link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&display=swap" rel="stylesheet">


	<link rel="stylesheet" href="<?= base_url(PATH_ONEPAGE)?>/css/style-starter.css">
  </head>
  <body>
  	<a class="wsp-cover" href="https://api.whatsapp.com/send?phone=5493574406322&text=Hola,%20tengo%20una%20consulta" target="_blank">
  		<img class="wsp-link" src="<?= base_url(PATH_ONEPAGE)?>/images/wsp-icon.png" title="Chatear en WhatsApp">
	</a>
<section class="w3l-bootstrap-header">
  <nav class="navbar navbar-expand-md navbar-light py-3">
	<div class="container">
	  <a class="navbar-brand" href="<?= base_url(); ?>"><img src="<?= base_url(PATH_ONEPAGE)?>/images/logo-azul.png" class="img-fluid" width="52px"></a>

	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
		aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		Menu
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto">
		  <li class="nav-item active">
			<a class="nav-link" href="#">Inicio</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#servicios">Servicios</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#nosotros">Nosotros</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#contacto">Contacto</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link btn-acceso" href="<?= base_url(); ?>index/login">Acceso</a>
		  </li>
		</ul>
	  </div>
	  <a href="#domain" class="domain ml-3" data-toggle="modal" data-target="#DomainModal">
		<div class="hamburger1">
		  <div></div>
		  <div></div>
		  <div></div>
		</div>
	  </a>
	</div>
  </nav>
</section>



<div class="modal right fade" id="DomainModal" tabindex="-1" role="dialog" aria-labelledby="DomainModalLabel2">
  <div class="modal-dialog" role="document">
	<div class="modal-content">

	  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
		  aria-hidden="true">&times;</span></button>

	  <div class="modal-body">
		<div class="modal__content">
		  <h2 class="logo"><img src="<?= base_url(PATH_ONEPAGE)?>/images/logo-azul.png" class="img-fluid"></h2>

		  <p class="mt-md-3 mt-2">Cedip Centro Médico con mas de 7 años de trayectoria, es una institución dedicada al cuidado de personas.</p>
		  <div class="widget-menu-items mt-sm-5 mt-4">
			<h5 class="widget-title">Menu Items</h5>
			<nav class="navbar p-0">
			  <ul class="navbar-nav">
				<li class="nav-item active">
				  <a class="nav-link">Inicio</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="#servicios">Servicios</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="#nosotros">Nosotros</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="#contacto">Contacto</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link btn-acceso" href="#">Acceso</a>
				</li>
			  </ul>
			</nav>
		  </div>
		  <div class="widget-social-icons mt-sm-5 mt-4">
			<h5 class="widget-title">Contáctanos</h5>
			<ul class="icon-rounded address">
			  <li>
				<p> Rivadavia 949, <br>C.P. 5133, <br>Villa Santa Rosa, Córdoba.</p>
			  </li>
			  <li class="mt-3">
				<p><span class="fa fa-phone"></span> <a href="tel:3574406322">WhatsApp 3574 40-6322</a></p>
				<p><span class="fa fa-phone"></span> <a href="tel:3574480133">Fijo (03574) 480133</a></p>
			  </li>
			  <li class="mt-2">
				<p><span class="fa fa-envelope"></span> <a
					href="mailto:info@cedipcentromedico.com">info@cedipcentromedico.com</a></p>
			  </li>
			</ul>
		  </div>
		  <div class="widget-social-icons mt-sm-5 mt-4">
			<h5 class="widget-title">Nuestras redes</h5>
			<ul class="icon-rounded">
			  <li><a class="social-link twitter" href="https://www.instagram.com/cedipcentromedico/" target="_blank"><i class="fa fa-instagram"></i></a></li>
			  <li><a class="social-link linkedin" href="https://www.facebook.com/cedipcentromedico/" target="_blank"><i class="fa fa-facebook"></i></a></li>

			</ul>
		  </div>


		</div>
	  </div>
	</div>

  </div>

</div>

<section class="w3l-main-slider" id="home">

  <div class="companies20-content">
   
	<div class="owl-one owl-carousel owl-theme">
	  <div class="item">
		<li>
		  <div class="slider-info banner-view bg bg2">
			<div class="banner-info">
			  <div class="container">
				<div class="banner-info-bg">
				  <h5>Ecografía 5D</h5>
				  <p>La ecografía 5D es capaz de realizar una reconstrucción más definida y realista del feto. <br>Contamos con la nueva generación de ecógrafos de alta resolución que incrementa de manera decisiva la capacidad diagnóstica. </p>
				  <a class="btn btn-style btn-style-outline mt-sm-5 mt-4" href="#servicios"> Ver más</a>
				</div>
			  </div>
			</div>
		  </div>
		</li>
	  </div>
	  <div class="item">
		<li>
		  <div class="slider-info  banner-view banner-top1 bg bg2">
			<div class="banner-info">
			  <div class="container">
				<div class="banner-info-bg">
				  <h5>Ubicación estratégica</h5>
				  <p>Rivadavia 949, Villa Santa Rosa, departamento Río Primero, en la provincia de Córdoba, República Argentina; a la vera de la Ruta Provincial 10, 90 km al noreste de la capital.</p>
					<a class="btn btn-style btn-style-outline mt-sm-5 mt-4" href="#contacto"> Ver más</a>
				</div>
			  </div>
			</div>
		  </div>
		</li>
	  </div>
	  <!--<div class="item">
		<li>
		  <div class="slider-info banner-view banner-top2 bg bg2">
			<div class="banner-info">
			  <div class="container">
				<div class="banner-info-bg">
				  <h5>Test COVID</h5>
				  <p>Donec maximus erat quis magna tincidunt, et ullamcorper ex condimentum. Pellentesque 
					volutpat lectus felis, sit amet dapibus tortor convallis sit amet. Quisque egestas sem quis 
					augue porta, et iaculis massa consequat.</p>
					<a class="btn btn-style btn-style-outline mt-sm-5 mt-4" href="#servicios"> Ver servicios</a>
				</div>
			  </div>
			</div>
		  </div>
		</li>
	  </div>
	  <div class="item">
		<li>
		  <div class="slider-info banner-view banner-top3 bg bg2" >
			<div class="banner-info">
			  <div class="container">
				<div class="banner-info-bg">
				  <h5>Mas de 20 años de excelencia</h5>
				  <p>Donec maximus erat quis magna tincidunt, et ullamcorper ex condimentum. Pellentesque 
					volutpat lectus felis, sit amet dapibus tortor convallis sit amet. Quisque egestas sem quis 
					augue porta, et iaculis massa consequat.</p>
					<a class="btn btn-style btn-style-outline mt-sm-5 mt-4" href="#servicios"> Ver servicios</a>
				</div>
			  </div>
			</div>
		  </div>
		</li>
	  </div>
	</div>
  </div>
</div>-->
  <!-- /main-slider -->
</section>
  <!-- w3l-features-photo-7 -->
  <section class="w3l-features-photo-7 py-5" id="servicios">
	  <div class="w3l-features-photo-7_sur py-lg-5 py-sm-3">
		  <div class="container">
			  <div class="row">
				  <div class="col-lg-8 w3l-features-photo-7_top-left">
					  <h2>Servicios</h2>
					  <p class="mb-lg-5 mb-4">Ecografías</p>
					  <h4>En Cedip contamos con nuevas tecnologías para brindar un excelente servicio a nuestros pacientes.</h4>
					  <p>Estudios de diagnóstico.
					  </p>
					  <div class="feat_top">
						  <div class="w3l-features-photo-7-box">
							  <div class="icon">
								<img src="<?= base_url(PATH_ONEPAGE)?>/images/heart.png" class="img-fluid"/>
							  </div>
							  <div class="info-feature">
								  <h5 class="w3l-features-photo-7-box-txt"><a href="#url">Ecografía Abdominal</a></h5>
								  <p>Se utiliza para ver los órganos internos en el abdomen, como el hígado, la vesícula biliar, el bazo, etc.</p>
							  </div>
						  </div>
						  <div class="w3l-features-photo-7-box">
							<div class="icon">
							  <img src="<?= base_url(PATH_ONEPAGE)?>/images/heart.png" class="img-fluid"/>
							</div>
							  <div class="info-feature">
								  <h5 class="w3l-features-photo-7-box-txt"><a href="#url">Ecografía Renovesical</a></h5>
								  <p>Está indicada para el estudio de tamaño, situación y morfología de los riñones y valoración de las paredes de la vejiga urinaria, etc.</p>
							  </div>
						  </div>
						  <div class="w3l-features-photo-7-box">
							<div class="icon">
							  <img src="<?= base_url(PATH_ONEPAGE)?>/images/heart.png" class="img-fluid"/>
							</div>
							  <div class="info-feature">
								  <h5 class="w3l-features-photo-7-box-txt"><a href="#url">Ecografía Testicular</a></h5>
								  <p>Ayuda a diagnosticar enfermedades del cordón espermático y del testículo.</p>
							  </div>
						  </div>
						  <div class="w3l-features-photo-7-box">
							<div class="icon">
							  <img src="<?= base_url(PATH_ONEPAGE)?>/images/heart.png" class="img-fluid"/>
							</div>
							  <div class="info-feature">
								  <h5 class="w3l-features-photo-7-box-txt"><a href="#url">Ecografía Tocoginecológica</a></h5>
								  <p>Es una técnica de exploración no invasiva que, mediante ultrasonidos, nos permite visualizar los genitales internos de la mujer.</p>
							  </div>
						  </div>
						   <div class="w3l-features-photo-7-box">
							<div class="icon">
							  <img src="<?= base_url(PATH_ONEPAGE)?>/images/heart.png" class="img-fluid"/>
							</div>
							  <div class="info-feature">
								  <h5 class="w3l-features-photo-7-box-txt"><a href="#url">Ecografía Transvaginal</a></h5>
								  <p>Es un examen utilizado para ver el útero, los ovarios, las trompas, el cuello uterino y el área pélvica de la mujer.</p>
							  </div>
						  </div>
						   <div class="w3l-features-photo-7-box">
							<div class="icon">
							  <img src="<?= base_url(PATH_ONEPAGE)?>/images/heart.png" class="img-fluid"/>
							</div>
							  <div class="info-feature">
								  <h5 class="w3l-features-photo-7-box-txt"><a href="#url">Ecografía Prostática</a></h5>
								  <p>El ultrasonido de próstata, también llamado ultrasonido transrectal, proporciona imágenes de la glándula prostática y tejidos circundantes.</p>
							  </div>
						  </div>
						   <div class="w3l-features-photo-7-box">
							<div class="icon">
							  <img src="<?= base_url(PATH_ONEPAGE)?>/images/heart.png" class="img-fluid"/>
							</div>
							  <div class="info-feature">
								  <h5 class="w3l-features-photo-7-box-txt"><a href="#url">Ecografía Doppler</a></h5>
								  <p>Es una prueba no invasiva que calcula el flujo de la sangre en los vasos sanguíneos haciendo rebotar ondas sonoras de alta frecuencia.</p>
							  </div>
						  </div>
						   <div class="w3l-features-photo-7-box">
							<div class="icon">
							  <img src="<?= base_url(PATH_ONEPAGE)?>/images/heart.png" class="img-fluid"/>
							</div>
							  <div class="info-feature">
								  <h5 class="w3l-features-photo-7-box-txt"><a href="#url">Ecografía Mamaria</a></h5>
								  <p>Es un examen complementario a la mamografía. Se examina con un ecógrafo tanto las mamas como las axilas.</p>
							  </div>
						  </div>
						   <div class="w3l-features-photo-7-box">
							<div class="icon">
							  <img src="<?= base_url(PATH_ONEPAGE)?>/images/heart.png" class="img-fluid"/>
							</div>
							  <div class="info-feature">
								  <h5 class="w3l-features-photo-7-box-txt"><a href="#url">Ecografía Muscular</a></h5>
								  <p>Permite explorar diversas estructuras del aparato músculo-esquelético, como músculos, tendones, ligamentos, y superficies de huesos.</p>
							  </div>
						  </div>
						   <div class="w3l-features-photo-7-box">
							<div class="icon">
							  <img src="<?= base_url(PATH_ONEPAGE)?>/images/heart.png" class="img-fluid"/>
							</div>
							  <div class="info-feature">
								  <h5 class="w3l-features-photo-7-box-txt"><a href="#url">Ecografía Tiroides</a></h5>
								  <p>Proporciona un mapa detallado de la glándula tiroides con mejor detalle anatómico que la gammagrafía.</p>
							  </div>
						  </div>
					  </div>
				  </div>
				  <div class="col-lg-4 w3l-features-photo-7_top-right mt-lg-0 mt-4">
					  <img src="<?= base_url(PATH_ONEPAGE)?>/images/doctor1.jpg" class="img-fluid" alt="" />
				  </div>
			  </div>
		  </div>
	  </div>
  </section>
  <!-- //w3l-features-photo-7 -->
<section class="w3l-video-sec"  id="nosotros">
	<div class="video-inner py-5">
		<div class="overlay1 py-lg-5 py-sm-3">
			<div class="container">
				<div class="video-content">
					<img src="<?= base_url(PATH_ONEPAGE)?>/images/heart-big.png" class="img-fluid" alt="" />
					<h4><a>Sobre nosotros</a></h4>
					<p>
		  Cedip con mas de 7 años de trayectoria, es una institución dedicada al cuidado de personas. <br>Contamos con una visión exclusiva en diagnóstico por imágenes, con unidades integrales al servicio del paciente, del médico y de las empresas.</p>

				</div>
			</div>
		</div>
	</div>
</section>
<!-- services page block 1 -->
<section class="w3l-features py-5">
	<div class="container py-lg-5 py-3">
		<div class="row main-cont-wthree-2">
			<div class="col-lg-6 feature-grid-right">
				<img src="<?= base_url(PATH_ONEPAGE)?>/images/healthcare.jpg" class="img-fluid" alt="healthcare">
			</div>
			<div class="col-lg-6 feature-grid-left mt-lg-0 mt-sm-5 mt-4">
				<h4 class="title-left">Profesionales</h4>
				<p class="text-para">Nuestra premisa es el máximo confort en tu atención. Nuestro Staff médico se destaca por su prestigio y su solidez académica brindando seguridad y confianza en los tratamientos que se realizan. </p>
				<div class="stats_main text-center">
					<div class="w3l-stats">
						<div class="">
							<img src="<?= base_url(PATH_ONEPAGE)?>/images/patients.png" class="img-fluid">
						</div>
						<div class="info-feature mt-3">
							<h5 class="w3l-stats-txt"><a href="#url">9.649</a></h5>
							<p class="stats-text">Pacientes</p>
						</div>
					</div>
					<div class="w3l-stats">
						<div class="">
							<img src="<?= base_url(PATH_ONEPAGE)?>/images/services.png" class="img-fluid">
						</div>
						<div class="info-feature mt-3">
							<h5 class="w3l-stats-txt"><a href="#url">1.870</a></h5>
							<p class="stats-text">Estudios</p>
						</div>
					</div>
					<div class="w3l-stats">
						<div class="">
							<img src="<?= base_url(PATH_ONEPAGE)?>/images/award.png" class="img-fluid">
						</div>
						<div class="info-feature mt-3">
							<h5 class="w3l-stats-txt"><a href="#url">4</a></h5>
							<p class="stats-text">Profesionales</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //apply-6-->
<section class="w3l-call-to-action_9 py-5">
  <div class="call-w3">
	  <div class="container">
		  <div class=" main-cont-wthree-2">
			  <div class="left-contect-calls text-center">
				  <h3 class="title mb-sm-5 mb-4">Confían en nosotros</h3>
				<div class="call-grids-w3 ">
					  <a href="#url" class="">
						  <img src="<?= base_url(PATH_ONEPAGE)?>/images/logo1.png" class="img-fluid" alt="">
					  </a>

					  <a href="#url" class="">
						  <img src="<?= base_url(PATH_ONEPAGE)?>/images/logo2.png" class="img-fluid" alt="">
					  </a>
					  <a href="#url" class="">
						  <img src="<?= base_url(PATH_ONEPAGE)?>/images/logo3.png" class="img-fluid" alt="">
					  </a>
					  <a href="#url" class="">
						  <img src="<?= base_url(PATH_ONEPAGE)?>/images/logo4.png" class="img-fluid" alt="">
					  </a>
					  <a href="#url" class="">
						  <img src="<?= base_url(PATH_ONEPAGE)?>/images/logo5.png" class="img-fluid" alt="">
					  </a>
				  </div>
			  </div>
		  </div>
	  </div>
  </div>
</section>
<!-- services page block 1 -->
<section class="w3l-apply-6" id="contacto">
	<!-- /apply-6-->
	<div class="apply-info py-5">
		<div class="container py-lg-5 py-sm-3">
			<div class="apply-grids-info row">
				<div class="apply-gd-left col-lg-5">
					<h4>Contacto</h4>
					<!-- <p class="para-apply">Servicio de atención las 24hs.
						<br><strong></strong> Tel: 1-2554-2356-33
					</p> -->
					<div class="mt-lg-5 mt-4">
						<div class="sub-apply mt-5">
							<div class="apply-sec-info">
								<div class="icon">
									<span class="fa fa-phone"></span>
								</div>
								<div class="appyl-sub-icon-info">
									<h5><a href="blog-single.html">Teléfonos</a></h5>
									<a href="tel:3574406322" class="learn">WhatsApp 3574 40-6322 <i class="fa fa-long-arrow-right ml-2"></i></a>
				  <a href="tel:3574480133" class="learn">Fijo (03574) 480133 <i class="fa fa-long-arrow-right ml-2"></i></a>
								</div>
							</div>
						</div>
						<div class="sub-apply mt-5">
							<div class="apply-sec-info">
								<div class="icon">
									<span class="fa fa-map"></span>
								</div>
								<div class="appyl-sub-icon-info">
									<h5><a href="blog-single.html">Dirección</a></h5>
									<a href="https://www.google.com/maps/place/Rivadavia+949,+Villa+Santa+Rosa,+C%C3%B3rdoba/data=!4m2!3m1!1s0x94331a03848e475b:0xa28526c443b4a3d4?sa=X&ved=2ahUKEwjCqoin1a_tAhUVHbkGHec3A4MQ8gEwAHoECAUQAQ" class="learn">Rivadavia 949, Villa Santa Rosa, Córdoba.<i class="fa fa-long-arrow-right ml-2"></i></a>
								</div>
							</div>
						</div>
						<div class="sub-apply mt-5">
							<div class="apply-sec-info">
								<div class="icon">
									<span class="fa fa-envelope"></span>
								</div>
								<div class="appyl-sub-icon-info">
									<h5><a href="blog-single.html">Email</a></h5>
									<a href="mailto:info@cedipcentromedico.com" class="learn">info@cedipcentromedico.com</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="apply-gd-right offset-lg-1 col-lg-6 mt-lg-0 mt-5">
				
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3414.5042775453453!2d-63.40249168535894!3d-31.151278981493228!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x943310aaa0791eb9%3A0xec22dbbb24c446d3!2sCedip+Centro+Medico!5e0!3m2!1ses!2sar!4v1476311670552" style="width: 100%;" height="100%" frameborder="0" allowfullscreen=""></iframe>
			
				</div>
			</div>
		</div>
	</div>
</section>

  <!-- footer-28 block -->
  <section class="w3l-medpill-footer ">
	<footer class="footer-28">
	  <div class="midd-footer-28 align-center py-lg-4 py-3 mt-md-5 mt-3">
		<div class="container">
		  <p class="copy-footer-28 text-center"> &copy; Copyright 2020 © Desarrollado por <a
			  href="http://pilsendigital.com/">Pilsen Digital.</a></p>
		</div>
	
	  </div>
	</footer>

	<!-- move top -->
	<button onclick="topFunction()" id="movetop" title="Go to top">
	  &#10548;
	</button>
	<script>

	  window.onscroll = function () {
		scrollFunction()
	  };

	  function scrollFunction() {
		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		  document.getElementById("movetop").style.display = "block";
		} else {
		  document.getElementById("movetop").style.display = "none";
		}
	  }

	  function topFunction() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	  }
	</script>
	<!-- /move top -->

	<script src="<?= base_url(PATH_ONEPAGE)?>/js/jquery-3.3.1.min.js"></script>
	
	<script src="<?= base_url(PATH_ONEPAGE)?>/js/green-audio-player.js"></script>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			new GreenAudioPlayer('.ready-player-1', { stopOthersOnPlay: true });
		});
	</script>

	<!-- video popup -->
	<script>
	  $('#notify').change(function () {
		if ($('#notify').is("Active")) {
		  $('body').css('overflow', 'hidden');
		} else {
		  $('body').css('overflow', 'auto');
		}
	  });
	</script>
	<!-- //video popup -->

	<script src="<?= base_url(PATH_ONEPAGE)?>/js/owl.carousel.js"></script>
	<!-- script for banner slider-->
	<script>
	  $(document).ready(function () {
		$('.owl-one').owlCarousel({
		  loop: true,
		  margin: 0,
		  nav: false,
		  responsiveClass: true,
		  autoplay: false,
		  autoplayTimeout: 5000,
		  autoplaySpeed: 1000,
		  autoplayHoverPause: false,
		  responsive: {
			0: {
			  items: 1,
			  nav: false
			},
			480: {
			  items: 1,
			  nav: false
			},
			667: {
			  items: 1,
			  nav: true
			},
			1000: {
			  items: 1,
			  nav: true
			}
		  }
		})
	  })
	</script>
	<!-- //script -->
	
  <!-- disable body scroll which navbar is in active -->
  <script>
	$(function () {
	  $('.navbar-toggler').click(function () {
		$('body').toggleClass('noscroll');
	  })
	});
  </script>
  <!-- disable body scroll which navbar is in active -->

	<script src="<?= base_url(PATH_ONEPAGE)?>/js/bootstrap.min.js"></script>

	</body>

	</html>