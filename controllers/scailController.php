<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$escamosa=new readingModel();
//$consulta=array();
$consulta=$escamosa->seleccionar_escamosa_modelo();
echo json_encode($consulta);