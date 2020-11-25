<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sucursales_model
 *
 * @author mario
 */
class Sucursales_model extends CI_Model
{
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    function getSucursalesPorLocalidad($cod_localidad)
    {
        $respuesta = $this->db->query("select * from sucursales where localidad = $cod_localidad");
        return $respuesta->result_array();
    }
}
