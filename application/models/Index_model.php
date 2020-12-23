<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	// Editar informacion paciente
	function edit($dni,$data){
		$data=array(
			'nombre' => $data['nombre'],
			'apellido' => $data['apellido'],
			'correo' => $data['correo'],
			'telefono' => $data['telefono'],
			'direccion' => $data['direccion'],
			'pass_web' => $data['pass_web']
		);
		$this->db->where('dni',$dni);
		$query=$this->db->update('pacientes',$data);
		return $query;
	}
	// Consulta existencia de usuario
	function getRecuperar($dni,$email){
		$this->db->where('dni',$dni);
		$this->db->where('correo',$email);
		$query=$this->db->get('pacientes');
		return $query;
	}
	//
	function asignaUsuario($data){
		$data_model = array(
			'correo' => $data['email'],
			'pass_web' => $data['password']
		);
		$this->db->where('dni',$data['dni']);
		$query=$this->db->update('pacientes',$data_model);
		return $query;
	}
	//
	function existsDNI($dni){
		$this->db->where('dni',$dni);
		$query=$this->db->get('pacientes');
		//echo $this->db->last_query();
		return $query;
	}
}