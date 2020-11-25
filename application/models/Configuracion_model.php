<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Configuracion_model
 *
 * @author adrians
 */
class Configuracion_model extends CI_Model {
    
    public function __construct() {
        parent::__construct ();
        $this->load->database();
    }
    
    function obtener_estilos_menu() {
        $css="";
        $query = $this->db->query("SELECT contenido FROM configuracion WHERE detalle = 'estilo_menu' ");
        $valor_obtenido=$query->row_array();
        if ($valor_obtenido!=null) {
            $css=$valor_obtenido['contenido'];
        }
        return $css;
    }
    
}
