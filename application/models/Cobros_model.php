<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cliente_model
 *
 * @author Adrian Sirianni
 */
class Cobros_model extends CI_Model
{
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
    //con los metodos siguientes se obtine la caja y se actualizan.
    public function get_cobros($turno){
        $r = $this->db->query("SELECT c.id as id, c.id_turno as id_turno, c.fecha as fecha, c.tipo_cobro as id_tipo_cobro, c.importe as importe, c.id_obra_social as id_obra_social,t.descripcion as descripcion_cobro,o.razon_social as obra_social FROM cobro as c, tipo_cobro as t, obras_sociales as o WHERE c.tipo_cobro=t.id and c.id_obra_social=o.codigo and c.id_turno= $turno");
        return $r->result_array();
    }
    
    public function get_tipo_cobros(){
        $r = $this->db->query("SELECT * from tipo_cobro");
        return $r->result_array();
    }
    
    function insertar_cobro($turno,$fecha,$tipo,$importe,$obra)
    {
        $datos = Array(
            "id_turno"=>$turno,
            "fecha"=>$fecha,
            "tipo_cobro"=>$tipo,
            "importe"=>$importe,
            "id_obra_social"=>$obra
        );
        
        return $this->db->insert("cobro",$datos);
    }
    
    function update_cobro_turno($turno,$cobro)
    {
        $datos = Array(
            "cobrado"=>$cobro
        );
        $this->db->where("codigo",$turno);
        return $this->db->update("turnos",$datos);
    }
    
    function borrar_cobro($codigo)
    {
        $this->db->where("id",$codigo);
        return $this->db->delete("cobro");
    }
    
    function borrar_cobro_by_turno($codigo)
    {
        $this->db->where("id_turno",$codigo);
        return $this->db->delete("cobro");
    }
    
    function update_precio_turno($turno,$importe)
    {
        $datos = Array(
            "importe"=>$importe
        );
        $this->db->where("codigo",$turno);
        return $this->db->update("turnos",$datos);
    }
   
    
 }