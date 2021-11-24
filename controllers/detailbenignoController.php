<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$detallebenigno=new readingModel();
$idbenigno=isset($_POST['idbenigno'])?$_POST['idbenigno']:null;
//$consulta=array();
$consulta=$detallebenigno->seleccionar_detallebenigno_modelo($idbenigno);
echo json_encode($consulta);