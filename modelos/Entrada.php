<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Entrada
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($fecha,$tipo,$concepto,$cliente,$detalle,$empleado,$subtotal,$iva,$forma_pago,$pagado)
	{
		$sql="INSERT INTO entrada (fecha,tipo,concepto,cliente,detalle,empleado,subtotal,iva,forma_pago,pagado)
		VALUES ('$fecha','$tipo','$concepto','$cliente','$detalle','$empleado','$subtotal','$iva','$forma_pago','$pagado')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($identrada,$fecha,$tipo,$concepto,$cliente,$detalle,$empleado,$subtotal,$iva,$forma_pago,$pagado)
	{
		$sql="UPDATE entrada SET fecha='$fecha',tipo='$tipo', concepto='$concepto', cliente='$cliente', detalle='$detalle',empleado='$empleado', subtotal='$subtotal', iva='$iva', forma_pago='$forma_pago', pagado='$pagado' WHERE identrada='$identrada'";
		return ejecutarConsulta($sql);
	}



	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($identrada)
	{
		$sql="SELECT * FROM entrada WHERE identrada='$identrada'";
		return ejecutarConsultaSimpleFila($sql);
	}
	
	//Implementamos un método para eliminar empleados
	public function eliminar($identrada)
	{
		$sql="DELETE FROM entrada WHERE identrada='$identrada'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM entrada";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM entrada";
		return ejecutarConsulta($sql);		
	}
}

?>