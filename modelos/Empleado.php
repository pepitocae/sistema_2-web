<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Empleado
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$apellidos,$direccion,$email,$celular,$cargo,$salario,$comisiones,$banco,$cuenta)
	{
		$sql="INSERT INTO empleado (nombre,apellidos,direccion,email,celular,cargo,salario,comisiones,banco,cuenta)
		VALUES ('$nombre','$apellidos','$direccion','$email','$celular','$cargo','$salario','$comisiones','$banco','$cuenta')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idempleado,$nombre,$apellidos,$direccion,$email,$celular,$cargo,$salario,$comisiones,$banco,$cuenta)
	{
		$sql="UPDATE empleado SET nombre='$nombre',apellidos='$apellidos', direccion='$direccion', email='$email', celular='$celular',cargo='$cargo', salario='$salario', comisiones='$comisiones', banco='$banco', cuenta='$cuenta' WHERE idempleado='$idempleado'";
		return ejecutarConsulta($sql);
	}



	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idempleado)
	{
		$sql="SELECT * FROM empleado WHERE idempleado='$idempleado'";
		return ejecutarConsultaSimpleFila($sql);
	}
	
	//Implementamos un método para eliminar empleados
	public function eliminar($idempleado)
	{
		$sql="DELETE FROM empleado WHERE idempleado='$idempleado'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM empleado";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM empleado";
		return ejecutarConsulta($sql);		
	}
}

?>