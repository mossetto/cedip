<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//extendemos el controlador base de codeigniter
class Super_Controller extends CI_Controller{
	private $usuario;
	public $pagina;
	public $vehiculo;
	
	public function __construct(){
		parent::__construct();
		date_default_timezone_set("America/Argentina/Buenos_Aires");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library("Pagina");
//        $this->load->library("Usuario");
//        $this->load->library("Vehiculo");
//        $this->load->library('grocery_CRUD');
//        $this->usuario=new Usuario();
		  $this->pagina=new Pagina();
//        $this->vehiculo=new Vehiculo();

		  if($this->session->userdata("ingresado") != TRUE)
		  {
			exit;
		  }
	}
 
	
	
	/**********************************
	*  MODULO PERMISO
	**********************************/
	
	public function dar_permiso_a_modulo($id_modulo = null)
	{
		$tipo_usuario = (int)$this->session->userdata("tipo_usuario");
		
		if($tipo_usuario != 1 && $tipo_usuario != 2)
		{
		
			if($id_modulo!= null)
			{
				$array=$this->Usuario_model->get_permiso_modulo_usuario($id_modulo,$this->session->userdata("dni"));
				$respuesta= (boolean)$array;

				if($respuesta && $this->session->userdata("operativo") != "si")
				{
					$respuesta=false;
				}
				return $respuesta;
			}
		}
		else
		{
			return true;
		}
	}
	
	
	/************************************
	 * MODULOS CON COMPROBACIONES
	 *************************************/
	
	// MODULO CAJA
	public function caja($fecha = null) {
		if ($this->dar_permiso_a_modulo(1))
		{
			$this->load->model("Caja_model");
			$this->load->model("Movimiento_caja_model");

			if($fecha == null)
			{
				$fecha = "".Date("Y-m-d");
			}
		
			$entradas = 0;
			$salidas = 0;
			$total = 0;

			$listado_entradas = $this->Caja_model->obtener_listado_entradas($fecha);
			$listado_salidas = $this->Caja_model->obtener_listado_salidas($fecha);
			
			foreach($listado_entradas as $e){
				$entradas+=$e["importe"];
			}
			
			foreach($listado_salidas as $s){
				$salidas+=$s["importe"];
			}
			
			$total=$entradas-$salidas;


			$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
			$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
			$dni=$this->session->userdata('dni');
			$nombre=$this->session->userdata('nombre');
			$apellido=$this->session->userdata('apellido');
			$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
			$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
			$vista["seccion"] = "Escritorio";
			$vista["detalle"] = $this->pagina->generar_pantalla_ingreso_caja($fecha,$entradas, $salidas, $total,$listado_entradas,$listado_salidas);
			$this->load->view('secretaria/vista_general.php',$vista);
		}
		else
		{
			redirect("acceso");
		}  
	}

	public function imprimir_caja($fecha = null) {
		if ($this->dar_permiso_a_modulo(1))
		{
			$this->load->model("Caja_model");
			$this->load->model("Movimiento_caja_model");

			if($fecha == null)
			{
				$fecha = "".Date("Y-m-d");
			}
		
			$entradas = 0;
			$salidas = 0;
			$total = 0;

			$listado_entradas = $this->Caja_model->obtener_listado_entradas($fecha);
			$listado_salidas = $this->Caja_model->obtener_listado_salidas($fecha);
			
			foreach($listado_entradas as $e){
				$entradas+=$e["importe"];
			}
			
			foreach($listado_salidas as $s){
				$salidas+=$s["importe"];
			}
			
			$total=$entradas-$salidas;
			
			$vista["impresion"]=$this->pagina->generar_impresion_caja($fecha,$entradas,$salidas,$listado_entradas,$listado_salidas);

			$this->load->view('reportes/impresion.php',$vista);
		}
		else
		{
			redirect("acceso");
		}  
	}

	// FIN MODULO CAJA 
	
