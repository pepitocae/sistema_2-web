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
if ($_SESSION['compras']==1)
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
                          <h1 class="box-title">Gastos <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> <a href="../reportes/rptproveedores.php" target="_blank"><button class="btn btn-info"><i class="fa fa-clipboard"></i> Reporte</button></a></h1>
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
                            <th>Tipo</th>
                            <th>Concepto</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Proveedor</th>
                            <th>Empleado</th>
                            <th>Detalle</th>
                            <th>Forma de Pago</th>
                            <th>Pagado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Concepto</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Proveedor</th>
                            <th>Empleado</th>
                            <th>Detalle</th>
                            <th>Forma de Pago</th>
                            <th>Pagado</th>
                          </tfoot>
                        </table>
                    </div>
                     <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Fecha (*):</label>
                            <input type="hidden" name="idsalida" id="idsalida">
                            <input type="date" class="form-control" name="fecha" id="fecha" required>
                          </div>
                           <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Tipo(*):</label>
                            <select name="tipo" id="tipo" class="form-control selectpicker" required>
                               <option value="Corriente">Corriente</option>
                               <option value="Insumos">Insumos</option>
                               <option value="Nomina">Nómina</option>
                               <option value="Comisiones">Comisiones</option>
                               <option value="Renta">Renta</option>
                               <option value="Financieros">Financieros</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Concepto:</label>
                            <input type="text" class="form-control" name="concepto" id="concepto" maxlength="50" placeholder="Concepto" required>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Marca:</label>
                            <input type="text" class="form-control" name="marca" id="marca" maxlength="50" placeholder="Marca">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Modelo:</label>
                            <input type="text" class="form-control" name="modelo" id="modelo" maxlength="50" placeholder="Modelo">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Proveedor:</label>
                            <input type="text" class="form-control" name="proveedor" id="proveedor" maxlength="50" placeholder="Proveedor">
                          </div>
                           <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Empleado:</label>
                            <input type="text" class="form-control" name="empleado" id="empleado" maxlength="50" placeholder="Empleado">
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Detalle:</label>
                            <input type="text" class="form-control" name="detalle" id="detalle" maxlength="50" placeholder="Detalle">
                          </div>
                           <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Forma de pago(*):</label>
                            <select name="forma_pago" id="forma_pago" class="form-control selectpicker" required>
                               <option value="Efectivo">Efectivo</option>
                               <option value="Tarjeta">Tarjeta</option>
                               <option value="Bono regalo">Bono regalo</option>
                               <option value="Transferencia">Transferencia</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Pagado:</label>
                            <input type="text" class="form-control" name="pagado" id="pagado" maxlength="50" placeholder="Pagado" required>
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
<script type="text/javascript" src="scripts/salida.js"></script>
<?php 
}
ob_end_flush();
?>