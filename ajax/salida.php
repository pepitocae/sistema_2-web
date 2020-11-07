<?php 
ob_start();
if (strlen(session_id()) < 1){
	session_start();//Validamos si existe o no la sesión
}
if (!isset($_SESSION["nombre"]))
{
  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
}
else
{
//Validamos el acceso solo al usuario logueado y autorizado.
if ($_SESSION['compras']==1)
{
require_once "../modelos/Salida.php";

$salida=new Salida();

$idsalida=isset($_POST["idsalida"])? limpiarCadena($_POST["idsalida"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$tipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
$concepto=isset($_POST["concepto"])? limpiarCadena($_POST["concepto"]):"";
$marca=isset($_POST["marca"])? limpiarCadena($_POST["marca"]):"";
$modelo=isset($_POST["modelo"])? limpiarCadena($_POST["modelo"]):"";
$proveedor=isset($_POST["proveedor"])? limpiarCadena($_POST["proveedor"]):"";
$empleado=isset($_POST["empleado"])? limpiarCadena($_POST["empleado"]):"";
$detalle=isset($_POST["detalle"])? limpiarCadena($_POST["detalle"]):"";
$forma_pago=isset($_POST["forma_pago"])? limpiarCadena($_POST["forma_pago"]):"";
$pagado=isset($_POST["pagado"])? limpiarCadena($_POST["pagado"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idsalida)){
			$rspta=$salida->insertar($fecha,$tipo,$concepto,$marca,$modelo,$proveedor,$empleado,$detalle,$forma_pago,$pagado);
			echo $rspta ? "Gasto registrado" : "Gasto no se pudo registrar";
		}
		else {
			$rspta=$salida->editar($idsalida,$fecha,$tipo,$concepto,$marca,$modelo,$proveedor,$empleado,$detalle,$forma_pago,$pagado);
			echo $rspta ? "Gasto actualizado" : "Gasto no se pudo actualizar";
		}
	break;

	
	case 'eliminar':
		$rspta=$salida->eliminar($idsalida);
 		echo $rspta ? "Gasto eliminado" : "Gasto no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$salida->mostrar($idsalida);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$salida->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idsalida.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="eliminar('.$reg->idsalida.')"><i class="fa fa-trash"></i></button>',
 				"1"=>$reg->fecha,
 				"2"=>$reg->tipo,
				"3"=>$reg->concepto,
				"4"=>$reg->marca,
				"5"=>$reg->modelo,
				"6"=>$reg->proveedor,
				"7"=>$reg->empleado,
				"8"=>$reg->detalle,
				"9"=>$reg->forma_pago,
				"10"=>$reg->pagado
 				
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
//Fin de las validaciones de acceso
}
else
{
  require 'noacceso.php';
}
}
ob_end_flush();
?>