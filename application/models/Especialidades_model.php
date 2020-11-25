<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Especialidades_model
 *
 * @author mario
 */
class Especialidades_model extends CI_Model
{
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    function getEspecialidades()
    {
        $resultado = $this->db->query("select * from especialidades");
        return $resultado->result_array();
    }
    
    function getEspecialidad($codigo)
    {
        $resultado = $this->db->query("select * from especialidades where codigo = $codigo");
        return $resultado->row_array();
    }
    
    function getPrimeraEspecialidad()
    {
        $resultado = $this->db->query("select min(codigo) as codigo from especialidades");
        return $resultado->row_array();
    }
}
