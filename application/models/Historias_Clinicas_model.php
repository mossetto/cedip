<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Historias_Clinicas_model
 *
 * @author mario
 */
class Historias_Clinicas_model extends CI_Model
{
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    function getHistoriasClinicasSinJoin()
    {
        $resultado = $this->db->query("select * from historias_clinicas");
        return $resultado->result_array();
    }

    function getHistoriaClinicaSinJoin($codigo)
    {
        $resultado = $this->db->query("select * from historias_clinicas where codigo = ?",array($codigo));
        return $resultado->row_array();
    }

    function getHistoriasClinicas()
    {
        $resultado = $this->db->query("select historias_clinicas.codigo,historias_clinicas.fecha,historias_clinicas.paciente,historias_clinicas.medico,historias_clinicas.profesional,historias_clinicas.especialidad,historias_clinicas.imagen1,historias_clinicas.imagen2,historias_clinicas.imagen3,historias_clinicas.imagen4,historias_clinicas.examen,historias_clinicas.conclusion, especialidades.especialidad as nombre_especialidad, empleados.nombre as nombre_profesional, empleados.apellido as apellido_profesional,pacientes.nombre as nombre_paciente, pacientes.apellido as apellido_paciente from historias_clinicas INNER JOIN profesionales on profesionales.codigo = historias_clinicas.profesional INNER JOIN empleados on empleados.dni = profesionales.cod_usuario INNER JOIN especialidades on especialidades.codigo = historias_clinicas.especialidad INNER JOIN pacientes on pacientes.dni = historias_clinicas.paciente;");
        return $resultado->result_array();
    }
    function getHistoriasClinicasActivas()
    {
        $resultado = $this->db->query("select historias_clinicas.codigo, turnos.paciente as dni_paciente, turnos.fecha,turnos.hora_desde, turnos.profesional,turnos.paciente,historias_clinicas.observaciones,historias_clinicas.imagen1,historias_clinicas.imagen2,historias_clinicas.imagen3,historias_clinicas.imagen4, empleados.nombre, empleados.apellido, especialidades.especialidad from historias_clinicas INNER JOIN turnos on turnos.codigo = historias_clinicas.turno INNER JOIN profesionales on turnos.profesional = profesionales.codigo INNER JOIN empleados on empleados.dni= profesionales.cod_usuario INNER JOIN especialidades on especialidades.codigo = turnos.especialidad where historias_clinicas.activo = 'si' ");
        return $resultado->result_array();
    }
    
    function getHistoriasClinicasActivasPorPaciente($dni)
    {
        $resultado = $this->db->query("select historias_clinicas.codigo, turnos.paciente as dni_paciente, turnos.fecha,turnos.hora_desde, turnos.profesional,turnos.paciente,historias_clinicas.observaciones,historias_clinicas.imagen1,historias_clinicas.imagen2,historias_clinicas.imagen3,historias_clinicas.imagen4, empleados.nombre, empleados.apellido, especialidades.especialidad from historias_clinicas INNER JOIN turnos on turnos.codigo = historias_clinicas.turno INNER JOIN profesionales on turnos.profesional = profesionales.codigo INNER JOIN empleados on empleados.dni= profesionales.cod_usuario INNER JOIN especialidades on especialidades.codigo = turnos.especialidad where historias_clinicas.activo = 'si' and turnos.paciente = $dni");
        return $resultado->result_array();
    }
    
    function getPacientesConHistoriaClinica()
    {
        $resultado = $this->db->query("select pacientes.dni, pacientes.nombre, pacientes.apellido, obras_sociales.razon_social as obra_social from pacientes INNER JOIN obras_sociales on obras_sociales.codigo = pacientes.cod_obra_social INNER JOIN turnos on turnos.paciente = pacientes.dni INNER JOIN historias_clinicas on historias_clinicas.turno = turnos.codigo where historias_clinicas.activo ='si' group by pacientes.dni");
        return $resultado->result_array();
    }
    
    function getHistoriaClinicaPorTurno($turno)
    {
        $resultado = $this->db->query("select historias_clinicas.*, especialidades.especialidad from historias_clinicas INNER JOIN turnos on turnos.codigo = historias_clinicas.turno INNER JOIN especialidades on especialidades.codigo = turnos.especialidad where historias_clinicas.turno = $turno");
        return $resultado->result_array();
    }
    
   /* function getHistoriaClinica($codigo)
    {
        $resultado = $this->db->query("select historias_clinicas.*, especialidades.especialidad from historias_clinicas INNER JOIN turnos on turnos.codigo = historias_clinicas.turno INNER JOIN especialidades on especialidades.codigo = turnos.especialidad where historias_clinicas.codigo = $codigo");

        return $resultado->result_array();
    }*/
    
    function getHistoriaClinica($codigo)
    {
        $resultado = $this->db->query("select * from historias_clinicas where codigo = $codigo");
        return $resultado->result_array();
    }

