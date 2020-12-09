<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
        public $template;
	/**
	 * Index Page for this controller. 
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
         * 
         * 
	 */
        public function __construct(){
            parent::__construct();
            $this->load->model("Pacientes_model");
            $this->load->helper('url');
            $this->load->helper('form');
            $this->load->helper('html');
            $this->load->library('form_validation');
            $this->load->library('email');
            $this->load->library('session');
            $this->load->library("Pagina");
            $this->load->library("Usuario");
            $this->load->library("Template");
            		
            $this->template = new Template();
            date_default_timezone_set('America/Argentina/Cordoba');
//            echo date('l jS \of F Y h:i:s A');
	}
    
	public function index() {

        $this->load->view('index/index');

        //$this->template = $this->template->generar_pagina_principal("Cedip Centro Medico Argentina");
        //$template["template"]=$this->template;
        //$template["slider"]= true;
        //$output["output"]=$this->template->generar_inicio();
        //$this->load->view('home/vista_general_cabecera',$template);
        //$this->load->view('home/vista_general_detalle',$output);
        //$this->load->view('home/vista_general_pie',$template);
        //$this->load->view('home/index');
            
	}
        
        public function acceso(){
            $pagina = new Pagina();
            $pagina->generar_pagina_loguin();
            $vista["pagina"]=$pagina;
            $vista["salida_error"]="";
            $this->load->view('loguin', $vista);
	}
        
        public function validar_usuario(){
            $pagina = new Pagina();
            $pagina->generar_pagina_loguin();
            $output["pagina"]=$pagina;
            
            //$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|valid_email');
            $this->form_validation->set_rules('usuario', 'Usuario', 'required');
            $this->form_validation->set_rules('pass', 'Pass', 'required');
            $this->form_validation->set_message(
                            'required', 'Valor requerido. No lo deje en blanco');
            //$this->form_validation->set_message(
                            //'valid_email', 'Ingrese con mail valido. Ej. jose@suempresa.com');
            if ($this->form_validation->run() == FALSE){
                $output['salida_error']="";
                $this->load->view('loguin', $output);
                
            }else{
                $usuario_ingresado = $this->input->post("usuario");
                $pass_ingresado = $this->input->post("pass");
                
                $usuario=new Usuario();
                $usuario_verificado=$usuario->verificar_usuario($usuario_ingresado, $pass_ingresado);
               
                if ($usuario_verificado->getExiste()) 
                {
                  // HACER COMPROBACION DE HORARIO Y DIA.
                    
                  // COMPROBANDO DIA:
                    
                    
                    
                    $this->load->model("Empleados_model");
                    $dia_habilitado = $this->Empleados_model->getDiaHabilitado($this->session->userdata("dni"));
                    $dia_habilitado = (int)$dia_habilitado["dia_habilitado"];
                    
                    $num_dia = (int)Date("N");
                    
                    $acceso_dias = true;
                    
                    if($dia_habilitado == 1)
                    {
                        if($num_dia > 5)
                        {
                            $acceso_dias= false;
                        }
                    }
                    else if($dia_habilitado == 2)
                    {
                        if($num_dia > 6)
                        {
                            $acceso_dias= false;
                        }
                    }
                    $hoy = getdate();
                    $hora_actual =$hoy["hours"];//"".date('H:i:s', time() - date('Z'));
                    
                    if($acceso_dias)
                    {
                        $horario = $this->Empleados_model->getHorariosEmpleado($this->session->userdata("dni"),$hora_actual);
                        
                        if($horario["hasta"] == "")
                        {
                            $output['salida_error']="No tiene acceso para este horario.";
                            $this->load->view('loguin', $output);
                        }
                        else
                        {
                            if($horario["hasta"] > $hora_actual)
                            {
                                
                                
                                if($usuario_verificado->getTipo_usuario()==1 || $usuario_verificado->getTipo_usuario()==3)
                                {
                                  redirect('/administrador/index');
                                }
                                else if($usuario_verificado->getTipo_usuario()==2)
                                {
                                  $this->cargar_menu_modulos($this->session->userdata("dni"));
                                  redirect('/secretaria/index');    
                                }
                                else if($usuario_verificado->getTipo_usuario()==4)
                                {
                                  $this->cargar_menu_modulos($this->session->userdata("dni"));
                                  redirect('/Profesional/index');    
                                }
                            }
                            else 
                            {
                                $output['salida_error']="No tiene acceso para este horario.";
                                $this->load->view('loguin', $output);
                            }
                        }
                    }
                    else
                    {
                        $output['salida_error']="No tiene acceso para este dia.";
                        $this->load->view('loguin', $output);
                    }    
                }
                else{
                    $output['salida_error']="datos incorrectos, ingreselos nuevamente";
                    $this->load->view('loguin', $output);
                }
            }
	}
        
        private function cargar_menu_modulos($dni)
        {
            $this->load->model("Usuario_model"); 
            $modulos_usuario = $this->Usuario_model->get_modulos_usuario($dni);
            
            $this->session->set_userdata("menu_modulos",$modulos_usuario);
        }
        
        public function iniciar_sesion_paciente()
        {
            //echo "iniciar_sesion_paciente";
            if($this->input->is_ajax_request())
            {
                $respuesta = false;
                $resultado = $this->Pacientes_model->getPacienteInicioSesion($this->input->post("dni"),$this->input->post("password"));
                
                if($resultado && ($resultado[0]["estado"]=="operativo"))
                {
                    $resultado = $resultado[0];
                    
                    $datos = Array(
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
                        "ingresado"=>"true",
                    );
                    
                    $this->session->set_userdata($datos);
                    
                    $respuesta = true;
                }
                
                echo json_encode($respuesta);
            }
            else
            {
                redirect(base_url());
            }
        }
        
        public function mi_historial_clinico()
        {
            if($this->session->userdata("tipo_usuario")=="paciente")
            {
                $this->load->model("Pacientes_model");
                
                $historial_paciente= $this->Pacientes_model->getHistorialMedicoPaciente($this->session->userdata("dni"));
                
                $titulo = "Cedip - Historial clinico de ".$this->session->userdata("nombre")." ".$this->session->userdata("apellido");

                $template["template"]=$this->template->generar_pagina_principal($titulo);
                $template["slider"]= false;
                $output["output"]=$this->template->generar_pagina_ver_mi_historial_clinico($historial_paciente);

                $this->load->view('home/vista_general_cabecera',$template);
                $this->load->view('home/vista_general_detalle',$output);
                $this->load->view('home/vista_general_pie',$template);
                
            }
            else
            {
                redirect(base_url());
            }
        }
        
        public function ver_profesionales_por_especialidad()
        {
                $cod_especialidad = $this->input->post("codigo");
                $this->load->model("Profesionales_model");
                $this->load->model("Especialidades_model");
                
                $profesionales = $this->Profesionales_model->getProfesionalesPorEspecialidad($cod_especialidad);
                $especialidad = $this->Especialidades_model-> getEspecialidad($cod_especialidad);
                
                $especialidad= $especialidad["especialidad"];
                $titulo = "Medicos ".$this->session->userdata("nombre")." ".$this->session->userdata("apellido");

                //$template["template"]=$this->template->generar_pagina_principal($titulo);
                //$output["output"]=$this->template->generar_render_ver_profesionales_por_especialidad($cod_especialidad,$especialidad,$profesionales);
                
                echo json_encode($this->template->generar_render_ver_profesionales_por_especialidad($cod_especialidad,$especialidad,$profesionales));
                /*
                $this->load->view('home/vista_general_cabecera',$template);
                $this->load->view('home/vista_general_detalle',$output);
                $this->load->view('home/vista_general_pie',$template);*/
           
           
        }
        
        public function htmlRegistrarTurno()
        {
            if ($this->input->is_ajax_request()) 
            {
              $this->load->library("Pagina");
              $profesional = $this->input->post("profesional");
              $fecha = $this->input->post("fecha");
              $hora_desde = $this->input->post("hora_desde");
              $hora_hasta = $this->input->post("hora_hasta");
              $especialidad = $this->input->post("especialidad");
              $resultado = $this->pagina->render_registrar_turno_usuario_paciente($profesional,$fecha,$hora_desde,$hora_hasta,$this->session->userdata("dni"),$especialidad);

              echo json_encode($resultado);
            }else{
                redirect(base_url());
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
              $precio=$this->input->post("precio");
              $cobrado= $this->input->post("cobrado");
              $obra_social=1;

              $mensaje ="";

              $this->load->model("Pacientes_model");

              if($this->Pacientes_model->getPaciente($paciente))
              {

                 $this->load->model("Turnos_model");
                 
                 if($this->Turnos_model->agregarTurno($fecha,$hora_desde,$hora_hasta,$profesional,$paciente,$estado,$especialidad,$precio,$cobrado,$obra_social))
                 {
                   $mensaje="Turno agregado correctamente";  
                 }
              }
              else
              {
                  $mensaje="Paciente no encontrado";
              }

              echo json_encode($mensaje);
            }else{
                redirect(base_url());
            }    
        }
        
        public function getHorariosDia()
        {
        if ($this->input->is_ajax_request()) 
        {
                $numero_dia = $this->input->post("numero_dia");
                $fecha = $this->input->post("fecha");
                $profesional = $this->input->post("profesional");
                $anio =  $this->input->post("anio");
                $mes = $this->input->post("mes");
                $dia = $this->input->post("dia");

                $this->load->model("Turnos_model");
                $this->load->model("Horarios_model");
                $this->load->model("Profesionales_model");
                $profesional_nombre_apellido = $this->Profesionales_model->getNombreApellidoProfesional($profesional);
                $turnos_profesional_hoy = $this->Turnos_model->getHorariosPorFechaProfesional($fecha,$profesional);
                $horarios_profesional = $this->Horarios_model->getHorariosProfesional($profesional,$numero_dia,$anio,$mes);

                $resultado = $this->pagina->render_horarios_dia($turnos_profesional_hoy,$horarios_profesional,$anio,$mes,$dia,$profesional,$profesional_nombre_apellido);

                echo json_encode($resultado);
              }else{
                  redirect(base_url());
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
        
        public function mis_turnos()
        {
            if($this->session->userdata("tipo_usuario") == "paciente")
            {
                $this->load->model("Pacientes_model");
                $turnos = $this->Pacientes_model->getTurnosPaciente($this->session->userdata("dni"));
                
                $titulo = "Cedip -   - Mis turnos";

                $template["template"]=$this->template->generar_pagina_principal($titulo);
                $template["slider"]= false;
                $output["output"]=$this->template->generar_render_mis_turnos($turnos);
                
                $this->load->view('home/vista_general_cabecera',$template);
                $this->load->view('home/vista_general_detalle',$output);
                $this->load->view('home/vista_general_pie',$template);
            }
            else
            {
                redirect(base_url());
            }
        }
        
        public function getCantidadTurnosPendientePaciente()
        {
            if(($this->session->userdata("tipo_usuario") == "paciente") && $this->input->is_ajax_request())
            {
                $this->load->model("Pacientes_model");
                $cantidad = $this->Pacientes_model->getCantidadTurnosPendientePaciente($this->session->userdata("dni"));
            
                $respuesta = null;
                
                $cantidad_real = (int)$cantidad["cantidad"];
                
                if($cantidad_real >= 1)
                {
                     $respuesta = false;
                }
                else
                {
                    $respuesta = true;
                }
                
                echo json_encode($respuesta);
            }
            else
            {
                redirect(base_url());
            }
        }
        
        public function cancelar_turno()
        {
            if(($this->session->userdata("tipo_usuario") == "paciente") && $this->input->is_ajax_request())
            {
                $this->load->model("Turnos_model");
                echo json_encode($this->Turnos_model->cancelar_turno($this->input->post("codigo"),$this->session->userdata("dni")));
            }
            else
            {
                redirect(base_url());
            }
        }
        
        public function reporte_historia_clinica($codigo)
        {
            $this->load->model("Historias_Clinicas_model");
            $historia_clinica = $this->Historias_Clinicas_model->Historias_Clinicas_model->getHistoriaClinica($codigo);
            
            if(($this->session->userdata("tipo_usuario") == "paciente" && $this->session->userdata("dni") == $historia_clinica[0]["paciente"])) 
            {
                
                $this->load->model("Pacientes_model");
                $this->load->model("Obras_sociales_model");
                $this->load->model("Especialidades_model");

                
                $especialidad= $this->Especialidades_model->getEspecialidad($historia_clinica[0]["especialidad"]);

                $paciente = $this->Pacientes_model->getPaciente($historia_clinica[0]["paciente"]);


                $fecha = new DateTime($historia_clinica[0]["fecha"]);

                $obra_social = $this->Obras_sociales_model->getObraSocial($paciente[0]["cod_obra_social"]);


                

                $this->load->library('Pdf');
                $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('Israel Parra');
                $pdf->SetTitle($paciente[0]["apellido"]."_".$fecha->format('d_m_Y'));
                $pdf->SetSubject('Tutorial TCPDF');
                $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

                $paciente = $paciente[0]["nombre"]." ".$paciente[0]["apellido"];
                $direccion = "";
          $pdf->SetHeaderData(PDF_HEADER_LOGO, 40, null . '', $direccion, array(0, 64, 255), array(0, 64, 128));
                $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));

             $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

               $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

               $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

               $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


         $pdf->setFontSubsetting(true);

         $pdf->SetFont('freemono', '', 10, '', true);

         $pdf->AddPage();

            $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

            
                    $html = "<div style='margin-top: 10px;'></div>";
                    $html .= "<p><b>Nombre: </b> $paciente</p>
                              <p><b>Medico Solicitante: </b> ".$historia_clinica[0]["medico"]."</p>
                              <p><b>Fecha: </b>".$fecha->format('d-m-Y')."</p>
                              <p><b>Obra social: </b>".$obra_social["razon_social"]."</p>
                              <p><b>Especialidad: </b>".$especialidad["especialidad"]."</p>
                              <p style='margin-top: 10px;'><b>Examen:</b></p><p>".$historia_clinica[0]["examen"]."</p>
                              <p style='margin-top: 10px;'><b>Conclusion:</b></p><p>".$historia_clinica[0]["conclusion"]."</p>";

                    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

                    $nombre_archivo = utf8_decode("Localidades de .pdf");
                    $pdf->Output($nombre_archivo, 'I');
            }
            else
            {
                redirect("Welcome/acceso");
            }
        }
        
        public function cerrar_sesion()
        {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }