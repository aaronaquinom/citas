<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$glandular=new readingModel();
//$consulta=array();
$consulta=$glandular->seleccionar_glandular_modelo();
echo json_encode($consulta);