<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Template
{
    
   protected $ci;
   private $logo;
   private $titulo;
   private $telefono;
   private $correo;
   private $localizacion;
   private $textos_deslizables;
   private $especialidades;
   private $fondo_deslizante;
   private $secciones;
    
   public function __construct() 
   {
       $this->ci =&get_instance();
       
       
       $this->ci->load->model("Datos_home_model");
       $this->ci->load->model("Textos_deslizables_model");
       $this->ci->load->model("Especialidades_model");
       
       $this->logo = $this->ci->Datos_home_model->getLogo();
       $this->telefono= $this->ci->Datos_home_model->getTelefono();
       $this->correo= $this->ci->Datos_home_model->getCorreo();
       $this->localizacion= $this->ci->Datos_home_model->getLocalizacion();
       $this->textos_deslizables= $this->ci->Textos_deslizables_model->getTextos();
       $this->especialidades = $this->ci->Especialidades_model->getEspecialidades();
       $this->fondo_deslizante= $this->ci->Datos_home_model->getFondosDeslizantes();
       $this->secciones = $this->ci->Datos_home_model->getSecciones();
       
   }
   
   
   public function generar_pagina_principal($titulo)
   {
      $template = new Template();
      $template->setTitulo($titulo);
      return $template;
   }
   
   // SETTERS
   
   public function setTitulo($titulo)
   {
       $this->titulo = $titulo;
   }
   
   // GETTERS
   
   public function getFondoDeslizante()
   {
       return $this->fondo_deslizante;
   }
   
   public function getTitulo()
   {
       return $this->titulo;
   }
   
   public function getLogo()
   {
       return $this->logo;
   }
   
   public function getTelefono()
   {
       return $this->telefono;
   }
   
   public function getCorreo()
   {
       return $this->correo;
   }
   
   public function getLocalizacion()
   {
       return $this->localizacion;
   }
   
   
   public function getMenu()
   {
       $html=
       "<div class='header-bottom'>
		<div class='container'>
			<!--top-nav-->
			<div class='top-nav cl-effect-5'>
				<span class='menu-icon'><img src='".base_url()."recursos/home/images/menu-icon.png' alt=''/></span>		
				<ul class='nav1'>";
                                foreach($this->secciones as $value)
                                {
                                    $html.="<li><a href='#".$value["nombre_seccion"]."'> <span data-hover='".$value["nombre_seccion"]."'>".$value["nombre_seccion"]."</span></a></li>";
                                }
				$html.="</ul>
				<!-- script-for-menu -->
				<script>
				   $( 'span.menu-icon' ).click(function() {
					 $( 'ul.nav1' ).slideToggle( 300, function() {
					 // Animation complete.
					  });
					 });
				</script>
				<!-- /script-for-menu -->
			</div>
			<!--//top-nav-->";
                        if($this->especialidades)
                        {
                            $html.="<form class='navbar-form navbar-right'>
                                    <div class='form-group'>";
                                        if($this->ci->session->userdata("ingresado") == true)
                                        {
                                            $html.="
                                            <select type='text' id='buscar_especialidad_home' class='chosen-select' style='width: 220px;'>
                                            <option value='0'>SELECCIONE ESPECIALIDAD</option>";
                                            foreach ($this->especialidades as $value) {
                                                $html.="<option value='".$value["codigo"]."'>".$value["especialidad"]."</option>";
                                            }
                                            $html.="</select>";
                                        }
                                        else
                                        {
                                            $html.="
                                            <select type='text' id='buscar_especialidad_home' class='chosen-select' style='width: 220px;'>
                                            <option value='0'>Seleccione especialidad 
                                            para ver los medicos</option>";
                                            foreach ($this->especialidades as $value) {
                                                $html.="<option value='".$value["codigo"]."'>".$value["especialidad"]."</option>";
                                            }
                                            $html.="</select>";
                                        }
                                   $html.=" </div>		
                            </form>";
                        }
			$html.="<div class='clearfix'> </div>
		</div>
	</div>";
       return $html;
   }
   
   public function getHeader()
   {
        $html=
        "	<div class='header'>
		<div class='container'>
			<div class='header-logo'>
				<a href='index.html'><img src='".base_url()."recursos/home/images/".$this->getLogo()."' width='300' alt='logo'/></a>					
			</div>
			<div class='header-info'>
                                
				<p>Servicio de informacion:</p>
				<h4><span class='glyphicon glyphicon-phone'>".$this->getTelefono()."</h4>
                                <div style='text-align: right;margin-top: 10px;'>";
                                    if($this->ci->session->userdata("ingresado") == "true")
                                    {
                                        $html.="
                                        <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                            <button id='boton_desplazar_opciones_usuario' type='button' class='btn btn-cuenta dropdown-toggle form-control' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <span class='glyphicon glyphicon-user'></span>  Mi cuenta<span class='caret'></span>
                                            </button>
                                            <ul class='dropdown-menu'>
                                              <li><a href='".base_url()."index.php/Welcome/mi_historial_clinico' onClick='comentar_pagina_cliente()'>Historial Medico</a></li>
                                              <li><a href='".base_url()."index.php/Welcome/mis_turnos'>Mis turnos</a></li>
                                              <li role='separator' class='divider'></li>
                                              <li><a href='".base_url()."index.php/Welcome/cerrar_sesion'>Cerrar Sesion</a></li>
                                            </ul>
                                        </div>";
                                    }
                                    else
                                    {
                                        $html.="<input type='button' class='btn btn-default form-control' onClick='abrirModalIngresar()' value='Ingreso'>";
                                    }
                                    
                                $html.="</div>
			</div>			
			<div class='clearfix'> </div>
		</div>	
	</div>";
        return $html;
   }
   
   public function generar_inicio()
   {
        $html="<div class='gallery' id='gallery'></div>";
         
        for($i=0; $i < count($this->secciones); $i++)
        {
            $html.="<a name='".$this->secciones[$i]["nombre_seccion"]."'></a>";
            $html.="<h1 class='text-center' style='text-transform: uppercase;margin-top: 20px;'>".$this->secciones[$i]["nombre_seccion"]."</h1>";
            $html.="<div style='text-align: center;text-transform: uppercase;' class='recent-posts-text'>".$this->secciones[$i]["contenido"]."</div>";
        }
       
        return $html;
   }
   
   public function getBanner()
   {
      $html="";
      
      if($this->textos_deslizables)
      {
        $html=
        "	<div class='banner'>
                  <div class='container '>
                          <!-- banner-text Slider starts Here -->
                          <script src='".base_url()."recursos/home/js/responsiveslides.js'></script>
                           <script>
                                  // You can also use '$(window).load(function() {''
					$(function () {
					// Slideshow 4
						$('#slider3').responsiveSlides({
						auto: true,
						pager:true,
						nav:false,
						speed: 500,
						namespace: 'callbacks',
						before: function () {
						$('.events').append('<li>before event fired.</li>');
						},
						after: function () {
							$('.events').append('<li>after event fired.</li>');
						}
					});	
				});
                          </script>
                          <!--//End-slider-script -->
                          <div  id='top' class='callbacks_container'>
                                  <ul class='rslides' id='slider3'>";
        
                                    for($i=0; $i < count($this->textos_deslizables);$i++) {
                                      $html.="<li>
                                                  <div class='banner-text'>		
                                                          <h1>".$this->textos_deslizables[$i]["titulo"]."</h1>
                                                          ".$this->textos_deslizables[$i]["descripcion"]."
                                                  </div>
                                              </li>"; 
                                    }
                          $html.="</ul>
                          </div>
                  </div>
          </div>
          
            <div class='banner-bottom' style='margin-bottom: 100px;'>
		<div class='container'>
			<h2>Ir a las secciones</h2>
			<a href='#gallery' class='arrow scroll'> </a>
		</div>
            </div>"; 
      }
      return $html;
   }
   
   public function generar_pagina_ver_mi_historial_clinico($historial_paciente)
   {
       $html="<h1 class='text-center' style='margin-top: 20px;margin-bottom: 70px;'>Historia clinica de ".$this->ci->session->userdata("nombre")." ".$this->ci->session->userdata("apellido")."</h1>
               <div class='row'>";
       if(!$historial_paciente)
       {
           $html.="<h3>No se encontro un historial clinico</h3>";
       }
       for($i=0; $i<count($historial_paciente);$i++)
       {
            $date = new DateTime($historial_paciente[$i]["fecha"]);                     
            $fecha = $date->format("d/m/Y");
            
            $html.=
            "
                <div class='col-md-3'>
                    <h3 class='text-center'>".$fecha."</h3>
                    <a href='".base_url()."index.php/Welcome/reporte_historia_clinica/".$historial_paciente[$i]["codigo"]."' class='btn btn-default form-control' style='background-color: #880015;color: #fff;font-weight: bold;margin-top: 10px;'>Informe</a>
                        
                </div>
            ";
                         
       }
       $html.="</div>";
       return $html;
   }
   
   public function generar_render_ver_profesionales_por_especialidad($cod_especialidad,$especialidad,$profesionales)
   {
       $html=
       "<div style='text-align: center;'>
               <h1 class='text-center' style='margin-top: 20px; margin-bottom: 20px;color: #448885;'>Profesionales de <span class='text-lowercase'>".$especialidad."</span></h1>";
       
       foreach ($profesionales as $value) {
           $html.=
           "
			
			<div style='text-align: center;border-width: 1px;border-style: solid;width: 120px;display:inline-block; padding: 2px 2px;'>
				<div >
					<h2 class='text-center'>".$value["nombre"]." ".$value["apellido"]."</h2>";
                                        $fecha = new DateTime();
                                        $html.="
					<h5 class='text-center' style='color: #000;'>".$fecha->format("d/m/Y")."</h5>

					<div class='' style='margin-top: 10px;'>
						<div class='text-center' >
							
								<img src='".base_url()."recursos/img/empleados/".$value["imagen"]."' width='100px' height='100px' style='border-width: 3px; border-color: #8d5555; border-style: solid;'/>
						</div>
					</div>
					<div class=''>
						<div style='margin-top: 20px;' class='text-center'>";
                                                    if($this->ci->session->userdata("ingresado") == "true")
                                                    {
                                                        $html.="<input type='button' class='btn btn-primary' value='Pedir turno' onClick='pedir_turno(".$cod_especialidad.",".$value["codigo"].")' style='width: 100px;'>";
                                                    }
                                                    else
                                                    {
                                                       $html.="<input type='button' class='btn btn-default' onClick='modal_registrarse()' style='width: 100px;' value='Ingresar'>";
                                                    }
						$html.="</div>
					</div>
				</div>
			</div>
		";
       }
       
       $html.="</div>";
       
       return $html;
   }
   
   public function generar_render_mis_turnos($turnos)
   {
       $html=
       "	<div class='row'>
			<h1 class='text-center' style='color: #448885;margin-top: 20px;' >Mis turnos</h1>
			<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12' style='color: #448885;'>";
       
                    foreach ($turnos as $value) {
                      
			$html.="<div class='col-xs-12 col-sm-4 col-md-3 col-lg-3' style='margin-top: 20px;' id='mi_turno_".$value["codigo"]."'>
					<h2 class='text-center'>".$value["fecha"]."</h2>

					<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
						<div class='text-center' >
							
								<img src='".base_url()."recursos/img/empleados/".$value["imagen"]."' width='194px' height='194px' style='border-width: 3px; border-color: #8d5555; border-style: solid;'/>
						</div>
						<h5 class='text-center' style='color: #000; margin-top: 10px;'>Profesional: ".$value["nombre"]." ".$value["apellido"]."</h5>
						<h5 class='text-center' style='color: #000;'>Hora entrada: ".$value["hora_desde"]."hs</h5>
						<h5 class='text-center' style='color: #000;'>Hora salida: ".$value["hora_hasta"]."hs</h5>";
                                                if($value["estado"] == "pendiente")
                                                {
                                                    $html.="<h5 class='text-center'>Estado: <span style='color: #F00;'>pendiente</span></h5>";
                                                }
                                                else
                                                {
                                                    $html.="<h5 class='text-center'>Estado: <span style='color: #0F0;'>confirmado</span></h5>";
                                                }
                                $html.="</div>
					<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
						<div style='margin-top: 20px;' class='text-center'>
							<input type='button' class='btn btn-danger' value='Cancelar turno' onClick='cancelar_turno(".$value["codigo"].")'style='width: 200px;'>
						</div>

					</div>
				</div>";
                    }
		$html.="</div>
		</div>";
       return $html;
   }
   
   
}