    function getHistoriaClinicaConJoin($codigo)
    {
        $resultado = $this->db->query(

        "select historias_clinicas.*, 
        pacientes.nombre as pacientes_nombre, 
        pacientes.apellido as pacientes_apellido, 
        pacientes.num_afiliado as pacientes_num_afiliado,
        pacientes.nacimiento as pacientes_nacimiento,
        pacientes.telefono as pacientes_telefono,
        pacientes.celular as pacientes_celular,
        pacientes.correo as pacientes_correo,
        pacientes.direccion as pacientes_direccion,
        pacientes.titular as pacientes_titular,
        pacientes.sexo as pacientes_sexo,
        pacientes.grupo_familiar as pacientes_grupo_familiar,
        pacientes.parentesco as pacientes_parentesco,
        pacientes.lugar_trabajo_titular as pacientes_lugar_trabajo_titular,
        pacientes.jerarquia_trabajo_titular as pacientes_jerarquia_trabajo_titular,
        localidades.descripcion as localidades_descripcion
        from historias_clinicas 
        INNER JOIN pacientes on pacientes.dni = historias_clinicas.paciente 
        INNER JOIN localidades on localidades.cod_localidad = pacientes.localidad
        where historias_clinicas.codigo = $codigo");
        return $resultado->row_array();
    }
    
    function addHistoriaClinica($turno,$estado)
    {
        $datos = Array("turno"=>$turno,"activo"=>$estado);
        
        return $this->db->insert("historias_clinicas",$datos);
    }
    
    function editEstadoHistoriaClinica($turno,$estado)
    {
         $datos = Array("turno"=>$turno,"activo"=>$estado);
         
         $this->db->where("turno",$turno);
         return $this->db->update("historias_clinicas",$datos); 
    }
    
    function getHistoriaClinicaPaciente($dni)
    {
       $resultado = $this->db->query("select turnos.fecha,historias_clinicas.codigo, historias_clinicas.turno,historias_clinicas.observaciones,historias_clinicas.imagen1,historias_clinicas.imagen2,historias_clinicas.imagen3,historias_clinicas.imagen4,turnos.paciente from historias_clinicas INNER JOIN turnos on turnos.codigo = historias_clinicas.turno where turnos.paciente = $dni and historias_clinicas.activo = 'si' ");
       return $resultado->result_array(); 
    }
    
    /*function actualizarHistoriaClinica($codigo,$observaciones,$imagen1,$imagen2,$imagen3,$imagen4)
    {
        $resultado = $this->db->query("select * from historias_clinicas where codigo = $codigo");
        $resultado= $resultado->result_array();
        $resultado = $resultado[0];
        
        if($imagen1 == "")
        {
            $imagen1= $resultado["imagen1"];
        }
        if($imagen2 == "")
        {
            $imagen2= $resultado["imagen2"];
        }
        if($imagen3 == "")
        {
            $imagen3= $resultado["imagen3"];
        }
        if($imagen4 == "")
        {
            $imagen4= $resultado["imagen4"];
        }
        
        $datos = Array(
            "observaciones"=>$observaciones,
            "imagen1"=>$imagen1,
            "imagen2"=>$imagen2,
            "imagen3"=>$imagen3,
            "imagen4"=>$imagen4,
        );
        $this->db->where("codigo",$codigo);
        $this->db->update("historias_clinicas",$datos);
    }*/
    
    public function set_imagenes($codigo,$imagenes)
    {
        $datos = Array(
           "imagenes"=>$imagenes,
        );
        
        $this->db->where("codigo",$codigo);
        return $this->db->update("historias_clinicas",$datos);
    }
    public function actualizarHistoriaClinica($codigo,$fecha,$examen,$conclusion,$imagenes,$medico)
    {
        $datos = Array(
            "fecha"=>$fecha,
            "examen"=>$examen,
            "conclusion"=>$conclusion,
            "imagenes"=>$imagenes,
            "medico"=>$medico,
        );
        
        $this->db->where("codigo",$codigo);
        return $this->db->update("historias_clinicas",$datos);
    }
    
    public function agregar_historia_clinica($fecha,$paciente,$profesional,$especialidad,$examen,$conclusion,$imagenes,$medico)
    {
        $datos = Array(
            "codigo"=>null,
            "fecha"=>$fecha,
            "paciente"=>$paciente,
            "profesional"=>$profesional,
            "especialidad"=>$especialidad,
            "examen"=>$examen,
            "conclusion"=>$conclusion,
            "imagenes"=>$imagenes, // IMAGES IS JSON ARRAY
            "medico"=>$medico,
        );
        
        return $this->db->insert("historias_clinicas",$datos);
    }
    
    function eliminar_historia_clinica($codigo)
    {
        $this->db->where('codigo', $codigo);
        return $this->db->delete('historias_clinicas');
    }
    
    
}
