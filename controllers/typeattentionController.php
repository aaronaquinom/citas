<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$tipoatencion=new readingModel();
//$consulta=array();
$consulta=$tipoatencion->seleccionar_tipoatencion_modelo();
echo json_encode($consulta);