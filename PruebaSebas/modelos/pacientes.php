
<?php 
// Incluimos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Pacientes 
{
	// Implementamos nuestro constructor
	public function __construct()
	{

	}


	// Implementamos un método para insertar registros
	public function insertar($cedula, $nombre, $direccion, $genero, $fechNac,$ocupacion,$telefono1,$telefono2, $email,$provincia,$canton,$fechaIngreso,$sucursal)
	{
		try {
			$sql = "INSERT INTO paciente (cedula, nombre,direccion,genero,fechNac,ocupacion,telefono1,telefono2,email,provincia,canton,fechaIngreso,sucursal )
			VALUES ('$cedula','$nombre','$direccion','$genero','$fechNac',$ocupacion,$telefono1,,$telefono2, $email,$provincia,$canton,$fechaIngreso,$sucursal)";
			return ejecutarConsulta($sql);
		} catch (Exception $e) {
			return $e->getCode(); // Devuelve el código de error de la excepción
		}
	}

	// Implementamos un método para editar registros
	public function editar($cedula, $nombre, $direccion, $genero, $fechaNac, $ocupacion, $telefono1, $telefono2, $email, $provincia, $canton, $fechaIngreso, $sucursal )
	{
		$sql = "UPDATE paciente SET nombre='$nombre', direccion='$direccion', genero='$genero', fechaNac='$fechaNac',ocupacion='$ocupacion',telefono1='$telefono1', telefono2='$telefono2',email='$email',provincia='$provincia',canton='$canton',fechaIngreso='$fechaIngreso',sucursal='$sucursal',WHERE cedula='$cedula'";
		return ejecutarConsulta($sql);
	}

	// Implementamos un método para eliminar registros
	public function eliminar($cedula)
	{
		$sql = "DELETE FROM paciente WHERE cedula='$cedula'";
		return ejecutarConsulta($sql);
	}

	// Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($cedula)
	{
		$sql = "SELECT * FROM paciente WHERE cedula='$cedula'";
		return ejecutarConsultaSimpleFila($sql);
	}

	// Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT * FROM paciente";
		return ejecutarConsulta($sql);		
	}
}

?>
