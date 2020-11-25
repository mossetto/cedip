<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Turnos_model
 *
 * @author mario
 */
class Turnos_model extends CI_Model
{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function comprobar_disponibilidad_turno($id_profesional,$fecha,$hora_desde,$hora_hasta)
    {
        $sql="SELECT * FROM turnos where turnos.profesional = $id_profesional and (estado = 'pendiente' or estado = 'confirmado') and fecha = '".Date("Y-m-d")."' and (
                ('".$hora_desde."' = hora_desde and '".$hora_hasta."' = hora_hasta)
                or ('".$hora_desde."' > hora_desde and '".$hora_desde."' < hora_hasta)
                or ('".$hora_hasta."' > hora_desde and '".$hora_hasta."' < hora_hasta)
            )";

        $result = $this->db->query($sql);

        $disponible = true;
        
        if(count($result->result_array()) > 0) 
        {
            $disponible=false;
        }

        return $disponible;
    }

    function getTurnosPorProfesionalEspecialidadMesAnio($cod_profesional,$cod_especialidad,$mes,$anio)
    {
        $result = $this->db->query("select turnos.codigo, turnos.fecha from turnos INNER JOIN profesionales on profesionales.codigo = turnos.profesional INNER JOIN especialidades_profesionales on especialidades_profesionales.cod_profesional = turnos.profesional where turnos.fecha >= '$anio-$mes-00' and fecha <= '$anio-$mes-31' and turnos.profesional = $cod_profesional and especialidades_profesionales.especialidad = $cod_especialidad and estado <> 'cancelado' and turnos.estado <> 'cumplido'");
        return $result->result_array();
    }
    
    function getTurnosProfesionalPorMesAnioEspecialidad($cod_profesional,$cod_especialidad,$mes,$anio)
    {
        $result = $this->db->query("select turnos.codigo, turnos.fecha from turnos where turnos.fecha >= '$anio-$mes-00' and fecha <= '$anio-$mes-31' and turnos.profesional = $cod_profesional and especialidad = $cod_especialidad and estado <> 'cancelado' and turnos.estado <> 'cumplido'");
        return $result->result_array();
    }
    
    function getTurnosMesPorProfesional($cod_profesional,$mes,$anio)
    {
        $result = $this->db->query("select turnos.codigo, turnos.fecha from turnos INNER JOIN profesionales on profesionales.codigo = turnos.profesional where turnos.fecha >= '$anio-$mes-00' and fecha <= '$anio-$mes-31' and turnos.profesional = $cod_profesional and estado <> 'cancelado' and turnos.estado <> 'cumplido'");
        return $result->result_array();
    }
    
    function getTurnosImpresion($turno)
    {
        $result = $this->db->query("select turnos.codigo, turnos.paciente as dni_paciente, turnos.fecha, turnos.hora_desde, turnos.hora_hasta, empleados.nombre as nombre_profesional, empleados.apellido as apellido_profesional, especialidades.especialidad, turnos.paciente, turnos.estado, turnos.observaciones, pacientes.nombre as nombre_paciente, pacientes.apellido as apellido_paciente from turnos INNER JOIN profesionales on profesionales.codigo = turnos.profesional INNER JOIN empleados on empleados.dni = profesionales.cod_usuario INNER JOIN especialidades on especialidades.codigo = turnos.especialidad INNER JOIN pacientes on pacientes.dni = turnos.paciente where turnos.codigo = $turno");
        return $result->row_array();
    }
    
    function getUltimoTurno()
    {
        $result = $this->db->query("select turnos.codigo, turnos.paciente as dni_paciente, turnos.fecha, turnos.hora_desde, turnos.hora_hasta, empleados.nombre as nombre_profesional, empleados.apellido as apellido_profesional, especialidades.especialidad, turnos.paciente, turnos.estado, pacientes.nombre as nombre_paciente, pacientes.apellido as apellido_paciente, turnos.observaciones from turnos INNER JOIN profesionales on profesionales.codigo = turnos.profesional INNER JOIN empleados on empleados.dni = profesionales.cod_usuario INNER JOIN especialidades on especialidades.codigo = turnos.especialidad INNER JOIN pacientes on pacientes.dni = turnos.paciente where turnos.codigo in (select max(turnos.codigo) from turnos)");
        return $result->row_array();
    }
    
    function getTurnosHoyLista()
    {
        $day= Date('d');
        $month=Date('m');
        $year=Date('Y');
        $result = $this->db->query("select turnos.fecha, turnos.codigo,empleados.nombre as nombre_profesional, empleados.apellido as apellido_profesional, pacientes.dni, pacientes.nombre,pacientes.apellido,turnos.hora_desde,turnos.hora_hasta,turnos.estado, turnos.cobrado, turnos.importe from turnos INNER JOIN profesionales on profesionales.codigo = turnos.profesional INNER JOIN empleados on empleados.dni = profesionales.cod_usuario INNER JOIN pacientes on pacientes.dni = turnos.paciente where turnos.fecha = '".$year."-".$month."-".$day."' and turnos.estado = 'confirmado'");
        return $result->result_array();
    }

    function getTurnosPaciente($dni)
    {
        $result = $this->db->query("select turnos.fecha, turnos.codigo,empleados.nombre as nombre_profesional, empleados.apellido as apellido_profesional, pacientes.dni, pacientes.nombre,pacientes.apellido,turnos.hora_desde,turnos.hora_hasta,turnos.estado, turnos.cobrado, turnos.importe from turnos INNER JOIN profesionales on profesionales.codigo = turnos.profesional INNER JOIN empleados on empleados.dni = profesionales.cod_usuario INNER JOIN pacientes on pacientes.dni = turnos.paciente where pacientes.dni = ".$this->db->escape($dni)." order by turnos.fecha desc");
        return $result->result_array();
    }
    
    function cobrar_turno($codigo)
    {
        $datos = Array(
            "cobrado"=>"si",
        );
        
        $this->db->where("codigo",$codigo);
        return $this->db->update("turnos",$datos);
    }
    function getDatosNomencladorTurno($especialidad,$obra_social)
    {
        $day= Date('d');
        $month=Date('m');
        $year=Date('Y');
        $result = $this->db->query("select * from nomenclador where nomenclador.cod_obra_social = $obra_social and nomenclador.cod_especialidad = $especialidad and fecha_hasta in (select min(nomenclador.fecha_hasta) as fecha_hasta from nomenclador where nomenclador.cod_obra_social = $obra_social and nomenclador.cod_especialidad = $especialidad and nomenclador.fecha_hasta >= '".$year."-".$month."-".$day."')");
        return $result->row_array();
    }
    
    function getTurnosFinalizados()
    {
        $result = $this->db->query("select turnos.fecha, turnos.codigo,empleados.nombre as nombre_profesional, empleados.apellido as apellido_profesional, pacientes.dni, pacientes.nombre,pacientes.apellido,turnos.hora_desde,turnos.hora_hasta,turnos.estado from turnos INNER JOIN profesionales on profesionales.codigo = turnos.profesional INNER JOIN empleados on empleados.dni = profesionales.cod_usuario INNER JOIN pacientes on pacientes.dni = turnos.paciente where turnos.estado = 'cumplido'");
        return $result->result_array();
    }
    
    function getTurnosProximosConfirmados()
    {
        $day= Date('d');
        $month=Date('m');
        $year=Date('Y');
        $result = $this->db->query("select turnos.fecha,turnos.codigo,empleados.nombre as nombre_profesional, empleados.apellido as apellido_profesional, pacientes.dni, pacientes.nombre,pacientes.apellido,turnos.hora_desde,turnos.hora_hasta,turnos.estado from turnos INNER JOIN profesionales on profesionales.codigo = turnos.profesional INNER JOIN empleados on empleados.dni = profesionales.cod_usuario INNER JOIN pacientes on pacientes.dni = turnos.paciente where turnos.fecha >= '".$year."-".$month."-".$day."' and turnos.estado = 'confirmado'");
        return $result->result_array();
    }
    
    function getTurnosDesdeHoyLista($dni_profesional)
    {
        $day= Date('d');
        $month=Date('m');
        $year=Date('Y');
        $result = $this->db->query("select turnos.codigo, turnos.paciente, turnos.fecha, turnos.hora_desde, turnos.hora_hasta, turnos.profesional, empleados.nombre as nombre_profesional, empleados.apellido as apellido_profesional, especialidades.especialidad, pacientes.nombre as nombre_paciente, pacientes.apellido as apellido_paciente, turnos.estado, turnos.importe, turnos.cobrado from turnos INNER JOIN profesionales on profesionales.codigo =turnos.profesional INNER JOIN empleados on empleados.dni = profesionales.cod_usuario INNER JOIN especialidades on especialidades.codigo = turnos.especialidad INNER JOIN pacientes on pacientes.dni = turnos.paciente where turnos.fecha <= '".$year."-".$month."-".$day."' and turnos.profesional in (select profesionales.codigo from profesionales where profesionales.cod_usuario = $dni_profesional) order by fecha desc");
        return $result->result_array();
    }
    
    function getTurnosTodosDesdeHoyLista()
    {
        $day= Date('d');
        $month=Date('m');
        $year=Date('Y');
        $result = $this->db->query("select turnos.codigo, turnos.paciente, turnos.fecha, turnos.hora_desde, turnos.hora_hasta, turnos.profesional, empleados.nombre as nombre_profesional, empleados.apellido as apellido_profesional, especialidades.especialidad, pacientes.nombre as nombre_paciente, pacientes.apellido as apellido_paciente, turnos.estado, turnos.importe, turnos.cobrado from turnos INNER JOIN profesionales on profesionales.codigo =turnos.profesional INNER JOIN empleados on empleados.dni = profesionales.cod_usuario INNER JOIN especialidades on especialidades.codigo = turnos.especialidad INNER JOIN pacientes on pacientes.dni = turnos.paciente where turnos.fecha <= '".$year."-".$month."-".$day."' order by fecha desc");
        return $result->result_array();
    }
    
    function getTurnosHoyListaProfesional($profesional)
    {
        $day= Date('d');
        $month=Date('m');
        $year=Date('Y');
        $result = $this->db->query("select turnos.codigo,empleados.nombre as nombre_profesional, empleados.apellido as apellido_profesional, pacientes.dni, pacientes.nombre,pacientes.apellido,turnos.hora_desde,turnos.hora_hasta,turnos.estado, especialidades.especialidad, turnos.importe, turnos.cobrado from turnos INNER JOIN profesionales on profesionales.codigo = turnos.profesional INNER JOIN empleados on empleados.dni = profesionales.cod_usuario INNER JOIN pacientes on pacientes.dni = turnos.paciente INNER JOIN especialidades on especialidades.codigo = turnos.especialidad where turnos.fecha = '".$year."-".$month."-".$day."' and turnos.estado = 'confirmado' and turnos.profesional= $profesional");
        return $result->result_array();
    }
    
    
    function getTurnosHoyCalendario()
    {
	$resultado = $this->db->query("select turnos.codigo,turnos.fecha,turnos.hora_desde,turnos.hora_hasta,turnos.profesional,turnos.paciente,turnos.estado,empleados.nombre,empleados.apellido from turnos INNER JOIN profesionales on profesionales.codigo = turnos.profesional INNER JOIN empleados on empleados.dni = profesionales.cod_usuario where empleados.operativo = 'si' and turnos.fecha = '".Date('y')."-".Date('m')."-".date('d')."' and estado <> 'cancelado' and turnos.estado <> 'cumplido'");
	return $resultado->result_array();
    }
    
    function getHorariosPorFechaProfesional($fecha,$profesional)
    {
        $resultado = $this->db->query("select turnos.*, empleados.nombre as nombre_profesional, empleados.apellido as apellido_profesional, pacientes.nombre as pacientes_nombre, pacientes.apellido as pacientes_apellido from turnos INNER JOIN profesionales on profesionales.codigo = turnos.profesional INNER JOIN empleados on profesionales.cod_usuario = empleados.dni INNER JOIN pacientes on pacientes.dni = turnos.paciente  where turnos.fecha = '$fecha' and turnos.profesional = $profesional and turnos.estado <> 'cancelado' and turnos.estado <> 'cumplido' order by turnos.hora_desde asc");
        return $resultado->result_array();
    }
    
    function agregarTurno($fecha,$hora_desde,$hora_hasta,$profesional,$paciente,$estado,$especialidad,$precio,$cobrado,$obra_social,$observaciones)
    {
        $datos = Array(
            "codigo"=>null,
            "fecha"=>$fecha,
            "hora_desde"=>$hora_desde,
            "hora_hasta"=>$hora_hasta,
            "profesional"=>$profesional,
            "paciente"=>$paciente,
            "estado"=>$estado,
            "especialidad"=>$especialidad,
            "importe"=>$precio,
            "cobrado"=>$cobrado,
            "obra_social"=>$obra_social,
            "observaciones"=>$observaciones,
        );
        
        return $this->db->insert("turnos",$datos);
    }
    
    function actualizarTurno($codigo,$fecha,$hora_desde,$hora_hasta,$profesional,$paciente,$estado,$especialidad,$observaciones)
    {
        $datos = Array(
            "fecha"=>$fecha,
            "hora_desde"=>$hora_desde,
            "hora_hasta"=>$hora_hasta,
            "profesional"=>$profesional,
            "paciente"=>$paciente,
            "estado"=>$estado,
            "especialidad"=>$especialidad,
            "observaciones"=> $observaciones,
        );
        
        $this->db->where("codigo",$codigo);
        return $this->db->update("turnos",$datos);
    }
    
    function getTurno($codigo)
    {
        $resultado = $this->db->query("select * from turnos where turnos.codigo = $codigo");
	   return $resultado->result_array();
    }
    
    function getCodigoUltimoTurno()
    {
        $resultado = $this->db->query("select max(codigo) as codigo from turnos");
	   return $resultado->result_array();
    }
    
    function borrar_turno($codigo)
    {
        $this->db->where("codigo",$codigo);
        return $this->db->delete("turnos");
    }
    
    function cancelar_turno($codigo,$dni)
    {
        $datos = Array(
            "estado"=>"cancelado",
        );
        
        $this->db->where("codigo",$codigo);
        $this->db->where("paciente",$dni);
        
        return $this->db->update("turnos",$datos);
    }
    
    function getCantidadTurnosEnPendiente()
    {
        $resultado = $this->db->query("select count(codigo) as cantidad from turnos where  estado = 'pendiente'");
	return $resultado->row_array();
    }
    
    function getTurnosPendientes()
    {
        $resultado = $this->db->query("select * from turnos where estado = 'pendiente'");
	return $resultado->result_array();
    }
    
    function atender_turno($codigo)
    {
        $datos = Array(
            "estado"=> "cumplido",
        );
        
        $this->db->where("codigo",$codigo);
        return $this->db->update("turnos",$datos);
    }
    
    function obtener_turno($codigo)
    {
        $resultado = $this->db->query("select * from turnos where turnos.codigo = $codigo");
        return $resultado->row_array();
    }
}
