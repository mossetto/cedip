
        
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Empleados</h3>
                </div>
                
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>DNI</th>
                        <th>USUARIO</th>
                        <th>Controles</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($usuarios as $value)
                      {
                        echo "
                        <tr>
                            <td>".$value["dni"]."</td>
                            <td>".$value["usuario"]."</td>
                            <td>
                                <a href='".base_url()."index.php/Administrador/administrar_modulos_de_usuario/".$value["dni"]."' class='btn btn-warning' data-toggle='tooltip' title='' data-original-title='Modulos' onClick='adm_modulos_usuario(".$value["dni"].")'><i class='fa fa-cubes'></i></a>
                            </td>
                        </tr>";
                      }?>
                    </tbody>
                  </table>
                
            </div>
           
        </div>
    </section>
    <!-- /.content -->
  </div>