<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$tipofua=new readingModel();
//$consulta=array();
$consulta=$tipofua->seleccionar_tipofua_modelo();
echo json_encode($consulta);