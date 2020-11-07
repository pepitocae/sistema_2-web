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
if ($_SESSION['ventas']==1)
{
require_once "../modelos/Entrada.php";

$entrada=new Entrada();

$identrada=isset($_POST["identrada"])? limpiarCadena($_POST["identrada"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$tipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
$concepto=isset($_POST["concepto"])? limpiarCadena($_POST["concepto"]):"";
$cliente=isset($_POST["cliente"])? limpiarCadena($_POST["cliente"]):"";
$detalle=isset($_POST["detalle"])? limpiarCadena($_POST["detalle"]):"";
$empleado=isset($_POST["empleado"])? limpiarCadena($_POST["empleado"]):"";
$subtotal=isset($_POST["subtotal"])? limpiarCadena($_POST["subtotal"]):"";
$iva=isset($_POST["iva"])? limpiarCadena($_POST["iva"]):"";
$forma_pago=isset($_POST["forma_pago"])? limpiarCadena($_POST["forma_pago"]):"";
$pagado=isset($_POST["pagado"])? limpiarCadena($_POST["pagado"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($identrada)){
			$rspta=$entrada->insertar($fecha,$tipo,$concepto,$cliente,$detalle,$empleado,$subtotal,$iva,$forma_pago,$pagado);
			echo $rspta ? "Ingreso registrado" : "Ingreso no se pudo registrar";
		}
		else {
			$rspta=$entrada->editar($identrada,$fecha,$tipo,$concepto,$cliente,$detalle,$empleado,$subtotal,$iva,$forma_pago,$pagado);
			echo $rspta ? "Ingreso actualizado" : "Ingreso no se pudo actualizar";
		}
	break;

	
	case 'eliminar':
		$rspta=$entrada->eliminar($identrada);
 		echo $rspta ? "Ingreso eliminado" : "Ingreso no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$entrada->mostrar($identrada);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$entrada->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->identrada.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="eliminar('.$reg->identrada.')"><i class="fa fa-trash"></i></button>',
 				"1"=>$reg->fecha,
 				"2"=>$reg->tipo,
				"3"=>$reg->concepto,
				"4"=>$reg->cliente,
				"5"=>$reg->detalle,
				"6"=>$reg->empleado,
				"7"=>$reg->subtotal,
				"8"=>$reg->iva,
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