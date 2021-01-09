<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pacientes_model
 *
 * @author mario
 */
class Pacientes_model extends CI_Model
{
	//put your code here
	
	public function __construct() {
		parent::__construct();
	}
	
	function getPacientes()
	{
		$resultado = $this->db->query("select * from pacientes");
		return $resultado->result_array();
	}
	
	function getPaciente($paciente)
	{
		$resultado = $this->db->query("SELECT * FROM pacientes where pacientes.dni = $paciente");
		return $resultado->result_array();
	}
	
	function getPrimerPaciente()
	{
		$resultado = $this->db->query("SELECT min(pacientes.dni) as dni from pacientes");
		return $resultado->row_array();
	}
	
	function getObraSocialPaciente($paciente)
	{
		$resultado = $this->db->query("select obras_sociales.codigo,obras_sociales.razon_social from obras_sociales INNER JOIN pacientes on pacientes.cod_obra_social = obras_sociales.codigo where pacientes.dni = $paciente");
		return $resultado->row_array();
	}
	
	function getPacientesPorSugerencia($dni)
	{
		$resultado = $this->db->query("SELECT * FROM pacientes where pacientes.dni Like '$dni%'");
		return $resultado->result_array();
	}
	
	function getPacienteInicioSesion($dni,$password)
	{
		$resultado = $this->db->query("SELECT * FROM pacientes where pacientes.dni = '$dni' and pacientes.pass_web = '$password'");
		return $resultado->result_array();
	}
	
	function getHistorialMedicoPaciente($dni)
	{
		$resultado = $this->db->query("select historias_clinicas.codigo, historias_clinicas.fecha, especialidades.especialidad, empleados.nombre, empleados.apellido, pacientes.nombre as nombre_paciente, pacientes.apellido as apellido_paciente, obras_sociales.razon_social, historias_clinicas.imagen1, historias_clinicas.imagen2,historias_clinicas.imagen3,historias_clinicas.imagen4 from historias_clinicas INNER JOIN especialidades on especialidades.codigo = historias_clinicas.especialidad INNER JOIN profesionales on profesionales.codigo = historias_clinicas.profesional INNER JOIN empleados on empleados.dni = profesionales.cod_usuario INNER JOIN pacientes on pacientes.dni = historias_clinicas.paciente INNER JOIN obras_sociales on obras_sociales.codigo = pacientes.cod_obra_social where historias_clinicas.paciente = $dni ORDER BY 2 DESC");
		//echo $this->db->last_query();
		return $resultado->result();//->result_array();
	}


	function getHistorialMedicoPacienteDate($dni,$fecha1,$fecha2)
	{
		$resultado = $this->db->query("select historias_clinicas.codigo, historias_clinicas.fecha, especialidades.especialidad, empleados.nombre, empleados.apellido, pacientes.nombre as nombre_paciente, pacientes.apellido as apellido_paciente, obras_sociales.razon_social, historias_clinicas.imagen1, historias_clinicas.imagen2,historias_clinicas.imagen3,historias_clinicas.imagen4 from historias_clinicas INNER JOIN especialidades on especialidades.codigo = historias_clinicas.especialidad INNER JOIN profesionales on profesionales.codigo = historias_clinicas.profesional INNER JOIN empleados on empleados.dni = profesionales.cod_usuario INNER JOIN pacientes on pacientes.dni = historias_clinicas.paciente INNER JOIN obras_sociales on obras_sociales.codigo = pacientes.cod_obra_social where historias_clinicas.paciente = $dni AND historias_clinicas.fecha BETWEEN '$fecha1' AND '$fecha2' ORDER BY 2 DESC");
		return $resultado->result();
	}
	
	
	function getTurnosPaciente($dni)
	{
		$resultado = $this->db->query("select turnos.codigo, turnos.fecha, turnos.hora_desde, turnos.hora_hasta, empleados.nombre, empleados.apellido, empleados.imagen, turnos.estado, especialidades.especialidad from turnos INNER JOIN profesionales on profesionales.codigo = turnos.profesional INNER JOIN empleados on empleados.dni = profesionales.cod_usuario INNER JOIN especialidades on especialidades.codigo = turnos.especialidad where turnos.paciente = $dni and turnos.estado = 'pendiente' or turnos.estado = 'confirmado' order by turnos.estado ASC ");
		return $resultado->result_array();
	} 
	
	function getCantidadTurnosPendientePaciente($dni)
	{
		$resultado = $this->db->query("select count(codigo) as cantidad from turnos where turnos.paciente = $dni and estado = 'pendiente'");
		return $resultado->row_array();
	}
	function obtener_paciente($dni)
	{
		$resultado = $this->db->query("SELECT * FROM pacientes where pacientes.dni = $dni");
		return $resultado->row_array();
	} 
}
