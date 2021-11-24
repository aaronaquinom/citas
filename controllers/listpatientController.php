<?php
$peticionAjax=true;
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/patientModel.php";
$data=new patientModel();
        
        $consulta=$data->listar_paciente_modelo();     
        
        $arreglo["data"]=$consulta;
        
        echo json_encode($arreglo);


   
