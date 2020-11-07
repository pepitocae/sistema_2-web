<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Persona
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($tipo_persona,$nombre,$rfc,$direccion,$telefono,$email,$giro,$banco,$cuenta,$clabe,$contacto)
	{
		$sql="INSERT INTO persona (tipo_persona,nombre,rfc,direccion,telefono,email,giro,banco,cuenta,clabe,contacto)
		VALUES ('$tipo_persona','$nombre','$rfc','$direccion','$telefono','$email','$giro','$banco','$cuenta','$clabe','$contacto')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idpersona,$tipo_persona,$nombre,$rfc,$direccion,$telefono,$email,$giro,$banco,$cuenta,$clabe,$contacto)
	{
		$sql="UPDATE persona SET tipo_persona='$tipo_persona',nombre='$nombre',rfc='$rfc',direccion='$direccion',telefono='$telefono',email='$email',giro='$giro', banco='$banco',cuenta='$clabe',contacto='$contacto' WHERE idpersona='$idpersona'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idpersona)
	{
		$sql="DELETE FROM persona WHERE idpersona='$idpersona'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idpersona)
	{
		$sql="SELECT * FROM persona WHERE idpersona='$idpersona'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listarp()
	{
		$sql="SELECT * FROM persona WHERE tipo_persona='Proveedor'";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros 
	public function listarc()
	{
		$sql="SELECT * FROM persona WHERE tipo_persona='Cliente'";
		return ejecutarConsulta($sql);		
	}
}

?>