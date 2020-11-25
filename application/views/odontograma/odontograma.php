<style>
	.renglon{
		border-width: 1px;
		border-color: #000;
		border-style: solid;
		min-height: 40px;
	}

	.linea_a_la_derecha{
		border-color: #000;border-style: solid;border-width: 3px;border-left-width: 0px;border-top: 0px;border-bottom: 0px;
	}

	.linea_abajo{
		border-color: #000;border-style: solid;border-width: 3px;border-left-width: 0px;border-top: 0px;border-right: 0px;
	}

	.linea_abajo_derecha{
		border-color: #000;
		border-style: solid;
		border-width: 3px;
		border-left-width: 0px;
		border-top-width: 0px;
		border-right-width: 3px;
		border-top-width: 3px;
	}

	.tabla_grafico td{text-align: center;font-weight: bold;}
	.tabla_grafico img{width: 40px;}

</style>


		<div class="renglon">
			<div class="col-md-6">
				<h4>PACIENTE: <?php echo $historia_clinica["pacientes_nombre"]." ".$historia_clinica["pacientes_apellido"] ?></h4>
			</div>
			<div class="col-md-6">
				<h4>N° AFIL: <?php echo $historia_clinica["pacientes_num_afiliado"]?></h4>
			</div>
		</div>

		<div class="clearfix"></div>
		<br>

		<div class="col-md-3">
			<p><strong>Titular:</strong></p> <input type="text" name="" class="form-control" disabled="" value="<?php echo $historia_clinica["pacientes_titular"]?>">
		</div>
		<div class="col-md-3">
			<p><strong>Grupo Familiar:</strong></p> <input type="text" name="" class="form-control" disabled="" value="<?php echo $historia_clinica["pacientes_grupo_familiar"]?>">
		</div>
		<div class="col-md-3">
			<p><strong>Parentesco:</strong></p> <input type="text" name="" class="form-control" disabled="" value="<?php echo $historia_clinica["pacientes_parentesco"]?>">
		</div>
		<div class="col-md-3">
			<p><strong>Fecha de Nac:</strong></p>
			<input type="text" name="" class="form-control" value="<?php echo $historia_clinica["pacientes_nacimiento"]?>" disabled>
			
		</div>

		<div class="clearfix"></div>

		<br>

		<div class="col-md-12">
			<p><strong>Domicilio(calle,num,barrio,localidad):</strong></p>
			<input type="text" name="" class="form-control" value='<?php echo $historia_clinica["pacientes_direccion"]?> - <?php echo $historia_clinica["localidades_descripcion"]?>' disabled>
		</div>

		<div class="clearfix"></div>

		<br>

		<div class="col-md-3">
			<p><strong>Tel/Cel:</strong></p> 
			<input type="text" name="" class="form-control" value="<?php echo $historia_clinica["pacientes_telefono"]?> / <?php echo $historia_clinica["pacientes_celular"]?>" disabled>
		</div>
		<div class="col-md-6">
			<p><strong>Lugar de trabajo del titular:</strong></p> <input type="text" name="" class="form-control" disabled="" value="<?php echo $historia_clinica["pacientes_lugar_trabajo_titular"]?>">
		</div>
		<div class="col-md-3">
			<p><strong>Jerarquía:</strong></p> <input type="text" name="" class="form-control" disabled="" value="<?php echo $historia_clinica["pacientes_jerarquia_trabajo_titular"]?>">
		</div>

		<div class="clearfix"></div>

		<br>

		<div class="col-md-8">
			<p><strong>E-Mail:</strong> <?php echo $historia_clinica["pacientes_correo"]?></p>
		</div>

		<div class="col-md-4">
			<div class="col-md-4">
				<p><strong>SEXO:</strong></p>
			</div>
			<div class="col-md-8">

				<?php 
				if($historia_clinica["pacientes_sexo"] =="m")
				{?>
					<p><strong>M&nbsp;&nbsp;<input type="checkbox" name="" checked disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				F&nbsp;&nbsp;<input type="checkbox" name="" disabled></strong></p>
				<?php
				} else  { ?>
					<p><strong>M&nbsp;&nbsp;<input type="checkbox" name=""  disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				F&nbsp;&nbsp;<input type="checkbox" name="" checked disabled></strong></p>
				<?php
				}?>
				
			</div>
		</div>

