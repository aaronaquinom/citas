<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$prestacion=new readingModel();
//$consulta=array();
$consulta=$prestacion->listar_concepto_prestacion();
echo json_encode($consulta);