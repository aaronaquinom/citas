<?php
if ($peticionAjax){
    require_once "../core/mainModel.php";
} else{
    require_once "./core/mainModel.php";
}
class networkModel extends mainModel
{
    public function seleccionar_red_modelo(){
        $sql=mainModel::conectar()->prepare("CALL SP_LISTAR_RED");
        $sql->execute();
        return $sql->fetchAll(); //a nivel de arreglos->

    }
    public function seleccionar_microred_modelo($idred){
        $sql=mainModel::conectar()->prepare("CALL SP_LISTAR_MICRORED('$idred')");
        $sql->execute();
        return $sql->fetchAll(); //a nivel de arreglos->

    }
    public function seleccionar_establecimiento_modelo($idmicrored){
        $sql=mainModel::conectar()->prepare("CALL SP_LISTAR_ESTABLECIMIENTO('$idmicrored')");
        $sql->execute();
        return $sql->fetchAll();

    }
}