<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$destino=new readingModel();
//$consulta=array();
$consulta=$destino->listar_destino_asegurado();
echo json_encode($consulta);