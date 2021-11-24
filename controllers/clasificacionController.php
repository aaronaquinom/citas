<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$clasificacion=new readingModel();
//$consulta=array();
$consulta=$clasificacion->seleccionar_clasificacion_modelo();
echo json_encode($consulta);