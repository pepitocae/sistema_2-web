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
require_once "../modelos/Empleado.php";

$empleado=new Empleado();

$idempleado=isset($_POST["idempleado"])? limpiarCadena($_POST["idempleado"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellidos=isset($_POST["apellidos"])? limpiarCadena($_POST["apellidos"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$celular=isset($_POST["celular"])? limpiarCadena($_POST["celular"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$salario=isset($_POST["salario"])? limpiarCadena($_POST["salario"]):"";
$comisiones=isset($_POST["comisiones"])? limpiarCadena($_POST["comisiones"]):"";
$banco=isset($_POST["banco"])? limpiarCadena($_POST["banco"]):"";
$cuenta=isset($_POST["cuenta"])? limpiarCadena($_POST["cuenta"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idempleado)){
			$rspta=$empleado->insertar($nombre,$apellidos,$direccion,$email,$celular,$cargo,$salario,$comisiones,$banco,$cuenta);
			echo $rspta ? "Empleado registrado" : "Empleado no se pudo registrar";
		}
		else {
			$rspta=$empleado->editar($idempleado,$nombre,$apellidos,$direccion,$email,$celular,$cargo,$salario,$comisiones,$banco,$cuenta);
			echo $rspta ? "Empleado actualizada" : "Empleado no se pudo actualizar";
		}
	break;

	
	case 'eliminar':
		$rspta=$empleado->eliminar($idempleado);
 		echo $rspta ? "Empleado eliminado" : "Empleado no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$empleado->mostrar($idempleado);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$empleado->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idempleado.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="eliminar('.$reg->idempleado.')"><i class="fa fa-trash"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->apellidos,
				"3"=>$reg->direccion,
				"4"=>$reg->email,
				"5"=>$reg->celular,
				"6"=>$reg->cargo,
				"7"=>$reg->salario,
				"8"=>$reg->comisiones,
				"9"=>$reg->banco,
				"10"=>$reg->cuenta
 				
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