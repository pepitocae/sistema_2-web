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
if ($_SESSION['almacen']==1)
{
require_once "../modelos/Vacante.php";

$vacante=new Vacante();

$idvacante=isset($_POST["idvacante"])? limpiarCadena($_POST["idvacante"]):"";
$puesto=isset($_POST["puesto"])? limpiarCadena($_POST["puesto"]):"";
$ubicacion=isset($_POST["ubicacion"])? limpiarCadena($_POST["ubicacion"]):"";
$fecha_inicio=isset($_POST["fecha_inicio"])? limpiarCadena($_POST["fecha_inicio"]):"";
$fecha_final=isset($_POST["fecha_final"])? limpiarCadena($_POST["fecha_final"]):"";
$cliente=isset($_POST["cliente"])? limpiarCadena($_POST["cliente"]):"";
$requisitos=isset($_POST["requisitos"])? limpiarCadena($_POST["requisitos"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idvacante)){
			$rspta=$vacante->insertar($puesto,$ubicacion,$fecha_inicio,$fecha_final,$cliente,$requisitos,$clave);
			echo $rspta ? "Vacante registrada" : "Vacante no se pudo registrar";
		}
		else {
			$rspta=$vacante->editar($idvacante,$puesto,$ubicacion,$fecha_inicio,$fecha_final,$cliente,$requisitos,$clave);
			echo $rspta ? "Vacante actualizada" : "Vacante no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$vacante->desactivar($idvacante);
 		echo $rspta ? "Vacante Desactivada" : "Vacante no se puede desactivar";
	break;

	case 'activar':
		$rspta=$vacante->activar($idvacante);
 		echo $rspta ? "Vacante activada" : "Vacante no se puede activar";
	break;

	case 'mostrar':
		$rspta=$vacante->mostrar($idvacante);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$vacante->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idvacante.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idvacante.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idvacante.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idvacante.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->puesto,
 				"2"=>$reg->ubicacion,
				"3"=>$reg->fecha_inicio,
				"4"=>$reg->fecha_final,
				"5"=>$reg->cliente,
				"6"=>$reg->requisitos,
				"7"=>$reg->clave,
 				"8"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
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