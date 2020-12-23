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
	public function index(){
		if(!$this->session->userdata('dni')){
			redirect('index/login','refresh');
		}
		else{
			redirect('index/user','refresh');
		}
	}
	//
	function login(){
		if($this->session->userdata('dni')){
			redirect('index','refresh');
		}
		//
		if($this->input->post('username') && $this->input->post('password')){
			$resultado = $this->Pacientes_model->getPacienteInicioSesion($this->input->post("username"),$this->input->post("password"));
			if($resultado && ($resultado[0]['estado'] == 'operativo')) {
				$datasession = array(
					'dni' => $resultado[0]['dni'],
					'tipo_usuario' => 'paciente'
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
		if($this->session->userdata('dni')){
			redirect('index','refresh');
		}
		//
		$data['message'] = null;
		//
		if($this->input->post('dni') && $this->input->post('email')){
			if($this->Index_model->getRecuperar($this->input->post('dni'),$this->input->post('email'))->result()){
				$data['message'] = true;
			}
		}
		$this->load->view('index/recuperar',$data);
	}
	//
	function registro(){
		if($this->session->userdata('dni')){
			redirect('index','refresh');
		}
		//
		$data['message'] = null;
		$data['message_title'] = '';
		$data['message_text'] = '';
		//
		$this->form_validation->set_rules($this->rules_register);
		//
		if ($this->form_validation->run() == TRUE) {
			//
			if ($this->input->post('email') != $this->input->post('email2')){
				$data['message_title'] = 'Valida tu correo electronico';
				$data['message_text'] = 'Correos Electronico no son coincidentes.';
				$data['message'] = true;
			}else{
				if ($this->input->post('password') != $this->input->post('password2')){
					$data['message_title'] = 'Valida tu contraseña';
					$data['message_text'] = 'Contraseñas no son coincidentes.';
					$data['message'] = true;
				}
			}
			if($data['message'] == null){
				//
				if($this->Index_model->existsDNI($this->input->post('dni'))->result()){
					$data_model = array(
						'dni' => $this->input->post('dni'),
						'email' => $this->input->post('email'),
						'password' => $this->input->post('password')
					);
					$this->Index_model->asignaUsuario($data_model);
					//
					//$data['message_title'] = 'Valida tu email';
					//$data['message_text'] = 'Puedes iniciar session, haz click <a href="#">AQUI</a>';
					//
					$data['message_title'] = 'Registro Exitoso';
					$data['message_text'] = 'Recibirás un email de confirmación, revisalo para completar el registro. Gracias';
				}else{
					//
					$data['message_title'] = 'Valida tu DNI';
					$data['message_text'] = 'El DNI ya existe en nuestra base de datos, Por favor verifique.';
				}
				$data['message'] = true;
			}
		}
		$this->load->view('index/registro',$data);
	}
	//
	function user(){
		if(!$this->session->userdata('dni')){
			redirect('index','refresh');
		}
		if($this->session->userdata('dni') == NULL){
			redirect('index','refresh');
		}
		//
		$dni = $this->session->userdata('dni');
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
			$this->form_validation->set_rules($this->rules_user);
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
				$dni = $this->session->userdata('dni');
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
			$data['message'] = false;
		}
		$this->load->view('index/datos_user',$data);
	}
	//
	function estudios(){
		if(!$this->session->userdata('dni')){
			redirect('index','refresh');
		}
		if($this->session->userdata('dni') == NULL){
			redirect('index','refresh');
		}
		//
		$dni = $this->session->userdata('dni');
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
		//
		$data['historial'] = $this->Pacientes_model->getHistorialMedicoPaciente($this->session->userdata("dni"));
		//
		if ($this->input->post()){
			$fecha1 = $this->input->post('fecha1');
			$fecha2 = $this->input->post('fecha2');
			$data['historial'] = $this->Pacientes_model->getHistorialMedicoPacienteDate($this->session->userdata("dni"),$fecha1,$fecha2);
		}
		//
		$this->load->view('index/estudios_user',$data);
	}
	//
	// Reglas para formularios
	private $rules_user = array(
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
	//
	private $rules_register = array(
		'dni' => array(
			'field' => 'dni',
			'for' => 'dni',
			'rules' => 'trim|required'
		),
		'email' => array(
			'field' => 'email',
			'for' => 'email',
			'rules' => 'trim|required'
		),
		'emai2' => array(
			'field' => 'email2',
			'for' => 'email2',
			'rules' => 'trim|required'
		),
		'password' => array(
			'field' => 'password',
			'for' => 'password',
			'rules' => 'trim|required'
		),
		'password2' => array(
			'field' => 'password2',
			'for' => 'password2',
			'rules' => 'trim|required'
		)
	);
}