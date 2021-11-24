<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$detalleclasificacion=new readingModel();
$idclasificacion=isset($_POST['idclasificacion'])?$_POST['idclasificacion']:null;
//$consulta=array();
$consulta=$detalleclasificacion->seleccionar_detalleclasificacion_modelo($idclasificacion);
echo json_encode($consulta);


