<?php 

	include "../../LogicModel/ActionsVehicle.php";
	include "../../ConfigApp/Conexion.php";

	$conexion = new Conexion();
	ActionsVehicle::obtenerDataVehiclesList($conexion);

 ?>