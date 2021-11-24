<?php
if ($peticionAjax){
    require_once "../core/mainModel.php";
} else{
    require_once "./core/mainModel.php";
}
class ubigeoModel extends mainModel
{
    public function seleccionar_departamento_modelo(){
        $sql=mainModel::conectar()->prepare("CALL SP_LISTAR_DEPARTAMENTO");
        $sql->execute();
        return $sql->fetchAll(); //a nivel de arreglos->

    }
    public function seleccionar_provincia_modelo($iddepartamento){
        $sql=mainModel::conectar()->prepare("CALL SP_LISTAR_PROVINCIA('$iddepartamento')");
        $sql->execute();
        return $sql->fetchAll(); //a nivel de arreglos->

    }
    public function seleccionar_distrito_modelo($idprovincia){
        $sql=mainModel::conectar()->prepare("CALL SP_LISTAR_DISTRITO('$idprovincia')");
        $sql->execute();
        return $sql->fetchAll();

    }

    public function seleccionar_ipress_modelo($iddistrito){
        $sql=mainModel::conectar()->prepare("CALL SP_LISTAR_IPRESS('$iddistrito')");
        $sql->execute();
        return $sql->fetchAll();

    }
    
}