<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Secretaria extends Super_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->library("Usuario");
		$this->load->library("Pagina");
		$this->load->library('grocery_CRUD');
		$this->secretaria=new Usuario();
		$this->pagina=new Pagina();
	}
	
	public function index() {
		if ($this->secretaria->verificar_acceso() && $this->secretaria->verificar_operatividad()) {
			try{
				 $this->load->model("Especialidades_model");
				$especialidades = $this->Especialidades_model->getEspecialidades();
				
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "Escritorio";
				$vista["detalle"] = $this->pagina->generar_escritorio_secretaria($especialidades);
				$this->load->view('secretaria/vista_general.php',$vista);
			}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

			}else{
				redirect("acceso");
		}
	}
	
	public function abm_historias_clinicas() {
		if ((($this->session->userdata("tipo_usuario") == "1" || $this->session->userdata("tipo_usuario") == "3" || $this->session->userdata("tipo_usuario") == "4" || $this->session->userdata("tipo_usuario") == "2") && $this->session->userdata("operativo") == "si")) 
			
		{
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "ABM Historias Clinicas";
				$vista["detalle"] = $this->pagina->render_historias_clinicas();
				$this->load->view('secretaria/vista_general.php',$vista);
			

		}else{
			redirect("acceso");
		}
	}
	
	public function getTurnosDesdeHoyLista() {
//        if ($this->input->is_ajax_request()) 
//        {
		  $this->load->model("Turnos_model");
		  
		  $resultado = $this->Turnos_model->getTurnosTodosDesdeHoyLista();
		  
		  for($i=0; $i < count($resultado);$i++)
		  {
			  $resultado[$i]["nombre_profesional"]=$resultado[$i]["nombre_profesional"]." ".$resultado[$i]["apellido_profesional"];
			  $resultado[$i]["nombre_paciente"]=$resultado[$i]["nombre_paciente"]." ".$resultado[$i]["apellido_paciente"];
		  }
		  echo json_encode($resultado);
//        }else{
//            redirect("acceso");
//        }
	}
	
//    public function getTurnosHoyLista()
//    {
////        if ($this->input->is_ajax_request()) 
////        {
//          $this->load->model("Turnos_model");
//          
//          $resultado = $this->Turnos_model->getTurnosHoyLista();
//          
//          for($i=0; $i < count($resultado);$i++)
//          {
//              $resultado[$i]["nombre_profesional"]=$resultado[$i]["nombre_profesional"]." ".$resultado[$i]["apellido_profesional"];
//              $resultado[$i]["nombre_paciente"]=$resultado[$i]["nombre_paciente"]." ".$resultado[$i]["apellido_paciente"];
//          }
//          echo json_encode($resultado);
////        }else{
////            redirect("acceso");
////        }
//    }
	
	/*public function render_editar_historia_clinica()
	{
		
		if ($this->secretaria->verificar_acceso() && $this->secretaria->verificar_operatividad())
		{
		  
		   $this->load->model("Historias_clinicas_model");
		   
		   $codigo = $this->input->post("codigo");
		   
		   $historia_clinica = $this->Historias_clinicas_model->getHistoriaClinica($codigo);
		   
		   $resultado = $this->pagina->render_editar_historia_clinica($codigo,$historia_clinica[0]);
		   
		   echo json_encode($resultado);
		}
		else{
			redirect("acceso");
		}
	}*/
	
	public function getHistoricoTurnos()
	{
		if($this->input->is_ajax_request() && $this->session->userdata("operativo") == "si" && $this->session->userdata("tipo_usuario") == "2")
		{
			$this->load->model("Turnos_model");
			$resultado = $this->Turnos_model->getTurnosTodosDesdeHoyLista();
			
			for($i=0; $i < count($resultado);$i++)
			{
				$resultado[$i]["profesional"]= substr($resultado[$i]["nombre_profesional"], 0,1)." ".$resultado[$i]["apellido_profesional"];
				$resultado[$i]["paciente"]=substr($resultado[$i]["nombre_paciente"], 0,1)." ".$resultado[$i]["apellido_paciente"];         
			}
			
			echo json_encode($resultado);
		}
		
		else{
			redirect("acceso");
		}
	}
	
	
	public function ver_calendario() {
		if ($this->secretaria->verificar_acceso() && $this->secretaria->verificar_operatividad()) {
			try{
				$this->load->model("Especialidades_model");
				$especialidades = $this->Especialidades_model->getEspecialidades();
				
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "Calendario";
				$vista["detalle"] = $this->pagina->ver_calendario_secretaria($especialidades);
				$this->load->view('secretaria/vista_general.php',$vista);
			}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

			}else{
				redirect("acceso");
		}
	}
	
	public function ver_turnos_hoy() {
		if ($this->secretaria->verificar_acceso() && $this->secretaria->verificar_operatividad()) {
			try{
				
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "Turnos hoy";
				$vista["detalle"] = $this->pagina->ver_turnos_hoy();
				$this->load->view('secretaria/vista_general.php',$vista);
			}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

			}else{
				redirect("acceso");
		}
	}
   
	public function ver_turnos_proximos_confirmados() {
		if ($this->secretaria->verificar_acceso() && $this->secretaria->verificar_operatividad()) {
			try{
				
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "Turnos confirmados";
				$vista["detalle"] = $this->pagina->ver_turnos_confirmados();
				$this->load->view('secretaria/vista_general.php',$vista);
			}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

			}else{
				redirect("acceso");
		}
	}
	
	public function ver_turnos_finalizados() {
		if ($this->secretaria->verificar_acceso() && $this->secretaria->verificar_operatividad()) {
			try{
				
				$imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
				$dni=$this->session->userdata('dni');
				$nombre=$this->session->userdata('nombre');
				$apellido=$this->session->userdata('apellido');
				$vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
				$vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
				$vista["seccion"] = "Turnos confirmados";
				$vista["detalle"] = $this->pagina->ver_turnos_finalizados();
				$this->load->view('secretaria/vista_general.php',$vista);
			}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

			}else{
				redirect("acceso");
		}
	}
		
	public function test_rango_() {
		echo $this->hourIsBetween('09:45', '12:15', '9:45');
	}
	
	public function test_rango() {
		if($this->input->is_ajax_request())
		{
			$desde=$this->input->post("desde");
			$hasta=$this->input->post("hasta");
			$input=$this->input->post("input");        
			echo json_encode($this->hourIsBetween($desde, $hasta, $input));
		}
	}
   
}