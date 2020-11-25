<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion_horarios_avanzados_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_horarios_por_dia($numero_dia)
    {
        $r = $this->db->query("SELECT configuracion_horarios_avanzados.*, dias.descripcion as dias_descripcion FROM configuracion_horarios_avanzados  inner join dias on dias.codigo = configuracion_horarios_avanzados.dia WHERE dia = ?",array($numero_dia));
        return $r->result_array();
    }

    public function get_horarios()
    {
        $r = $this->db->query("SELECT configuracion_horarios_avanzados.*, dias.descripcion as dias_descripcion FROM configuracion_horarios_avanzados inner join dias on dias.codigo = configuracion_horarios_avanzados.dia ");
        return $r->result_array();
    }

    public function agregar_horario($dia,$desde,$hasta,$tiempo_turno,$fecha_modificacion,$usuario)
    {
        $datos = array(
            "dia"=>$dia,
            "desde"=>$desde,
            "hasta"=>$hasta,
            "tiempo_turno"=>$tiempo_turno,
            "fecha_modificacion"=>$fecha_modificacion,
            "usuario"=>$usuario
        );

        return $this->db->insert("configuracion_horarios_avanzados",$datos);
    }
    
    public function eliminar($id)
    {
        $this->db->where("id",$id);
        return $this->db->delete("configuracion_horarios_avanzados");
    }
}

?>