	// MODULO ESPECIALIDADES
	public function abm_especialidades() {
		if ($this->dar_permiso_a_modulo(2)){
			try{
				$crud = new grocery_CRUD();           
				$crud->set_table('especialidades');
				$crud->required_fields('especialidad');
				$crud->columns('codigo','especialidad');
				$output = $crud->render();
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "ABM Especialidades";
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
	
	// FIN MODULO ESPECIALIDADES
	
	// MODULO OBRAS SOCIALES
	
	 public function abm_obrassociales()
	{
		if ($this->dar_permiso_a_modulo(3)){ 
			try{
				$crud = new grocery_CRUD();           
				$crud->set_table('obras_sociales');
				$crud->required_fields('razon_social','direccion','telefono','correo','dia_vencimiento');
				$crud->columns('codigo','razon_social','direccion','telefono','correo','dia_vencimiento');
				$output = $crud->render();
				
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "ABM Obras Sociales";
				$this->load->view('administrador/cabecera.php',$vista);
				$this->load->view('administrador/detalle.php',$output);
				$this->load->view('administrador/pie.php');

			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

		}else{
			redirect("acceso");
		}
	}
	
	public function abm_nomenclador()
	{
		if ($this->dar_permiso_a_modulo(3))
		{
			try{
				$crud = new grocery_CRUD();           
				$crud->set_table('nomenclador');
				$crud->set_relation('cod_obra_social','obras_sociales','razon_social');
				$crud->set_relation('cod_especialidad','especialidades','especialidad');
				$crud->required_fields('cod_obra_social','cod_especialidad','precio','fecha_hasta');
				$crud->columns('cod_nomen_obra_social','cod_obra_social','cod_especialidad','precio','fecha_hasta');
				$output = $crud->render();
				
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "ABM Nomenclador";
				$this->load->view('administrador/cabecera.php',$vista);
				$this->load->view('administrador/detalle.php',$output);
				$this->load->view('administrador/pie.php');

			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

		}else{
			redirect("acceso");
		}
	}
	
	
	// FIN MODULO OBRAS SOCIALES
	
	// MODULO PACIENTES
	
	public function abm_pacientes() {
		if ($this->dar_permiso_a_modulo(4))
		{
			try{
				$crud = new grocery_CRUD();           
				$crud->set_table('pacientes');
				$crud->set_relation('localidad','localidades','descripcion');
				$crud->set_relation('cod_obra_social','obras_sociales','razon_social');
				$crud->set_relation('usuario','usuarios_sistema_empleados','descripcion');
				$crud->required_fields('dni','nombre','apellido','correo','pass_web', 'telefono','celular','direccion','localidad','cod_obra_social', 'fecha_ingresado', 'usuario', 'estado');
				$crud->columns('dni','nombre','apellido','correo', 'pass_web','telefono','celular','direccion','localidad','cod_obra_social','estado');

				$crud->callback_after_insert(function ($post_array,$primary_key) {

					return false;
					//$post_array['date_edition']=date("Y-m-d H:i:s");
					//$post_array['editeur']=$this->session->username;
					//return var_dump($post_array);
					
				});

				$crud->callback_after_update(function ($post_array,$primary_key) {

					return false;
					//$post_array['date_edition']=date("Y-m-d H:i:s");
					//$post_array['editeur']=$this->session->username;
					//return var_dump($post_array);
					
				});




				$output = $crud->render();

				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');

				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "Pacientes";

				//var_dump($output);
				$this->load->view('administrador/cabecera.php',$vista);
				$this->load->view('administrador/detalle.php',$output);
				$this->load->view('administrador/pie.php', $output);

			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}else{
			redirect("acceso");
		}
	}
	
	public function abm_historias_clinicas() {
		if ($this->dar_permiso_a_modulo(4)) 
		{
			$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
			$dni=$this->session->userdata('dni');
			$nombre=$this->session->userdata('nombre');
			$apellido=$this->session->userdata('apellido');
			$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
			$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
			$vista["seccion"] = "ABM Historias Clinicas";
			$vista["detalle"] = $this->load->render_historias_clinicas();
			if ($this->session->userdata("tipo_usuario") == "1") {
				$vista["config"] = $this->pagina->generar_configuraciones();
			}
			
			$this->load->view('secretaria/vista_general.php',$vista);

		}else{
			redirect("acceso");
		}
	}

	public function ver_odontograma($id_historia_clinica = 0) {

		$this->load->model("Historias_Clinicas_model");

		$historia_clinica = $this->Historias_Clinicas_model->getHistoriaClinicaConJoin($id_historia_clinica);

		if ($this->dar_permiso_a_modulo(4) && $historia_clinica) 
		{
			// SE BUSCA EL ODONTOGRAMA SINO ESTA, SE CREA

			$this->load->model("Odontograma_model");

			$odontograma = $this->Odontograma_model->get_odontograma_por_historia($id_historia_clinica);

			if(!$odontograma){
				$this->Odontograma_model->agregar_odontograma($id_historia_clinica,"","","");
				$odontograma = $this->Odontograma_model->get_odontograma_por_historia($id_historia_clinica);
			}

			// FIN SUBIDA / OBTENCION ODONTOGRAMA

			$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
			$dni=$this->session->userdata('dni');
			$nombre=$this->session->userdata('nombre');
			$apellido=$this->session->userdata('apellido');
			$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
			$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
			$vista["seccion"] = "Odontograma";

			$datos_odontograma= array(
				"historia_clinica"=>$historia_clinica,
				"odontograma"=>$odontograma,
			);

			$vista["detalle"] = $this->load->view("odontograma/odontograma",$datos_odontograma,true);

			if ($this->session->userdata("tipo_usuario") == "1") {
				$vista["config"] = $this->pagina->generar_configuraciones();
			}
			
			$this->load->view('secretaria/vista_general.php',$vista);

		}else{
			redirect("acceso");
		}
	}

	public function guardar_odontograma()
	{
		if($this->dar_permiso_a_modulo(4) && $this->input->is_ajax_request() && $this->input->post())
		{
			$id_historia_clinica= $this->input->post("id_historia_clinica");
			$observaciones= $this->input->post("observaciones");
			$reservado_os= $this->input->post("reservado_os");
			$config= $this->input->post("movimientos_dibujados");

			$this->load->model("Odontograma_model");

			$respuesta = $this->Odontograma_model->editar_odontograma($id_historia_clinica,$observaciones,$reservado_os,$config);

			echo json_encode($respuesta);
		}
	}
	
	// FIN MODULO PACIENTES
	
	// MODULO REPORTES
	
	public function reporte_liquidacion_obras_sociales()
	{
		if($this->dar_permiso_a_modulo(5))
		{
			$this->load->model("Obras_sociales_model");
			$this->load->model("Especialidades_model");
			
			$obras_sociales = $this->Obras_sociales_model->getObrasSociales();
			$especialidades = $this->Especialidades_model->getEspecialidades();
			$hoy = Date("Y")."-".Date("m")."-".Date("d");
			$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
			$dni=$this->session->userdata('dni');
			$nombre=$this->session->userdata('nombre');
			$apellido=$this->session->userdata('apellido');
			$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
			$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
			$vista["seccion"] = "Liquidacion obras sociales";
			$vista["detalle"] = $this->pagina->generar_pantalla_liquidacion_obras_sociales($hoy,$obras_sociales,$especialidades);
			$this->load->view('administrador/vista_general.php',$vista);
		}
		else{
			redirect("acceso");
		}
	}
	//// reporte obras sociales
	public function reporte_obras_sociales()
	{
		if($this->dar_permiso_a_modulo(5))
		{
			
			$this->generar_filtro_reporte_reporte_obras_sociales($this->_data_first_month_day(),$this->_data_last_month_day());
			
		}
		else{
			redirect("acceso");
		}
	}
	
	public function filtrar_reporte_agrupado()
	{
		if($this->dar_permiso_a_modulo(5))
		{
			$desde = $this->input->post("fecha_desde");
			$hasta = $this->input->post("fecha_hasta");
			$this->generar_filtro_reporte_reporte_obras_sociales($desde,$hasta);
			
		}
		else{
			redirect("acceso");
		}
	}
	
	private function generar_filtro_reporte_reporte_obras_sociales($desde, $hasta) {
		$this->load->model("Reportes_model");
		$listado_total= $this->Reportes_model->obtener_listado_obras_sociales_agurpadas($desde,$hasta,"");
		$listado_cobrado=$this->Reportes_model->obtener_listado_agrupado_cobrados($desde, $hasta);
		$listado_no_cobrado=$this->Reportes_model->obtener_listado_obras_sociales_agurpadas($desde,$hasta,"no");

		$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
		$dni=$this->session->userdata('dni');
		$nombre=$this->session->userdata('nombre');
		$apellido=$this->session->userdata('apellido');
		$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
		$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
		$vista["seccion"] = "Reporte Agrupado de Obras Sociales";
		$vista["desde"]=$desde;
		$vista["hasta"]=$hasta;
		$vista["listado_total"]=$listado_total;
		$vista["listado_cobrado"]=$listado_cobrado;
		$vista["listado_no_cobrado"]=$listado_no_cobrado;

		$this->load->view('reportes/reporte_obras_sociales.php',$vista);
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////
	
	public function reporte_turnos()
	{
		if($this->dar_permiso_a_modulo(5))
		{
			
			$this->generar_filtro_reporte_turnos($this->_data_first_month_day(),$this->_data_last_month_day());
			
		}
		else{
			redirect("acceso");
		}
	}
	
	function _data_last_month_day() { 
		$month = date('m');
		$year = date('Y');
		$day = date("d", mktime(0,0,0, $month+1, 0, $year));

		return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
	}
	
	function _data_first_month_day() {
		$month = date('m');
		$year = date('Y');
		return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
	}
	
	public function filtrar_reporte_turnos()
	{
		if($this->dar_permiso_a_modulo(5))
		{
			$desde = $this->input->post("fecha_desde");
			$hasta = $this->input->post("fecha_hasta");
			$this->generar_filtro_reporte_turnos($desde,$hasta);
			
		}
		else{
			redirect("acceso");
		}
	}
	
	public function filtrar_reporte_cobros()
	{
		if($this->dar_permiso_a_modulo(5))
		{
			$desde = $this->input->post("fecha_desde");
			$hasta = $this->input->post("fecha_hasta");
			$tipo_cobro = $this->input->post("tipo_cobro");
			$obra_social = $this->input->post("obra_social");
			$this->generar_filtro_reporte_cobros($desde,$hasta, $tipo_cobro, $obra_social);
			
		}
		else{
			redirect("acceso");
		}
	}
	
	private function generar_filtro_reporte_turnos($desde, $hasta) {
		$this->load->model("Reportes_model");
		$listado= $this->Reportes_model->listado_turnos($desde,$hasta);
		

		$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
		$dni=$this->session->userdata('dni');
		$nombre=$this->session->userdata('nombre');
		$apellido=$this->session->userdata('apellido');
		$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
		$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
		$vista["seccion"] = "Listado de Turnos";
		$vista["desde"]=$desde;
		$vista["hasta"]=$hasta;
		$vista["listado"]=$listado;

		$this->load->view('reportes/reporte_turnos.php',$vista);
	}
	
	public function reporte_cobros() {
		if($this->dar_permiso_a_modulo(5))
		{
			$tipo_cobro="t";
			$obra_social="t";
			$paciente="t";
			$this->generar_filtro_reporte_cobros($this->_data_first_month_day(),$this->_data_last_month_day(),$tipo_cobro, $obra_social, $paciente);
			
		}
		else{
			redirect("acceso");
		}
	}
	
	public function generar_filtro_reporte_cobros($fecha_desde, $fecha_hasta, $tipo_cobro, $obra_social){
		$this->load->model("Reportes_model");
		$this->load->model("Cobros_model");
		$this->load->model("Obras_sociales_model");
		$listado= $this->Reportes_model->listado_cobros($fecha_desde, $fecha_hasta, $tipo_cobro, $obra_social);
		

		$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
		$dni=$this->session->userdata('dni');
		$nombre=$this->session->userdata('nombre');
		$apellido=$this->session->userdata('apellido');
		$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
		$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
		$vista["seccion"] = "Reporte de cobros";
		$vista["desde"]=$fecha_desde;
		$vista["hasta"]=$fecha_hasta;
		$vista["listado"]=$listado;
		$vista["tipo_cobros"]=$this->Cobros_model->get_tipo_cobros();
		$vista["obra_sociales"]=$this->Obras_sociales_model->getObrasSociales();
		$total=0;
		foreach ($listado as $l) {
			$total=$total+$l["importe"];
		}
		 $vista["total_consulta"]=$total;
		
		$this->load->view('reportes/reporte_cobros.php',$vista);
	}
	
	// FIN MODULO REPORTES
	
	// COBRAR TURNOS PARA LA TABLA COBROS
	public function cobrar_turnos($turno)
	{
		if($this->dar_permiso_a_modulo(5))
		{
			if(!empty($turno)){
				$hoy = Date("Y")."-".Date("m")."-".Date("d");
				$this->mostrar_vista_cobro($turno,$hoy);      
			}else{
				redirect("acceso");
			}
		}
		else{
			redirect("acceso");
		}
	}
	
	
	public function mostrar_vista_cobro($turno, $fecha) {
		$this->load->model("Turnos_model");
		$this->load->model("Pacientes_model");
		$this->load->model("Cobros_model");
		$this->load->model("Obras_sociales_model");
		$turno_seleccionado= $this->Turnos_model->obtener_turno($turno);
		
		if(!empty($turno_seleccionado)){
			$paciente=$this->Pacientes_model->obtener_paciente($turno_seleccionado["paciente"]);
			if(!empty($paciente)){
				$listado_cobros=$this->Cobros_model->get_cobros($turno);
				$abonado=0;
				foreach ($listado_cobros as $c) {
					$abonado=$abonado+$c["importe"];
				}
				$diferencia=$turno_seleccionado["importe"]-$abonado;
					
				if($diferencia<=0){
					$this->Cobros_model->update_cobro_turno($turno,"si");
					
				}else{
					$this->Cobros_model->update_cobro_turno($turno,"no");
					
				}
				
				$turno_seleccionado= $this->Turnos_model->obtener_turno($turno);
				$diferencia=$turno_seleccionado["importe"]-$abonado;
				
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				
				$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "Gestor de cobro: Turno ".$turno;
				$vista["turno"]=$turno_seleccionado;
				$vista["valor_turno"]=$turno_seleccionado["importe"];
				$vista["abonado"]=$abonado;
				$vista["fecha"]=$fecha;
				$vista["tipo_cobros"]=$this->Cobros_model->get_tipo_cobros();
				$vista["obra_sociales"]=$this->Obras_sociales_model->getObrasSociales();
				$vista["diferencia"]=$diferencia;
				$vista["paciente"]=$paciente;
				$vista["listado_cobros"]=$listado_cobros;

				$this->load->view('administrador/cobrar_turno.php',$vista);
			}else{
				redirect("acceso");
			}
			
			
		}else{
			redirect("acceso");
		}
		

		
	}
	
	public function afectar_caja($turno_id, $importe)
	{
		
		$this->load->model("Turnos_model");
		$this->load->model("Nomenclador_model");
		$this->load->model("Factura_model");
		$this->load->model("Caja_model");

		$codigo= $turno_id;
		$turno = $this->Turnos_model->getTurno($codigo);
		$precio_aux= $importe;

		$this->Factura_model->agregarFactura($precio_aux,$turno[0]["paciente"],$codigo);
		$numero = $this->Factura_model->getUltimaFactura();
		$detalle="cobro turno";
		$this->Caja_model->registrar_cobro_caja($numero["numero"],Date("Y-m-d"), "e", $precio_aux, $detalle, $this->session->userdata("dni"),1,"e");

		
		
	}
	
	public function registrar_pago_turno() {
		if ($this->input->is_ajax_request()){
			$turno=$this->input->post('turno');
			if(!empty($turno)){
				$fecha=$this->input->post('fecha');
				$tipo=$this->input->post('tipo');
				$obra=$this->input->post('obra');
				$importe=$this->input->post('importe');
				$caja=$this->input->post('caja');
				$this->load->model("Cobros_model");
				$this->Cobros_model->insertar_cobro($turno,$fecha,$tipo,$importe,$obra);
				
				if($caja=='si'){
					
					$this->afectar_caja($turno,$importe);
				}
			}else{
				redirect("acceso");
			}
		}else{
			redirect("acceso");
		}
	}
	
	public function eliminar_pago_turno(){
		 if ($this->input->is_ajax_request()){
			 $id=$this->input->post('id');
			 if(!empty($id)){
				$this->load->model("Cobros_model");
				$this->Cobros_model->borrar_cobro($id);
			 }
		 }
	}
	
	public function eliminar_turno(){
		 if ($this->input->is_ajax_request()){
			 $id=$this->input->post('id');
			 if(!empty($id)){
				$this->load->model("Turnos_model");
				$this->load->model("Cobros_model");
				$this->Turnos_model->borrar_turno($id);
				$this->Cobros_model->borrar_cobro_by_turno($id);
			 }
		 }
	}
	
	public function actualizar_precio_turno(){
		if ($this->input->is_ajax_request()){
		   $id=$this->input->post('id');
		   $precio=$this->input->post('precio');
		   if(!empty($id)){
			   $this->load->model("Cobros_model");
			   $this->Cobros_model->update_precio_turno($id,$precio);
		   }
		}
	}
	
	/**********************************
	*  Mario
	**********************************/
   
   public function miPerfil()
   {
		if ($this->session->userdata("ingresado") && $this->session->userdata("operativo") == "si") 
		{
			$dni=$this->session->userdata('dni');
			
			$this->load->model("Usuario_model");
			$resultado = $this->Usuario_model->getDatosRelacionados($dni);
			
			   
			$this->session->set_userdata('email', $resultado["correo"]);
			$this->session->set_userdata('nombre', $resultado["nombre"]);
			$this->session->set_userdata('apellido', $resultado["apellido"]);
			$this->session->set_userdata('telefono', $resultado["telefono"]);
			$this->session->set_userdata('movil', $resultado["movil"]);
			$this->session->set_userdata('usuario', $resultado["usuario"]);
			$this->session->set_userdata('inicio', $resultado["inicio"]);
			$this->session->set_userdata('imagen', $resultado["imagen"]);
			$this->session->set_userdata('apellido', $resultado["apellido"]);

			$imagen=base_url()."recursos/img/empleados/".$resultado["imagen"];
			
			$nombre=$this->session->userdata('nombre');
			$apellido=$this->session->userdata('apellido');
			
			$tipo_usuario = $this->session->userdata("tipo_usuario");
			
			$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
			$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
				
			
			
			
			$vista["detalle"] = 
			$this->pagina->generar_render_datos_personales($resultado["dni"],
										$resultado["correo"],$resultado["usuario"],$resultado["pass"],$resultado["nombre"],
										$resultado["apellido"],$resultado["telefono"],$resultado["movil"],$resultado["tipo_usuario"],
										$resultado["direccion"],$resultado["sucursal"],$resultado["localidad"],base_url()."recursos/img/empleados/".$resultado["imagen"],
										$resultado["inicio"],$resultado["operativo"]); // fin de funcion generar datos personales
			
			$vista["seccion"] = "Mi perfil";
			$this->load->view('administrador/vista_general.php',$vista);
		}
		else
		{
			redirect("acceso");
		}
   }  
   
   public function actualizar_datos()
	{ 
		if($this->input->post())
		{
			if ($this->session->userdata("ingresado") && $this->session->userdata("operativo") == "si") 
			{
				
			   
				// SUBIDA DE IMAGEN
				$imagen ="";
				$config['upload_path'] = "./recursos/img/empleados/";
				$config['allowed_types'] = "jpg|jpeg|png";
				$config ['max_size'] = '1000';

				$this->load->library("upload",$config);

				if($this->upload->do_upload("imagen")) // si se sube la imagen
				{
				   $imagen = $this->upload->data("file_name");
				}
				// fin subida de imagen
				
				
				$this->load->model("Usuario_model");
				$this->Usuario_model->actualizaDatosUsuario($this->session->userdata('dni'),$this->input->post("usuario"),$this->input->post("password"),
																$this->input->post("nombre"),$this->input->post("apellido"),
																$this->input->post("telefono"),$this->input->post("movil"),
																$this->input->post("direccion"),
																$this->input->post("correo"),$imagen);
				
				/*$this->usuario->actualizarDatos($dni,$this->input->post("usuario"),$this->input->post("password"),
																$this->input->post("nombre"),$this->input->post("apellido"),
																$this->input->post("telefono"),$this->input->post("movil"),
																$this->input->post("direccion"),
																$this->input->post("correo"),$imagen);*/
				
				redirect("Secretaria/miPerfil");
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
	
	public function cerrar_sesion()
	{
		$this->session->sess_destroy();
		redirect("acceso");
	}
	
	public function prueba()
	{
		$busqueda = new MarioSearch();
	}
	
	public function getProfesional()
	{
		if (true) 
		{
			
		  $this->load->model("Profesionales_model");
		  
		  $resultado = $this->Profesionales_model->getProfesional($this->input->post("codigo"));
		  
		  echo json_encode($resultado);
		}else{
			redirect("acceso");
		}
	}
	
	public function getTiposEmpleados()
	{
		if ($this->input->is_ajax_request()) 
		{
			
		  $this->load->model("Empleados_model");
		  
		  $resultado = $this->Empleados_model->getTiposEmpleados();
		  
		  echo json_encode($resultado);
		}
		else
		{
			redirect("acceso");
		}
	}
	
	public function getProfesionalesPorEspecialidad()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model("Profesionales_model");
			$resultado = $this->Profesionales_model->getProfesionalesPorEspecialidad($this->input->post("especialidad"));
			
			echo json_encode($resultado);
		}
		else
		{
			redirect("acceso");
		}
	}
	
	public function getTurnosPorProfesionalEspecialidadMesAnio()
	{
		$this->load->model("Turnos_model");
		
		$cod_profesional=$this->input->post("profesional");
		$cod_especialidad=$this->input->post("especialidad");
		$mes=$this->input->post("mes");
		$anio=$this->input->post("anio");
		
		$resultado = $this->Turnos_model->getTurnosPorProfesionalEspecialidadMesAnio($cod_profesional,$cod_especialidad,$mes,$anio);
		echo json_encode($resultado);
	}
	
	public function getTurnosHoyLista()
	{
		if ($this->input->is_ajax_request()) 
		{
		  $this->load->model("Turnos_model");
		  
		  $resultado = $this->Turnos_model->getTurnosHoyLista();
		  
		  for($i=0; $i < count($resultado);$i++)
		  {
			  $resultado[$i]["nombre_profesional"]=$resultado[$i]["nombre_profesional"]." ".$resultado[$i]["apellido_profesional"];
			  $resultado[$i]["nombre"]=$resultado[$i]["nombre"]." ".$resultado[$i]["apellido"];
		  }
		  echo json_encode($resultado);
		}else{
			redirect("acceso");
		}
	}
	
	public function getHorariosDia()
	{
		if ($this->input->is_ajax_request()) 
		{
		  $this->load->model("Profesionales_model");
		  $fecha = $this->input->post("fecha");
		  $profesional = $this->input->post("profesional");
		  $anio =  $this->input->post("anio");
		  $mes = $this->input->post("mes");
		  $dia = $this->input->post("dia");
		  $numero_dia = date("N", strtotime("$fecha"));

		  $id_tipo_usuario = (int)$this->session->userdata("tipo_usuario");


			if($id_tipo_usuario == 4)
			{
				$codigo_profesional = $this->Profesionales_model->getCodigoProfesionalPorDni($this->session->userdata('dni'));
			  $profesional = $codigo_profesional[0]['codigo'];
			}
		  

		  
		  
		  $this->load->model("Turnos_model");
		  $this->load->model("Horarios_model");
		  $profesional_nombre_apellido = $this->Profesionales_model->getNombreApellidoProfesional($profesional);
		  $turnos_profesional_hoy = $this->Turnos_model->getHorariosPorFechaProfesional($fecha,$profesional);
		  $horarios_profesional = $this->Horarios_model->getHorariosProfesional($profesional,$numero_dia,$anio,$mes);
		  
		  // CANCELADO: OBTENIA LOS TURNOS EN LISTA
		  //$resultado = $this->pagina->render_horarios_dia($turnos_profesional_hoy,$horarios_profesional,$anio,$mes,$dia,$profesional,$profesional_nombre_apellido);

		  // METODO QUE OBTIENE LOS TURNOS EN TABLA

		  $resultado = $this->pagina->render_turnos_profesional_fecha($turnos_profesional_hoy,$dia,$mes,$anio,$profesional,$profesional_nombre_apellido);
		 
		  echo json_encode($resultado);
		}else{
			redirect("acceso");
		}
	}

	public function imprimir_turnos()
	{
		$this->load->model("Turnos_model");
		$this->load->model("Profesionales_model");

		$anio = (int)$this->input->get("anio");
		$mes = (int)$this->input->get("mes");
		$dia = (int)$this->input->get("dia");
		$profesional = (int)$this->input->get("profesional");

		if($mes < 10)
		{
			$mes="0".$mes;
		}

		if($dia < 10)
		{
			$dia="0".$dia;
		}

		$fecha = $anio."-".$mes."-".$dia;


		$turnos_profesional_hoy = $this->Turnos_model->getHorariosPorFechaProfesional($fecha,$profesional);

		$fecha = DateTime::createFromFormat("Y-m-d",$fecha);
		$fecha = $fecha->format("d-m-Y");

		$impresion="<h2>Turnos correspondientes a ".$fecha;

		$profesional_row = $this->Profesionales_model->getNombreApellidoProfesional($profesional);

		if($profesional_row)
		{
			$impresion.="<h3>Profesional: ".ucwords($profesional_row[0]["nombre"])." ".ucwords($profesional_row[0]["apellido"])."</h3>";
		}

		$impresion.=
		"<div class='col-md-12'>
		  <table class='table table-bordered table-responsive' style='width: 100%;'>
			<thead>
			  <tr>
				<th>Profesional</th>
				<th>Paciente</th>
				<th>Dni</th>
				<th>Desde</th>
				<th>Hasta</th>
				<th>Estado</th>
				<th>Observaciones</th>
				<th></th>
			  </tr>
			</thead>
			<tbody>";

			foreach($turnos_profesional_hoy as $turno)
			{
			  $impresion.=
			  "<tr>
				<td>".$turno["nombre_profesional"]." ".$turno["apellido_profesional"]."</td>
				<td>".$turno["pacientes_nombre"]." ".$turno["pacientes_apellido"]."</td>
				<td>".$turno["paciente"]."</td>
				<td>".$turno["hora_desde"]."</td>
				<td>".$turno["hora_hasta"]."</td>
				<td>".$turno["estado"]."</td>
				<td>".$turno["observaciones"]."</td>
			  </tr>";
			}

		  $impresion.="
			</tbody>
		  </table>";

		  $salida["impresion"]=$impresion;

		$this->load->view("reportes/impresion",$salida);


	}
	
	public function getPacientesPorSugerencia()
	{
		if ($this->input->is_ajax_request()) 
		{
		  $this->load->model('Pacientes_model');
		  
		  $resultado = $this->Pacientes_model->getPacientesPorSugerencia($this->input->post("dni"));
		  
		  for($i=0; $i < count($resultado);$i++)
		  {
			  $resultado[$i]["nombre"]=$resultado[$i]["nombre"]." ".$resultado[$i]["apellido"];
		  }
		  echo json_encode($resultado);
		}else{
			redirect("acceso");
		}    
	}
	
	public function prueba_fechas()
	{
		$fecha = DateTime::createFromFormat("Y-m-d","2018-05-24");

		echo $fecha->format("w");
	}

	public function htmlRegistrarTurno()
	{
		if ($this->input->is_ajax_request()) 
		{
		  $this->load->model("Pacientes_model");
		  $this->load->model("Profesionales_model");
		  $this->load->model("Especialidades_model");
		  $this->load->model("Turnos_model");
		  
		$profesional = $this->input->post("profesional");

		$id_tipo_usuario = (int)$this->session->userdata("tipo_usuario");


		if($id_tipo_usuario == 4)
		{
			$codigo_profesional = $this->Profesionales_model->getCodigoProfesionalPorDni($this->session->userdata('dni'));
		  $profesional = $codigo_profesional[0]['codigo'];
		}
		  
		  $especialidades_profesional= $this->Profesionales_model->getEspecialidadesProfesional($profesional);

		  $fecha = $this->input->post("fecha");
		  $hora_desde = $this->input->post("hora_desde");
		  $hora_hasta = $this->input->post("hora_hasta");
		  $nombre = $this->input->post("nombre");
		  $apellido = $this->input->post("apellido");

		  $pacientes = $this->Pacientes_model->getPacientes();
		  
		  $primer_paciente = $this->Pacientes_model->getPrimerPaciente();
		  $primera_especialidad = $this->Especialidades_model->getPrimeraEspecialidad();
		  $obra_social_primer_paciente = $this->Pacientes_model->getObraSocialPaciente($primer_paciente["dni"]);
		  
		  $id_obra_social = 0;

		  if($obra_social_primer_paciente)
		  {
			$id_obra_social = $obra_social_primer_paciente["codigo"];
		  }

		  $precio= $this->Turnos_model->getDatosNomencladorTurno($primera_especialidad["codigo"],$id_obra_social);
		  
		  $turnos_profesional_hoy = $this->Turnos_model->getHorariosPorFechaProfesional($fecha,$profesional);

		  $resultado = $this->pagina->render_registrar_turno($profesional,$fecha,$pacientes,$especialidades_profesional,$nombre,$apellido,$obra_social_primer_paciente,$precio["precio"],$turnos_profesional_hoy);
		  
		  echo json_encode($resultado);
		}else{
			redirect("acceso");
		}    
	}



	public function getHtmlListadoTurnosPaciente()
	{
		if ($this->input->is_ajax_request()) 
		{
			$this->load->model("Turnos_model");
		  
			$dni = $this->input->post("dni");

			$turnos = $this->Turnos_model->getTurnosPaciente($dni);
		  
			$resultado = $this->pagina->render_turnos_pacientes($turnos);
		  
			echo json_encode($resultado);
			
		}else{
			redirect("acceso");
		}
	}
	
	public function registrar_turno()
	{
		if ($this->input->is_ajax_request()) 
		{
		  
		  $profesional = $this->input->post("profesional");
		  $fecha = $this->input->post("fecha");
		  $hora_desde = $this->input->post("hora_desde");
		  $hora_hasta = $this->input->post("hora_hasta");
		  $paciente = $this->input->post("paciente");
		  $estado = $this->input->post("estado");
		  $especialidad = $this->input->post("especialidad");
		  $importe = $this->input->post("precio");
		  $cobrado = $this->input->post("cobrado");
		  $obra_social = $this->input->post("obra_social");
		  $observaciones = $this->input->post("observaciones");
		  $afecta_caja = $this->input->post("afecta_caja");
		  
		  
		  $mensaje ="";
		  
		  $this->load->model("Pacientes_model");
		  
		  if($this->Pacientes_model->getPaciente($paciente))
		  {
			 
			 $this->load->model("Turnos_model");
			 
			 // SI ES FORMATO ES 00:00
			if(strlen($hora_desde) == 5)
			{
				$hora_desde.=":00";
			} 

			 // SI ES FORMATO ES 00:00
			if(strlen($hora_hasta) == 5)
			{
				$hora_hasta.=":00";
			} 

//            $disponible = $this->Turnos_model->comprobar_disponibilidad_turno($profesional,$fecha,$hora_desde,$hora_hasta);
			$disponible = true;

			if($disponible)
			{
				if($this->Turnos_model->agregarTurno($fecha,$hora_desde,$hora_hasta,$profesional,$paciente,$estado,$especialidad,$importe,$cobrado,$obra_social,$observaciones))
				{
					if($afecta_caja == true && $estado == "cumplido")
					{
						$this->load->model("Factura_model");
						$this->load->model("Caja_model");

						$codigo_turno = $this->Turnos_model->getCodigoUltimoTurno();
						$codigo_turno = $codigo_turno[0]["codigo"];

						$this->Factura_model->agregarFactura($importe,$paciente,$codigo_turno);
						$numero = $this->Factura_model->getUltimaFactura();

						$detalle="cobro turno N°".$codigo_turno;

						$this->Caja_model->registrar_cobro_caja($numero["numero"],Date("Y-m-d"), "e", $importe, $detalle, $this->session->userdata("dni"),1,"e");
					}

					$mensaje="Turno agregado correctamente";  
				}
				else
				{
					$mensaje="No se ha podido agregar"; 
				}
			}
			else
			{
				$mensaje="Horario no disponible";
			}
		  }
		  else
		  {
			  $mensaje="Paciente no encontrado";
		  }
		  
		  echo json_encode($mensaje);
		}else{
			redirect("acceso");
		}    
	}

	public function fix_caja(){
		$this->load->model("Caja_model");
		$this->load->model("Movimiento_caja_model");

		$listado_cajas = $this->db->query("SELECT DISTINCT(fecha) as fecha FROM caja_detalle");
		$listado_cajas = $listado_cajas->result_array();

		$this->db->query("truncate caja");

		foreach($listado_cajas as $caja)
		{
			$fecha = $caja["fecha"];

			$entradas = 0;
			$salidas = 0;
			$total = 0;

			$listado_entradas = $this->Caja_model->obtener_listado_entradas($fecha);
			$listado_salidas = $this->Caja_model->obtener_listado_salidas($fecha);
			
			foreach($listado_entradas as $e){
				$entradas+=$e["importe"];
			}
			
			foreach($listado_salidas as $s){
				$salidas+=$s["importe"];
			}
			
			$total=$entradas-$salidas;

			// AGREGO LA CAJA

			$this->db->query("INSERT INTO caja (codigo, fecha, entradas, salidas, saldo, estado) VALUES (NULL, '".$fecha."', '".$entradas."', '".$salidas."', '".$total."', 'a');");
		}
	}
	
	public function actualizar_turno()
	{
		if ($this->input->is_ajax_request()) 
		{
		  $codigo = $this->input->post("codigo");
		  $profesional = $this->input->post("profesional");
		  $fecha = $this->input->post("fecha");
		  $hora_desde = $this->input->post("hora_desde");
		  $hora_hasta = $this->input->post("hora_hasta");
		  $paciente = $this->input->post("paciente");
		  $estado = $this->input->post("estado");
		  $especialidad = $this->input->post("especialidad");
		  $observaciones = $this->input->post("observaciones");
		  $afecta_caja = $this->input->post("afecta_caja");
			
		  
		  $this->load->model("Pacientes_model");
		  
		  $mensaje ="";
		  
		  if($this->Pacientes_model->getPaciente($paciente))
		  {
			 $this->load->model("Turnos_model");
			 
			 if($this->Turnos_model->actualizarTurno($codigo,$fecha,$hora_desde,$hora_hasta,$profesional,$paciente,$estado,$especialidad,$observaciones))
			 {
				if($afecta_caja == true && $estado == "cumplido")
				{
					$this->load->model("Factura_model");
					$this->load->model("Caja_model");

					$codigo_turno = $codigo;

					$turno_row = $this->Turnos_model->getTurno($codigo);

					$this->Factura_model->agregarFactura($turno_row[0]["importe"],$turno_row[0]["paciente"],$codigo_turno);
					$numero = $this->Factura_model->getUltimaFactura();

					$detalle="cobro turno N°".$codigo_turno;
					
					$this->Caja_model->registrar_cobro_caja($numero["numero"],Date("Y-m-d"), "e", $turno_row[0]["importe"], $detalle, $this->session->userdata("dni"),1,"e");
				}

			   $mensaje="Turno actualizado correctamente";  
			 }
		  }
		  else
		  {
			  $mensaje="Turno no actualizado";
		  }
		  
		  echo json_encode($mensaje);
		}else{
			redirect("acceso");
		}    
	}
	
	public function borrar_turno()
	{
		if ($this->input->is_ajax_request()) 
		{
		  $codigo = $this->input->post("codigo");
		  /*$profesional = $this->input->post("profesional");
		  $fecha = $this->input->post("fecha");
		  $hora_desde = $this->input->post("hora_desde");
		  $hora_hasta = $this->input->post("hora_hasta");
		  $paciente = $this->input->post("paciente");
		  $estado = $this->input->post("estado");
		  $especialidad = $this->input->post("especialidad");*/
		  
		  $this->load->model("Turnos_model");
		 
		  echo json_encode($this->Turnos_model->borrar_turno($codigo));
		  
		  
		}else{
			redirect("acceso");
		}    
	}
	
	public function getPacientesConHistoriaClinica()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model("Historias_Clinicas_model");
			$resultado = $this->Historias_Clinicas_model->getPacientesConHistoriaClinica();
			echo json_encode($resultado);
		}
		else
		{
			redirect("acceso");
		}
	}
	
	public function htmlAdministrarTurno()
	{
		if ($this->input->is_ajax_request()) 
		{
			$this->load->model("Pacientes_model");
			$this->load->model("Profesionales_model");
			$pacientes = $this->Pacientes_model->getPacientes();
			$this->load->model("Turnos_model");
			$this->load->model("Especialidades_model");
			$this->load->model("Pacientes_model");
			
			$codigo = $this->input->post("codigo");
			
			$turno = $this->Turnos_model->getTurno($codigo);
			$paciente = $this->Pacientes_model->getPaciente($turno[0]["paciente"]);
			$profesional = $turno[0]["profesional"];
			$profesional_nombre_apellido = $this->Profesionales_model->getNombreApellidoProfesional($profesional);
			
			$especialidad= $this->Especialidades_model->getEspecialidad($turno[0]["especialidad"]);
			$resultado ="";
			
			if($turno)
			{
				$resultado = $this->pagina->render_administrar_turno($turno[0],$pacientes,$especialidad,$profesional_nombre_apellido,$paciente);
			}
			else
			{
				$resultado = "Ha ocurrido un problema";
			}
			
			echo json_encode($resultado);
		}else{
			redirect("acceso");
		}
	}
	
		
	
	public function getListadoPacientes()
	{
		if ($this->input->is_ajax_request()) 
		{
			$this->load->model("Pacientes_model");
			$resultado = $this->Pacientes_model->getPacientes();
			echo json_encode($resultado);
		}else{
			redirect("acceso");
		}
	}
	
	
   
	
	public function sincroniza_con_historias_clinicas()
	{
		$estado = $this->input->post("estado");
		
		if ($this->input->is_ajax_request()) 
		{
			$codigo_turno = $this->input->post("codigo");
			
			$this->load->model("Historias_Clinicas_model");
			$historia_clinica = $this->Historias_Clinicas_model->getHistoriaClinicaPorTurno($codigo_turno);
			
			if($codigo_turno != null) // SI SE ACTUALIZA UN TURNO
			{
				if($estado == "cumplido")
				{
					if($historia_clinica)
					{
						$this->Historias_Clinicas_model->editEstadoHistoriaClinica($codigo_turno,"si");
					}
					else
					{
						$this->Historias_Clinicas_model->addHistoriaClinica($codigo_turno,"si");
					}

				}
				else
				{
					
					if($historia_clinica)
					{
						$this->Historias_Clinicas_model->editEstadoHistoriaClinica($codigo_turno,"no");
					}
					else
					{
					   $this->Historias_Clinicas_model->addHistoriaClinica($codigo_turno,"no"); 
					}
				}
			}
			else // SI SE AGREGA UN TURNO
			{
				$this->load->model("Turnos_model");
				
				$codigo_turno = $this->Turnos_model->getCodigoUltimoTurno();
				$codigo_turno = $codigo_turno[0]["codigo"];
				$this->Historias_Clinicas_model->addHistoriaClinica($codigo_turno,"no");  
			}
			
			echo json_encode($estado);
		}else{
			redirect("acceso");
		}
	}
	
	public function render_ver_historia_clinica()
	{
		 if ($this->input->is_ajax_request() && $this->session->userdata("ingresado"))
		{
		  
		   $this->load->model("Historias_clinicas_model");
		   
		   $codigo = $this->input->post("codigo");
		   
		   $historia_clinica = $this->Historias_clinicas_model->getHistoriaClinica($codigo);
		   $historia_paciente = $this->Historias_clinicas_model->getHistoriaClinicaPaciente($this->input->post("dni"));

		   $resultado = $this->pagina->render_ver_historia_clinica($codigo,$historia_clinica[0],$historia_paciente);
		   
		   echo json_encode($resultado);
		}
		else{
			redirect("acceso");
		}
	}
	
	public function render_editar_historia_clinica()
	{
		
		if (true)
		{
		  
		   $this->load->model("Historias_clinicas_model");
		   
		   $codigo = $this->input->post("codigo");
		   $dni = $this->input->post("dni");
		   
		   $historia_clinica = $this->Historias_clinicas_model->getHistoriaClinica($codigo);
		   $historia_paciente = $this->Historias_clinicas_model->getHistoriaClinicaPaciente($dni);
		   $resultado = $this->pagina->render_editar_historia_clinica($codigo,$historia_clinica[0],$historia_paciente);
		   
		   echo json_encode($resultado);
		}
		else{
			redirect("acceso");
		}
	}
	
	public function getHistoriasClinicasActivas()
	{
		 if ($this->input->is_ajax_request())
		{
		   $this->load->model("Historias_clinicas_model");
		   
		   $resultado = $this->Historias_clinicas_model->getHistoriasClinicasActivas();
		   
		   for($i=0; $i < count($resultado);$i++)
		   {
			   $resultado[$i]["profesional"]= substr($resultado[$i]["nombre"], 0, 1).". ".$resultado[$i]["apellido"];
			   $resultado[$i]["especialidad"]= substr($resultado[$i]["especialidad"], 0, 10);
			   $resultado[$i]["observaciones"]= substr($resultado[$i]["observaciones"], 0, 8)."...";
		   }
		   echo json_encode($resultado);
		}
		else{
			redirect("acceso");
		}
	}
	
	public function getHistoriasClinicasActivasPorPaciente()
	{
		 if ($this->input->is_ajax_request())
		{
		   $this->load->model("Historias_clinicas_model");
		   
		   $resultado = $this->Historias_clinicas_model->getHistoriasClinicasActivasPorPaciente($this->input->post("dni"));
		   
		   for($i=0; $i < count($resultado);$i++)
		   {
			   $resultado[$i]["profesional"]= substr($resultado[$i]["nombre"], 0, 1).". ".$resultado[$i]["apellido"];
			   $resultado[$i]["especialidad"]= substr($resultado[$i]["especialidad"], 0, 15);
			   $resultado[$i]["observaciones"]= substr($resultado[$i]["observaciones"], 0, 8)."...";
		   }
		   echo json_encode($resultado);
		}
		else{
			redirect("acceso");
		}
	}
	
	public function getLiquidacionObraSocialEntreFechas()
	{
		 if ($this->input->is_ajax_request())
		{
		   $this->load->model("Nomenclador_model");
		   $obra_social = (int)$this->input->post("obra_social");
		   $especialidad = (int)$this->input->post("especialidad");
		   
		   $resultado = $this->Nomenclador_model->getLiquidacionObrasSocialesEntreFechas($this->input->post("fecha1"),$this->input->post("fecha2"),$obra_social, $especialidad);
		   
		   echo json_encode($resultado);
		}
		else{
			redirect("acceso");
		}
	}
	
   
	
	
	
	
	public function obtenerLiquidacionObrasSocialesEntreFechas()
	{
	   if(($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "2" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si")
	   {
		 $this->load->model("Nomenclador_model");
		 
		 $fecha1 = $this->input->post("fecha1");
		 $fecha2 = $this->input->post("fecha2");
		 echo json_encode($this->Nomenclador_model->getLiquidacionObraSocialEntreFechas($fecha1,$fecha2));
	   }
	   else
	   {
		   redirect("acceso");
	   } 
	}
	
	public function imprimir_reporte_liquidacion_obras_sociales($fecha1,$fecha2,$obra_social,$especialidad)
	{
		if(($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "2" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si")
	   {
			$this->load->model("Nomenclador_model");
			
			
			$obras_sociales= $this->Nomenclador_model->getLiquidacionObrasSocialesEntreFechas($fecha1,$fecha2,$obra_social,$especialidad);

			$vista["impresion"] = $this->pagina->generar_impresion_obras_sociales($fecha1,$fecha2,$obras_sociales);
			$this->load->view('reportes/impresion',$vista);
		}
		else{
			redirect("acceso");
		}
	}
	
	public function administrar_turnos_pendientes()
	{
		if(true)
		{
			$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
			$dni=$this->session->userdata('dni');
			$nombre=$this->session->userdata('nombre');
			$apellido=$this->session->userdata('apellido');
			
			$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
			$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
			$vista["seccion"] = "Turnos pendientes";
			if ($this->session->userdata("tipo_usuario") == "1") {
				$vista["config"] = $this->pagina->generar_configuraciones();
			}
			$vista["detalle"] = $this->pagina->administrar_turnos_pendientes();
			$this->load->view('administrador/vista_general.php',$vista);
		}
		else{
			redirect("acceso");
		}
	}
	
	public function getTurnosPendientes()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model("Turnos_model");
			echo json_encode($this->Turnos_model->getTurnosPendientes());
		}
		else{
			redirect("acceso");
		}
	}
	
	
	
   


	public function imprimir_turno_registrado($numero_turno)
	{
		if ($this->session->userdata("operativo") == "si") 
		{
			$this->load->model("Turnos_model");
			
			$datos_turno = $this->Turnos_model->getTurnosImpresion($numero_turno);
			$turno = $datos_turno["codigo"];
			$dni_paciente= $datos_turno["dni_paciente"];
			$fecha = $datos_turno["fecha"];
			$hora_desde = $datos_turno["hora_desde"];
			$hora_hasta = $datos_turno["hora_hasta"];
			$nombre_profesional = $datos_turno["nombre_profesional"];
			$apellido_profesional = $datos_turno["apellido_profesional"];
			$especialidad = $datos_turno["especialidad"];
			$estado = $datos_turno["estado"];
			$nombre_paciente = $datos_turno["nombre_paciente"];
			$apellido_paciente = $datos_turno["apellido_paciente"];
			$observaciones = $datos_turno["observaciones"];
			
			$vista["impresion"] = $this->pagina->generar_impresion_turno($turno,$dni_paciente,$fecha,$hora_desde,$hora_hasta,$nombre_profesional,$apellido_profesional,$especialidad,$estado,$nombre_paciente,$apellido_paciente,$observaciones);
			$this->load->view('reportes/impresion',$vista);
		}
		else{
			redirect("acceso");
		}    
	}
   
	public function imprimir_ultimo_turno()
	{
	   if ($this->session->userdata("operativo") == "si") 
		{
			$this->load->model("Turnos_model");
			
			$datos_turno = $this->Turnos_model->getUltimoTurno();
			$turno = $datos_turno["codigo"];
			$dni_paciente=$datos_turno["dni_paciente"];
			$fecha = $datos_turno["fecha"];
			$hora_desde = $datos_turno["hora_desde"];
			$hora_hasta = $datos_turno["hora_hasta"];
			$nombre_profesional = $datos_turno["nombre_profesional"];
			$apellido_profesional = $datos_turno["apellido_profesional"];
			$especialidad = $datos_turno["especialidad"];
			$estado = $datos_turno["estado"];
			$nombre_paciente = $datos_turno["nombre_paciente"];
			$apellido_paciente = $datos_turno["apellido_paciente"];
			
			$vista["impresion"] = $this->pagina->generar_impresion_turno($turno,$dni_paciente,$fecha,$hora_desde,$hora_hasta,$nombre_profesional,$apellido_profesional,$especialidad,$estado,$nombre_paciente,$apellido_paciente,$datos_turno["observaciones"]);
			$this->load->view('reportes/impresion',$vista);
		}
		else{
			redirect("acceso");
		}    
	}
	
	public function getTurnosProximosConfirmados()
	{
		if($this->input->is_ajax_request())
		{    
			$this->load->model("Turnos_model");
			echo json_encode($this->Turnos_model->getTurnosProximosConfirmados());
		}
		else
		{
			redirect(base_url());
		}
	}
	
	public function getTurnosFinalizados()
	{
		if($this->input->is_ajax_request())
		{    
			$this->load->model("Turnos_model");
			echo json_encode($this->Turnos_model->getTurnosFinalizados());
		}
		else
		{
			redirect(base_url());
		}
	}
	
	
	
 
	public function registrar_movimiento(){
	   if ($this->dar_permiso_a_modulo(1)) {
		   $this->load->model("Caja_model");
		   
		   $fecha=date('Y-m-d');
		   $concepto= $pedido= $this->input->post("concepto");
		   $importe= $this->input->post("importe");
		   $detalle= $this->input->post("detalle");
		   $empleado=$this->session->userdata('dni');
								 
		   $this->Caja_model->registrar_movimiento_caja($fecha, 5, $importe, "", $concepto, $detalle, $empleado);
		   $this->actualizar_caja($fecha);
		   $this->caja();
		}else {
			redirect("acceso");  
		}
	}
	
	private function actualizar_caja($fecha)
	{
		$this->load->model("Caja_model");
		$this->load->model("Movimiento_caja_model");

		$entradas = 0;
		$salidas = 0;
		$total = 0;

		$total_entradas = $this->db->query("SELECT sum(importe) as entradas FROM caja_detalle where fecha = '".$fecha."' and tipo_mov = 'e'");
		$total_entradas= $total_entradas->row_array();
		$total_entradas= (float)$total_entradas["entradas"];

		$total_salidas  = $this->db->query("SELECT sum(importe) as salidas FROM caja_detalle where fecha = '".$fecha."' and tipo_mov = 's'");
		$total_salidas= $total_salidas->row_array();
		$total_salidas= (float)$total_salidas["salidas"];
		
		
		$total=$total_entradas-$total_salidas;

		$this->db->query("UPDATE caja SET entradas = '".$total_entradas."', salidas = '".$total_salidas."', saldo = '".$total."' WHERE caja.fecha = '".$fecha."'");

	}

	public function getDatosNomencladorTurno()
	{
		if($this->input->is_ajax_request() && (($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "2" || $this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "4") && $this->session->userdata("operativo") == "si"))
		{
			$obra_social= $this->input->post("obra_social");
			$especialidad=$this->input->post("especialidad");

			$this->load->model("Turnos_model");
			echo json_encode($this->Turnos_model->getDatosNomencladorTurno($especialidad,$obra_social));
		}
		else
		{
			redirect("acceso");
		}
	}
	
	public function getObraSocialPaciente()
	{
		if($this->input->is_ajax_request() && (($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "2" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si"))
		{
			$paciente= $this->input->post("paciente");

			$this->load->model("Pacientes_model");
			echo json_encode($this->Pacientes_model->getObraSocialPaciente($paciente));
		}
		else
		{
			redirect("acceso");
		}
	}
	
	
	
	public function ver_detalle_comprobante() {
		
		if(($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "2" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si")
		{
			$tipo_comp=$pedido= $this->input->post("tipo_comp");
			$num_comp=$pedido= $this->input->post("num_comp");
			$this->load->model("Caja_model");
			//si el tipo de comprobante es 1 osea fc de ventas tira el listado con detalle, sino muestra el moviento de caja
			if ($tipo_comp==1) {
				$cabecera_factura=$this->Caja_model->obtener_cabecera_factura($this->session->userdata('sucursal'), $num_comp );
				$detalle_factura=$this->Caja_model->obtener_detalle_factura($this->session->userdata('sucursal'), $num_comp );
				$this->pagina->generar_detalle_venta_caja($cabecera_factura, $detalle_factura);
			}else{          
				$comprobante=$this->Caja_model->obtener_movimiento_detale_caja($num_comp);
				$this->pagina->generar_detalle_comprobante_caja($comprobante["numero"], $comprobante["fecha"], 
				$comprobante["tipo_mov"], $comprobante["importe"], $comprobante["concepto"]);
			}
		}
		else
		{
			redirect("acceso");
		}

	}
	
	public function eliminar_movimiento()
	{
		if(($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "2" || $this->session->userdata("tipo_usuario") == "3") && $this->session->userdata("operativo") == "si")
		{
			$this->load->model("Movimiento_caja_model");
//            $this->load->model("Caja_model");
			$codigo_mov = $this->input->post("codigo");
			
			
			$detalle_comprobante=$this->Movimiento_caja_model->obtener_comprobante_caja_detalle($codigo_mov);
			if($detalle_comprobante["comprobante"]!=0){
				$datos = Array(
					
					"estado"=>"c",
				);
				$this->db->where("numero",$detalle_comprobante["comprobante"]);
				$this->db->update("factura",$datos);
			}
			
			$this->Movimiento_caja_model->eliminar_detalle_caja($codigo_mov);
			
//            $caja = $this->Caja_model->obtener_caja(Date("Y-m-d"));
//            
//            $entradas = $caja["entradas"];
//            $salidas = $caja["salidas"];
//            $saldo = $caja["saldo"];
//            
//            if ($movimiento["tipo_mov"] == "e")
//            {
//                $entradas = (float)$entradas - (float)$movimiento["importe"];
//                $saldo = (float)$saldo - (float)$movimiento["importe"];
//            }
//            else
//            {
//                $salidas = (float)$salidas - (float)$movimiento["importe"];
//                $saldo = (float)$saldo + (float)$movimiento["importe"];
//            }
//                
//            $this->Caja_model->actualizar_caja($entradas,$salidas,$saldo,"a");
		}
		else
		{
			redirect("acceso");
		}
	}
	
	public function getHistoriasClinicas()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model("Historias_Clinicas_model");
			
			$historias = $this->Historias_Clinicas_model->getHistoriasClinicas();
			
			for($i=0; $i < count($historias);$i++)
			{
			   $historias[$i]["nombre_paciente"].=" ".$historias[$i]["apellido_paciente"];
			   $historias[$i]["nombre_profesional"].=" ".$historias[$i]["apellido_profesional"];
			}
	 
			echo json_encode($historias);
		}
		else
		{
			redirect("acceso");
		}
	}
	
	public function getHtmlAgregarHistoriaClinica()
	{
		 if($this->input->is_ajax_request())
		{
			$this->load->model("Profesionales_model");
			$this->load->model("Especialidades_model");
			$this->load->model("Pacientes_model");
			
			$profesionales = $this->Profesionales_model->getListadoProfesionales();
			$especialidades= $this->Especialidades_model->getEspecialidades();
			$pacientes= $this->Pacientes_model->getPacientes();
			echo json_encode($this->pagina->render_agregar_historia_clinica($profesionales,$especialidades,$pacientes));
		}
		else
		{
			redirect("acceso");
		}
	}
	
	public function agregar_historia_clinica()
	{ 
		if($this->input->post())
		{
			if ($this->session->userdata("operativo") == "si") 
			{
				$this->load->library("upload");

				$imagenes = array();


				for($i=1; $i <= count($_FILES);$i++)
				{
					$respuesta = $this->subir_imagen_historia_clinica("imagen".$i);

					if($respuesta["respuesta"]) // si se sube la imagen
					{
					   $imagenes[] = $respuesta["nombre_imagen"];
					}
				}
				
				
				// fin subida de imagen
				
			   $this->load->model("Historias_Clinicas_model");
			   
			   $imagenes = serialize($imagenes);
			   $fecha = $this->input->post("fecha_agregar_historia_clinica");
			   $paciente = $this->input->post("paciente_agregar_historia_clinica");
			   $profesional = $this->input->post("profesional_agregar_historia_clinica");
			   $especialidad = $this->input->post("especialidad_agregar_historia_clinica");
			   $examen = $this->input->post("examen_agregar_historia_clinica");
			   $conclusion = $this->input->post("conclusion_agregar_historia_clinica");
			   $medico = $this->input->post("medico_agregar_historia_clinica");
			   
			   $this->Historias_Clinicas_model->agregar_historia_clinica($fecha,$paciente,$profesional,$especialidad,$examen,$conclusion,$imagenes,$medico);
				
			   if($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3")
			   {
					redirect("administrador/abm_historias_clinicas");
			   }
			   else if($this->session->userdata("tipo_usuario") == "2")
			   {
					redirect("secretaria/abm_historias_clinicas");
			   }
			   else if($this->session->userdata("tipo_usuario") == "4")
			   {
					redirect("profesional/abm_historias_clinicas");
			   }
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

	public function image_to_array()
	{
		$this->load->model("Historias_Clinicas_model");

		$historias = $this->Historias_Clinicas_model->getHistoriasClinicasSinJoin();

		foreach ($historias as $row)
		{
			$imagenes= array();

			if(trim($row["imagen1"]) != "")
			{
				$imagenes[]=$row["imagen1"];
			}

			if(trim($row["imagen2"]) != "")
			{
				$imagenes[]=$row["imagen2"];
			}

			if(trim($row["imagen3"]) != "")
			{
				$imagenes[]=$row["imagen3"];
			}

			if(trim($row["imagen4"]) != "")
			{
				$imagenes[]=$row["imagen4"];
			}

			$this->Historias_Clinicas_model->set_imagenes($row["codigo"],serialize($imagenes));
		}
	}

	private function subir_imagen_historia_clinica($name_post)
	{
		$respuesta = array("respuesta"=>false,"nombre_imagen"=>"");

		$name_img=uniqid();
	
		// SUBIENDO LA IMAGEN ORIGINAL
		$config_subida_principal['upload_path'] = "./recursos/img/temporales/";
		$config_subida_principal['allowed_types']        = 'jpg|jpeg|JPEG|JPG|png';
		$config_subida_principal['max_size']             = 1024;
		$config_subida_principal['max_width']            = 5000;
		$config_subida_principal['max_height']           = 5000;
		$config_subida_principal["overwrite"]=false;
		$config_subida_principal['maintain_ratio'] = false;
		$config_subida_principal['file_name'] = $name_img;

		$this->upload->initialize($config_subida_principal);

		if ( ! $this->upload->do_upload($name_post))
		{
			$respuesta["respuesta"] = false;
			$respuesta["error"] = $this->upload->display_errors();
		}
		else
		{
			$this->load->library("MyHelperImage");
			$myHelperImage= new MyHelperImage();

			$respuesta["respuesta"]= true;

			$data = array('upload_data' => $this->upload->data());

			$nombre_imagen=$name_img;
			$nombre_imagen.=".";
			$nombre_imagen.=$myHelperImage->obtenerExtensionFichero($_FILES[$name_post]['name']);
			
			$respuesta["nombre_imagen"]=$nombre_imagen;

			// REDIMENSION
			$src=base_url()."/recursos/img/temporales/".$nombre_imagen;

			$dir_file ="recursos/img/pacientes/".$nombre_imagen;
			$width=400;
			$height= 400;
			$myHelperImage->redimensionar_imagen($width,$height,$src,$dir_file);

			unlink("recursos/img/temporales/".$nombre_imagen);
		}

		return $respuesta;
	}
	
	public function getHtmlEditarHistoriaClinica()
	{
		if($this->input->is_ajax_request())
		{
			$codigo = $this->input->post("codigo");
			$this->load->model("Profesionales_model");
			$this->load->model("Especialidades_model");
			$this->load->model("Pacientes_model");
			$this->load->model("Historias_Clinicas_model");
			
			$historia_clinica= $this->Historias_Clinicas_model->getHistoriaClinica($codigo);
			$paciente = $this->Pacientes_model->getPaciente($historia_clinica[0]["paciente"]);
			$paciente = $paciente[0]["nombre"]." ".$paciente[0]["apellido"];
			$profesional = $this->Profesionales_model->getProfesional($historia_clinica[0]["profesional"]);
			$profesional = $profesional[0]["nombre"]." ".$profesional[0]["apellido"];
			$especialidad = $this->Especialidades_model->getEspecialidad($historia_clinica[0]["especialidad"]);
			
			echo json_encode($this->pagina->render_editar_historia_clinica($historia_clinica[0],$paciente,$profesional,$especialidad["especialidad"]));
		}
		else
		{
			redirect("acceso");
		}
	}

	public function actualizar_historia_clinica()
	{

		if($this->input->post())
		{
		
			if ((($this->session->userdata("tipo_usuario") == "1"  || $this->session->userdata("tipo_usuario") == "2" || $this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "4") && $this->session->userdata("operativo") == "si")) 
			{
				//echo var_dump($this->input->post());


				$this->load->model("Historias_Clinicas_model");
				$this->load->model("Profesionales_model");
				$this->load->model("Especialidades_model");
				$this->load->model("Pacientes_model");

				$this->load->library("upload");

				$codigo = $this->input->post("codigo_actualizar_historia_clinica");
			   
				$historia_clinica = $this->Historias_Clinicas_model->getHistoriaClinica($codigo);
				
				// SUBIDA DE IMAGEN
				$imagenes_a_eliminar = json_decode($this->input->post("imagenes_a_eliminar_historia"),true);

				
				$imagenes_actuales = unserialize($historia_clinica[0]["imagenes"]);

				if($imagenes_a_eliminar != null)
				{
					$arreglo_nuevo_actuales = array();

					for($i=0; $i < count($imagenes_actuales);$i++)
					{
						$borrar = false;

						for($j=0; $j < count($imagenes_a_eliminar);$j++)
						{
							if($imagenes_actuales[$i] == $imagenes_a_eliminar[$j])
							{
								$borrar= true;
								unlink("recursos/img/pacientes/".$imagenes_a_eliminar[$j]);
								break;
							}
						}

						if(!$borrar)
						{
							$arreglo_nuevo_actuales[]=$imagenes_actuales[$i];
						}
					}  

					$imagenes_actuales= $arreglo_nuevo_actuales;
				}				

				for($i=1; $i <= count($_FILES);$i++)
				{

					$respuesta = $this->subir_imagen_historia_clinica("imagen".$i);


					if($respuesta["respuesta"]) // si se sube la imagen
					{
						$imagenes_actuales[] = $respuesta["nombre_imagen"];
					}else{
						//MOSTRAR ERROR $respuesta["error"];
					}
				}

				// fin subida de imagen

				$examen = $this->input->post("examen_editar_historia_clinica");
				$conclusion = $this->input->post("conclusion_editar_historia_clinica");
				$fecha = $this->input->post("fecha_editar_historia_clinica");
				$medico= $this->input->post("medico_editar_historia_clinica");
				$imagenes = serialize($imagenes_actuales);

				$this->Historias_Clinicas_model->actualizarHistoriaClinica($codigo,$fecha,$examen,$conclusion,$imagenes,$medico);
				
				if($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3")
				{
					redirect("administrador/abm_historias_clinicas");
				}
				else
				{
					redirect("secretaria/abm_historias_clinicas");
				}


				/**/
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
	
	public function eliminar_historia_clinica()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model("Historias_Clinicas_model");
			$codigo = $this->input->post("codigo");

			$historia_clinica = $this->Historias_Clinicas_model->getHistoriaClinicaSinJoin($codigo);

			$respuesta = $this->Historias_Clinicas_model->eliminar_historia_clinica($codigo);

			if($respuesta)
			{
				$imagenes= unserialize($historia_clinica["imagenes"]);

				if(is_array($imagenes))
				{
					for($i=0; $i < count($imagenes);$i++)
					{
						if(trim($imagenes[$i]) != "" && file_exists("recursos/img/pacientes/".$imagenes[$i]))
						{
							unlink("recursos/img/pacientes/".$imagenes[$i]);
						}
					}
				}
			}
			
			echo json_encode($respuesta);
		}
		else
		{
			redirect("acceso");
		}
		
	}
	
	public function reporte_historia_clinica($codigo)
	{
		if((($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "2" || $this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "4") && $this->session->userdata("operativo") == "si")) 
		{
			$this->load->model("Historias_Clinicas_model");
			$this->load->model("Pacientes_model");
			$this->load->model("Obras_sociales_model");
			$this->load->model("Especialidades_model");
			
			$historia_clinica = $this->Historias_Clinicas_model->Historias_Clinicas_model->getHistoriaClinica($codigo);
			
			$historia_clinica[0]["examen"];
			$historia_clinica[0]["conclusion"];
			$especialidad= $this->Especialidades_model->getEspecialidad($historia_clinica[0]["especialidad"]);
			
			$paciente = $this->Pacientes_model->getPaciente($historia_clinica[0]["paciente"]);
		   
			
			$fecha = new DateTime($historia_clinica[0]["fecha"]);
			
			$obra_social = $this->Obras_sociales_model->getObraSocial($paciente[0]["cod_obra_social"]);
			
			 
			//$this->load->view('reportes/impresion_con_js',$vista);
			
			$this->load->library('Pdf');
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('CoreGarello');
			$pdf->SetTitle($paciente[0]["apellido"]."_".$fecha->format('d_m_Y'));
			$pdf->SetSubject('CoreGarello');
			$pdf->SetKeywords('CoreGarello');
 
			$paciente = $paciente[0]["nombre"]." ".$paciente[0]["apellido"];
			$direccion = "";
			// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
			$pdf->SetHeaderData(PDF_HEADER_LOGO, 210, null . '', $direccion, array(0, 64, 255), array(0, 64, 128));
			$pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
			// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
			// se pueden modificar en el archivo tcpdf_config.php de libraries/config
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
			// se pueden modificar en el archivo tcpdf_config.php de libraries/config
			//$pdf->SetMargins(0, 50, 0);
			$pdf->SetMargins(15, 50, 15);
			$pdf->SetHeaderMargin(0);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			// se pueden modificar en el archivo tcpdf_config.php de libraries/config
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			//relación utilizada para ajustar la conversión de los píxeles
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			// ---------------------------------------------------------
			// establecer el modo de fuente por defecto
			$pdf->setFontSubsetting(true);
 
			// Establecer el tipo de letra
 
			//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
			// Helvetica para reducir el tamaño del archivo.
			$pdf->SetFont('Helvetica', '', 13, '', true);
 
			// Añadir una página
			// Este método tiene varias opciones, consulta la documentación para más información.
			$pdf->AddPage();
 
			//fijar efecto de sombra en el texto
			$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

			// Establecemos el contenido para imprimir
			/*$provincia = $this->input->post('provincia');
			$provincias = $this->pdfs_model->getProvinciasSeleccionadas($provincia);
			foreach($provincias as $fila)
			{
				$prov = $fila['p.provincia'];
			}*/
			//preparamos y maquetamos el contenido a crear
			$html = "<div style='margin-top: 10px;margin-left: 20px !important;font-family: Arial;'>";
			$html .= "<p><b>Nombre: </b> $paciente</p>
					  <p><b>Medico Solicitante: </b> ".$historia_clinica[0]["medico"]."</p>
					  <p><b>Fecha: </b>".$fecha->format('d-m-Y')."</p>
					  <p><b>Obra social: </b>".$obra_social["razon_social"]."</p>
					  <p><b>Especialidad: </b>".$especialidad["especialidad"]."</p>
					  <p style='margin-top: 10px;'><b>Examen:</b></p><p>".$historia_clinica[0]["examen"]."</p>
					  <p style='margin-top: 10px;'><b>Conclusion:</b></p><p>&nbsp;&nbsp;&nbsp;".$historia_clinica[0]["conclusion"]."</p>";
			$html.="</div>";
 
			//provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
			/*foreach ($provincias as $fila) 
			{
				$id = $fila['l.id'];
				$localidad = $fila['l.localidad'];

				$html .= "<tr><td class='id'>" . $id . "</td><td class='localidad'>" . $localidad . "</td></tr>";
			}
			$html .= "</table>";*/

			// Imprimimos el texto con writeHTMLCell()
			$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

			// ---------------------------------------------------------
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
			$nombre_archivo = utf8_decode("Localidades de .pdf");
			$pdf->Output($nombre_archivo, 'I');
		}
		else
		{
			redirect("acceso");
		}
	}
	
	public function comprobar_imagenes()
	{
		if($this->input->is_ajax_request())
		{
			$codigo = $this->input->post("codigo");
			
			$this->load->model("Historias_Clinicas_model");
			$historia = $this->Historias_Clinicas_model->getHistoriaClinica($codigo);
			
			$imagen1= (boolean)getimagesize(base_url()."recursos/img/pacientes/".$historia[0]["imagen1"]);
			$imagen2= (boolean)getimagesize(base_url()."recursos/img/pacientes/".$historia[0]["imagen2"]);
			$imagen3= (boolean)getimagesize(base_url()."recursos/img/pacientes/".$historia[0]["imagen3"]);
			$imagen4= (boolean)getimagesize(base_url()."recursos/img/pacientes/".$historia[0]["imagen4"]);
			
		   
			$respuesta = false;
			
			if($imagen1 || $imagen2 || $imagen3 || $imagen4)
			{
				$respuesta = true;
			}
			
			echo json_encode($respuesta);
		}
	}
	
	public function ver_imagenes_historia_clinica($codigo)
	{
		if((($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "2" || $this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "4") && $this->session->userdata("operativo") == "si")) 
		{
		
			$this->load->model("Historias_Clinicas_model");
			$historia = $this->Historias_Clinicas_model->getHistoriaClinica($codigo);


			$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
			$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
			$dni=$this->session->userdata('dni');
			$nombre=$this->session->userdata('nombre');
			$apellido=$this->session->userdata('apellido');
			$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
			$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
			$vista["seccion"] = "Imagenes de la historia clinica";
			$vista["detalle"] = $this->pagina->render_ver_imagenes_historia_clinica($historia);
			
			if($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3")
			{
				$this->load->view('administrador/vista_general.php',$vista);
			}
			else if($this->session->userdata("tipo_usuario") == "2")
			{
				$this->load->view('secretaria/vista_general.php',$vista);
			}
			else
			{
				$this->load->view('profesional/vista_general.php',$vista);
			}
		}
		
	}
	
	public function mostrar_datos_factura()
	{
		if((($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "2" || $this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "4") && $this->session->userdata("operativo") == "si")) 
		{
			$this->load->model("Caja_model");
			
			$datos = $this->Caja_model->getDatosDeDetalle($this->input->post("comprobante"));
			
			echo json_encode($this->pagina->generar_render_ver_factura($datos,$this->input->post("comprobante")));
		}  
		else
		{
			redirect("acceso");
		}
	}
	
	public function mostrar_datos_movimiento_caja()
	{
		if((($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "2" || $this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "4") && $this->session->userdata("operativo") == "si")) 
		{
			$this->load->model("Caja_model");
			
			$datos = $this->Caja_model->getDatosDeMovimiento($this->input->post("comprobante"));
			
			echo json_encode($this->pagina->generar_render_ver_movimiento_caja($datos,$this->input->post("comprobante")));
		}  
		else
		{
			redirect("acceso");
		}
	}
	
	public function imprimir_datos_factura($comprobante)
	{
		if((($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "2" || $this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "4") && $this->session->userdata("operativo") == "si")) 
		{
			$this->load->model("Caja_model");
			
			$datos = $this->Caja_model->getDatosDeDetalle($comprobante);
			
			$html= $this->pagina->generar_render_imprimir_factura($datos,$comprobante);
			
			$impresion["impresion"]= $html;
			
			$this->load->view("reportes/impresion",$impresion);
		}  
		else
		{
			redirect("acceso");
		}
	}
	
	public function imprimir_datos_movimiento_caja($comprobante)
	{
		if((($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "2" || $this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "4") && $this->session->userdata("operativo") == "si")) 
		{
			$this->load->model("Caja_model");
			
			$datos = $this->Caja_model->getDatosDeMovimiento($comprobante);
			
			$html = $this->pagina->generar_render_imprimir_movimiento_caja($datos,$comprobante);
			$impresion["impresion"]= $html;
			
			$this->load->view("reportes/impresion",$impresion);
		}  
		else
		{
			redirect("acceso");
		}
	}
	
	
	function hourIsBetween($from, $to, $input) {
		$dateFrom = DateTime::createFromFormat('!H:i', $from);
		$dateTo = DateTime::createFromFormat('!H:i', $to);
		$dateInput = DateTime::createFromFormat('!H:i', $input);
		if ($dateFrom > $dateTo) {
			$dateTo->modify('+1 day');
		}
		return ($dateFrom <= $dateInput && $dateInput <= $dateTo) || ($dateFrom <= $dateInput->modify('+1 day') && $dateInput <= $dateTo);
	}
}