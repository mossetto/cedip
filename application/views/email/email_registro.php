<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">
 
 <head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Cedip Centro Médico - Registro</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<style>
    @media only screen and (max-width: 414px) {
  tr {font-size: 23px;}	
  .table-resp {width: 375px;}	
    }
</style>
 

<body style="margin: 0; padding: 0;">
 
    <table cellpadding="0" cellspacing="0" width="100%" >
        <tr>
             <td>


                <table class="table-resp" align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
                    <tr>
                        <td style="
                        background-color: #107cbd;
                        padding: 12px 50px;">
                            <img width="80" src="<?= base_url().'/recursos/img/logo-blanco.png'; ?>" alt="">
                            <p style="color: white;">Centro Médico</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="
                        background-color: rgb(252, 252, 252);
                        padding: 20px 50px;
                        color: rgb(85, 85, 85)">
                            <h3>Te has registrado correctamente</h3>
                            <p >Bienvenido al portal de Cedip, ahora podés acceder al portal online para ver tus últimos estudios y descargar informes e imágenes de los mismos.</p>
                            <p>Estos son tus datos de acceso:</p>
                            <span style="font-weight: bold;">DNI: </span><span > <?php echo $dni; ?></span> <br>
                            <span style="font-weight: bold;">Contraseña: </span><span><?php echo $password; ?></span> <br><br>
                            <button style="
                            font-size: 16px;
                            background-color: rgb(255, 176, 29);
                            border-style: none;
                            padding: 10px 20px;
                            border-radius: 5px;
                            cursor: pointer;"><a href="http://cedipcentromedico.com/" style="text-decoration: none; color: black;">Acceso al portal</a></button>
                        </td>
                    </tr>

                    <tr>
                        <td style="
                        background-color: #107cbd;
                        padding: 20px 50px;
                        font-size: 13px;">
                           <p style="color: white;">WhatsApp 3574 40-6322 - Fijo (03574) 480133 </p>
                           <p style="color: white;">Rivadavia 949, Villa Santa Rosa - Córdoba Argentina</p>
                           <p style="color: white;">info@cedipcentromedico.com</p>
                        </td>
                    </tr>

                    
                    
                </table>


             </td>
        </tr>
    </table>

<!-- 
    <table width="100%">
        <tr>
            <td>
                <table width="600" align="center" border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                    <tr>
                        <td>

                            <table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                                <tr>
                                    <td width="50%" valign="top" style="padding:15px">
                                        Bloque 1
                                    </td>
                                    <td width="50%" valign="top" style="padding:15px">
                                        Bloque 2
                                    </td>
                                </tr>
                            </table>

                            <table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                                <tr>
                                    <td width="50%" valign="top" style="padding:40px 15px">
                                        Bloque 3
                                    </td>
                                    <td width="50%" valign="top" style="padding:40px 15px">
                                        Bloque 4
                                    </td>
                                </tr>
                            </table>

                            <table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                                <tr>
                                    <td width="50%" valign="top" style="padding:15px">
                                        Bloque 5
                                    </td>
                                    <td width="50%" valign="top" style="padding:15px">
                                        Bloque 6
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table> -->
    
    
</body>



</html>