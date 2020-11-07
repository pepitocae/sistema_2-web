<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Postulado
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$e_mail,$telefono,$sueldo,$ciudad,$estado,$direccion,$nivel_estudios,$clave,$curriculum)
	{
		$sql="INSERT INTO postulado (nombre,e_mail,telefono,sueldo,ciudad,estado,direccion,nivel_estudios,clave,curriculum,condicion)
		VALUES ('$nombre','$e_mail','$telefono','$sueldo','$ciudad','$estado','$direccion','$nivel_estudios','$clave','$curriculum','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idpostulado,$nombre,$e_mail,$telefono,$sueldo,$ciudad,$estado,$direccion,$nivel_estudios,$clave,$curriculum)
	{
		$sql="UPDATE postulado SET nombre='$nombre',e_mail='$e_mail',telefono='$telefono',sueldo='$sueldo',ciudad='$ciudad',estado= '$estado',direccion='$direccion',nivel_estudios='$nivel_estudios',clave='$clave',curriculum='$curriculum'WHERE idpostulado='$idpostulado'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idpostulado)
	{
		$sql="UPDATE postulado SET condicion='0' WHERE idpostulado='$idpostulado'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idpostulado)
	{
		$sql="UPDATE postulado SET condicion='1' WHERE idpostulado='$idpostulado'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idpostulado)
	{
		$sql="SELECT * FROM postulado WHERE idpostulado='$idpostulado'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM postulado";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM postulado where condicion=1";
		return ejecutarConsulta($sql);		
	}
}

?>