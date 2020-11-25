
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <a href="<?php echo base_url()?>index.php/administrador/modulos" class="btn btn-warning pull-right" ><i class='fa fa-arrow-left'></i> Volver al listado</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tabla_modulos_usuario" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Modulo</th>
                        <th>Activo</th>
                      </tr>
                    </thead>
                    <tbody id="cuerpo_tabla_modulos_usuario">
                        <?php 
                            foreach($modulos_existentes as $value)
                            {
                                echo 
                                "<tr>
                                    <td>".$value["id_modulo"]."</td>
                                    <td>".$value["desc_modulo"]."</td>
                                    <td>
                                        <button class='btn btn-success' id='boton_modulo_".$value["id_modulo"]."' onClick='activar_desactivar_modulo(".$value["id_modulo"].",".$id_usuario.")'>Activo</button>
                                    </td>
                                </tr>";
                            }
                            
                            foreach($modulos_faltantes as $value)
                            {
                                echo 
                                "<tr>
                                    <td>".$value["id"]."</td>
                                    <td>".$value["modulo"]."</td>
                                    <td>
                                        <button class='btn btn-danger' id='boton_modulo_".$value["id"]."' onClick='activar_desactivar_modulo(".$value["id"].",".$id_usuario.")'>No Activo</button>
                                    </td>
                                </tr>";
                            }
                        ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
         </div>
    </section>
    </div>
    <!-- /.content -->
    <script>
   function activar_desactivar_modulo(id_modulo,id_usuario)
   {
       var texto_activo="Activo";
       var texto_no_activo="No Activo";
       
       var texto_actual= $("#boton_modulo_"+id_modulo).text();
       
       if(texto_actual == texto_activo) // DESACTIVAR EL MODULO
       {
           $.ajax({
                url: "<?php echo base_url()?>index.php/Administrador/desactivar_modulo_usuario",
                type: "POST",
                data:{id_modulo:id_modulo,id_usuario:id_usuario},
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data)
                    {
                        $("#boton_modulo_"+id_modulo).removeClass("btn-success");
                        $("#boton_modulo_"+id_modulo).addClass("btn-danger");
                        $("#boton_modulo_"+id_modulo).text(texto_no_activo);
                    }
                },
                error: function(event){alert(event.responseText);},
            });    
           
       }
       else if(texto_actual == texto_no_activo) // ACTIVAR EL MODULO
       {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Administrador/activar_modulo_usuario",
                type: "POST",
                data:{id_modulo:id_modulo,id_usuario:id_usuario},
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data)
                    {
                       $("#boton_modulo_"+id_modulo).removeClass("btn-danger");
                       $("#boton_modulo_"+id_modulo).addClass("btn-success");
                       $("#boton_modulo_"+id_modulo).text(texto_activo);
                    }
                },
                error: function(event){alert(event.responseText);},
            });    
           
       }
      
   }
      $(function () {
        
        $('#tabla_modulos_usuario').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });
    </script>
  </div>

