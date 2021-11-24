<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$detallehormonal=new readingModel();
$idhormonal=isset($_POST['idhormonal'])?$_POST['idhormonal']:null;
//$consulta=array();
$consulta=$detallehormonal->seleccionar_detallehormonal_modelo($idhormonal);
echo json_encode($consulta);