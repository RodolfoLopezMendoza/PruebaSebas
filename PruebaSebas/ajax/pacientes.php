<?php 

require_once "../modelos/pacientes.php";

$pacientes=new Pacientes();

$cedula=isset($_POST["cedula"])? $_POST["cedula"]:"";
$nombre=isset($_POST["nombre"])? $_POST["nombre"]:"";
$direccion=isset($_POST["direccion"])? $_POST["direccion"]:"";
$genero=isset($_POST["genero"])? $_POST["genero"]:""; 
$fechNac=isset($_POST["fechNac"])? $_POST["fechNac"]:""; 
$ocupacion=isset($_POST["ocupacion"])? $_POST["ocupacion"]:""; 
$telefono1=isset($_POST["telefono1"])? $_POST["telefono1"]:""; 
$telefono2=isset($_POST["telefono2"])? $_POST["telefono2"]:""; 
$email=isset($_POST["email"])? $_POST["email"]:""; 
$provincia=isset($_POST["provincia"])? $_POST["provincia"]:""; 
$canton=isset($_POST["canton"])? $_POST["canton"]:""; 
$fechaIngreso=isset($_POST["fechaIngreso"])? $_POST["fechaIngreso"]:""; 
$sucursal=isset($_POST["sucursal"])? $_POST["sucursal"]:""; 




switch ($_GET["op"]){
	case 'guardar':
		
			$rspta=$pacientes->insertar($cedula, $nombre, $direccion, $genero, $fechNac,$ocupacion,$telefono1,$telefono2, $email,$provincia,$canton,$fechaIngreso,$sucursal); // Modificar la llamada a la función insertar
			if (intval($rspta)==1){
				echo "paciente agregado";
			}
			if (intval($rspta)==1062){
				echo "la cedula esta repetida";
			}
			break;

		case 'editar':
			$rspta=$pacientes->editar($cedula, $nombre, $direccion, $genero, $fechNac,$ocupacion,$telefono1,$telefono2, $email,$provincia,$canton,$fechaIngreso,$sucursal); // Modificar la llamada a la función editar
			echo $rspta ? "paciente actualizado con exito" : "el paciente no se pudo actualizar";
		
			break;

		case 'eliminar':
			$rspta=$pacientes->eliminar($cedula);
			echo $rspta ? "paciente eliminado" : "el paciente no se pudo eliminar";
		
			break;

	case 'mostrar':
		$rspta=$pacientes->mostrar($cedula);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	
	case 'listar':
		$rspta=$pacientes->listar();
 		//Vamos a declarar un array
 		$data= Array();

     foreach ($rspta as $key => $value) {

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->cedula,
 				"1"=>$reg->nombre,
				"2"=>$reg->direccion,
				"3"=>$reg->genero,
				"4"=>$reg->fechNac, 
                "5"=>$reg->ocupacion, 
                "6"=>$reg->telefono1, 
                "7"=>$reg->telefono2, 
                "8"=>$reg->email, 
                "9"=>$reg->provincia, 
                "10"=>$reg->canton, 
                "11"=>$reg->fechaIngreso, 
                "12"=>$reg->sucursal, 
 				"13"=>'<button class="btn btn-primary" onclick="mostrar(\''.$reg->cedula. '\')"><i class="bx bx-search"></i>&nbsp;Seleccionar</button>'
 			);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data
		);
 		echo json_encode($results);

	break;
}
}