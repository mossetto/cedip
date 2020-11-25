<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Doctor Plus a Medical Category Flat bootstrap Responsive website Template | Home :: w3layouts</title>
<link href="<?php echo base_url()?>recursos/home/css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="<?php echo base_url()?>recursos/home/css/style.css" type="text/css" rel="stylesheet" media="all">
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Doctor Plus Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Custom Theme files -->
<!-- js -->
<script src="<?php echo base_url()?>recursos/home/js/jquery-1.11.1.min.js"></script> 
<!-- //js -->	
<!-- start-smoth-scrolling-->
<script type="text/javascript" src="<?php echo base_url()?>recursos/home/js/move-top.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>recursos/home/js/easing.js"></script>	
<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
</script>
<!--//end-smoth-scrolling-->
</head>
<body>
	<!--header-->
	<div class="header">
		<div class="container">
			<div class="header-logo">
				<a href="index.html"><img src="images/logo.png" alt="logo"/></a>					
			</div>
			<div class="header-info">
				<p>Information Service:</p>
				<h4>000-1234-1234</h4>
			</div>			
			<div class="clearfix"> </div>
		</div>	
	</div>
	<!--//header-->
	<!--header-bottom-->
	<div class="header-bottom">
		<div class="container">
			<!--top-nav-->
			<div class="top-nav cl-effect-5">
				<span class="menu-icon"><img src="images/menu-icon.png" alt=""/></span>		
				<ul class="nav1">
					<li><a href="index.html" class="active"><span data-hover="Home">Home</span></a></li>
					<li><a href="about.html"> <span data-hover="About">About</span></a></li>
					<li><a href="services.html"> <span data-hover="Services">Services</span></a></li>
					<li><a href="news.html"> <span data-hover="News">News</span></a></li>
					<li><a href="contact.html"> <span data-hover="Contact">Contact</span></a></li>
				</ul>
				<!-- script-for-menu -->
				<script>
				   $( "span.menu-icon" ).click(function() {
					 $( "ul.nav1" ).slideToggle( 300, function() {
					 // Animation complete.
					  });
					 });
				</script>
				<!-- /script-for-menu -->
			</div>
			<!--//top-nav-->
			<form class="navbar-form navbar-right">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
					<button type="submit" class="btn btn-default"></button>
				</div>		
			</form>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//header-bottom-->
	<!--banner-->
	<div class="banner">
		<div class="container ">
			<!-- banner-text Slider starts Here -->
			<script src="<?php echo base_url()?>recursos/home/js/responsiveslides.js"></script>
			 <script>
				// You can also use "$(window).load(function() {"
					$(function () {
					// Slideshow 4
						$("#slider3").responsiveSlides({
						auto: true,
						pager:true,
						nav:false,
						speed: 500,
						namespace: "callbacks",
						before: function () {
						$('.events').append("<li>before event fired.</li>");
						},
						after: function () {
							$('.events').append("<li>after event fired.</li>");
						}
					});	
				});
			</script>
			<!--//End-slider-script -->
			<div  id="top" class="callbacks_container">
				<ul class="rslides" id="slider3">
					<li>
						<div class="banner-text">		
							<h1>We are here to care for you</h1>
							<p>Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
						</div>
					</li>
					<li>
						<div class="banner-text">		
							<h1>Lorem ip sum avai re for cayou</h1>
							<p>Majority have sufferedorem lipsum available, but the  alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
						</div>
					</li>
					<li>
						<div class="banner-text">		
							<h1>Availf able lor emip cayou refor</h1>
							<p>Randomised words orem ipsum available, but the majority have suffered alteration in some form, by injected humour, or which don't look even slightly believable.</p>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!--//banner-->
	<!--banner-bottom-->
	<div class="banner-bottom">
		<div class="container">
			<h2>Lorem Ipsum was popularised in the with the release of Letraset sheets containing</h2>
			<a href="#gallery" class="arrow scroll"> </a>
		</div>
	</div>
	<!--//banner-bottom-->
	<!--gallery-->
	<div class="gallery" id="gallery">
		<div class="col-md-6 gallery-left">
			<h4>Letraset sheets</h4>
			<p>Lorem Ipsum was popularised in the with the release of Letraset sheets contai ningthe with the release of </p>
		</div>
		<div class="col-md-6 gallery-right">
			<div class="gallery-grid-a">
				<h4>Letraset sheets</h4>
				<p>Lorem Ipsum was popularised in the with the release of Letraset sheets contai ningthe with the release of </p>
			</div>	
			<div class="gallery-grid-b">		
				<h4>Letraset sheets</h4>
			<p>Lorem Ipsum was popularised in the with the release of Letraset sheets contai ningthe with the release of </p>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
	<!--//gallery-->
	<!--work-->
	<div class="work">		
		<div class="container">	
			<div class="work-title">
				<h3>More projects</h3>
				<p>Lorem Ipsum was popularised in the with the release of Letraset sheets contai ningthe</p>
			</div>
			<div class="col-md-4 work-grids">
				<ul>
					<li><img src="images/icon2.png" alt=""></li>
					<li>
						<h4>Quas molestias excep</h4>
						<p>praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
					</li>
				</ul>
			</div>	
			<div class="col-md-4 work-grids">
				<ul>
					<li><img src="images/icon3.png" alt=""></li>
					<li>
						<h4>occaecati cupiusint</h4>
						<p>praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
					</li>
				</ul>
			</div>
			<div class="col-md-4 work-grids">
				<ul>
					<li><img src="images/icon4.png" alt=""></li>
					<li>
						<h4>Excepturi sint occa</h4>
						<p>praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
					</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//work-->
	<div class="like">		
		<div class="container">
			<div class="work-title">
				<h3>Stay connected with us</h3>
				<p class="cnnct">Lorem Ipsum was popularised in the with the release of Letraset sheets contai ningthe</p>
			</div>
			<div class="col-md-3 like-grids">
				<a href="#">
					<img src="images/icon1.png" alt=""/>
				</a>
				<p>Facebook</p>
			</div>
			<div class="col-md-3 like-grids">
				<a href="#">
					<img src="images/icon5.png" alt=""/>
				</a>
				<p>Twitter</p>
			</div>
			<div class="col-md-3 like-grids">
				<a href="#">
					<img src="images/icon6.png" alt=""/>
				</a>
				<p>Pinterest</p>
			</div>
			<div class="col-md-3 like-grids">
				<a href="#">
					<img src="images/icon7.png" alt=""/>
				</a>
				<p>Googleplus</p>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--map-->
	<div class="map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d24195.46256216959!2d-74.0042145!3d40.7084875!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1434980604138"></iframe>
		<div class="container">	
			<div class="map-info">
				<ul>
					<li>Head office</li>
					<li>Anore Road-22</li>
					<li>New York,USA-0000</li>
					<li>111 222 555</li>
				</ul>
			</div>
		</div>
	</div>
	<!--//map-->
	<!--footer-->
	<div class="footer">
		<div class="container">
			<div class="footer-grids">				
				<div class="col-md-4 recent-posts">
					<h4>Recent posts</h4>
					<div class="recent-posts-text">
						<h5>MARCH 30, 2015</h5>
						<p>Duis autem vel eum iriure dolor</p>
					</div>
					<div class="recent-posts-text">
						<h5>MARCH 15, 2015</h5>
						<p>Duis autem vel eum iriure dolor</p>
					</div>
					<div class="recent-posts-text">
						<h5>MARCH 3, 2015</h5>
						<p>Duis autem vel eum iriure dolor</p>
					</div>
				</div>
				<div class="col-md-4 recent-posts">
					<h4>Twitter feeds</h4>
					<div class="recent-posts-text">
						<h5>about 2 days ago<span>@kristit</span></h5>
						<p>Good work buddy</p>
					</div>
					<div class="recent-posts-text">
						<h5>about 2 days ago <span>@fasteven</span></h5>
						<p>Good work buddy</p>
					</div>
					<div class="recent-posts-text">
						<h5>about 2 days ago <span>@streamer</span> </h5>
						<p>Good work buddy</p>
					</div>
				</div>
				<div class="col-md-4 recent-posts">
					<h4>Our address</h4>
					<p class="adrs">Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus,
						 facilisi Nam liber tempor cum soluta </p>
					<ul>
						<li><span></span>Moonshine St. 14/05 Light, Japan</li>
						<li><span class="ph-no"></span>+00 (123) 111 11 11</li>
						<li><span class="mail"></span><a href="mailto:example@mail.com">mail@example.com</a></li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>	
	</div>	
	<!--//footer-->
	<div class="footer-bottom">
		<div class="container">
			<p>Copyright © 2015 Doctor Plus. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
		</div>
	</div>
	<!--smooth-scrolling-of-move-up-->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!--//smooth-scrolling-of-move-up-->
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url()?>recursos/home/js/bootstrap.js"> </script>
</body>
</html>