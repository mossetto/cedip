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
			if($resultado && ($resultado[0]['estado'] == 'operativo')) {
				$datasession = array(
					'dni' => $resultado[0]['dni'],
					'tipo_usuario' => 'paciente',
					//'len_email' => len($resultado[0]['correo']),
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
			$html = "<div>";
			$html .= "<p><b>Nombre: </b> $paciente</p>
					  <p><b>Medico Solicitante: </b> ".$historia_clinica[0]["medico"]."</p>
					  <p><b>Fecha: </b>".$fecha->format('d-m-Y')."</p>
					  <p><b>Obra social: </b>".$obra_social["razon_social"]."</p>
					  <p><b>Especialidad: </b>".$especialidad["especialidad"]."</p>
					  <p style='margin-top: 10px;'><b>Examen: </b></p><p style='background-color:powderblue;margin-left: 10px !important;'>".trim($historia_clinica[0]["examen"])."</p>




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