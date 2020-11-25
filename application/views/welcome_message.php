<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Free coming soon template with jQuery countdown">
    <meta name="author" content="http://bootstraptaste.com">
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <title>Cedip</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>construccion/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>construccion/css/bootstrap-theme.css" rel="stylesheet">

    <!-- siimple style -->
    <link href="<?php echo base_url(); ?>construccion/css/style.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

	<div id="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<h1>Estamos trabajando!</h1>
					<h2 class="subtitle">En breve podra acceder al portal</h2><br>
					 <img src="<?php echo base_url(); ?>construccion/img/logo.png">
				</div>
				
			</div>
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3">
						<p class="copyright">Copyright © 2016. Desarrollado por<a href="http://pilsendigital.com/"> pilsendigital.com</a></p>
                        <!-- 
                            All links in the footer should remain intact. 
                            Licenseing information is available at: http://bootstraptaste.com/license/
                            You can buy this theme without footer links online at: http://bootstraptaste.com/buy/?theme=WeBuild
                        -->
				</div>
			</div>		
		</div>
	</div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url(); ?>construccion/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>construccion/js/jquery.countdown.min.js"></script>
	<script type="text/javascript">
            $('#countdown').countdown('2015/01/01', function(event) {
              $(this).html(event.strftime('%w weeks %d days <br /> %H:%M:%S'));
            });
        </script>
  </body>
</html>