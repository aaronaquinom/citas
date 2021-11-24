<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/ubigeoModel.php";
$ipress=new ubigeoModel();
$iddistrito= isset($_POST['iddistrito'])?$_POST['iddistrito']:null;
//$consulta=array();
$consulta=$ipress->seleccionar_ipress_modelo($iddistrito);
echo json_encode($consulta);