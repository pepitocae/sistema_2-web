<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Vacante
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($puesto,$ubicacion,$fecha_inicio,$fecha_final,$cliente,$requisitos,$clave)
	{
		$sql="INSERT INTO vacante (puesto,ubicacion,fecha_inicio,fecha_final,cliente,requisitos,clave,condicion)
		VALUES ('$puesto','$ubicacion','$fecha_inicio','$fecha_final','$cliente','$requisitos','$clave','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idvacante,$puesto,$ubicacion,$fecha_inicio,$fecha_final,$cliente,$requisitos,$clave)
	{
		$sql="UPDATE vacante SET puesto='$puesto',ubicacion='$ubicacion',fecha_inicio='$fecha_inicio',fecha_final='$fecha_final',cliente='$cliente',requisitos='$requisitos',clave='$clave' WHERE idvacante='$idvacante'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idvacante)
	{
		$sql="UPDATE vacante SET condicion='0' WHERE idvacante='$idvacante'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idvacante)
	{
		$sql="UPDATE vacante SET condicion='1' WHERE idvacante='$idvacante'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idvacante)
	{
		$sql="SELECT * FROM vacante WHERE idvacante='$idvacante'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM vacante";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM vacante where condicion=1";
		return ejecutarConsulta($sql);		
	}
}

?>