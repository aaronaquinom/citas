<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/networkModel.php";
$red=new networkModel();
//$consulta=array();
$consulta=$red->seleccionar_red_modelo();
echo json_encode($consulta);