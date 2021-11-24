<?php
if ($peticionAjax){
    require_once "../models/printModel.php";
} else{
    require_once "./models/printModel.php";
}
class printController extends printModel{
   
    public function imprimir_muestra_controlador(){
        $codigoR=mainModel::decryption ($codigoR);
        $codigoE=mainModel::decryption ($codigoE);
    }  
                                      
}