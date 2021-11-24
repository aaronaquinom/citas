<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$plataforma=new readingModel();
//$consulta=array();
$consulta=$plataforma->seleccionar_plataforma_modelo();
echo json_encode($consulta);