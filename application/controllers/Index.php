<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model("Pacientes_model");
		$this->load->model("Historias_Clinicas_model");
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
		$data['message'] = '';
		//
		if($this->input->post('username') && $this->input->post('password')){
			$resultado = $this->Pacientes_model->getPacienteInicioSesion($this->input->post("username"),$this->input->post("password"));

			//$data['message']  = $resultado;
			//var_dump($resultado[0]);
			//exit;

			if($resultado && ($resultado[0]['estado'] == 'operativo')) {
				$datasession = array(
					'dni' => $resultado[0]['dni'],
					'tipo_usuario' => 'paciente',
					'email' => $resultado[0]['correo']
					//'len_email' => len(),
					//'reintento_correo' => 0
				);
				$this->session->set_userdata($datasession);
				redirect('index','refresh');
			}else{
				$data['message'] = 'Usuario o Contraseña Incorrecta, Por favor intente nuevamente.';
			}
		}
		$this->load->view('index/login',$data);
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
		if($this->input->post()){
			$user = $this->Index_model->getRecuperar($this->input->post('dni'),$this->input->post('email'));
			if($user->num_rows() == 1){
				$data['dni'] = $this->input->post('dni');
				$data['password'] = $user->row()->pass_web;
				$data['email'] = $this->input->post('email');
				//
				$data['titulo_ventana'] = 'Te enviamos un email';
				$data['mensaje_ventana'] = 'Enviamos un email de recuperación, revisalo para recuperar la contraseña. Gracias';
				$data['message'] = true;
				//
				$this->send_email($data,'recuperar');
			}else{
				$data['titulo_ventana'] = 'Informacion';
				$data['mensaje_ventana'] = 'No hemos encontrado coincidencias en nuestro sistema.';
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
					$data['message_title'] = 'Registro Exitoso';
					$data['message_text'] = 'Recibirás un email de confirmación, revisalo para completar el registro. Gracias';
					//
					$data['dni'] = $this->input->post('dni');
					$data['email'] = $this->input->post('email');
					$data['password'] = $this->input->post('password');
					$this->send_email($data,'registro');
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

				if($this->session->userdata('email') <> $resultado["correo"]){
					$data_email['email'] = $resultado["correo"];
					$this->send_email($data_email,'cambio');
					$this->session->set_userdata('email', $data_email['email']);
				}
				$data['message'] = true;
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

			if($fecha1 == '' or $fecha2 == ''){
				$data['historial'] = $this->Pacientes_model->getHistorialMedicoPaciente($this->session->userdata("dni"));
			}else{
				$data['historial'] = $this->Pacientes_model->getHistorialMedicoPacienteDate($this->session->userdata("dni"),$fecha1,$fecha2);
			}
		}
		//
		$this->load->view('index/estudios_user',$data);
	}
	//
	function reporte($codigo){
		if(!$this->session->userdata('dni')){
			redirect('index','refresh');
		}
		if(!$this->Historias_Clinicas_model->getHistoriaClinica($codigo)){
			redirect('index/estudios','refresh');
		}
		//
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
			$html = "<div><basefont face = 'arial, verdana, sans-serif, helvetica'>";
			$html .= "<p><b>Nombre: </b> $paciente</p>
					  <p><b>Medico Solicitante: </b> ".$historia_clinica[0]["medico"]."</p>
					  <p><b>Fecha: </b>".$fecha->format('d-m-Y')."</p>
					  <p><b>Obra social: </b>".$obra_social["razon_social"]."</p>
					  <p><b>Especialidad: </b>".$especialidad["especialidad"]."</p>
					  <p style='margin-top: 10px;'><b>Examen: </b></p><p style='background-color:powderblue;margin-left: 10px !important;font-family: helvetica;'><pre style=''>".trim($historia_clinica[0]["examen"])."</pre></p>




					  <p style='margin-top: 10px;'>&nbsp;&nbsp;&nbsp;<b>Conclusion:</b></p><p>&nbsp;&nbsp;&nbsp;".$historia_clinica[0]["conclusion"]."</p>";
			$html.="</div>";
			//echo $html;

			//color:red !important;border: red 2px solid !important; margin: 20px !important;
			//text-align: justify;margin-left: 20px !important;





 
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
	//
	function images($codigo){
		if(!$this->session->userdata('dni')){
			redirect('index','refresh');
		}
		if(!$this->Historias_Clinicas_model->getHistoriaClinica($codigo)){
			redirect('index/estudios','refresh');
		}
		//
		$historia = $this->Historias_Clinicas_model->getHistoriaClinica($codigo);
		
		//$dni=$this->session->userdata('dni');
		//$nombre=$this->session->userdata('nombre');
		//$apellido=$this->session->userdata('apellido');
		//$this->pagina = new Pagina();
		//$data["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
		//$data["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
		//$data["seccion"] = "Imagenes de la historia clinica";
		//$data["detalle"] = $this->pagina->render_ver_imagenes_historia_clinica($historia);
		//$data["historia"] = $historia;
		$data["imagenes"] = unserialize($historia[0]["imagenes"]);
		$this->load->view('index/images',$data);
	}
	//
	function send_email($data=null, $type=null) {

		$from_email = "info@cedipcentromedico.com";
		$to_email = $data['email'];
		
		$config = array();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'a2plcpnl0717.prod.iad2.secureserver.net';
		$config['smtp_crypto'] = 'ssl';
		$config['smtp_user'] = 'info@cedipcentromedico.com';
		$config['smtp_pass'] = 'FA%MT/4o2';
		$config['smtp_port'] = '465';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$config['charset'] = 'utf-8';
		//
		$asunto_email = '';
		if ($type === 'registro'){
			$msg = $this->load->view('email/email_registro',$data,true);
			$asunto_email = 'Registro de Usuario';
		}
		elseif($type === 'recuperar'){
			$msg = $this->load->view('email/email_recuperar',$data,true);
			$asunto_email = 'Recuperación de Contraseña';
		}elseif($type === 'cambio'){
			$msg = $this->load->view('email/email_cambio_email',$data,true);
			$asunto_email = 'Cambio de Correo Electronico';
		}
		
		//Load email library
		$this->load->library('email');
		$this->load->library('session');

		$this->email->initialize($config);
		$this->email->set_newline("\r\n");

		$this->email->from($from_email, $asunto_email);
		$this->email->to($to_email);
		$this->email->subject('Cedip Centro Médico');
		$this->email->message($msg);
		$this->email->set_newline("\r\n");
		//Send mail
		//$this->email->send();

		if($this->email->send()){
			//$this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
			return true;
		}
		else{
			//var_dump($this->email->print_debugger());
			//$this->session->set_flashdata("email_sent","You have encountered an error");
			return false;
		}
	}
	//
	function preview($data=null){
		//redirect('producto/search','refresh');
		$data_email['dni'] = 'test';
		$data_email['password'] = 1;
		$this->load->view('email/email_recuperar',$data_email);
	}
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