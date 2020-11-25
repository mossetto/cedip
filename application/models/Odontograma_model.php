<?php

class Odontograma_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_odontograma_por_historia($id_historia_clinica)
    {
    	$r = $this->db->query("select * from odontograma where id_historia_clinica = ?",array($id_historia_clinica));
    	return $r->row_array();
    }

    public function agregar_odontograma($id_historia_clinica,$observaciones,$reservado_os,$config)
    {
    	return $this->db->insert("odontograma",array(
    		"id_historia_clinica"=>$id_historia_clinica,
    		"observaciones"=>$observaciones,
    		"reservado_os"=>$reservado_os,
    		"config"=>$config
    	));	
    }

    public function editar_odontograma($id_historia_clinica,$observaciones,$reservado_os,$config)
    {
    	$this->db->where("id_historia_clinica",$id_historia_clinica);
    	
    	return $this->db->update("odontograma",array(
    		"id_historia_clinica"=>$id_historia_clinica,
    		"observaciones"=>$observaciones,
    		"reservado_os"=>$reservado_os,
    		"config"=>$config
    	));	
    }
}