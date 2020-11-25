<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Localidades_model
 *
 * @author mario
 */
class Localidades_model extends CI_Model
{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function getLocalidades()
    {
        $respuesta = $this->db->query("select * from localidades");
        return $respuesta->result_array();
    }
}
