<!-- BEGIN MODAL -->
    <div class="modal fade" id="modalingresar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="box">
                            <div class="box-header">
                              <h3 class="box-title text-center"> <i class='menu-icon fa fa-user bg-red'></i> Ingresar</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-6 col-md-offset-3 ">
                                            <div class="form-group">
                                                <label for="dni">DNI</label>
                                                <input type="text" class="form-control" id="dni_ingresar" name="dni_ingresar"/>
                                            </div>

                                            <div class="form-group">
                                                <label for="contrasenia_ingresar">Contraseña</label>
                                                <input type="password" id="password_ingresar" class="form-control"/>
                                            </div>

                                            <div class="form-group">
                                                <p id="modal_ingresar_mensaje"></p>
                                                <button class="btn btn-success form-control" id="btn_iniciar_sesion" onClick="iniciarSesionPaciente()"> <i class='menu-icon fa fa-sign-out bg-red'></i> Ingresar </button>
                                                <!--<input type="button" class="btn btn-success form-control" id="btn_iniciar_sesion" value="Ingresar"/>-->
                                            </div>
                                            <div class="form-group">
                                                <span style="color: #f00;" id="mensaje_inicio_sesion_paciente"></span>
                                            </div>
                                    </div>
                                </div>
                            </div>
                      <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- FIN MODAL -->

    <div class="modal fade" id="modalturnero" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="box">
                            <div class="box-header">
                              <h3 class="box-title text-center"> <i class='menu-icon fa fa-user bg-red'></i>Turnero</h3>
                              <input type="text"  hidden="true" id="profesional_turnero_paciente" value=""/>
                              <input type="text" hidden="true" id="especialidad_turnero_paciente" value=""/>
                              <select id="select_mes_filtro_turnero">
                                  <option value="1">Enero</option>
                                  <option value="2">Febrero</option>
                                  <option value="3">Mayo</option>
                                  <option value="4">Abril</option>
                                  <option value="5">Marzo</option>
                                  <option value="6">Junio</option>
                                  <option value="7">Julio</option>
                                  <option value="8">Agosto</option>
                                  <option value="9">Septiembre</option>
                                  <option value="10">Otubre</option>
                                  <option value="11">Noviembre</option>
                                  <option value="12">Diciembre</option>
                              </select>
                              <select id="select_anio_filtro_turnero">
                                  
                              </select>
                              <input type="button" class="btn btn-primary" value="filtrar" onClick="filtro_turnero()"/>
                              
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class='col-md-12 col-sm-12 col-xs-12' id='div_calendario'>
                                        <!-- Form Element sizes -->
                                        <div class='box box-success'>
                                          <div class='box-header with-border'>
                                            
                                          </div>
                                          <div class='box-body'>

                                            <div id='calendario' style='width: 100%;margin-top: 10px;'>
                                                    <div class='col-md-12 col-xs-12 col-sm-12 sinpadding' style='background-color: #53a3a3;width: 100%;text-align:center;'>
                                                            <!--<input style='float:left;background-color:#04b173;' type='button' class='btn btn-default' value='<' onClick='mes_anterior(&#039;calendario&#039;)'/>-->
                                                            <span style='font-size: 22px;;color:#fff;' id='calendario_mes'></span>
                                                            <!--<input style='float:right;background-color:#04b173;' type='button' class='btn btn-default' value='>' onClick='mes_siguiente(&#039;calendario&#039;)'/>-->
                                                    </div>
                                                    <div id='nombres_dia' class='col-md-12 col-sm-12 col-xs-12'>

                                                    </div>
                                                    <!-- MESES -->
                                                    <div id='calendario_botonera' class='col-md-12 col-sm-12 col-xs-12 sinpadding'>
                                                    <!-- ENERO -->

                                                    </div>
                                            </div>
                                            </div>
                                                <!-- /.box-body -->
                                              </div>
                                              <!-- /.box -->

                                    </div>
                                </div>
                            </div>
                      <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- FIN MODAL -->
<!-- BEGIN MODAL 'S-->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="box">
                        <div class="box-header">
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="cuerpo-modal">
                            
                        </div>
                  <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- BEGIN MODAL -->
