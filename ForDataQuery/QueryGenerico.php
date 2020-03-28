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
            	$cont = 0;
            	//$queryData[0] = 
            	while($row=$fetchData->fetch(PDO::FETCH_ASSOC)){
                	$queryData[$cont] = $row;
                	$cont = $cont + 1;
            	}
            	// add propiedades al objeto para returnarlos al ajax del front
            	$objectReturn->correcto = true;
            	$objectReturn->mensaje = "Consulta SQL ejecutada exitosamente";
            	$objectReturn->listaResultado = $queryData;
                // Las alteraciones de header deben etar antes de cualquier respuesta o salida
                // permitir peticiones externas
                header('Access-Control-Allow-Origin: *');
                // retornando en json en cuanto el front lo llame
                header('Content-Type: application/json');
            	// volviendo a formato json
            	echo json_encode($objectReturn);
                Conexion::cerrarConexion();
			} catch (Exception $ex) {
				// print "Error: " . $ex -> getMessage() . "<br>";
				// die();
				$objectReturn->correcto = false;
            	$objectReturn->mensaje = $ex -> getMessage();
            	$objectReturn->listaResultado = [];
                // permitir peticiones externas
                header('Access-Control-Allow-Origin: *');
                // retornando en json en cuanto el front lo llame
                header('Content-Type: application/json');
            	// volviendo a formato json
            	echo json_encode($objectReturn);
                Conexion::cerrarConexion();
			}
		}
	}
?>