<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$atencion=new readingModel();
//$consulta=array();
$consulta=$atencion->seleccionar_atencion_modelo();
echo json_encode($consulta);