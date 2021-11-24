<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$detalleescamosa=new readingModel();
$idescamosa=isset($_POST['idescamosa'])?$_POST['idescamosa']:null;
//$consulta=array();
$consulta=$detalleescamosa->seleccionar_detalleescamosa_modelo($idescamosa);
echo json_encode($consulta);
