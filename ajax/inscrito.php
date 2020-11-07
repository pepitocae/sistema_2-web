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
require_once "../modelos/Inscrito.php";

$inscrito=new Inscrito();

$idinscrito=isset($_POST["idinscrito"])? limpiarCadena($_POST["idinscrito"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$area_interes=isset($_POST["area_interes"])? limpiarCadena($_POST["area_interes"]):"";
$grado_estudios=isset($_POST["grado_estudios"])? limpiarCadena($_POST["grado_estudios"]):"";
$ingles=isset($_POST["ingles"])? limpiarCadena($_POST["ingles"]):"";
$zona_interes=isset($_POST["zona_interes"])? limpiarCadena($_POST["zona_interes"]):"";
$tipo_vacante=isset($_POST["tipo_vacante"])? limpiarCadena($_POST["tipo_vacante"]):"";
$comentarios=isset($_POST["comentarios"])? limpiarCadena($_POST["comentarios"]):"";
$sueldo_actual=isset($_POST["sueldo_actual"])? limpiarCadena($_POST["sueldo_actual"]):"";
$residencia=isset($_POST["residencia"])? limpiarCadena($_POST["residencia"]):"";
$trabajando=isset($_POST["trabajando"])? limpiarCadena($_POST["trabajando"]):"";
$cv=isset($_POST["cv"])? limpiarCadena($_POST["cv"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idinscrito)){
			$rspta=$inscrito->insertar($fecha,$nombre,$email,$telefono,$area_interes,$grado_estudios,$ingles,$zona_interes,$tipo_vacante,$comentarios,$sueldo_actual,$residencia,$trabajando,$cv);
			echo $rspta ? "Inscrito registrado" : "Inscrito no se pudo registrar";
		}
		else {
			$rspta=$inscrito->editar($idinscrito,$fecha,$nombre,$email,$telefono,$area_interes,$grado_estudios,$ingles,$zona_interes,$tipo_vacante,$comentarios,$sueldo_actual,$residencia,$trabajando,$cv);
			echo $rspta ? "Inscrito actualizado" : "Inscrito no se pudo actualizar";
		}
	break;

	
	case 'eliminar':
		$rspta=$inscrito->eliminar($idinscrito);
 		echo $rspta ? "Inscrito eliminado" : "Inscrito no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$inscrito->mostrar($idinscrito);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$inscrito->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idinscrito.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="eliminar('.$reg->idinscrito.')"><i class="fa fa-trash"></i></button>',
 				"1"=>$reg->fecha,
 				"2"=>$reg->nombre,
				"3"=>$reg->email,
				"4"=>$reg->telefono,
				"5"=>$reg->area_interes,
				"6"=>$reg->grado_estudios,
				"7"=>$reg->ingles,
				"8"=>$reg->zona_interes,
				"9"=>$reg->tipo_vacante,
				"10"=>$reg->comentarios,
				"11"=>$reg->sueldo_actual,
				"12"=>$reg->residencia,
				"13"=>$reg->trabajando,
				"14"=>$reg->cv
 				
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