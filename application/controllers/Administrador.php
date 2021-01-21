<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Administrador extends Super_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library("Usuario");
		$this->load->library("Pagina");
		$this->load->library('Grocery_CRUD');
		$this->administrador=new Usuario();
		$this->pagina=new Pagina();
	}

	public function index() {
		if (($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3")&& $this->session->userdata("operativo") == "si") {
			try{
				
				// MODELS
				$this->load->model("Especialidades_model");
				$especialidades = $this->Especialidades_model->getEspecialidades();
				
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->menu_administrador($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->cabecera_administrador($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "Escritorio";
				$vista["config"] = $this->pagina->generar_configuraciones();
				$vista["detalle"] = $this->pagina->generar_escritorio_secretaria($especialidades);
				$this->load->view('secretaria/vista_general.php',$vista);
			}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

			}else{
				redirect("acceso");
		}
	}
	
	public function abm_empleados() {
		if (($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3")&& $this->session->userdata("operativo") == "si") {
		
			try{
		
				$crud = new grocery_CRUD();           
				$crud->set_table('empleados');
				$crud->set_relation('tipo_usuario','tipo_usuario','tipo');
				$crud->set_relation('cod_sucursal','sucursales','descripcion');
				$crud->set_relation('cod_localidad','localidades','descripcion');
				$crud->set_relation('dia_habilitado','dias_habilitados','dias');
				$crud->set_field_upload('imagen','recursos/img/empleados/');
				
				$crud->required_fields('dni','correo', 'usuario','pass', 'nombre','apellido', 
						'tipo_usuario','direccion', 'cod_sucursal','cod_localidad', 'imagen', 'inicio','dia_habilitado','operativo');
				$crud->columns('dni','correo', 'usuario','pass', 'nombre','apellido', 
						'tipo_usuario','dia_habilitado','operativo');
				
				$crud->callback_before_insert(array($this,'insertar_usuario_sistema'));
				
				$output = $crud->render();
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->menu_administrador($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->cabecera_administrador($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "Empleados";
				$vista_pie["config"] = $this->pagina->generar_configuraciones();
				$this->load->view('administrador/cabecera.php',$vista);
				$this->load->view('administrador/detalle.php',$output);
				$this->load->view('administrador/pie.php', $vista_pie);

			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

		}else{
			redirect("acceso");
		}
	}
	
	function insertar_usuario_sistema($post_array) {
		$this->load->model('Usuario_model');
		$nombre = $post_array['nombre']." ".$post_array['apellido'];
		$agregado = $this->Usuario_model->insertar_usuario_sistema($nombre);

		return $agregado;
	} 
	
	public function abm_profesionales() {
		if (($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3")&& $this->session->userdata("operativo") == "si"){
			try{
				$crud = new grocery_CRUD();           
				$crud->set_table('profesionales');
				$crud->set_relation('cod_usuario','empleados','apellido');
				$crud->required_fields('codigo','cod_usuario','dni');
				$crud->columns('cod_usuario','matricula');
				$crud->unset_delete();
				$output = $crud->render();
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->menu_administrador($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->cabecera_administrador($imagen, $dni, $nombre, $apellido);
				$vista_pie["config"] = $this->pagina->generar_configuraciones();
				$vista["seccion"] = "ABM Profesionales";
				$this->load->view('administrador/cabecera.php',$vista);
				$this->load->view('administrador/detalle.php',$output);
				$this->load->view('administrador/pie.php', $vista_pie);

			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

		}else{
			redirect("acceso");
		}
	}
	
	public function abm_textos_deslizables() {
		if (($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si"){
			try{
				$crud = new grocery_CRUD();           
				$crud->set_table('textos_deslizables_home');
				$crud->required_fields('titulo');
				$crud->columns('titulo','descripcion');
				$crud->unset_delete();
				$output = $crud->render();
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->menu_administrador($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->cabecera_administrador($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "Textos deslizables home";
				$vista_pie["config"] = $this->pagina->generar_configuraciones();
				$this->load->view('administrador/cabecera.php',$vista);
				$this->load->view('administrador/detalle.php',$output);
				$this->load->view('administrador/pie.php', $vista_pie);

			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

		}else{
			redirect("acceso");
		}
	}
	
	
	
	
	
	public function abm_localidades() {
		if (($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si")
		{
			try{
				$crud = new grocery_CRUD();           
				$crud->set_table('localidades');
				
				$crud->required_fields('descripcion');
				$crud->columns('descripcion');
				
				$crud->unset_delete();
				$output = $crud->render();
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->menu_administrador($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->cabecera_administrador($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "Localidades";
				$vista_pie["config"] = $this->pagina->generar_configuraciones();
				$this->load->view('administrador/cabecera.php',$vista);
				$this->load->view('administrador/detalle.php',$output);
				$this->load->view('administrador/pie.php', $vista_pie);

			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

		}else{
			redirect("acceso");
		}
	}
	
	public function abm_sucursales() {
		if(($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si") 
		{
			try{
				$crud = new grocery_CRUD();           
				$crud->set_table('sucursales');
				$crud->set_relation('localidad','localidades','descripcion');
				
				$crud->required_fields('descripcion','direccion','localidad','abreviatura');
				$crud->columns('numero','descripcion','direccion','localidad','abreviatura');
				$output = $crud->render();
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->menu_administrador($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->cabecera_administrador($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "Sucursales";
				$vista_pie["config"] = $this->pagina->generar_configuraciones();
				$this->load->view('administrador/cabecera.php',$vista);
				$this->load->view('administrador/detalle.php',$output);
				$this->load->view('administrador/pie.php', $vista_pie);

			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

		}else{
			redirect("acceso");
		}
	}
	
	public function administrar_especialidades()
	{
		if ($this->administrador->verificar_acceso() && $this->administrador->verificar_operatividad()
			&& ($this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "1")){
			try{
				$crud = new grocery_CRUD();           
				$crud->set_table('profesionales');
				$crud->set_relation('cod_usuario','empleados','dni');
				$crud->required_fields('codigo','cod_usuario','matricula');
				$crud->columns('codigo','cod_usuario','matricula');
				$output = $crud->render();
				
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->menu_administrador($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->cabecera_administrador($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "Especialidades";
				$vista_pie["config"] = $this->pagina->generar_configuraciones();
				$this->load->view('administrador/cabecera.php',$vista);
				$this->load->view('administrador/detalle.php',$output);
				$this->load->view('administrador/pie.php', $vista_pie);

			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

		}else{
			redirect("acceso");
		}
	}
	
	public function asignacion_horarios()
	{
		if (($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si"){

			$this->load->model("Configuracion_horarios_model");

			$respuesta = array("respuesta"=>true,"mensaje"=>"");

			if($this->input->post())
			{
				$desde=$this->input->post("horario_desde");
				$hasta= $this->input->post("horario_hasta");
				$tiempo_turno= $this->input->post("tiempo_turno");
				
				$usuario=$this->session->userdata("usuario");
				$fecha_modificacion=Date("Y-m-d");   

				// VALIDACION

				if((int)$desde >= (int)$hasta)
				{
					echo "$desde >= $hasta";

					$respuesta["respuesta"]=false;
					$respuesta["mensaje"]="<p>La hora desde no puede ser mayor a la hora hasta</p>";
				}

				if($respuesta["respuesta"])
				{
				   $this->Configuracion_horarios_model->editar_horario($desde,$hasta,$tiempo_turno,$fecha_modificacion,$usuario); 
				}
			}

			

			$config_h = $this->Configuracion_horarios_model->get_horario();

			$output["hora_desde"]= $config_h["desde"];
			$output["hora_hasta"]= $config_h["hasta"];
			$output["tiempo_turno"]= $config_h["tiempo_turno"];
			$output["usuario"]= $config_h["usuario"];
			$output["fecha"]= $config_h["fecha_modificacion"];
			
			$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
			$dni=$this->session->userdata('dni');
			$nombre=$this->session->userdata('nombre');
			$apellido=$this->session->userdata('apellido');
			$vista["menu"] = $this->pagina->menu_administrador($imagen, $dni, $nombre, $apellido);
			$vista["cabecera"] = $this->pagina->cabecera_administrador($imagen, $dni, $nombre, $apellido);
			$vista["seccion"] = "Asignacion Horarios";
			$vista_pie["config"] = $this->pagina->generar_configuraciones();

			$output["respuesta"]=$respuesta;

			$this->load->view('administrador/cabecera.php',$vista);
			$this->load->view('administrador/detalle_horarios.php',$output);
			$this->load->view('administrador/pie_horarios.php', $vista_pie);

			

		}else{
			redirect("acceso");
		}
	}
	
	public function modulos()
	{
		if (($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si"){
			try{
//                $crud = new grocery_CRUD();           
//                $crud->set_table('horarios');
//                $crud->set_relation('profesional','profesionales','dni');
//                $crud->set_relation('dia','dias','descripcion');
//                $crud->required_fields('profesional','dia','hora_desde','hora_hasta','tiempo_turno','vigencia_hasta');
//                $crud->columns('profesional','dia','hora_desde','hora_hasta','tiempo_turno','vigencia_hasta');
//                $output = $crud->render();
				$this->load->model("Empleados_model");
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->menu_administrador($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->cabecera_administrador($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "Asignacion de Modulos";
				$output["usuarios"] =  $this->Empleados_model->getEmpleados();
				$vista_pie["config"] = $this->pagina->generar_configuraciones();
				$this->load->view('administrador/cabecera.php',$vista);
				$this->load->view('administrador/modulos.php',$output);
				$this->load->view('administrador/pie_horarios.php', $vista_pie);

			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

		}else{
			redirect("acceso");
		}
	}
	
	public function administrar_modulos_de_usuario($id_usuario = null)
	{
		if(($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si")
		{
			
			$this->load->model("Empleados_model");
			$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
			$dni=$this->session->userdata('dni');
			$nombre=$this->session->userdata('nombre');
			$apellido=$this->session->userdata('apellido');
			$vista["menu"] = $this->pagina->menu_administrador($imagen, $dni, $nombre, $apellido);
			$vista["cabecera"] = $this->pagina->cabecera_administrador($imagen, $dni, $nombre, $apellido);
			$vista["seccion"] = "Modulos activos";
			$output["modulos_existentes"] = $this->Empleados_model->get_modulos_usuario($id_usuario);
			$output["modulos_faltantes"] = $this->Empleados_model->get_modulos_faltantes_usuario($id_usuario); 
			$output["id_usuario"]=$id_usuario;
			$output["usuario"]=$this->Empleados_model->get_usuario_por_id($id_usuario);
			$vista_pie["config"] = $this->pagina->generar_configuraciones();
			$this->load->view('administrador/cabecera.php',$vista);
			$this->load->view('administrador/adm_modulos_usuario.php',$output);
			$this->load->view('administrador/pie_horarios.php', $vista_pie);
		}
		else
		{
			redirect("Administrador/abm_usuarios");
		}
	}
	
	/********************************
	 * ACCESO A MODULOS
	 ********************************/
	
	public function activar_modulo_usuario()
	{
		if((($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3") 
				&& $this->session->userdata("operativo") == "si") && $this->input->is_ajax_request())
		{
			$this->load->model("Usuario_model");
			$id_usuario= $this->input->post("id_usuario");
			$id_modulo= $this->input->post("id_modulo");
			
			$respuesta = $this->Usuario_model->activar_modulo_usuario($id_modulo,$id_usuario);
		
			echo json_encode($respuesta);
		}
	}
	
	public function desactivar_modulo_usuario()
	{
		if((($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3") 
				&& $this->session->userdata("operativo") == "si") && $this->input->is_ajax_request())
		{
			$this->load->model("Usuario_model");
			$id_usuario= $this->input->post("id_usuario");
			$id_modulo= $this->input->post("id_modulo");
			
			$respuesta = $this->Usuario_model->desactivar_modulo_usuario($id_modulo,$id_usuario);
		
			echo json_encode($respuesta);
		}
	}

	public function configuracion_avanzada_horarios()
	{
		if (($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si")
		{
			$this->load->model("Configuracion_horarios_avanzados_model");

			$respuesta = array("respuesta"=>true,"mensaje"=>"");

			if($this->input->post())
			{
				$dia=$this->input->post("dia");
				$hora_desde=$this->input->post("horario_desde");
				$hora_hasta= $this->input->post("horario_hasta");
				$tiempo_turno= $this->input->post("tiempo_turno");

				// VALIDACION (que no choque con otro horario)

				if((int)$hora_desde >= (int)$hora_hasta)
				{
					$respuesta["respuesta"]=false;
					$respuesta["mensaje"]="<p>La hora desde no puede ser mayor a la hora hasta</p>";
				}

				if($respuesta["respuesta"])
				{
					$choca_con_fecha = false;

					$horarios_de_dia = $this->Configuracion_horarios_avanzados_model->get_horarios_por_dia($dia);

					foreach($horarios_de_dia as $horario)
					{
						if(((int)$horario["desde"] < (int)$hora_desde && (int)$horario["hasta"] > (int)$hora_desde) ||
							((int)$horario["desde"] < (int)$hora_hasta && (int)$horario["hasta"] > (int)$hora_hasta))
						{
							$choca_con_fecha= true;
							break;
						}
					}

					if($choca_con_fecha)
					{
						$respuesta["respuesta"]=false;
						$respuesta["mensaje"]="El horario seleccionado choca con otro horario configurado";
					}

				}

				if($respuesta["respuesta"])
				{
					$this->Configuracion_horarios_avanzados_model->agregar_horario($dia,$hora_desde,$hora_hasta,$tiempo_turno,date("Y-m-d"),$this->session->userdata("usuario"));
				}
				
			}
			
				
			$this->load->model("Configuracion_horarios_model");
			$this->load->model("Configuracion_horarios_avanzados_model");

			$config_h = $this->Configuracion_horarios_model->get_horario();

			$output["hora_desde"]= $config_h["desde"];
			$output["hora_hasta"]= $config_h["hasta"];
			$output["tiempo_turno"]= $config_h["tiempo_turno"];
			$output["usuario"]= $config_h["usuario"];
			$output["fecha"]= $config_h["fecha_modificacion"];

			$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
			$dni=$this->session->userdata('dni');
			$nombre=$this->session->userdata('nombre');
			$apellido=$this->session->userdata('apellido');
			$vista["menu"] = $this->pagina->menu_administrador($imagen, $dni, $nombre, $apellido);
			$vista["cabecera"] = $this->pagina->cabecera_administrador($imagen, $dni, $nombre, $apellido);
			$vista["seccion"] = "Asignacion Avanzada de Horarios";
			$vista_pie["config"] = $this->pagina->generar_configuraciones();



			$output["configuraciones"] = $this->Configuracion_horarios_avanzados_model->get_horarios();
			$output["respuesta"]=$respuesta;
			$this->load->view('administrador/cabecera.php',$vista);
			$this->load->view('administrador/detalle_horarios_avanzados.php',$output);
			$this->load->view('administrador/pie_horarios.php', $vista_pie);
			
		}
		else
		{
			redirect("acceso");
		}
	}

	public function eliminar_horario_avanzado($id)
	{
		if (($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si"){
			$this->load->model("Configuracion_horarios_avanzados_model");
			$this->Configuracion_horarios_avanzados_model->eliminar($id);
			redirect("Administrador/configuracion_avanzada_horarios");
		}
	}

	public function asignacion_especialidades()
	{
		if (($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si"){
			try{
				
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->menu_administrador($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->cabecera_administrador($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "Asignacion Especialidades";
				$vista["config"] = $this->pagina->generar_configuraciones();
				$vista["detalle"]=$this->pagina->generar_render_administrar_profesionales();
				$this->load->view('administrador/vista_general.php',$vista);
			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

		}else{
			redirect("acceso");
		}
	}
	
	public function getDatosHome()
	{
		if ($this->administrador->verificar_acceso() && $this->administrador->verificar_operatividad()
			&& $this->input->is_ajax_request() && ($this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "1"))
		{
		   $this->load->model("Datos_home_model");
		   $resultado = $this->Datos_home_model->getDatosHome();
		   echo json_encode($resultado);
		}
		else{
			redirect("acceso");
		}
	}
	
	public function getDatoHome()
	{
		if ($this->administrador->verificar_acceso() && $this->administrador->verificar_operatividad()
			&& $this->input->is_ajax_request() && ($this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "1"))
		{
		   $this->load->model("Datos_home_model");
		   $resultado = $this->Datos_home_model->getDatoHome($this->input->post("codigo"));
		   echo json_encode($resultado);
		}
		else{
			redirect("acceso");
		}
	}
	
	public function actualizar_imagen_dato_home()
	{
		if ($this->administrador->verificar_acceso() && $this->administrador->verificar_operatividad()
			&& ($this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "1"))
		{
		   // SUBIDA DE IMAGEN
				$imagen ="";
				$config['upload_path'] = "./recursos/home/images/";
				$config['allowed_types'] = "jpg|jpeg|png";
				$config ['max_size'] = '1000';

				$this->load->library("upload",$config);

				if($this->upload->do_upload("imagen_actualizar_dato_home")) // si se sube la imagen
				{
				   $imagen = $this->upload->data("file_name");
				}
				
				if($imagen != "")
				{
						// fin subida de imagen
				   $this->load->model("Datos_home_model");
				   $resultado = $this->Datos_home_model->actualizar_dato($this->input->post("codigo_imagen_dato_home_actualizar"),$imagen);
				}
				redirect('/administrador/abm_datos_home');
		}
		else{
			redirect("acceso");
		}
	}
	
	public function actualizar_texto_dato_home()
	{
		if ($this->administrador->verificar_acceso() && $this->administrador->verificar_operatividad()
			&& ($this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "1"))
		{
		   $this->load->model("Datos_home_model");
		   $resultado = $this->Datos_home_model->actualizar_dato($this->input->post("codigo_texto_dato_home_actualizar"),$this->input->post("descripcion_dato_home_actualizar"));
		   
		   redirect('/administrador/abm_datos_home');
		}
		else{
			redirect("acceso");
		}
	}
	
	
	
	public function abm_datos_home()
	{
		if (($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si"){
			try{
				
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->menu_administrador($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->cabecera_administrador($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "Datos Home Principal";
				$vista["config"] = $this->pagina->generar_configuraciones();
				$vista["detalle"]=$this->pagina->render_abm_datos_home();
				$this->load->view('administrador/vista_general.php',$vista);
			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

		}else{
			redirect("acceso");
		}
	}
	
	
	
	
	
   
	public function getVigencias()
	{
		if ($this->administrador->verificar_acceso() && $this->administrador->verificar_operatividad()
			&& $this->input->is_ajax_request() && ($this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "1"))
		{
		   $this->load->model("Horarios_model"); 
		   
		   $resultado = $this->Horarios_model->getVigencias();
		   return $resultado;
		}
		else{
			redirect("acceso");
		}
	}
	
	public function getListadoProfesionales()
	{
		if ($this->administrador->verificar_acceso() && $this->administrador->verificar_operatividad()
				&& $this->input->is_ajax_request() && ($this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "1")) 
		{
		   $this->load->model("Profesionales_model"); 
		   
		   $resultado = $this->Profesionales_model->getListadoProfesionales();
		   echo json_encode($resultado);
		}
		else{
			redirect("acceso");
		}
	}
	
	public function administrar_especialidades_profesional()
	{
		 if ($this->administrador->verificar_acceso() && $this->administrador->verificar_operatividad()
				&& $this->input->is_ajax_request() && ($this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "1"))
		{
		   $this->load->model("Profesionales_model");
		   $this->load->model("Especialidades_model");
		   
		   $codigo = $this->input->post("codigo");
		   $datos_profesional = $this->Profesionales_model->getNombreApellidoProfesional($codigo);
		   $nombre = $datos_profesional[0]["nombre"];
		   $apellido = $datos_profesional[0]["apellido"];
		   
		   $especialidades = $this->Especialidades_model->getEspecialidades();
		   $especialidades_profesional = $this->Profesionales_model->getEspecialidadesProfesional($codigo);
		   $especialidades_faltantes =$this->Profesionales_model->obtener_especialidades_faltantes_profesional($codigo);
		   
		   $resultado = $this->pagina->render_asignar_especialidades($codigo,$nombre,$apellido,$especialidades_profesional,$especialidades,$especialidades_faltantes);
		   echo json_encode($resultado);
		}
		else{
			redirect("acceso");
		}
	}
	
	public function agregar_especialidad_profesional()
	{
		 if ($this->administrador->verificar_acceso() && $this->administrador->verificar_operatividad()
				&& $this->input->is_ajax_request() && ($this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "1"))
		{
		   $this->load->model("Profesionales_model");
		   
		   $resultado = $this->Profesionales_model->agregarEspecialidad($this->input->post("profesional"),$this->input->post("especialidad"));
		   
		   echo json_encode($resultado);
		}
		else{
			redirect("acceso");
		}
	}
	
	public function borrar_especialidad_profesional()
	{
		 if ($this->administrador->verificar_acceso() && $this->administrador->verificar_operatividad()
				&& $this->input->is_ajax_request() && ($this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "1"))
		{
		   $this->load->model("Profesionales_model");
		   
		   $resultado = $this->Profesionales_model->borrar_especialidad_profesional($this->input->post("profesional"),$this->input->post("especialidad"));
		   
		   echo json_encode($resultado);
		}
		else{
			redirect("acceso");
		}
	}
	
	 /*public function abm_historias_clinicas() {
		if ($this->administrador->verificar_acceso() && $this->administrador->verificar_operatividad() && $this->administrador->getTipo_usuario() == "1" || $this->administrador->getTipo_usuario() == "3") {
			
				
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->menu_administrador($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->cabecera_administrador($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "ABM Historias Clinicas";
				$vista["detalle"] = $this->pagina->render_historias_clinicas();
				$this->load->view('administrador/vista_general.php',$vista);
			

		}else{
			redirect("acceso");
		}
	}*/
	
   
	public function actualizar_historia_clinica()
	{ 

		if($this->input->post())
		{
			if ($this->administrador->verificar_acceso() && $this->administrador->verificar_operatividad()) 
			{
				
				// SUBIDA DE IMAGEN
				$imagen1 ="";
				$imagen2 ="";
				$imagen3 ="";
				$imagen4 ="";
				
				$config['upload_path'] = "./recursos/img/pacientes/";
				$config['allowed_types'] = "jpg|jpeg|png";
				$config ['max_size'] = '1000';

				$this->load->library("upload",$config);

				if($this->upload->do_upload("imagen1_actualizar_historia_clinica")) // si se sube la imagen
				{
				   $imagen1 = $this->upload->data("file_name");
				}
				if($this->upload->do_upload("imagen2_actualizar_historia_clinica")) // si se sube la imagen
				{
				   $imagen2 = $this->upload->data("file_name");
				}
				if($this->upload->do_upload("imagen3_actualizar_historia_clinica")) // si se sube la imagen
				{
				   $imagen3 = $this->upload->data("file_name");
				}
				if($this->upload->do_upload("imagen4_actualizar_historia_clinica")) // si se sube la imagen
				{
				   $imagen4 = $this->upload->data("file_name");
				}
				// fin subida de imagen
				
				$observaciones = $this->input->post("observaciones_actualizar_historia_clinica");
				$codigo = $this->input->post("codigo_actualizar_historia_clinica");
				
				$this->load->model("Historias_clinicas_model");
				$this->Historias_clinicas_model->actualizarHistoriaClinica($codigo,$observaciones,$imagen1,$imagen2,$imagen3,$imagen4);
				
				
				redirect("administrador/abm_historias_clinicas");
			}
			else
			{
				redirect("acceso");
			}
		}
		else
		{
			redirect("acceso");
		}
	}
	
	public function getHistoriasClinicasActivas()
	{
		 if ($this->administrador->verificar_acceso() && $this->administrador->verificar_operatividad()
				&& $this->input->is_ajax_request() && ($this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "1"))
		{
		   $this->load->model("Historias_clinicas_model");
		   
		   $resultado = $this->Historias_clinicas_model->getHistoriasClinicasActivas();
		   
		   echo json_encode($resultado);
		}
		else{
			redirect("acceso");
		}
	}
	
	public function abm_horarios_habilitados()
	{
		if ((($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si")){ try{
				$crud = new grocery_CRUD();           
				$crud->set_table('horarios_habilitados');
				$crud->set_relation("empleado", "empleados", "usuario");
				$crud->required_fields('empleado','desde','hasta');
				$crud->columns('empleado','desde','hasta');
				$output = $crud->render();
				
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "ABM horarios habilitados";
				$vista_pie["config"] = $this->pagina->generar_configuraciones();
				$this->load->view('administrador/cabecera.php',$vista);
				$this->load->view('administrador/detalle.php',$output);
				$this->load->view('administrador/pie.php', $vista_pie);

			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

		}else{
			redirect("acceso");
		}
	}
	
   
	public function abm_dias_habilitados()
	{
		if ((($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si")){ try{
				$crud = new grocery_CRUD();           
				$crud->set_table('dias_habilitados');
				$crud->required_fields('codigo','dias');
				$crud->columns('codigo','dias');
				$output = $crud->render();
				
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "ABM Dias habilitados";
				$vista_pie["config"] = $this->pagina->generar_configuraciones();
				$this->load->view('administrador/cabecera.php',$vista);
				$this->load->view('administrador/detalle.php',$output);
				$this->load->view('administrador/pie.php', $vista_pie);

			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

		}else{
			redirect("acceso");
		}
	}
	
	public function abm_secciones()
	{
		if ((($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si")){ try{
				$crud = new grocery_CRUD();           
				$crud->set_table('secciones_home');
				$crud->required_fields('nombre_seccion');
				$crud->columns('nombre_seccion','contenido');
				$crud->unset_add();
				$crud->unset_delete();
				$output = $crud->render();
				
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "ABM Secciones";
				$vista_pie["config"] = $this->pagina->generar_configuraciones();
				$this->load->view('administrador/cabecera.php',$vista);
				$this->load->view('administrador/detalle.php',$output);
				$this->load->view('administrador/pie.php', $vista_pie);

			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

		}else{
			redirect("acceso");
		}
	}
	
	public function abm_historias_clinicas() {
		if ((($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si")) 
			
		{
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "ABM Historias Clinicas";
				$vista["detalle"] = $this->pagina->render_historias_clinicas();
				if ($this->session->userdata("tipo_usuario") == "1") {
					$vista["config"] = $this->pagina->generar_configuraciones();
				}
				
				$this->load->view('administrador/vista_general.php',$vista);
				
		}else{
			redirect("acceso");
		}
	}
}