<!--<div class="col-md-12" style="border-width: 1px;border-color: #000; border-left-width: 0px; border-style: solid;height: 280px;">
	<h3 style="text-decoration:underline;">Referencias</h3>
	<p>
		<strong class="text-danger">Color Rojo:</strong> Prestaciones Existentes 
		&nbsp;&nbsp;&nbsp;&nbsp;
		<strong class="text-blue">Color Azul:</strong> 
		Prestaciones requeridas x diente ausente a extraer Coronas</p>

	<p style="text-align: center;"><strong>Cantidad de dientes existentes</strong> <input type="number"</p>
</div>-->
		<br><br>
		<div>
			<div class="alert alert-danger" role="alert">
				<h4>Recuerde: Presionar en el boton guardar, para que sus cambios seas guardados!</h4>
			</div>
		</div>
<button id="btn_seleccion_1" class="btn btn-sm btn-default text-danger" style="color: #a94442;font-weight: bold;" onclick="setear_color('#a94442')">
	<img src="<?php echo base_url() ?>recursos/odontograma/pencil_red.png">
</button>

<button id="btn_seleccion_2" class="btn btn-sm btn-default text-blue active" style="font-weight: bold;" onclick="setear_color('#0073b7')">
	<img src="<?php echo base_url() ?>recursos/odontograma/pencil_blue.png">
</button>

<button id="btn_seleccion_3" class="btn btn-sm btn-default text-blue" style="font-weight: bold;" onclick="activar_borrador()">
	<img src="<?php echo base_url() ?>recursos/odontograma/eraser.png">
</button>

<canvas id="canvas" style="background-color: #ccc;background-image: url('<?php echo base_url() ?>recursos/odontograma/fondo.png')">MARIO</canvas>

<div class="col-md-9" style="border-width: 1px;border-color: #000; border-style: solid;min-height: 200px;">
	<p><strong>Observaciones:</strong></p>

	<textarea class="form-control" style="min-height: 150px" id="observaciones"><?php echo $odontograma["observaciones"]?></textarea>
</div>

<div class="col-md-3" style="border-width: 1px;border-color: #000; border-left-width: 0px; border-style: solid;min-height: 200px;"">				
	<h3 style="text-decoration:underline;">Reservado Obra Social</h3>
	<textarea class="form-control" style="min-height: 120px" id="reservado_os"><?php echo $odontograma["reservado_os"]?></textarea>
</div>

<div class="clearfix"></div>


<div style="text-align: center;margin-top: 20px;">
	<button class="btn btn-success" onclick="guardar_odontograma();"><i class="fa fa-save"></i> Guardar Cambios</button>
</div>

<script type="text/javascript">
		

/* ESTE ARREGLO GUARDA LOS MOVIMIENTOS QUE SE PUSIERON
	es un arreglo multidimensional que guarda, punto x punto y, 
	color
	ancho y alto de la figura
	 y si es borrador o dibujo
*/

var movimientos_dibujados= new Array();

var estoyDibujando ,lienzo,ctx;

var color= "#0073b7";	
var borrador=false;	

function setear_color(colour)
{
	color= colour;
	borrador=false;

	$("[id*=btn_seleccion_]").removeClass("active");

	if(colour == "#0073b7")
	{
		$("#btn_seleccion_2").addClass("active");
	}
	else
	{
		$("#btn_seleccion_1").addClass("active");
	}
}

function activar_borrador()
{
	borrador=true;
	$("[id*=btn_seleccion_]").removeClass("active");
	$("#btn_seleccion_3").addClass("active");
}

