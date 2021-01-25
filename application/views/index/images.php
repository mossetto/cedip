<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<style>
	body{
		background: rgb(92,155,194);
background: linear-gradient(30deg, rgba(92,155,194,1) 0%, rgba(220,227,232,1) 91%);
	}
	.imagen-estudio{
		height: 100%;
		display: flex;
		justify-content: center;
	}
	.imagen-estudio img{
		width: 100%;
		margin-right: 0!important;
		margin-bottom: 10px;
	}
	.btn-volver a{
		color: white!important;
	}
</style>
<script>
let btnDownload = document.querySelector('button');
let img = document.querySelector('img');
 
// Must use FileSaver.js 2.0.2 because 2.0.3 has issues.
btnDownload.addEventListener('click', () => {
	let imagePath = img.getAttribute('src');
	let fileName = getFileName(imagePath);
	saveAs(imagePath, fileName);
});
 
function getFileName(str) {
	return str.substring(str.lastIndexOf('/') + 1)
}
</script>
<body>
	<div class="container mt-3">
		<div class="row">
			<div class="col-12">
				<button class="btn btn-primary mb-3 btn-volver"><a href="<?= base_url(); ?>index.php/index/estudios">Volver</a></button>
			</div>
<?php
	//var_dump($imagenes);
	if(is_array($imagenes)){
		for($i=0; $i < count((is_countable($imagenes)?$imagenes:[])); $i++){
			if(getimagesize(base_url()."recursos/img/pacientes/".$imagenes[$i])) {
?>

			<!-- inicio item -->
			<div class="col-12 d-flex flex-column mb-3">
				<div class="imagen-estudio">
					<!--<img src="https://picsum.photos/id/234/180/100" alt="">-->
					<img src="<?= base_url()."recursos/img/pacientes/".$imagenes[$i]; ?>" style="margin-right: 10px;margin-top: 10px;" alt="imagen">
				</div>
				<button class="btn btn-primary btn-volver">
					<a style="display: flex; justify-content: center;" href="<?= base_url()."recursos/img/pacientes/".$imagenes[$i]; ?>" download target="_blank">
					Descargar Archivo
					</a>
				</button>
			</div>
			<!-- fin item -->
<?php
			}
		}
	}
?>
<!--
			<div class="col-12 d-flex flex-column mb-3">
				<div class="imagen-estudio">
					<img src="https://picsum.photos/id/237/200/300" alt="">
				</div>
				<button class="btn btn-volver">
					<a style="display: flex; justify-content: center;" href="https://picsum.photos/id/237/200/300" download target="_blank">
					Descargar Archivo
					</a>
				</button>
			</div>



			<div class="col-12 d-flex flex-column mb-3">
				<div class="imagen-estudio">
					<img src="https://picsum.photos/id/214/200/100" alt="">
				</div>
				<button class="btn btn-volver">
					<a style="display: flex; justify-content: center;" href="https://picsum.photos/id/237/200/300" download target="_blank">
					Descargar Archivo
					</a>
				</button>
			</div>
-->			
		</div>
	</div>
	
</body>
</html>