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
class Caja_model extends CI_Model
{
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
    //con los metodos siguientes se obtine la caja y se actualizan.
    public function obtener_caja($fecha){
        $r = $this->db->query("SELECT * FROM caja WHERE fecha = '$fecha'");
        return $r->row_array();
    }
    
    public function generar_caja($fecha) {
        $entradas=$this->obtener_entradas($fecha);
        $salidas=$this->obtener_salidas($fecha);
        $total=(float)($entradas-$salidas);
        $this->persistir_caja($fecha, $entradas, $salidas, $total, null);
        return $total;
    }
    
    //los siguientes 3 metodos dependen de generar caja
    
    public function obtener_entradas($fecha) {
        $entradas=0;
        $query = $this->db->query("select sum(importe) as importe from caja_detalle where tipo_mov='e' and fecha='$fecha'");
        $valor_obtenido=$query->row_array();
        if ($valor_obtenido!=null) {
            $entradas=floatval($valor_obtenido['importe']);
        }
        return round((float) $entradas, 2);
    }
    
    public function obtener_salidas($fecha) {
        $salidas=0;
        $query = $this->db->query("select sum(importe) as importe from caja_detalle where tipo_mov='s' and fecha='$fecha'");
        $valor_obtenido=$query->row_array();
        if ($valor_obtenido!=null) {
            $salidas=floatval($valor_obtenido['importe']);
        }
        return  round((float)$salidas, 2);
    }
    
    public function persistir_caja($fecha, $entradas, $salidas, $saldo, $estado){
        
        $existe_caja=false;
        $query = $this->db->query("select fecha from caja where fecha='$fecha'");
        $valor_obtenido=$query->row_array();

        if ($valor_obtenido!=null) {
            $existe_caja=$valor_obtenido['fecha'];
        }
        if($existe_caja){
            $this->db->query("update caja set entradas = $entradas, salidas = $salidas, saldo = $saldo  where fecha = '$fecha'");  

        }else{
          $this->db->query("insert into caja values ('$fecha', $entradas, $salidas, $saldo)");  
        }             
    }
    
    
    
    
     public function abrir_caja(){
        $fecha = Date("Y-m-d");
        
        $datos = Array(
            "fecha"=>$fecha,
            "entradas"=>0,
            "salidas"=>0,
            "saldo"=> 0,
            "estado"=>"a",
        );
        
        $this->db->insert("caja",$datos);
    }
    
    public function obtener_listado_entradas($fecha) {
        $query = $this->db->query("select t.codigo as codigo, t.fecha as fecha, "
                . "c.codigo as tipo_cod_comp, "
                . "c.detalle as tipo, "
                . "t.comprobante as comprobante, "
                . "t.importe as importe ,"
                . "t.detalle as detalle "
                . "from caja_detalle as t, "
                . "tipo_comprobante as c "
                . "where tipo_mov = 'e' "
                . "and t.tipo_comp=c.codigo "
                . "and fecha= '$fecha' ");
        return $query->result_array();
    }
    
    public function obtener_listado_salidas($fecha) {
        $query = $this->db->query("select t.codigo as codigo, t.fecha as fecha, "
                . "c.codigo as tipo_cod_comp, "
                . "c.detalle as tipo, "
                . "t.comprobante as comprobante, "
                . "t.importe as importe ,"
                . "t.detalle as detalle "
                . "from caja_detalle as t, "
                . "tipo_comprobante as c "
                . "where tipo_mov = 's' "
                . "and t.tipo_comp=c.codigo "
                . "and fecha= '$fecha'");
        return $query->result_array();
    }
    
    public function actualizar_caja($entradas,$salidas,$saldo,$estado){
        $fecha = Date("Y-m-d");
        
        $datos = Array(
            "entradas"=>$entradas,
            "salidas"=>$salidas,
            "saldo"=> $saldo
            
        );
        
        $this->db->where("fecha",$fecha);
        $this->db->update("caja",$datos);
    }
    
    public function registrar_movimiento_caja($fecha, $tipo_comprobante, $importe, $factura, $entrada_salida, $detalle, $empleado){
                
        $datos = Array(
            "codigo"=>null,
            "fecha"=>$fecha,
            "tipo_comp"=>"$tipo_comprobante",
            "comprobante"=>$factura,
            "importe"=>$importe,
            "tipo_mov"=>$entrada_salida,
            "detalle"=>$detalle,
            "empleado"=>$empleado
        );
        
        $this->db->insert("caja_detalle",$datos);
    }
    
    public function registrar_cobro_caja($numero, $fecha, $concepto, $importe, $detalle, $empleado,$tipo_comprobante,$entrada_salida){
        
        $tabla_caja_detalle="caja_detalle";
        
        
        $datos = Array(
            "codigo"=>null,
            "fecha"=>$fecha,
            "tipo_comp"=>"$tipo_comprobante",
            "importe"=>$importe,
            "comprobante"=>$numero,
            "tipo_mov"=>$entrada_salida,
            
        );
        
        $this->db->insert($tabla_caja_detalle,$datos);
       
        
        
    }
        
    function obtener_ultimo_movimiento() {
        $tabla="movimiento_caja";
        $valor=$this->db->count_all($tabla);
        
        return $valor+1;
    }
        
    function obtener_movimiento_detale_caja($numero_movimiento) {
        $tabla="movimiento_caja";
        $query = $this->db->query("select * from $tabla where numero = $numero_movimiento");
        return $query->row_array();
    }
    
    public function eliminar_movimiento_caja($tipo_comprobante, $comprobante_numero){
          
        $tabla_caja_detalle="caja_detalle";

        $this->db->query("DELETE FROM $tabla_caja_detalle WHERE tipo_comp = $tipo_comprobante AND comprobante=$comprobante_numero");
    }
        
    public function getDatosDeDetalle($comprobante){
        $r = $this->db->query("select turnos.codigo, turnos.fecha, turnos.hora_desde, turnos.hora_hasta, empleados.nombre as nombre_profesional, empleados.apellido as apellido_profesional , especialidades.especialidad, pacientes.nombre as nombre_paciente, pacientes.apellido as apellido_paciente, obras_sociales.razon_social, turnos.importe, pacientes.num_afiliado as pacientes_num_afiliado from turnos INNER JOIN profesionales on profesionales.codigo = turnos.profesional INNER JOIN empleados on empleados.dni = profesionales.cod_usuario INNER JOIN especialidades on especialidades.codigo = turnos.especialidad INNER JOIN obras_sociales on obras_sociales.codigo = turnos.obra_social INNER JOIN pacientes on pacientes.dni = turnos.paciente where turnos.codigo in (select factura.turno from factura where factura.numero = $comprobante)");
        return $r->row_array();
    }
    
    public function getDatosDeMovimiento($comprobante){
        $r = $this->db->query("select cd.codigo as numero, cd.fecha as fecha, cd.tipo_mov as tipo_mov, cd.importe as importe, cd.detalle as concepto, e.nombre as nombre_empleado, e.apellido as apellido_empleado from caja_detalle as cd, empleados as e where cd.empleado=e.dni and cd.codigo=$comprobante");
        return $r->row_array();
    }
    
 }