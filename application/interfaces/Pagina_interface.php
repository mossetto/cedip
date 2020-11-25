<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author mario
 */
interface Pagina_interface 
{
    //put your code here
    public function generar_estilos($css);
    public function generar_pagina_loguin();
    public function obtener_titulo();
    public function obtener_estilos();
    
    public function menu_administrador($imagen, $dni, $nombre, $apellido);
    public function menu_secretaria($imagen, $dni, $nombre, $apellido);
    public function menu_profesional($imagen, $dni, $nombre, $apellido);
    public function cabecera_administrador($imagen, $dni, $nombre, $apellido);
    public function cabecera_secretaria($imagen, $dni, $nombre, $apellido);
    public function cabecera_profesional($imagen, $dni, $nombre, $apellido);
    public function render_ver_perfil();
    public function get_cabecera($logo, $dni, $nombre, $apellido);
    public function get_menu($imagen, $dni, $nombre, $apellido);
    public function generar_escritorio_secretaria($especialidades);
    public function generar_render_datos_personales($dni,$correo,$usuario,$pass,$nombre,$apellido,$telefono,$movil,$tipo_usuario,$direccion,$sucursal,$localidad,$imagen,$inicio,$operativo);
    
    
    
}
