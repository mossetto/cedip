    
        
        <div class="col-md-12">
            <div class="text-danger" style="font-weight: bold;">
              <?php
              if(!$respuesta["respuesta"])
              { 
                echo $respuesta["mensaje"];
              }
              ?>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                  <a href="<?php echo base_url()?>index.php/administrador/configuracion_avanzada_horarios" class="btn btn-primary pull-right"><i class='fa fa-gears'></i> Configuracion Avanzada</a>
                    <h3 class="box-title">Asignacion de Horarios</h3>
                </div>
                <form class="form-horizontal" action="<?php echo base_url()?>index.php/administrador/asignacion_horarios" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">HORA DESDE</label>
                      <div class="col-sm-10">
                          <select class="form-control" name="horario_desde">
                                <option value="1:00:00" <?php if($hora_desde=='1:00:00'){echo 'selected';} ?> >1:00:00</option>
                                <option value="2:00:00" <?php if($hora_desde=='2:00:00'){echo 'selected';} ?> >2:00:00</option>
                                <option value="3:00:00" <?php if($hora_desde=='3:00:00'){echo 'selected';} ?> >3:00:00</option>
                                <option value="4:00:00" <?php if($hora_desde=='4:00:00'){echo 'selected';} ?> >4:00:00</option>
                                <option value="5:00:00" <?php if($hora_desde=='5:00:00'){echo 'selected';} ?> >5:00:00</option>
                                <option value="6:00:00" <?php if($hora_desde=='6:00:00'){echo 'selected';} ?> >6:00:00</option>
                                <option value="7:00:00" <?php if($hora_desde=='7:00:00'){echo 'selected';} ?> >7:00:00</option>
                                <option value="8:00:00" <?php if($hora_desde=='8:00:00'){echo 'selected';} ?> >8:00:00</option>
                                <option value="9:00:00" <?php if($hora_desde=='9:00:00'){echo 'selected';} ?> >9:00:00</option>
                                <option value="10:00:00" <?php if($hora_desde=='10:00:00'){echo 'selected';} ?> >10:00:00</option>
                                <option value="11:00:00" <?php if($hora_desde=='11:00:00'){echo 'selected';} ?> >11:00:00</option>
                                <option value="12:00:00" <?php if($hora_desde=='12:00:00'){echo 'selected';} ?> >12:00:00</option>
                                <option value="14:00:00" <?php if($hora_desde=='14:00:00'){echo 'selected';} ?> >14:00:00</option>
                                <option value="15:00:00" <?php if($hora_desde=='15:00:00'){echo 'selected';} ?> >15:00:00</option>
                                <option value="18:00:00" <?php if($hora_desde=='18:00:00'){echo 'selected';} ?> >18:00:00</option>
                                <option value="20:00:00" <?php if($hora_desde=='20:00:00'){echo 'selected';} ?> >20:00:00</option>
                                <option value="21:00:00" <?php if($hora_desde=='21:00:00'){echo 'selected';} ?> >21:00:00</option>
                                <option value="22:00:00" <?php if($hora_desde=='22:00:00'){echo 'selected';} ?> >22:00:00</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">HORA HASTA</label>
                      <div class="col-sm-10">
                          <select class="form-control" name="horario_hasta">
                                <option value="1:00:00" <?php if($hora_hasta=='1:00:00'){echo 'selected';} ?> >1:00:00</option>
                                <option value="2:00:00" <?php if($hora_hasta=='2:00:00'){echo 'selected';} ?> >2:00:00</option>
                                <option value="3:00:00" <?php if($hora_hasta=='3:00:00'){echo 'selected';} ?> >3:00:00</option>
                                <option value="4:00:00" <?php if($hora_hasta=='4:00:00'){echo 'selected';} ?> >4:00:00</option>
                                <option value="5:00:00" <?php if($hora_hasta=='5:00:00'){echo 'selected';} ?> >5:00:00</option>
                                <option value="6:00:00" <?php if($hora_hasta=='6:00:00'){echo 'selected';} ?> >6:00:00</option>
                                <option value="7:00:00" <?php if($hora_hasta=='7:00:00'){echo 'selected';} ?> >7:00:00</option>
                                <option value="8:00:00" <?php if($hora_hasta=='8:00:00'){echo 'selected';} ?> >8:00:00</option>
                                <option value="9:00:00" <?php if($hora_hasta=='9:00:00'){echo 'selected';} ?> >9:00:00</option>
                                <option value="10:00:00" <?php if($hora_hasta=='10:00:00'){echo 'selected';} ?> >10:00:00</option>
                                <option value="11:00:00" <?php if($hora_hasta=='11:00:00'){echo 'selected';} ?> >11:00:00</option>
                                <option value="12:00:00" <?php if($hora_hasta=='12:00:00'){echo 'selected';} ?> >12:00:00</option>
                                <option value="14:00:00" <?php if($hora_hasta=='14:00:00'){echo 'selected';} ?> >14:00:00</option>
                                <option value="15:00:00" <?php if($hora_hasta=='15:00:00'){echo 'selected';} ?> >15:00:00</option>
                                <option value="18:00:00" <?php if($hora_hasta=='18:00:00'){echo 'selected';} ?> >18:00:00</option>
                                <option value="20:00:00" <?php if($hora_hasta=='20:00:00'){echo 'selected';} ?> >20:00:00</option>
                                <option value="21:00:00" <?php if($hora_hasta=='21:00:00'){echo 'selected';} ?> >21:00:00</option>
                                <option value="22:00:00" <?php if($hora_hasta=='22:00:00'){echo 'selected';} ?> >22:00:00</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">TIEMPO TURNO</label>
                      <div class="col-sm-10">
                          <select class="form-control" name="tiempo_turno">
                            <option value="3:00:00" <?php if($tiempo_turno=='3:00:00'){echo 'selected';} ?> >3:00:00</option>
                                <option value="2:30:00" <?php if($tiempo_turno=='2:30:00'){echo 'selected';} ?> >2:30:00</option>
                                <option value="2:00:00" <?php if($tiempo_turno=='2:00:00'){echo 'selected';} ?> >2:00:00</option>
                                <option value="1:30:00" <?php if($tiempo_turno=='1:30:00'){echo 'selected';} ?> >1:30:00</option>
                                <option value="1:00:00" <?php if($tiempo_turno=='1:00:00'){echo 'selected';} ?> >1:00:00</option>
                                <option value="0:45:00" <?php if($tiempo_turno=='0:45:00'){echo 'selected';} ?> >0:45:00</option>
                                <option value="0:30:00" <?php if($tiempo_turno=='0:30:00'){echo 'selected';} ?> >0:30:00</option>
                                <option value="0:15:00" <?php if($tiempo_turno=='0:15:00'){echo 'selected';} ?> >0:15:00</option>
                                <option value="0:10:00" <?php if($tiempo_turno=='0:10:00'){echo 'selected';} ?> >0:10:00</option>
                                <option value="0:05:00" <?php if($tiempo_turno=='0:05:00'){echo 'selected';} ?> >0:05:00</option>
                        </select>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                      <label class="col-sm-8 control-label">Ultima actualizacion: ----- <?php echo $fecha." ".$usuario ?></label>
<!--                    <button type="submit" class="btn btn-default">Cancel</button>-->
                    <button type="submit" class="btn btn-info pull-right">Actualizar</button>
                  </div><!-- /.box-footer -->
                </form>
            </div>
           
        </div>
    </section>
    <!-- /.content -->
  </div>