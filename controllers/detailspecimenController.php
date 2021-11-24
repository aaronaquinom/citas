<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$especimen=new readingModel();
$idespecimen= isset($_POST['idespecimen'])?$_POST['idespecimen']:null;
//$consulta=array();
$consulta=$especimen->seleccionar_detalleespecimen_modelo($idespecimen);
echo json_encode($consulta);