<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/ubigeoModel.php";
$provincia=new ubigeoModel();
$iddepartamento= isset($_POST['iddepartamento'])?$_POST['iddepartamento']:null;
//$consulta=array();
$consulta=$provincia->seleccionar_provincia_modelo($iddepartamento);
echo json_encode($consulta);