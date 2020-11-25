<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author adrians
 */
class Usuario {
    //atributos del sistema, para verificar e instaciar variables
    private $existe;
    protected $ci;
    //atributos de la tabla empleados
    private $dni;
    private $correo;
    private $usuario;
    private $pass;
    private $nombre;
    private $apellido;
    private $telefono;
    private $movil;
    private $tipo_usuario;
    private $direccion;
    private $cod_sucursal;
    private $cod_localidad;
    private $imagen;
    private $inicio;
    private $operativo;
   

    

    public function __construct() {
        $this->ci =&get_instance();
        $this->ci->load->helper("html");
        $this->ci->load->library("email");
        $this->ci->load->model("Usuario_model");
    }
    
    public function verificar_usuario($dato_usuario, $pass) {
        $usuario=$this->ci->Usuario_model->get_usuario($dato_usuario, $pass);
        if($usuario->getExiste()){
            $this->cargar_usuario_session($usuario);
        }
        return $usuario;
    }
    //cargar usuario session si existe en la base de datos
    public function cargar_usuario_session($usuario) {
        $nuevosdatos = array(
            'email'     => $usuario->getCorreo(),
            'nombre'     => $usuario->getNombre(),
            'apellido'     => $usuario->getApellido(),
            'telefono'=>$usuario->getTelefono(),
            'movil'=>$usuario->getMovil(),
            'dni'     => $usuario->getDni(),
            'usuario'     => $usuario->getUsuario(),
            'tipo_usuario'     => $usuario->getTipo_usuario(),
            'sucursal'     => $usuario->getCod_sucursal(),
            'imagen'     => $usuario->getImagen(),
            'inicio'     => $usuario->getInicio(),
            'operativo'     => $usuario->getOperativo(),
            'ingresado' => TRUE
        );
        $this->ci->session->set_userdata($nuevosdatos);
	
    }
    
    public function verificar_acceso(){
        $validacion=false;
        if($session_id = $this->ci->session->userdata('ingresado')){
                $validacion=true;
        }
        return $validacion;
    }
    
    public function verificar_operatividad(){
        $validacion=false;
        if($this->ci->session->userdata('operativo')=="si"){
                $validacion=true;
        }
        return $validacion;
    }
    
    
    public function recuperar_datos($correo){
        $mensaje="";
        $existe_usuario= $this->ci->Usuario_model->existe_usuario($correo);
            if($existe_usuario){
                //$pass=$this->ci->Usuario_model->obtener_pass($correo);
                //$this->procesar_correo("admin@susitio.com", $correo, "Recuperacion de datos de acceso", $this->recuperacion_datos_usuario($correo, $pass));
                $mensaje= "Enviamos sus datos. Verifique su casilla de correo y de spam.";
            }else{
                $mensaje= "No existe el usuario con ese correo. Contacte al administrador.";
            }
        return $mensaje;
    }
    
    private function procesar_correo($from, $to, $subject, $mensaje){
		$envio;
                $configCorreo = array(

			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		); 
		$this->ci->email->initialize($configCorreo);
		$this->ci->email->from($from);
		$this->ci->email->to($to);
		$this->ci->email->subject($subject);
		$this->ci->email->message($mensaje);
		$envio=$this->ci->email->send();
		return $envio;
    }
    