<!--footer-->
	<div class="footer">
		<div class="container">
			<div class="footer-grids">
                            <div class="col-md-8 col-xs-12 recent-posts">
					<h4>Encuentranos</h4>
					<div class="col-md-12 col-xs-12">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3414.5042775453453!2d-63.40249168535894!3d-31.151278981493228!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x943310aaa0791eb9%3A0xec22dbbb24c446d3!2sCedip+Centro+Medico!5e0!3m2!1ses!2sar!4v1476311670552"  style='width: 100%;' height='300' frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
                            </div>
				<!--<div class="col-md-4 recent-posts">
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
				</div>-->
				<div class="col-md-4 col-xs-12 recent-posts">
					<h4>Contacto</h4>
					<!--<p class="adrs">Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus,
						 facilisi Nam liber tempor cum soluta </p>-->
					<ul>
						<li><span></span><?php echo $template->getLocalizacion();?></li>
						<li><span class="ph-no"></span><?php echo $template->getTelefono();?></li>
						<li><span class="mail"></span><a href="mailto:example@mail.com"><?php echo $template->getCorreo();?></a></li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>	
	</div>	
	<!--//footer-->
	<div class="footer-bottom">
		<div class="container">
			<p>Copyright © 2016 Cedip. Todos los derechos reservados | Desarrollado por <a href="http://alessoweb.com">AlessoWeb</a></p>
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
    <script src="<?php echo base_url()?>recursos/home/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>recursos/js/chosen.jquery.min.js"></script>
    
    <script>
        
    </script>
    <script>
        var meses = new Array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        var fecha_actual = new Date();
        var anio_actual = fecha_actual.getFullYear();
        var mes_actual = fecha_actual.getMonth()+1;
        var calendario = new MarioOliveraCalendar(meses,mes_actual,"calendario","calendario_botonera","calendario_mes");	
        
        $(document).ready(function(){
            
            $('.chosen-select').chosen({no_results_text: 'Oops, nothing found!'});
            
            //ANCLA:
            $('a.ancla').click(function(e){
                e.preventDefault();
                    volver  = $(this).attr('href');
                    $('html, body').animate({
                        scrollTop: $(volver).offset().top
                    }, 9000);
                });
        });
        
        $("#buscar_especialidad_home").change(function(){
            modal_ver_medicos_especialidad($(this).val());
        });
        
        
        
        function iniciarSesionPaciente()
        {
            var dni = document.getElementById('dni_ingresar').value;
            var password = document.getElementById('password_ingresar').value;
            
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url()?>index.php/Welcome/iniciar_sesion_paciente",
                    data: {dni:dni,password:password},

                    beforeSend: function(event){},
                    success: function(data)
                    {
                        data = JSON.parse(data);

                        if(data)
                        {
                            location.href= "<?php echo base_url()?>";
                        }
                        else
                        {
                            $("#mensaje_inicio_sesion_paciente").html("Datos incorrectos");
                        }

                    },
                    error: function(event){$("#mensaje_inicio_sesion_paciente").html("Datos incorrectos");},
                });
            
        }
        
        function pedir_turno(especialidad,profesional)
        {
            $.ajax
                    ({
                        type:'POST',
                        url: "<?php echo base_url();?>index.php/Welcome/getCantidadTurnosPendientePaciente",
                        data:{},
                        
                        beforeSend: function(event){},
                        
                        success: function(data)
                        {
                            data = JSON.parse(data);
                            
                           if(data)
                           {
                               var fecha_actual = new Date();
                                var anio_actual = fecha_actual.getFullYear();
                                var mes_actual = fecha_actual.getMonth()+1;

                                 $("#select_mes_filtro_turnero").val(mes_actual);

                                 var opciones_anio ="<option value='"+anio_actual+"' selected>"+anio_actual+"</option><option value='"+(anio_actual+1)+"'>"+(anio_actual+1)+"</option>";
                                $("#select_anio_filtro_turnero").html(opciones_anio);
                                  var fecha_actual = new Date();

                                var mes_actual = fecha_actual.getMonth()+1;
                                var anio_actual = fecha_actual.getFullYear();

                                $("#especialidad_turnero_paciente").val(especialidad);
                                $("#profesional_turnero_paciente").val(profesional);
                                setTurnero(profesional,especialidad,mes_actual,anio_actual);
                                $("#modal").modal("hide");
                                $("#modalturnero").modal("show");
                           }
                           else
                           {
                               $("#cuerpo-modal").html("No puede solitar un turno, dado que posee uno en estado pendiente");
                               $("#modal").modal("show");
                           }
                            
                        },
                        error: function(event){
                            alert("ERROR");
                        },
                    });
            
        }
        
      
        function filtro_turnero()
        {
            
            var mes = document.getElementById("select_mes_filtro_turnero").value;
            var anio = document.getElementById("select_anio_filtro_turnero").value;
            var especialidad =  $("#especialidad_turnero_paciente").val();
            var profesional = $("#profesional_turnero_paciente").val();
            setTurnero(profesional,especialidad,mes,anio);
        }
        
        function setTurnero(profesional,especialidad,mes,anio)
        {
            $.ajax
                    ({
                        type:'POST',
                        url: "<?php echo base_url();?>index.php/Welcome/getTurnosPorProfesionalEspecialidadMesAnio",
                        data:{profesional:profesional,especialidad:especialidad,mes:mes,anio:anio},
                        
                        beforeSend: function(event){},
                        
                        success: function(data)
                        {
                            data = JSON.parse(data);
                            
                            calendario.setMesActual(mes);
                            calendario.actualiza_mes(data);
                            
                        },
                        error: function(event){
                            alert("ERROR");
                        },
                    });
        }
        
    function getHorariosDia(dia,mes,id)
    {
        var anio = document.getElementById("select_anio_filtro_turnero").value;
        var numero_profesional= $("#profesional_turnero_paciente").val();
        var date = anio+"-"+mes+"-"+dia;
        fecha = new Date(date);
        
        var dia_nombre = null;
        
        if (navigator.userAgent.indexOf('Firefox') !=-1) {
        dia_nombre = fecha.getDay() +1;
      } else if (navigator.userAgent.indexOf('Chrome') !=-1) {
        dia_nombre = fecha.getDay();
      } 
   
        $.ajax({
           type:"POST",
           url: "<?php echo base_url()?>index.php/Welcome/getHorariosDia",
           data:{numero_dia:dia_nombre,fecha:date,profesional:numero_profesional,anio:anio,mes:mes,dia:dia},
           
           beforeSend: function(event){},
           success: function(data){
               data =JSON.parse(data);
               
               $("#cuerpo-modal").html(data);
               $("#modal").modal("show");
           },
           error: function(event){alert("Error no se pudo inicializar los horarios de el dia seleccionado")},
       });
    }
    
    function render_agregar_turno(codigo_horario,anio,mes,dia,profesional,hora_desde,hora_hasta)
    {
        var fecha = anio+"-"+mes+"-"+dia;
        
        
        var especialidad =  $("#especialidad_turnero_paciente").val();
        $.ajax({
           type:"POST",
           url: "<?php echo base_url()?>index.php/Welcome/htmlRegistrarTurno",
           data:{profesional:profesional,fecha:fecha,hora_desde:hora_desde,hora_hasta:hora_hasta,especialidad:especialidad},
           
           beforeSend: function(event){},
           success: function(data){
               data = JSON.parse(data);
               
               $("#cuerpo-modal").html(data);
               $("#modalturnero").modal("hide");
               $("#modal").modal("show");
           },
           errror: function(event){},
       });
    }
    
    function registrar_turno()
    {
        var profesional = document.getElementById('profesional_registrar_turno').value;
        var fecha = document.getElementById('fecha_registrar_turno').value;
        var hora_desde = document.getElementById('hora_desde_registrar_turno').value;
        var hora_hasta = document.getElementById('hora_hasta_registrar_turno').value;
        var paciente = document.getElementById('paciente_registrar_turno').value;
        var estado = document.getElementById('estado_registrar_turno').value;
        var especialidad2 = document.getElementById('especialidad_registrar_turno').value;
        var precio = "Esperando"
        var cobrado = "no";
        
        if(!isNaN(paciente))
        {
            $.ajax({
               type:"POST",
               url: "<?php echo base_url()?>index.php/Welcome/registrar_turno",
               data:{profesional:profesional,fecha:fecha,hora_desde:hora_desde,hora_hasta:hora_hasta,paciente:paciente,estado:estado,especialidad:especialidad2,precio:precio,cobrado:cobrado},

               beforeSend: function(event){},
               success: function(data){
                   alert(data);
                   data = JSON.parse(data);
                   
                   $("#cuerpo-modal").html(data);

               },
               errror: function(event){},
           });
        }
        else
        {
            alert("Dni no valido");
        }
        
    }
        
    function cancelar_turno(codigo)
    {
        $.ajax({
           type:"POST",
           url: "<?php echo base_url()?>index.php/Welcome/cancelar_turno",
           data:{codigo:codigo},
           beforeSend: function(event){},
           success: function(data){
               data = JSON.parse(data);
               
               var respuesta = "";
               
               if(data)
               {
                   respuesta="Turno cancelado";
                   $("#mi_turno_"+codigo).remove();
               }
               else
               {
                   respuesta="No se ha podido cancelar el turno";
               }
               
               $("#cuerpo-modal").html(respuesta);
               $("#modal").modal("show");
           },
           errror: function(event){},
       });
    }
        
        //-- CLASES - PLUGINS --//
                function MarioOliveraCalendar(meses,mes_actual,id_calendario,id_botonera,id_nombre)
		{
			// PROPIEDADES
			this.meses = meses;
			this.mes_actual=mes_actual;
			this.id_calendario=id_calendario;
			this.id_botonera=id_botonera;
			this.id_nombre=id_nombre;

			// METODOS
			this.actualiza_mes = actualiza_mes;
			this.construye_calendario =construye_calendario;
			this.mostrar_seleccion=mostrar_seleccion;
			this.mes_siguiente=mes_siguiente;
			this.mes_anterior=mes_anterior;
			this.mostrar_seleccion=mostrar_seleccion;
                        this.setMesActual=setMesActual;
                        
                        function setMesActual(mes)
                        {
                            this.mes_actual = mes;
                        }
			function actualiza_mes(data)
			{
				// ENERO MARZO MAYO JULIO AGOSTO OCTUBRE DICIEMBRE -- 31 dias
				if( this.mes_actual == 1 || this.mes_actual == 3 || this.mes_actual == 5 || this.mes_actual == 7 || 
					this.mes_actual == 8 || this.mes_actual == 10 || this.mes_actual==12)
				{
					this.construye_calendario(31,data);
						
				}
				else if(this.mes_actual == 2)
				{
					this.construye_calendario(29,data);
				}
				else
				{
					this.construye_calendario(30,data);
				}
                                
                                
			}

			function construye_calendario(cantidad_dias,data)
			{
                            if(data != null)
                            {
				$("#"+this.id_nombre).text(this.meses[this.mes_actual-1]);
                                        
                                        
                                        var dias = new Array();
                                        
                                        for(var i=0; i < data.length;i++)
                                        {
                                            fecha = new Date(data[i]["fecha"]);
                                            var dia = fecha.getDate();
                                            
                                            dias[dia+1]=dia+1;
                                        }
                                        
					var html ="";
                                        var html_2="";
                                        
                                        var numero_dia = 1;
					for(var i=1; i <= cantidad_dias;i++)
					{
                                            
                                                if(dias[i] != undefined)
                                                {
                                                    html+="<div class='col-md-2 col-sm-2 col-xs-2' style='padding: 0;'>";
                                                    html+="		<input type='button' class='btn btn-danger form-control' onClick='getHorariosDia("+i+","+this.mes_actual+",&#039;"+this.id_calendario+"&#039;)' value='"+i+"'/>";
                                                    html+="</div>";
                                                }   
                                                else
                                                {
                                                    html+="<div class='col-md-2 col-sm-2 col-xs-2' style='padding: 0;'>";
                                                    html+="		<input type='button' class='btn btn-default form-control' onClick='getHorariosDia("+i+","+this.mes_actual+",&#039;"+this.id_calendario+"&#039;)' value='"+i+"'/>";
                                                    html+="</div>";
                                                }
                                                numero_dia++;
                                           
                                                
					}
                                        
                                       
					$("#"+this.id_botonera).html(html);
                                        $("#"+this.id_botonera+"_dos").html(html_2);
                            }
                            
			}

			function mes_siguiente()
			{
				if(this.mes_actual+1 <= 12)
				{
					this.mes_actual= this.mes_actual+1;
				}
				else
				{
					this.mes_actual=1;
				}
				this.actualiza_mes();
			}

			function mes_anterior()
			{
				if(this.mes_actual-1 >= 1)
				{
					this.mes_actual-=1;
				}
				else
				{
					this.mes_actual=12;
				}
				this.actualiza_mes();
			}

			function mostrar_seleccion(dia,mes,id)
			{
				alert(dia+" DEL "+mes+" ELEMENTO: "+id);
			}
		}
                
                
        function modal_ver_medicos_especialidad(codigo)
        {
            $.ajax({
                type:"POST",
                url: "<?php echo base_url()?>index.php/Welcome/ver_profesionales_por_especialidad",
                data:{codigo:codigo},
                beforeSend: function(event){},
                success: function(data){
                    data = JSON.parse(data);
                    $("#cuerpo-modal").html(data);
                    $("#modal").modal("show");
                },
                errror: function(event){},
            });
        }
        
        function modal_registrarse()
        {
            $("#modal").modal("hide");
            $("#modalingresar").modal("show");
        }
        function abrirModalIngresar()
        {
            $("#modalingresar").modal("show");
        }
    </script>
</body>
</html>
