<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Salida
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($fecha,$tipo,$concepto,$marca,$modelo,$proveedor,$empleado,$detalle,$forma_pago,$pagado)
	{
		$sql="INSERT INTO salida (fecha,tipo,concepto,marca,modelo,proveedor,empleado,detalle,forma_pago,pagado)
		VALUES ('$fecha','$tipo','$concepto','$marca','$modelo','$proveedor','$empleado','$detalle','$forma_pago','$pagado')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idsalida,$fecha,$tipo,$concepto,$marca,$modelo,$proveedor,$empleado,$detalle,$forma_pago,$pagado)
	{
		$sql="UPDATE salida SET fecha='$fecha',tipo='$tipo', concepto='$concepto', marca='$marca', modelo='$modelo',proveedor='$proveedor', empleado='$empleado', detalle='$detalle', forma_pago='$forma_pago', pagado='$pagado' WHERE idsalida='$idsalida'";
		return ejecutarConsulta($sql);
	}



	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idsalida)
	{
		$sql="SELECT * FROM salida WHERE idsalida='$idsalida'";
		return ejecutarConsultaSimpleFila($sql);
	}
	
	//Implementamos un método para eliminar empleados
	public function eliminar($idsalida)
	{
		$sql="DELETE FROM salida WHERE idsalida='$idsalida'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM salida";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM salida";
		return ejecutarConsulta($sql);		
	}
}

?>