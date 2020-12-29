<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Acceso extends CI_Controller {
	public $template;

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
	}
	
	public function index() {
		$pagina = new Pagina();
		$pagina->generar_pagina_loguin();
		$vista["pagina"]=$pagina;
		$vista["salida_error"]="";
		$this->load->view('loguin', $vista);
	}
}