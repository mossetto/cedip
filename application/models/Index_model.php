<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	// Editar informacion de evento
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
}