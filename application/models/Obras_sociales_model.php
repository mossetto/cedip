<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Obras_sociales_model
 *
 * @author mario
 */
class Obras_sociales_model extends CI_Model
{
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
   function getObrasSociales()
   {
       $r = $this->db->query("select * from obras_sociales");
       return $r->result_array();
   }
   
   function getObraSocial($codigo)
   {
       $r = $this->db->query("select * from obras_sociales where codigo = $codigo");
       return $r->row_array();
   }
}
