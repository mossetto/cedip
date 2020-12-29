<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario_model
 *
 * @author adrians
 */
class Usuario_model extends CI_Model{
    
    public function __construct() {
        parent::__construct ();
        $this->load->database();
        $this->load->library("Usuario");
    }
    
    public function get_usuario($usua, $pass) {
        
        $usuario= new Usuario();
        $usuario->setExiste(false);
        
        $query = $this->db->query("SELECT * FROM empleados WHERE usuario = '$usua' and pass = '$pass'");
        $valor_obtenido=$query->row_array();
        
        if ($valor_obtenido!=null) {
            $usuario->setExiste(true);
            $usuario->setDni($valor_obtenido["dni"]);
            $usuario->setCorreo($valor_obtenido["correo"]);
            $usuario->setUsuario($valor_obtenido["usuario"]);
            $usuario->setPass($valor_obtenido["pass"]);
            $usuario->setNombre($valor_obtenido["nombre"]);
            $usuario->setApellido($valor_obtenido["apellido"]);
            $usuario->setTelefono($valor_obtenido["telefono"]);
            $usuario->setMovil($valor_obtenido["movil"]);
            $usuario->setTipo_usuario($valor_obtenido["tipo_usuario"]);
            $usuario->setDireccion($valor_obtenido["direccion"]);
            $usuario->setCod_sucursal($valor_obtenido["cod_sucursal"]);
            $usuario->setCod_localidad($valor_obtenido["cod_localidad"]);
            $usuario->setImagen($valor_obtenido["imagen"]);
            $usuario->setInicio($valor_obtenido["inicio"]);
            $usuario->setOperativo($valor_obtenido["operativo"]);
        }
        return $usuario;
    }
    
    public function existe_usuario($correo) {
        $validacion=false;
        $query = $this->db->query("select correo from empleados where correo = '$correo' ");
        $valor_obtenido=$query->row_array();
        if ($valor_obtenido) {
            $validacion=true;
        }
        return $validacion;
    }
    
    function obtener_pass($correo, $pass) {
        $query = $this->db->query("SELECT * FROM empleados where correo = ".$correo."and pass=".$pass);
        return $query->row_array();
    }
    
    // Devuelve todos los datos del usuario, pero relacionados.
    function getDatosRelacionados($dni)
    {
        $query = $this->db->query("SELECT dni, correo, usuario, pass, nombre, apellido, telefono, movil,"
                                        . "tipo_usuario.tipo as tipo_usuario, empleados.direccion,"
                                        . "sucursales.descripcion as sucursal, localidades.descripcion as localidad,"
                                        . "empleados.imagen,empleados.inicio,empleados.operativo from empleados "
                                        . "INNER JOIN tipo_usuario on empleados.tipo_usuario = tipo_usuario.codigo "
                                        . "INNER JOIN sucursales on empleados.cod_sucursal = sucursales.numero "
                                        . "INNER JOIN localidades on empleados.cod_localidad = localidades.cod_localidad "
                                        . "where dni =".$dni);
        return $query->row_array();
    }
    
    // Cambia los datos del usuario, donde sus CF estan relacionadas
    function actualizaDatosUsuario($dni,$usuario,$pass,$nombre,$apellido,$telefono,$movil,$direccion,$correo,$imagen)
    {
        if($imagen =="")
        {
            $query = $this->db->query("SELECT imagen FROM empleados where dni = ".$dni);
            $query = $query->row_array();
            $imagen = $query["imagen"];
            
        }
        
        $data = array(
            'usuario' => $usuario,
            'pass' => $pass,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'telefono' => $telefono,
            'movil' => $movil,
            'direccion' => $direccion,
            'correo' => $correo,
            'imagen' =>$imagen
        );
        
        $this->db->where('dni', $dni);
        
        $respuesta =  $this->db->update('empleados', $data);
        
        //var_dump($respuesta);
        // Si no quiso cambiar la imagen
        if($imagen == ""){}
    }
    
    public function get_modulos_usuario($id)
    {
        $r = $this->db->query("SELECT modulos_usuarios.id_usuario,modulos_usuarios.id_usuario,modulos_usuarios.id_modulo,modulos.modulo as desc_modulo FROM modulos_usuarios INNER JOIN modulos on modulos.id = modulos_usuarios.id_modulo where modulos_usuarios.id_usuario = $id");
        return $r->result_array();
    }
    
    public function get_modulos_faltantes_usuario($id)
    {
        $r = $this->db->query("SELECT modulos.* from modulos where modulos.id not in (SELECT modulos_usuarios.id_modulo as id FROM modulos_usuarios INNER JOIN modulos on modulos.id = modulos_usuarios.id_modulo where modulos_usuarios.id_usuario = $id)");
        return $r->result_array();
    }
    
    public function activar_modulo_usuario($id_modulo,$id_usuario)
    {
       $lo_tiene = $this->db->query("SELECT * FROM modulos_usuarios where id_usuario = $id_usuario and id_modulo = $id_modulo");
       $lo_tiene= $lo_tiene->row_array();
       
       $respuesta = true;
       
       if(!$lo_tiene)
       {
           $datos = Array(
               "id_modulo"=>$id_modulo,
               "id_usuario"=>$id_usuario,
           );
           
           $respuesta = $this->db->insert("modulos_usuarios",$datos);  
       }
       return $respuesta;
    }
    
    public function desactivar_modulo_usuario($id_modulo,$id_usuario)
    {
       $this->db->where("id_modulo",$id_modulo);
       $this->db->where("id_usuario",$id_usuario);
       
       return $this->db->delete("modulos_usuarios");
    }
    
    public function get_permiso_modulo_usuario($id_modulo,$id_usuario)
    {
       $r = $this->db->query("SELECT * FROM modulos_usuarios where id_usuario = $id_usuario and id_modulo = $id_modulo ");
       return $r->row_array(); 
    }
    
    public function insertar_usuario_sistema($nombre)
    {
       
           $datos = Array(
               "descripcion"=>$nombre
               
           );
           
           $respuesta = $this->db->insert("usuarios_sistema_empleados",$datos);  
       
       return $respuesta;
    }
}
