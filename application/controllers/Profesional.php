<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Profesional extends Super_Controller 
{
    public function __construct(){
        parent::__construct();
        $this->load->library("session");
        $this->load->library("Usuario");
        $this->load->library("Pagina");
        $this->load->library('grocery_CRUD');
        $this->profesional=new Usuario();
        $this->pagina=new Pagina();
    }
    
    public function index() {
        if ($this->session->userdata("tipo_usuario") == "4" && $this->session->userdata("operativo") == "si") {
            try{
                // MODELS
                $this->load->model("Profesionales_model");
                
                $dni=$this->session->userdata('dni');
                $cod_profesional = $this->Profesionales_model->getCodigoProfesionalPorDni($dni);

                $especialidades= array();
                
                if(count($cod_profesional) >0)
                {
                  $especialidades = $this->Profesionales_model->getEspecialidadesProfesional($cod_profesional[0]['codigo']);
                }
                
                $imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
                $nombre=$this->session->userdata('nombre');
                $apellido=$this->session->userdata('apellido');
                $vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
                $vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
                $vista["seccion"] = "Escritorio";
                $vista["detalle"] = $this->pagina->generar_escritorio_profesional($especialidades);
                $this->load->view('profesional/vista_general.php',$vista);
            }catch(Exception $e){
                    show_error($e->getMessage().' --- '.$e->getTraceAsString());
            }

            }else{
                redirect("acceso");
        }
    }
    
   public function getTurnosProfesional()
   {
       if($this->profesional->verificar_acceso() && $this->profesional->verificar_operatividad() && $this->input->is_ajax_request())
       {
           $this->load->model("Turnos_model");
           
           $this->load->model('Profesionales_model');
           $codigo_profesional = $this->Profesionales_model->getCodigoProfesionalPorDni($this->session->userdata('dni'));
           
           $cod_profesional  = $codigo_profesional[0]['codigo'];
           $resultado = $this->Turnos_model->getTurnosMesPorProfesional($cod_profesional,Date('m'),Date('y'));
           
           echo json_encode($resultado);
           
       }
       else
       {
            redirect("acceso");  
       }
   }
   
  /* public function getHorariosDia()
    {
        if ($this->profesional->verificar_acceso() && $this->profesional->verificar_operatividad() && $this->input->is_ajax_request()) 
        {
          $this->load->model('Profesionales_model');
          $codigo_profesional = $this->Profesionales_model->getCodigoProfesionalPorDni($this->session->userdata('dni'));
          $profesional = $codigo_profesional[0]['codigo'];
          
          $fecha = $this->input->post("fecha");
          $anio =  $this->input->post("anio");
          $mes = $this->input->post("mes");
          $dia = $this->input->post("dia");
          $numero_dia = date("N", strtotime($fecha));
          
          $this->load->model("Turnos_model");
          $this->load->model("Horarios_model");
          
          $turnos_profesional_hoy = $this->Turnos_model->getHorariosPorFechaProfesional($fecha,$profesional);
          $horarios_profesional = $this->Horarios_model->getHorariosProfesional($profesional,$numero_dia,$anio,$mes);
          $profesional_nombre_apellido = $this->Profesionales_model->getNombreApellidoProfesional($profesional);
          $resultado = $this->pagina->render_horarios_dia($turnos_profesional_hoy,$horarios_profesional,$anio,$mes,$dia,$profesional,$profesional_nombre_apellido);
         
          echo json_encode($resultado);
        }else{
            redirect("acceso");
        }
    }*/
    public function getTurnosProfesionalPorMesAnioEspecialidad()
    {
        if ($this->profesional->verificar_acceso() && $this->profesional->verificar_operatividad() && $this->input->is_ajax_request()) 
        {
            $this->load->model("Profesionales_model");
            $this->load->model("Turnos_model");
            
            $cod= $this->Profesionales_model->getCodigoProfesionalPorDni($this->session->userdata("dni"));
            $cod_profesional= $cod[0]["codigo"];
                    
            $cod_especialidad= $this->input->post("especialidad");
            $mes=$this->input->post("mes");
            $anio=$this->input->post("anio");
            
            $resultado=$this->Turnos_model->getTurnosProfesionalPorMesAnioEspecialidad($cod_profesional,$cod_especialidad,$mes,$anio);
            echo json_encode($resultado);
        }else{
            redirect("acceso");
        }
    }
    
    public function getHistoriaClinicaPorTurno()
    {
        if ($this->profesional->verificar_acceso() && $this->profesional->verificar_operatividad() && $this->input->is_ajax_request()) 
        {
            $this->load->model("Historias_clinicas_model");
            $resultado=$this->Historias_clinicas_model->getHistoriaClinicaPorTurno($this->input->post("turno"));
            echo json_encode($resultado);
        }else{
            redirect("acceso");
        }
    }
    
    public function abm_historias_clinicas() {
        if ($this->profesional->verificar_acceso() && $this->profesional->verificar_operatividad()) 
        {  
                
                $imagen=base_url()."recursos/img/empleados/".$this->session->userdata('imagen');
                $dni=$this->session->userdata('dni');
                $nombre=$this->session->userdata('nombre');
                $apellido=$this->session->userdata('apellido');
                $vista["menu"] = $this->pagina->get_menu($imagen, $dni, $nombre, $apellido);
                $vista["cabecera"] = $this->pagina->get_cabecera($imagen, $dni, $nombre, $apellido);
                $vista["seccion"] = "ABM Historias Clinicas";
                $vista["detalle"] = $this->pagina->render_historias_clinicas();
                $this->load->view('profesional/vista_general.php',$vista);
            

        }else{
            redirect("acceso");
        }
    }  
    
    
    
    
    
    public function getTurnosHoyLista()
    {
        if ($this->input->is_ajax_request()) 
        {
          $this->load->model("Turnos_model");
          $this->load->model("Profesionales_model");
          $codigo = $this->Profesionales_model->getCodigoProfesionalPorDni($this->session->userdata("dni"));
          $resultado = $this->Turnos_model->getTurnosHoyListaProfesional($codigo[0]["codigo"]);
          
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
    
     public function atender_turno() {
        if ($this->session->userdata("tipo_usuario") == "4" && $this->session->userdata("operativo") == "si" && $this->input->is_ajax_request()) 
        {
          $this->load->model("Turnos_model");
          echo json_encode($this->Turnos_model->atender_turno($this->input->post("codigo")));
        }
        else{
            redirect("acceso");
        }
     }
     
    public function getHistoricoTurnos()
    {
        if($this->input->is_ajax_request() && $this->session->userdata("operativo") == "si" && $this->session->userdata("tipo_usuario") == "4")
        {
            $this->load->model("Turnos_model");
            $resultado = $this->Turnos_model->getTurnosDesdeHoyLista($this->session->userdata("dni"));
            
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
}