<?php
	require_once "./core/configGeneral.php";
	require_once "./controllers/viewController.php";

	$plantilla = new viewController();
	$plantilla->obtener_plantilla_controlador();