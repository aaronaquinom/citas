<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/networkModel.php";
$red=new networkModel();;
$consulta=array();
$idmicrored= isset($_POST['idmicrored'])?$_POST['idmicrored']:null; 
$consulta=$red->seleccionar_establecimiento_modelo($idmicrored);
echo json_encode($consulta);