<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/ubigeoModel.php";
$departamento=new ubigeoModel();
//$consulta=array();
$consulta=$departamento->seleccionar_departamento_modelo();
echo json_encode($consulta);