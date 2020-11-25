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
                echo form_open('Administrador/agregar_cobro', $atributes);?>    
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='box box-default'>
                                <div class='box-body' style='background-color: #00c0ef;'>

                                    <div class='col-xs-4 col-md-4'>
                                        <label class='control-label'>VALOR DEL TURNO</label>
                                        <label class='control-label' style='font-size: 55px;'>$ <?php echo $valor_turno;?></label>
                                        
                                        <a class="form-control btn btn-warning" href="#sharp" onclick="actualizar_importe()">
                                            <i class="fa fa-check"></i> ACTUALIZAR IMPORTE
                                        </a>
                                        
                                    </div>
                                    <div class='col-xs-4 col-md-4'>
                                        <label class='control-label'>ABONADO</label>
                                        
                                        <label class='control-label' style='font-size: 55px;'>$ <?php echo $abonado;?></label>
                                        
                                    </div>


                                    <div class='col-xs-4 col-md-4'>
                                        
                                        <?php 
                                        
                                            if($turno["cobrado"]=='si'){
                                                echo "<label class='control-label' style='font-size: 40px; color: #FFFFFF;'>TURNO ABONADO</label>";

                                            }else{
                                                echo "<label class='control-label' style='font-size: 40px; color: #B80000;'>TURNO SIN ABONAR</label>";
                                            }
                                        
                                        ?>
                                        
                                        
                                        
                                        
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
                                <h3 class='box-title'>REGISTRAR PAGOS: </h3>
                                
                            </div>
                            <div class='box-body' id="reporte">
                                <div class='col-xs-12 col-md-2'>
                                    <label class='control-label'>FECHA</label>
                                    <input type='text' class='form-control select-fecha' name='fecha_cobro' value='<?php echo $fecha;?>' id='fecha_cobro' >
                                </div>
                                <div class='col-xs-12 col-md-2'>
                                    <label class='control-label'>TIPO COBRO</label>
                                    <select class='form-control' name="select_tipo_cobra" id="select_tipo_cobra">
                                        <?php 
                                            foreach ($tipo_cobros as $t) {
                                                echo "<option value='".$t["id"]."'>".$t["descripcion"]."</option>";
                                            }
                                        ?>
                                        
                                    </select>
                                </div>
                                <div class='col-xs-12 col-md-2'>
                                    <label class='control-label'>OBRA SOCIAL</label>
                                    <select class='form-control' name="select_obra_social" id="select_obra_social">
                                        <?php 
                                            foreach ($obra_sociales as $s) {
                                                echo "<option value='".$s["codigo"]."'>".$s["razon_social"]."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class='col-xs-12 col-md-2'>
                                    <label class='control-label'>IMPORTE</label>
                                    <input type='text' class='form-control' name='importe' value='<?php echo $diferencia;?>' id='importe_agregar' >
                                </div>
                                <div class='col-xs-12 col-md-4'>
                                    <!--<input type='submit' class='form-control btn btn-primary 'value=''/>-->
                                    
                                    <a class="form-control btn btn-success" href="#sharp" onclick="registrar_pago()">
                                        <i class="fa fa-check"></i> AGREGAR PAGO
                                    </a>
                                    
                                </div>
                                
                            </div>
                        </div>
                  </div>
               </div>
               
                </section>
                
                <?php if(!empty($listado_cobros)){?>
                    <div class='row'>
                                    <div class='col-lg-12' style='background-color: #5DCC00;'>
                                        <table class='table table-bordered table-hover dataTable'>
                                            <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Tipo Cobro</th>
                                                    <th>Importe</th>
                                                    <th>Obra Social</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>   
                                            <tbody style='font-weight: bold;'>
                                                <?php 
                                                foreach ($listado_cobros as $l) {
                                                    
                                            echo "<td>".$l["fecha"]."</td>
                                                    <td>".$l["descripcion_cobro"]."</td>
                                                    <td>".$l["importe"]."</td>
                                                    <td>".$l["obra_social"]."</td>
                                                    
                                                    <td>";
                                                    
                                                    
                                                       echo "<a class='btn btn-danger' href='#sharp' id='' onclick='eliminar_pago(".$l["id"].")' title='eliminar cobro' data-original-title='eliminar cobro'>
                                                            <i class='fa fa-minus-square'></i> eliminar
                                                        </a>";
                                                    
                                                    
                                                    
                                                    echo "</td>
                                                    
                                                    <tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                <?php }?>
                
                
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
        <div class="modal modal-warning" id="modal-actualizar-precio">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Ingrese el nuevo valor del turno</h4>
              </div>
                
              <div class="modal-body">
                  <input type="number" class="form-control"  id="valor_actualizar" value="<?php echo $valor_turno;?>"/>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal" onClick="$('#modal-actualizar-precio').modal('hide')">Cerrar</button>
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal" onClick="confirmar_actualizar()">Confirmar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
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
        var turno=<?php echo $turno["codigo"]; ?>;
        var caja='no';
        function registrar_pago(){
            
            var fecha=$( "#fecha_cobro" ).val();
            var tipo=$( "#select_tipo_cobra" ).val();
            var obra=$( "#select_obra_social" ).val();
            var importe=$( "#importe_agregar" ).val();
            
            console.log(fecha);
            console.log(tipo);
            console.log(obra);
            console.log(importe);
            
            var r = confirm("El cobro actual afecta la caja??!");
            
            if (r == true) {
                caja='si';
            }
            
            $.ajax
            ({
                type:'POST',
                url: "<?php echo base_url();?>index.php/Administrador/registrar_pago_turno",
                data:{turno:turno,fecha:fecha,tipo:tipo,obra:obra,importe:importe,caja:caja},

                beforeSend: function(event){},

                success: function(data)
                {
                    
                    location.href="<?php echo base_url()?>index.php/Administrador/cobrar_turnos/"+turno;

                },
                error: function(event){
                    alert("ERROR");
                    location.href="<?php echo base_url()?>index.php/Administrador/cobrar_turnos/"+turno;
                }
            });
            
            
        }
        
        function actualizar_importe(){
            $('#modal-actualizar-precio').modal('show');
        }
        
        function confirmar_actualizar(){
            
            var precio=$('#valor_actualizar').val();
            
            var r = confirm("Actualizar precio de turno??!");
            if (r == true) {
                $.ajax
                ({
                    type:'POST',
                    url: "<?php echo base_url();?>index.php/Administrador/actualizar_precio_turno",
                    data:{id:turno,precio:precio},

                    beforeSend: function(event){},

                    success: function(data)
                    {

                        location.href="<?php echo base_url()?>index.php/Administrador/cobrar_turnos/"+turno;

                    },
                    error: function(event){
                        alert("ERROR");
                    }
                });
            }
        }
        
        function eliminar_pago(id){
            var r = confirm("Eliminar pago??!");
            if (r == true) {
                $.ajax
                ({
                    type:'POST',
                    url: "<?php echo base_url();?>index.php/Administrador/eliminar_pago_turno",
                    data:{id:id},

                    beforeSend: function(event){},

                    success: function(data)
                    {

                        location.href="<?php echo base_url()?>index.php/Administrador/cobrar_turnos/"+turno;

                    },
                    error: function(event){
                        alert("ERROR");
                    }
                });
            }
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
                 timepicker:true,

                 format:'Y-m-d H:i'
            });
        });
    </script>
</html>
