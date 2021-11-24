<?php
$peticionAjax=true; 
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/readingModel.php";
$doctores=new readingModel();
//$consulta=array();
$consulta=$doctores->listar_doctores_iren();
echo json_encode($consulta);