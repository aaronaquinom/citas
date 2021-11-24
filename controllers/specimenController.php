<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$especimen=new readingModel();
//$consulta=array();
$consulta=$especimen->seleccionar_especimen_modelo();
echo json_encode($consulta);