<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Datos_home_model
 *
 * @author mario
 */
class Datos_home_model extends CI_Model
{
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    function getDatosHome()
    {
        $resultado = $this->db->query("select * from datos_home");
        return $resultado->result_array();
    }
    
    function getSecciones()
    {
        $resultado = $this->db->query("select * from secciones_home");
        return $resultado->result_array();
    }
    
    function actualizar_dato($codigo,$descripcion)
    {
        $datos= Array("descripcion"=>$descripcion);
        $this->db->where("codigo",$codigo);
        return $this->db->update("datos_home",$datos);
    }
    function getDatoHome($codigo)
    {
        $resultado = $this->db->query("select * from datos_home where codigo = $codigo");
        return $resultado->result_array();
    }
    
    function getLogo()
    {
        $resultado = $this->db->query("select descripcion from datos_home where codigo = 1");
        $resultado = $resultado->result_array();
        return $resultado[0]["descripcion"];
    }
    
    function getTelefono()
    {
        $resultado = $this->db->query("select descripcion from datos_home where codigo = 2");
        $resultado = $resultado->result_array();
        return $resultado[0]["descripcion"];
    }
    
    function getFondosDeslizantes()
    {
        $resultado = $this->db->query("select descripcion from datos_home where codigo = 6");
        $resultado = $resultado->result_array();
        return $resultado[0]["descripcion"];
    }
    
    function getCorreo()
    {
        $resultado = $this->db->query("select descripcion from datos_home where codigo = 3");
        $resultado = $resultado->result_array();
        return $resultado[0]["descripcion"];
    }
    
    function getLocalizacion()
    {
        $resultado = $this->db->query("select descripcion from datos_home where codigo = 4");
        $resultado = $resultado->result_array();
        return $resultado[0]["descripcion"];
    }
}
