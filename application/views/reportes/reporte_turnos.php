<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>  Centro Medico  </title>
        
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
       
        <link rel="stylesheet" href="<?php echo base_url(); ?>recursos/bootstrap/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>recursos/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>recursos/dist/css/skins/skin-green-light.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>recursos/css/chosen.min.css">
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>recursos/img/pagina/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>recursos/css/jquery.datetimepicker.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>recursos/css/bootstrap-table.css"/>
        
    </head>
    <body class="hold-transition skin-green-light sidebar-mini">
        <div class="wrapper">
            <?php echo $cabecera;?>
            <aside class="main-sidebar">
                <?php echo $menu;?>
            </aside>
            <div class="content-wrapper">
                <section class="content-header">
                  <h1>
                    <?php echo $seccion;?>
                  </h1>
                </section>

                <section class="content">
                <?php $atributes="id='filtro'";
                echo form_open('Administrador/filtrar_reporte_turnos', $atributes);?>    
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='box box-default'>
                                <div class='box-body' style='background-color: #00c0ef;'>

                                    <div class='col-xs-4 col-md-4'>
                                        <label class='control-label'>Fecha desde</label>
                                        <input type='text' class='form-control select-fecha' name='fecha_desde' value='<?php echo $desde; ?>' id='fecha_desde_liquidacion_obrassociales' >
                                    </div>
                                    <div class='col-xs-4 col-md-4'>
                                        <label class='control-label'>Fecha hasta</label>
                                        <input type='text' class='form-control select-fecha' name='fecha_hasta' value='<?php echo $hasta; ?>' id='fecha_hasta_liquidacion_obrassociales' >
                                    </div>


                                    <div class='col-xs-4 col-md-4'>
                                        <label> </label>
                                        <input type='submit' class='form-control btn btn-info 'value='Listar'/>
                                        
                                    </div>
                                </div>  
                            </div>
                        </div>
                   </div>
                <?php echo form_close();?>    
               <div class='row'>
                  <div class='col-md-12'>
                        <div class='box box-default'>
                            <div class='box-header'>
                                <h3 class='box-title'>Resultado: </h3>
                                
                            </div>
                            <div class='box-body' id="reporte">
                                <div class='row'>
                                    <div class='col-lg-12' style='background-color: #5DCC00;'>
                                        <table class='table table-bordered table-hover dataTable'>
                                            <thead>
                                                <tr>
                                                    <th>Turno</th>
                                                    <th>Dni</th>
                                                    <th>Fecha</th>
                                                    <th>Hora desde</th>
                                                    <th>Hora hasta</th>
                                                    <th>Importe</th>
                                                    <th>Cobrado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>   
                                            <tbody style='font-weight: bold;'>
                                                <?php 
                                                foreach ($listado as $l) {
                                                    
                                                    if($l["cobrado"]=='no'){
                                                       echo "<tr style='background-color: #D82042;' id='turno_".$l["turno"]."'>"; 
                                                    }else{
                                                       echo "<tr id='turno_".$l["turno"]."'>"; 
                                                    }
                                                    
                                                    echo "<td>".$l["turno"]."</td>
                                                    <td>".$l["dni"]."</td>
                                                    <td>".$l["fecha"]."</td>
                                                    <td>".$l["h_desde"]."</td>
                                                    <td>".$l["h_hasta"]."</td>
                                                    <td>".$l["importe"]."</td>
                                                    <td>".$l["cobrado"]."</td>
                                                    <td>";
                                                    
                                                    
                                                    
                                                    if($l["cobrado"]=='no'){
                                                       echo "<a class='btn btn-success' href='". base_url()."index.php/Administrador/cobrar_turnos/".$l["turno"]."' target='_blank' title='cobrar' data-original-title='cobrar'>
                                                            <i class='fa fa-dollar'></i> cobrar turno
                                                        </a>";
                                                    }else{
                                                        echo "<a class='btn btn-success' href='". base_url()."index.php/Administrador/cobrar_turnos/".$l["turno"]."' target='_blank' title='cobrar' data-original-title='cobrar'>
                                                            <i class='fa fa-dollar'></i> ver cobro
                                                        </a>";
//                                                       echo "<a class='btn btn-danger' href='#sharp' id='' onclick='asignar_usuario(1, 2)' title='eliminar cobro' data-original-title='eliminar cobro'>
//                                                            <i class='fa fa-minus-square'></i> eliminar cobro
//                                                        </a>";
                                                    }
                                                    echo "<a class='btn btn-danger' href='#sharp' id='' onclick='eliminar_turno(".$l["turno"].")' title='eliminar' data-original-title='eliminar'>
                                                            <i class='fa fa-minus-square'></i> eliminar turno
                                                        </a>";
                                                    
                                                    echo "</td>
                                                    
                                                    <tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                  </div>
               </div>
               
                </section>
            </div>
            <footer class="main-footer">
              <div class="pull-right hidden-xs">
                Version 1.0.0 
              </div>
              <strong>desarrollo <a href="http://www.alessoweb.com">alessoweb.com</a></strong>.
            </footer>
            <aside class="control-sidebar control-sidebar-dark">
              <?php // echo $config ?>
            </aside>
        </div>
    </body>
    <script src="<?php echo base_url(); ?>recursos/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>recursos/js/imagezoom.js"></script>
    <script src="<?php echo base_url(); ?>recursos/js/zelect.js"></script>
    <script src="<?php echo base_url(); ?>recursos/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>recursos/dist/js/app.min.js"></script>
    <script src="<?php echo base_url(); ?>recursos/dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>recursos/dashboard/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>recursos/js/bootstrap-table.js"></script>
    <script src="<?php echo base_url(); ?>recursos/js/chosen.jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>recursos/js/jquery.datetimepicker.js"></script>
    <script src="<?php echo base_url(); ?>recursos/dashboard/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>recursos/dashboard/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <script src="<?php echo base_url(); ?>recursos/js/jquery.datetimepicker.js"></script>
    <script>
        function imprimir_liquidacion_obras_sociales(){
            var contenido= document.getElementById('reporte').innerHTML;
            var contenidoOriginal= document.body.innerHTML;

            document.body.innerHTML = contenido;

            window.print();

            document.body.innerHTML = contenidoOriginal;
        }
        
        $(document).ready(function(){

            jQuery('.select-fecha').datetimepicker({
                lang:'es',
                 i18n:{
                  de:{
                   months:[
                    'Enero','Febrero','Märzo','Abril',
                    'Mayo','Junio','Julio','Agosto',
                    'Septiembre','Octubre','Noviembre','Diciembre',
                   ],
                   dayOfWeek:[
                    "So.", "Mo", "Di", "Mi", 
                    "Do", "Fr", "Sa.",
                   ]
                  }
                 },
                 timepicker:false,

                 format:'Y-m-d'
            });
        });
        
        function eliminar_turno(id){
            var r = confirm("Eliminar turno??!. Se van a eliminar tambien los pagos asociados a ese turno. Esta accion no se puede deshacer.");
            if (r == true) {
                $.ajax
                ({
                    type:'POST',
                    url: "<?php echo base_url();?>index.php/Administrador/eliminar_turno",
                    data:{id:id},

                    beforeSend: function(event){},

                    success: function(data)
                    {
                        alert("Turno eliminado!");
                        var fila="#turno_"+id;
                        $(fila).remove();
//                        location.href="<?php echo base_url()?>index.php/Administrador/reporte_turnos";

                    },
                    error: function(event){
                        alert("ERROR");
                    }
                });
            }
        }
        
    </script>
</html>
