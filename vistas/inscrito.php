<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['almacen']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Inscrito <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> <a href="../reportes/rptproveedores.php" target="_blank"><button class="btn btn-info"><i class="fa fa-clipboard"></i> Reporte</button></a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Área de interés</th>
                            <th>Grado de Estudios</th>
                            <th>Nivel de Inglés</th>
                            <th>Zona de interés</th>
                            <th>Tipo de Vacante</th>
                            <th>Comentarios</th>
                            <th>Sueldo actual/último</th>
                            <th>residencia</th>
                            <th>¿Trabajando?</th>
                            <th>Curriculum</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                           <tfoot>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Área de interés</th>
                            <th>Grado de Estudios</th>
                            <th>Nivel de Inglés</th>
                            <th>Zona de interés</th>
                            <th>Tipo de Vacante</th>
                            <th>Comentarios</th>
                            <th>Sueldo actual/último</th>
                            <th>residencia</th>
                            <th>¿Trabajando?</th>
                            <th>Curriculum</th>
                          </tfoot>
                        </table>
                    </div>
                   <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha(*):</label>
                            <input type="hidden" name="idinscrito" id="idinscrito">
                            <input type="date" class="form-control" name="fecha" id="fecha" required>
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre(*):</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="150" placeholder="Nombre" required>
                          </div>
                           <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>E_mail(*):</label>
                            <input type="text" class="form-control" name="email" id="email" maxlength="50" placeholder="Correo electrónico" required>
                          </div>
                           <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Teléfono(*):</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" maxlength="20" placeholder="Teléfono" required>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Área de Interés(*):</label>
                            <input type="text" class="form-control" name="area_interes" id="area_interes" maxlength="50" placeholder="Área de Interés"  required>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Grado de Estudios(*):</label>
                            <select name="grado_estudios" id="grado_estudios" class="form-control selectpicker" required>
                               <option value="Primaria">Primaria</option>
                               <option value="Secundaria">Secundaria</option>
                               <option value="Licenciatura">Licenciatura</option>
                               <option value="Maestria">Maestria</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Nivel de Inglés(*):</label>
                            <select name="ingles" id="ingles" class="form-control selectpicker" required>
                               <option value="Primaria">No se inglés</option>
                               <option value="Secundaria">bajo</option>
                               <option value="Licenciatura">Medio solo hablado</option>
                               <option value="Maestria">Medio hablado y escrito</option>
                               <option value="Maestria">Alto hablado</option>
                               <option value="Maestria">Alto hablado y escrito</option>
                            </select>
                          </div>
                           <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Zona de interés(*):</label>
                            <input type="text" class="form-control" name="zona_interes" id="zona_interes" maxlength="50" placeholder="Zona de Interés" required>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Tipo de vacante(*):</label>
                            <select name="tipo_vacante" id="tipo_vacante" class="form-control selectpicker" required>
                               <option value="Primaria">Tiempo Completo</option>
                               <option value="Secundaria">Medio Tiempo</option>
                               <option value="Licenciatura">Temporal</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            <label>Comentarios:</label>
                            <input type="text" class="form-control" name="comentarios" id="comentarios" maxlength="300" placeholder="Puedes escribir alguna información de interés (máximo:200 caracteres)">
                          </div>
                           <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Sueldo actual/último(*):</label>
                            <input type="text" class="form-control" name="sueldo_actual" id="sueldo_actual" maxlength="10" placeholder="Sueldo actual" required>
                          </div>
                           <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Residencia(*):</label>
                            <input type="text" class="form-control" name="residencia" id="residencia" maxlength="100" placeholder="Ciudad/Estado" required>
                          </div>
                           <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>¿Trabajando actualmente?(*):</label>
                            <input type="text" class="form-control" name="trabajando" id="trabajando" maxlength="10" placeholder="Si o No" required>
                          </div>
                          <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label>Curriculum(*):</label>
                            <input type="file" class="form-control" name="cv" id="cv">
                            <input type="hidden" name="cvactual" id="cvactual">
                          </div>
                         <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/inscrito.js"></script>
<?php 
}
ob_end_flush();
?>


