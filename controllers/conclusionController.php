<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$conclusion=new readingModel();
//$consulta=array();
$consulta=$conclusion->seleccionar_conclusion_modelo();
echo json_encode($consulta);