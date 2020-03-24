<?php 

	// Esta ruta se hace el include como si fuera
	include "../../DataModel/Quote.php";
	include "../../ConfigApp/Conexion.php";

	class ActionsQuote {
		
		public static function SaveQuoteMobile () {
			$conexion = new Conexion();
			$conexion->abrirConexion();

			// Recibimos las variables por POST
			$idQuote = substr(sha1(time()), 0, 16);
			$idVehicle = $_POST['idVehicle'];
			$typeQuote = $_POST['tipoCompra'];
			$initial_amount = $_POST['montoInicial'];
			$time_loan = $_POST['tiempo'];
			$month_amount = $_POST['pagoMensual'];
			// Instanciamos y creamos el objeto Quote
			$quote = new Quote($idQuote, $idVehicle, $typeQuote, $initial_amount, $time_loan, $month_amount);

			// Armamaos variables en base al objeto para armar el query
			$idQ = $quote->getIdQuote();
			$idV = $quote->getIdVehicle();
			$type = $quote->getType();
			$iniAmount = $quote->getInitialAmount();
			$time = $quote->getTimeLoan();
			$monAmount = $quote->getMonthAmount();

			$queryToExecute = " INSERT INTO quote (id_quote, id_vehicle, type, initial_amount, time_loan, month_amount) 
				VALUES ( '$idQ', '$idV', '$type', $iniAmount, $time, $monAmount ) ";

			$queryData = array();
			//variable que da formato como un json
			$objectReturn = new stdClass();

			try {
				$fetchData = $conexion->obtenerConexion()->prepare($queryToExecute);
            	$fetchData->execute();
            	// add propiedades al objeto para returnarlos al ajax del front
            	$objectReturn->correcto = true;
            	$objectReturn->mensaje = "Consulta SQL ejecutada exitosamente";
            	$objectReturn->listaResultado = [];
            	// volviendo a formato json
            	echo json_encode($objectReturn);
            	// permitir peticiones externas
         		header('Access-Control-Allow-Origin: *');
         		$conexion->cerrarConexion();
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
         		$conexion->cerrarConexion();
         		// retornando en json en cuanto el front lo llame
            	header('Content-Type: application/json');
			}

		}

	}

	
 ?>