function comenzar(){
					
	lienzo = document.getElementById('canvas');
	lienzo.width=1048;
 	lienzo.height=413;
 	ctx = lienzo.getContext('2d');

 	ctx.lineWidth=4; 
 	
 	/*
 	var img = new Image();
    img.src = "<?php echo base_url() ?>recursos/odontograma/fondo.png";

    img.onload = function(){
      ctx.drawImage(img, 0, 0);
    }
    */

    // LECTURA Y ESCRITURA DE LOS MOVIMIENTOS GUARDADOS EN DB


    var config = '<?php echo $odontograma["config"];?>';

    if($.trim(config) != "")
    {
    	config = JSON.parse('<?php echo $odontograma["config"];?>');

    	if(config.length > 0)
	    {
	    	movimientos_dibujados= config;

	    	for(var i=0; i < movimientos_dibujados.length;i++)
	    	{
	    		var x = movimientos_dibujados[i]["x"];
		    	var y = movimientos_dibujados[i]["y"];

	    		if(x != -1 && y != -1)
	    		{
	    			if((i - 1) >= 0)
	    			{
	    				var x_anterior = movimientos_dibujados[i-1]["x"];
		    			var y_anterior = movimientos_dibujados[i-1]["y"];

		    			if(x_anterior == -1 && y_anterior == -1)
		    			{
		    				ctx.beginPath();
		    			}
	    			}

	    			var color = movimientos_dibujados[i]["color"];
		    		
		    		var borrador= movimientos_dibujados[i]["borrador"];

		    		ctx.strokeStyle=color;

		    		if(borrador)
		    		{
		    			ctx.clearRect(x,y, -70, 70);
		    		}
		    		else
		    		{
		    			if(x != -1)
		    			{
		    				ctx.lineTo(x,y);
		    			}
		    		}

		    		ctx.stroke();
	    		}
	    		else
	    		{
	    			ctx.closePath();
	    		}
	    	}

	    	ctx.closePath();
	    }
    }
}

function guardar_odontograma()
{
	var observaciones = $("#observaciones").val();
	var reservado_os = $("#reservado_os").val();

	$.ajax({
		url: "<?php echo base_url() ?>index.php/Secretaria/guardar_odontograma",
		type: "POST",
		data: {id_historia_clinica:<?php echo $historia_clinica["codigo"] ?>,movimientos_dibujados:JSON.stringify(movimientos_dibujados),observaciones:observaciones,reservado_os:reservado_os
		},

		beforeSend: function(data){
		},

		success: function(data){
			data = JSON.parse(data);

			if(data)
			{
				location.reload();
			}
			else
			{
				alert("HA OCURRIDO UN ERROR");
			}
		},

		error: function(error){
			alert("HA OCURRIDO UN ERROR");
		}
	});
}

$(document).ready(function(){

	comenzar();

	$('#canvas').mousedown(function(e){
		estoyDibujando = true;
	//Indico que vamos a dibujar
	ctx.beginPath();

	//Averiguo las coordenadas X e Y por dónde va pasando el ratón
	ctx.moveTo(e.pageX - this.offsetLeft,
          e.pageY - this.offsetTop);
    });

    $('#canvas').mousemove(function(e){
    	if(estoyDibujando){
			//indicamos el color de la línea
			ctx.strokeStyle=color;

			var x =e.pageX - this.offsetLeft;
			var y =e.pageY - this.offsetTop

			//Por dónde vamos dibujando
			if(borrador == false)
			{

				ctx.lineTo(x,y);

              	movimientos_dibujados.push({
					x:x,
					y:y,
					color:color,
					borrador:borrador
				});
			}
			else
			{
				ctx.clearRect(x+30,y-30, -70, 70);

				movimientos_dibujados.push({
					x:x+30,
					y:y-30,
					color:color,
					borrador:borrador
				});
			}

			ctx.stroke();
		}
    });

    $('#canvas').mouseup(function(e){
      	ctx.closePath();

      	movimientos_dibujados.push({
			x:-1,
			y:-1,
			color:"",
			borrador:false
		});

		estoyDibujando = false;
    });

    $('#canvas').mouseleave(function(e){
      estoyDibujando = false;
    });
});

</script>