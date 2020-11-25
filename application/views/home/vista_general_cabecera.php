<!DOCTYPE html>
<html>
<head>
<title><?php echo $template->getTitulo();?></title>
<link href="<?php echo base_url()?>recursos/home/css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="<?php echo base_url()?>recursos/home/css/style_1.css" type="text/css" rel="stylesheet" media="all">
<link rel="stylesheet" href="<?php echo base_url(); ?>recursos/css/chosen.min.css">
<link rel="icon" type="image/png" href="<?php echo base_url(); ?>recursos/img/pagina/cedip_ico.ico"/>
<style>
    .chosen-single{
        height: 35px !important;
    }
    
    .banner{
        min-height: 650px;
        background: url(<?php echo base_url()?>recursos/home/images/<?php echo $template->getFondoDeslizante();?>) no-repeat 0px -196px;
        background-size: cover;
      }
</style>
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
	<?php echo $template->getHeader();?>
	<!--//header-->
        <!--header-bottom-->
            <?php echo $template->getMenu();?>
        <!--//header-bottom-->
        <!--banner-->
            <?php 
            if($slider)
            {
                echo $template->getBanner();
            }?>
        <!--//banner-->