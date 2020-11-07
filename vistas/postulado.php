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
                          <h1 class="box-title">Aspirantes <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> <a href="../reportes/rptcategorias.php" target="_blank"><button class="btn btn-info"><i class="fa fa-clipboard"></i> Reporte</button></a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Sueldo actual</th>
                            <th>Ciudad</th>
                            <th>Estado</th>
                            <th>Dirección</th>
                            <th>Nivel de Estudios</th>
                            <th>Clave</th>
                            <th>Curriculum</th>
                            <th>Condición</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Sueldo actual</th>
                            <th>Ciudad</th>
                            <th>Estado</th>
                            <th>Dirección</th>
                            <th>Nivel de Estudios</th>
                            <th>Clave</th>
                            <th>Curriculum</th>
                            <th>Condición</th>
                          </tfoot>
                        </table>
                    </div>
                   <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre(*):</label>
                            <input type="hidden" name="idpostulado" id="idpostulado">
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="150" placeholder="Nombre" required>
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>E_mail(*):</label>
                            <input type="text" class="form-control" name="e_mail" id="e_mail" maxlength="100" placeholder="Correo electrónico" required>
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Teléfono(*):</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" maxlength="15" placeholder="Teléfono" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Sueldo Actual(*):</label>
                            <input type="text" class="form-control" name="sueldo" id="sueldo" maxlength="20" placeholder="Sueldo Actual"  required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Ciudad(*):</label>
                            <input type="text" class="form-control" name="ciudad" id="ciudad" maxlength="100" placeholder="Ciudad"  required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Estado(*):</label>
                            <input type="text" class="form-control" name="estado" id="estado" maxlength="100" placeholder="Estado" required>
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Dirección:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" maxlength="150" placeholder="Dirección">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nivel de Estudios(*):</label>
                            <input type="text" class="form-control" name="nivel_estudios" id="nivel_estudios" maxlength="50" placeholder="Nivel de Estudios" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Clave(*):</label>
                            <input type="text" class="form-control" name="clave" id="clave" maxlength="15" placeholder="Clave de la vacante" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Curriculum(*):</label>
                            <input type="file" class="form-control" name="curriculum" id="curriculum">
                            <input type="hidden" name="curriculumactual" id="curriculumactual">
                            <img src="" width="150px" height="120px" id="curriculummuestra">
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
<script type="text/javascript" src="scripts/postulado.js"></script>
<?php 
}
ob_end_flush();
?>


