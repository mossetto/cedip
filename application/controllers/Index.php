<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	//	
	function index() {
		$this->load->view('index/index');
	}
	//
	function login(){
		$this->load->view('index/login');
	}
	//
	function recuperar(){
		$this->load->view('index/recuperar');
	}
	//
	function registro(){
		$this->load->view('index/registro');
	}
	//
	function user(){
		$this->load->view('index/datos_user');
	}
	//
	function estudios(){
		$this->load->view('index/estudios_user');
	}			
}