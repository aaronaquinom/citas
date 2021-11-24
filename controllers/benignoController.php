<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$benigno=new readingModel();
//$consulta=array();
$consulta=$benigno->seleccionar_benigno_modelo();
echo json_encode($consulta);