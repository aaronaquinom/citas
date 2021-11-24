<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/networkModel.php";
$red=new networkModel();
$idred= isset($_POST['idred'])?$_POST['idred']:null; 
//$consulta=array();
$consulta=$red->seleccionar_microred_modelo($idred);
echo json_encode($consulta);