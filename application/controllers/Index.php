<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("Pacientes_model");
		$this->load->model("Index_model");
		$this->load->library("session");
	}
	//	
	public function index() {
		if(!$this->session->userdata('iduser')){
			redirect('index/login','refresh');
		}
		else{
			redirect('index/user','refresh');
		}
	}
	//
	function login(){
		if($this->session->userdata('iduser')){
			redirect('index','refresh');
		}
		//
		if($this->input->post('username') && $this->input->post('password')){
			$data_login = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password')
			);

			$data_login = $this->Pacientes_model->getPacienteInicioSesion($this->input->post("username"),$this->input->post("password"));
			
			if($data_login && ($data_login[0]['estado'] == 'operativo')) {
				$datasession = array(
					'iduser' => $data_login[0]['dni']
				);
				$this->session->set_userdata($datasession);
				redirect('index','refresh');
			}
		}

		$this->load->view('index/login');
	}
	//
	function logout(){
		$this->session->sess_destroy();
		redirect('index','refresh');
	}	
	//
	function recuperar(){
		$this->load->view('index/recuperar');
	}
	//
	function registro(){
		$this->load->view('index/registro');
	}
	//
	function user(){
		if(!$this->session->userdata('iduser')){
			redirect('index','refresh');
		}
		if($this->session->userdata('iduser') == NULL){
			redirect('index','refresh');
		}
		//
		$dni = $this->session->userdata('iduser');
		$data_login = $this->Pacientes_model->getPaciente($dni);
		$resultado = $data_login[0];
		$data = Array(
			"dni"=>$resultado["dni"],
			"nombre"=>$resultado["nombre"],
			"apellido"=>$resultado["apellido"],
			"correo"=>$resultado["correo"],
			"pass_web"=>$resultado["pass_web"],
			"telefono"=>$resultado["telefono"],
			"celular"=>$resultado["celular"],
			"direccion"=>$resultado["direccion"],
			"localidad"=>$resultado["localidad"],
			"cod_obra_social"=>$resultado["cod_obra_social"],
			"estado"=>$resultado["estado"],
			"tipo_usuario"=>"paciente",
			"ingresado"=>"true"
		);
		$data['message'] = null;
		//
		if ($this->input->post('pass_web') == $this->input->post('pass_web2')){
			$this->form_validation->set_rules($this->rules);
			if ($this->form_validation->run() == TRUE) {
				$data_model = array(
					'nombre' => $this->input->post('nombre'),
					'apellido' => $this->input->post('apellido'),
					'correo' => $this->input->post('correo'),
					'telefono' => $this->input->post('telefono'),
					'direccion' => $this->input->post('direccion'),
					'pass_web' => $this->input->post('pass_web'),
					'pass_web2' => $this->input->post('pass_web2')
				);
				$this->Index_model->edit($data["dni"],$data_model);
				//
				$dni = $this->session->userdata('iduser');
				$data_login = $this->Pacientes_model->getPaciente($dni);
				$resultado = $data_login[0];				
				$data = Array(
					"dni"=>$resultado["dni"],
					"nombre"=>$resultado["nombre"],
					"apellido"=>$resultado["apellido"],
					"correo"=>$resultado["correo"],
					"pass_web"=>$resultado["pass_web"],
					"telefono"=>$resultado["telefono"],
					"celular"=>$resultado["celular"],
					"direccion"=>$resultado["direccion"],
					"localidad"=>$resultado["localidad"],
					"cod_obra_social"=>$resultado["cod_obra_social"],
					"estado"=>$resultado["estado"],
					"tipo_usuario"=>"paciente",
					"ingresado"=>"true"
				);
				$data['message'] = true;


				//redirect('index/user', 'refresh');
			}
		}else{
			//var_dump("contraseña incorrectas");
			$data['message'] = false;
		}
		$this->load->view('index/datos_user',$data);
	}
	//
	function estudios(){
		if(!$this->session->userdata('iduser')){
			redirect('index','refresh');
		}
		if($this->session->userdata('iduser') == NULL){
			redirect('index','refresh');
		}
		//
		$dni = $this->session->userdata('iduser');
		$data_login = $this->Pacientes_model->getPaciente($dni);
		$resultado = $data_login[0];
		$data = Array(
			"dni"=>$resultado["dni"],
			"nombre"=>$resultado["nombre"],
			"apellido"=>$resultado["apellido"],
			"correo"=>$resultado["correo"],
			"pass_web"=>$resultado["pass_web"],
			"telefono"=>$resultado["telefono"],
			"celular"=>$resultado["celular"],
			"direccion"=>$resultado["direccion"],
			"localidad"=>$resultado["localidad"],
			"cod_obra_social"=>$resultado["cod_obra_social"],
			"estado"=>$resultado["estado"],
			"tipo_usuario"=>"paciente",
			"ingresado"=>"true"
		);

		$data['historial'] = $this->Pacientes_model->getHistorialMedicoPaciente($this->session->userdata("iduser"));

		$this->load->view('index/estudios_user',$data);
	}
	//
	// Reglas para formularios
	private $rules = array(
		'nombre' => array(
			'field' => 'nombre',
			'for' => 'nombre',
			'rules' => 'trim|required'
		),
		'correo' => array(
			'field' => 'correo',
			'for' => 'correo',
			'rules' => 'trim|required'
		),
		'telefono' => array(
			'field' => 'telefono',
			'for' => 'telefono',
			'rules' => 'trim|required'
		),
		'direccion' => array(
			'field' => 'direccion',
			'for' => 'direccion',
			'rules' => 'trim|required'
		),
		'pass_web' => array(
			'field' => 'pass_web',
			'for' => 'pass_web',
			'rules' => 'trim'
		),
		'pass_web2' => array(
			'field' => 'pass_web2',
			'for' => 'pass_web2',
			'rules' => 'trim'
		)
	);
}