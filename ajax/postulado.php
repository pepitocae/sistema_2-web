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
require_once "../modelos/Postulado.php";

$postulado=new Postulado();

$idpostulado=isset($_POST["idpostulado"])? limpiarCadena($_POST["idpostulado"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$e_mail=isset($_POST["e_mail"])? limpiarCadena($_POST["e_mail"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$sueldo=isset($_POST["sueldo"])? limpiarCadena($_POST["sueldo"]):"";
$ciudad=isset($_POST["ciudad"])? limpiarCadena($_POST["ciudad"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$nivel_estudios=isset($_POST["nivel_estudios"])? limpiarCadena($_POST["nivel_estudios"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$curriculum=isset($_POST["curriculum"])? limpiarCadena($_POST["curriculum"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

		if (!file_exists($_FILES['curriculum']['tmp_name']) || !is_uploaded_file($_FILES['curriculum']['tmp_name']))
		{
			$imagen=$_POST["curriculumactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["curriculum"]["name"]);
			if ($_FILES['curriculum']['type'] == "image/jpg" || $_FILES['curriculum']['type'] == "application/pdf" || $_FILES['curriculum']['type'] == "image/png" || $_FILES['curriculum']['type'] == "application/doc")
			{
				$curriculum = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["curriculum"]["tmp_name"], "../files/articulos/" . $curriculum);
			}
		}
		if (empty($idpostulado)){
			$rspta=$postulado->insertar($nombre,$e_mail,$telefono,$sueldo,$ciudad,$estado,$direccion,$nivel_estudios,$clave,$curriculum);
			echo $rspta ? "Postulado registrado" : "Postulado no se pudo registrar";
		}
		else {
			$rspta=$postulado->editar($idpostulado,$nombre,$e_mail,$telefono,$sueldo,$ciudad,$estado,$direccion,$nivel_estudios,$clave,$curriculum);
			echo $rspta ? "Postulado actualizado" : "Postulado no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$postulado->desactivar($idpostulado);
 		echo $rspta ? "Postulado desactivado" : "Postulado no se puede desactivar";
	break;

	case 'activar':
		$rspta=$postulado->activar($idpostulado);
 		echo $rspta ? "Postulado activado" : "Postulado no se puede activar";
	break;

	case 'mostrar':
		$rspta=$postulado->mostrar($idpostulado);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$postulado->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idpostulado.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idpostulado.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idpostulado.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idpostulado.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->e_mail,
				"3"=>$reg->telefono,
				"4"=>$reg->sueldo,
				"5"=>$reg->ciudad,
				"6"=>$reg->estado,
				"7"=>$reg->direccion,
				"8"=>$reg->nivel_estudios,
				"9"=>$reg->clave,
				"10"=>"<img src='../files/articulos/".$reg->curriculum."' height='50px' width='50px' >",
 				"11"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				' <span class="label bg-red">Desactivado</span>'
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