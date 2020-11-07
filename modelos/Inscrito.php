<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Inscrito
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($fecha,$nombre,$email,$telefono,$area_interes,$grado_estudios,$ingles,$zona_interes,$tipo_vacante,$comentarios,$sueldo_actual,$residencia,$trabajando,$cv)
	{
		$sql="INSERT INTO inscrito (fecha,nombre,email,telefono,area_interes,grado_estudios,ingles,zona_interes,tipo_vacante,comentarios,sueldo_actual,residencia,trabajando,cv)
		VALUES ('$fecha','$nombre','$email','$telefono','$area_interes','$grado_estudios','$ingles','$zona_interes','$tipo_vacante','$comentarios','$sueldo_actual','$residencia','$trabajando','$cv')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idinscrito,$fecha,$nombre,$email,$telefono,$area_interes,$grado_estudios,$ingles,$zona_interes,$tipo_vacante,$comentarios,$sueldo_actual,$residencia,$trabajando,$cv)
	{
		$sql="UPDATE inscrito SET fecha='$fecha',nombre='$nombre',email='$email', telefono='$telefono', area_interes='$area_interes', grado_estudios='$grado_estudios',ingles='$ingles', zona_interes='$zona_interes', tipo_vacante='$tipo_vacante', comentarios='$comentarios', sueldo_actual='$sueldo_actual',residencia='$residencia',trabajando='$trabajando',cv='$cv' WHERE idinscrito='$idinscrito'";
		return ejecutarConsulta($sql);
	}



	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idinscrito)
	{
		$sql="SELECT * FROM inscrito WHERE idinscrito='$idinscrito'";
		return ejecutarConsultaSimpleFila($sql);
	}
	
	//Implementamos un método para eliminar inscritos
	public function eliminar($idinscrito)
	{
		$sql="DELETE FROM inscrito WHERE idinscrito='$idinscrito'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM inscrito";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM inscrito";
		return ejecutarConsulta($sql);		
	}
}

?>