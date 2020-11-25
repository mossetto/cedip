<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion_horarios_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_horario()
    {
        $r = $this->db->query("select * from configuracion_horarios where id = 1");
        return $r->row_array();
    }

    public function editar_horario($desde,$hasta,$tiempo_turno,$fecha_modificacion,$usuario)
    {
        $datos = array(
            "desde"=>$desde,
            "hasta"=>$hasta,
            "tiempo_turno"=>$tiempo_turno,
            "fecha_modificacion"=>$fecha_modificacion,
            "usuario"=>$usuario
        );

        $this->db->where("id",1);
        return $this->db->update("configuracion_horarios",$datos);
    }
}

?>