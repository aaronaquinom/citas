<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/ubigeoModel.php";
$distrito=new ubigeoModel();
$idprovincia= isset($_POST['idprovincia'])?$_POST['idprovincia']:null;
//$consulta=array();
$consulta=$distrito->seleccionar_distrito_modelo($idprovincia);
echo json_encode($consulta);