    private function recuperacion_datos_usuario($usuario, $pass){
        $mensaje = "
        <table border='0'
                        cellspacing='0'
                        cellpadding='30'
                        style='width:100%;
                        font-family:Helvetica Neue, Helvetica, Arial, sans-serif;
                        text-align:center;
                        background:#1C468C' width='100%' align='center'>
                <tbody>
                        <tr>
                                <td align='center'
                                        style='width:100%;
                                        font-family:Helvetica Neue, Helvetica, Arial, sans-serif;
                                        text-align:center; background:#BDBDBD' width='100%'>
                                        <table border='0' cellspacing='0' cellpadding='0' width='590'>
                                                <tbody>
                                                        <tr>

                                                                <td valign='bottom' style='text-align:right' align='right'>
                                                                        <h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif;
                                                                                                margin:0; padding:0;
                                                                                                font-size:15px;
                                                                                                font-weight:400; color:#FFFFFF'>Control de acceso</h3>
                                                                </td>
                                                        </tr>
                                                </tbody>
                                        </table>
                                </td>
                        </tr>
                        <tr>
                                <td align='center' style='width:100%;
                                                                        font-family:Helvetica Neue, Helvetica, Arial, sans-serif;
                                                                        text-align:center; background:#EEEEEE'><br><br><br>
                                        <h1 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:32px; line-height:40px; color:#000000; text-align:center' align='center'>Datos de Acceso </h1>
                                        <h3 style='font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-weight:300; margin:0; padding:0; font-size:20px; line-height:40px; color:#000000; text-align:center' align='center'>
                                                Usuario: ".$usuario."<br>
                                                Pass: ".$pass."<br>

                                                <br>
                                        </h3>
                                        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                                <tbody>
                                                        <tr>
                                                                <td style='color:#1d1e21; text-align:center' align='center'>
                                                                        <table align='center' border='0' cellspacing='0' cellpadding='20'>
                                                                                <tbody>
                                                                                        <tr>
                                                                                                <td width='162' height='40' style='height:40px; font-size:0px; line-height:0px'>&nbsp;</td>
                                                                                        </tr>
                                                                                        <tr>

                                                                                        </tr>
                                                                                        <tr>
                                                                                                <td style='height:40px; font-size:0px; line-height:0px' height='40'>&nbsp;</td>
                                                                                        </tr>
                                                                                </tbody>
                                                                        </table>
                                                                </td>
                                                        </tr>
                                                </tbody>
                                        </table>
                                </td>
                        </tr>
                </tbody>
        </table>";
        return $mensaje;
    }
    
    function getExiste() {
        return $this->existe;
    }

    function getDni() {
        return $this->dni;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getPass() {
        return $this->pass;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getMovil() {
        return $this->movil;
    }

    function getTipo_usuario() {
        return $this->tipo_usuario;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCod_sucursal() {
        return $this->cod_sucursal;
    }

    function getCod_localidad() {
        return $this->cod_localidad;
    }

    function getImagen() {
        return $this->imagen;
    }

    function getInicio() {
        return $this->inicio;
    }

    function setExiste($existe) {
        $this->existe = $existe;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setMovil($movil) {
        $this->movil = $movil;
    }

    function setTipo_usuario($tipo_usuario) {
        $this->tipo_usuario = $tipo_usuario;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setCod_sucursal($cod_sucursal) {
        $this->cod_sucursal = $cod_sucursal;
    }

    function setCod_localidad($cod_localidad) {
        $this->cod_localidad = $cod_localidad;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function setInicio($inicio) {
        $this->inicio = $inicio;
    }
    function getOperativo() {
        return $this->operativo;
    }

    function setOperativo($operativo) {
        $this->operativo = $operativo;
    }
    
    function cerrar_sesion()
    {
        $nuevosdatos = array(
            'email'     => null,
            'nombre'     => null,
            'apellido'     => null,
            'dni'     => null,
            'usuario'     => null,
            'tipo_usuario'     => null,
            'sucursal'     => null,
            'imagen'     => null,
            'inicio'     => null,
            'operativo'     => null,
            'ingresado' => FALSE
        );
        $this->ci->session->set_userdata($nuevosdatos);
        $this->ci->session->sess_destroy();
    }
    
    public function actualizaSession()
    {
        $this->ci->session->set_userdata('dni', $this->getDni());
        $this->ci->session->set_userdata('usuario', $this->getUsuario());
        $this->ci->session->set_userdata('nombre', $this->getNombre());
        $this->ci->session->set_userdata('apellido', $this->getApellido());
        $this->ci->session->set_userdata('email', $this->getCorreo());
        $this->ci->session->set_userdata('tipo_usuario', $this->getTipo_usuario());
        $this->ci->session->set_userdata('operativo', $this->getOperativo());
        $this->ci->session->set_userdata('imagen', $this->getImagen());
        $this->ci->session->set_userdata('inicio',$this->getInicio());
        $this->ci->session->set_userdata('ingresado',TRUE);
    }
    public function actualizarDatos($dni,$usuario,$pass,$nombre,$apellido,$telefono,$movil,$direccion,$correo,$imagen)
    {
        $this->setDni($dni);
        $this->setUsuario($usuario);
        $this->setPass($pass);
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setApellido($telefono);
        $this->setMovil($movil);
        $this->setDireccion($direccion);
        $this->setCorreo($correo);
        $this->setImagen($imagen);
        $this->actualizaSession();
    }
}
