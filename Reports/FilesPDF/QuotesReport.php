<?php 
	include "../../ConfigApp/Conexion.php";

	$type = $_GET['type'];
	$conexion = new Conexion();
	$conexion->abrirConexion();
	$queryData = array();
	$queryToExecute = "";
	$titleReport = "";

	if ($type == "todos") {
		$titleReport = "Reporte de Cotizaciones General";
		$queryToExecute = " SELECT T.name_trademark, ST.name_sub_trademark, V.anio, V.precio_unitario 
			FROM quote Q 
			INNER JOIN vehicle V ON V.id_vehicle = Q.id_vehicle 
			INNER JOIN subtrademark ST ON ST.id_sub_trademark = V.id_sub_trademark 
			INNER JOIN trademark T ON T.id_trademark = ST.id_trademark ";
	} else if ($type == "credito") {
		$titleReport = "Reporte de Cotizaciones al Credito";
		$queryToExecute = " SELECT T.name_trademark, ST.name_sub_trademark, V.anio, V.precio_unitario , Q.initial_amount, Q.time_loan, Q.month_amount 
			FROM quote Q 
			INNER JOIN vehicle V ON V.id_vehicle = Q.id_vehicle 
			INNER JOIN subtrademark ST ON ST.id_sub_trademark = V.id_sub_trademark 
			INNER JOIN trademark T ON T.id_trademark = ST.id_trademark 
			WHERE Q.type = 'Credito' ";
	} else if ($type == "contado") {
		$titleReport = "Reporte de Cotizaciones al Contado";
		$queryToExecute = " SELECT T.name_trademark, ST.name_sub_trademark, V.anio, V.precio_unitario 
			FROM quote Q 
			INNER JOIN vehicle V ON V.id_vehicle = Q.id_vehicle 
			INNER JOIN subtrademark ST ON ST.id_sub_trademark = V.id_sub_trademark 
			INNER JOIN trademark T ON T.id_trademark = ST.id_trademark 
			WHERE Q.type = 'Contado' ";
	}

	try {
		$fetchData = $conexion->obtenerConexion()->prepare($queryToExecute);
		$fetchData->execute();
		$cont = 0;
    	while($row=$fetchData->fetch(PDO::FETCH_ASSOC)){
        	$queryData[$cont] = $row;
        	$cont = $cont + 1;
    	}

    	/*
		foreach ($queryData as $key => $value) {
			// print_r($value);
			// echo "<br/>";
			// echo $value[$key];
			// echo $value['id_quote'];
			foreach ($value as $k => $val) {
				// echo $val;
			}
		}
		*/

		$conexion->cerrarConexion();

	} catch (Exception $ex) {
		print "Error: " . $ex -> getMessage() . "<br>";
		$conexion->cerrarConexion();
		die();
	}

 ?>

 <!DOCTYPE html>
 <html lang="es">
 <head>
 	<meta charset="utf-8" />
 	<style type="text/css">
 		table {
   			width: 100%;
   			border-color: black;
		}
		th {
			background: black;
			color: white;
		}
		th, td {
			text-align: center;
			border-color: black;
		}
		.text-title {
			font-family: sans-serif;
		}
		caption {
			font-weight: 250%;
			margin-bottom: 15px;
		}
 		
 	</style>
 	<title>Reportes</title>
 </head>
 <body>
 	<h1 class="text-title">AUTO TIENDA</h1>
 	<h2 class="text-title"><?php echo $titleReport; ?></h2>
 	<table border="1">
 		<caption class="text-title title-table">Lista de Cotizaciones realizadas por los clientes desde la aplicacion movil</caption>
 		<tr>
 			<?php 
 				if ($type === "todos" || $type == "contado") {
			?>
				<th>Nombre Marca</th>
				<th>Nombre Modelo</th>
				<th>Año</th>
				<th>Precio</th>
			<?php
 				} else {
			?>
				<th>Nombre Marca</th>
				<th>Nombre Modelo</th>
				<th>Año</th>
				<th>Precio</th>
				<th>Capital Amortizado</th>
				<th>Tiempo plazo</th>
				<th>Cuota Mensual</th>
			<?php
 				}
		 	?>
 			
 		</tr>

 		<?php 
			foreach ($queryData as $key => $value):
				?>
				<tr>
		<?php 
				foreach ($value as $k => $val):
	 	?>

	 				<td><?php echo $val; ?></td>

	 	<?php 
 		 		endforeach;
 		?>
 		 		</tr>
 		<?php
			endforeach;
	  	?>

 	</table>
 </body>
 </html>