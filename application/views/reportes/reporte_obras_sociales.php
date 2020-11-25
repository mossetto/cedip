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
                echo form_open('Administrador/filtrar_reporte_agrupado', $atributes);?>    
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
                                <button class='btn btn-default pull-right' onClick='imprimir_liquidacion_obras_sociales()'><i class='fa fa-print'></i> Imprimir</button>
                            </div>
                            <div class='box-body' id="reporte">
                                <div class='row'>
                                    <div class='col-lg-4' style='background-color: #5DCC00;'>
                                        <?php
                                            $html_totales="";
                                            $total_total=0;
                                            foreach ($listado_total as $t) {
                                                $html_totales.= "
                                                    <tr>
                                                        <th>".$t["razon_social"]."</th>
                                                        <th>".$t["turnos"]."</th>
                                                        <th> $".number_format($t["importe"], 2, ',', '.')."</th>

                                                    </tr>";
                                                $total_total=$total_total+$t["importe"];
                                            }
                                            $total_total=number_format($total_total, 2, ',', '.');
                                            
                                            $html_cobrados="";
                                            $total_cobrados=0;
                                            foreach ($listado_cobrado as $c) {
                                                $html_cobrados.= "
                                                    <tr>
                                                        <th>".$c["razon_social"]."</th>
                                                        <th>".$c["turnos"]."</th>
                                                        <th> $".number_format($c["importe"], 2, ',', '.')."</th>

                                                    </tr>";
                                                $total_cobrados=$total_cobrados+$c["importe"];
                                            }
                                            $total_cobrados=number_format($total_cobrados, 2, ',', '.');
                                            
                                            $html_nc="";
                                            $total_nc=0;
                                            foreach ($listado_no_cobrado as $nc) {
                                                $html_nc.= "
                                                    <tr>
                                                        <th>".$nc["razon_social"]."</th>
                                                        <th>".$nc["turnos"]."</th>
                                                        <th> $".number_format($nc["importe"], 2, ',', '.')."</th>

                                                    </tr>";
                                                $total_nc=$total_nc+$nc["importe"];
                                            }
                                            $total_nc=number_format($total_nc, 2, ',', '.');
     
                                        ?>
                                        <h4>Totales: $ <?php echo $total_total;?></h4> 
                                        <table class='table table-bordered table-hover dataTable'>
                                            <thead>
                                                <tr>
                                                    <th>Razon Social</th>
                                                    <th>Turnos</th>
                                                    <th>Importe</th>

                                                </tr>
                                            </thead>   
                                            <tbody style='font-weight: bold;'>
                                                <?php echo $html_totales;?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class='col-lg-4' style='background-color: #23B0ED;'>
                                        <h4>Cobrados: $ <?php echo $total_cobrados;?></h4> 
                                        <table class='table table-bordered table-hover dataTable'>
                                            <thead>
                                                <tr>
                                                    <th>Razon Social</th>
                                                    <th>Turnos</th>
                                                    <th>Importe</th>

                                                </tr>
                                            </thead>   
                                            <tbody style='font-weight: bold;'>
                                                <?php echo $html_cobrados;?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class='col-lg-4' style='background-color: #FFDE4C;'>
                                        <h4>No cobrados: $ <?php echo $total_nc;?></h4> 
                                        <table class='table table-bordered table-hover dataTable'>
                                            <thead>
                                                <tr>
                                                    <th>Razon Social</th>
                                                    <th>Turnos</th>
                                                    <th>Importe</th>

                                                </tr>
                                            </thead>   
                                            <tbody style='font-weight: bold;'>
                                                <?php echo $html_nc;?>
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
    </script>
</html>
