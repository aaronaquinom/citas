<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$detalleglandular=new readingModel();
$idglandular=isset($_POST['idglandular'])?$_POST['idglandular']:null;
//$consulta=array();
$consulta=$detalleglandular->seleccionar_detalleglandular_modelo($idglandular);
echo json_encode($consulta);