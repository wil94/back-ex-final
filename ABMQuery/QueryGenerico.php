<?php 
	class ExecuteQuerySQL {

		public static function obtenerDataSQL() {
		 	include_once "../ConfigApp/Conexion.php";
			Conexion::abrirConexion();
            //$queryToExecute = "Select * from horario";
			$queryToExecute = $_POST['sql'];
			$queryData = array();
			//variable que da formato como un json
			$objectReturn = new stdClass();

			try {
				$fetchData = Conexion::obtenerConexion()->prepare($queryToExecute);
            	$fetchData->execute();
            	// add propiedades al objeto para returnarlos al ajax del front
            	$objectReturn->correcto = true;
            	$objectReturn->mensaje = "Consulta SQL ejecutada exitosamente";
            	$objectReturn->listaResultado = [];
            	// volviendo a formato json
            	echo json_encode($objectReturn);
            	// permitir peticiones externas
         		header('Access-Control-Allow-Origin: *');
         		// retornando en json en cuanto el front lo llame
            	header('Content-Type: application/json');
			} catch (Exception $ex) {
				// print "Error: " . $ex -> getMessage() . "<br>";
				// die();
				$objectReturn->correcto = false;
            	$objectReturn->mensaje = $ex -> getMessage();
            	$objectReturn->listaResultado = [];
            	// volviendo a formato json
            	echo json_encode($objectReturn);
            	// permitir peticiones externas
         		header('Access-Control-Allow-Origin: *');
         		// retornando en json en cuanto el front lo llame
            	header('Content-Type: application/json');
			}
		}
	}
 ?>