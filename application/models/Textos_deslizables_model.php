<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Textos_deslizables_model
 *
 * @author mario
 */
class Textos_deslizables_model extends CI_Model
{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function getTextos()
    {
        $resultado = $this->db->query("select * from textos_deslizables_home");
        return $resultado->result_array();
    }
}
