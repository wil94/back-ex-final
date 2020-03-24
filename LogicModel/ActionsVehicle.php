<?php 
	
	class ActionsVehicle {

		public static function obtenerDataVehiclesList($conexion) {
			$conexion->abrirConexion();
			$queryToExecute = " SELECT V.id_vehicle, T.name_trademark, ST.name_sub_trademark, V.anio, ST.capacidad,
            V.img, V.precio_unitario
				FROM vehicle V 
				INNER JOIN subtrademark ST ON V.id_sub_trademark = ST.id_sub_trademark 
				INNER JOIN trademark T ON ST.id_trademark = T.id_trademark ";

			/* Para recepcion de variables por post o get y como incluirlos al query 
			$testPost = $_POST['idVehicle'];
			...sql= ..."where v.id_vehicle='$testPost'"
			*/

			$queryData = array();
			//variable que da formato como un json
			$objectReturn = new stdClass();

			try {
				$fetchData = $conexion->obtenerConexion()->prepare($queryToExecute);
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
         	// volviendo a formato json
         	echo json_encode($objectReturn);
         	// permitir peticiones externas
      		header('Access-Control-Allow-Origin: *');
      		$conexion->cerrarConexion();
      		// retornando en json en cuanto el front lo llame
         	// header('Content-Type: application/json');
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
      		$conexion->cerrarConexion();
      		// retornando en json en cuanto el front lo llame
         	// header('Content-Type: application/json');
			}
			
		}

	}

 ?>