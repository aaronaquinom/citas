<?php
if ($peticionAjax){
    require_once "../core/mainModel.php";
} else{
    require_once "./core/mainModel.php";
}
class readingModel extends mainModel
{
    public function seleccionar_tipofua_modelo(){
        $sql=mainModel::conectar()->prepare("CALL SP_LISTAR_TIPOFUA");
        $sql->execute();
        return $sql->fetchAll(); //a nivel de arreglos->

    }
        
    public function seleccionar_plataforma_modelo(){
        $sql=mainModel::conectar()->prepare("CALL SP_LISTAR_PERSONAL_PLATAFORMA");
        $sql->execute();
        return $sql->fetchAll(); //a nivel de arreglos->

    }

    public function seleccionar_atencion_modelo(){
        $sql=mainModel::conectar()->prepare("CALL SP_LISTAR_LUGAR_ATENCION");
        $sql->execute();
        return $sql->fetchAll(); //a nivel de arreglos->

    }

    public function seleccionar_tipoatencion_modelo(){
        $sql=mainModel::conectar()->prepare("CALL SP_LISTAR_ATENCION");
        $sql->execute();
        return $sql->fetchAll(); //a nivel de arreglos->

    }  
    
    public function listar_doctores_iren(){
        $sql=mainModel::conectar()->prepare("CALL SP_LISTAR_DOCTORES");
        $sql->execute();
        return $sql->fetchAll(); //a nivel de arreglos->
    }   

    public function listar_destino_asegurado(){
        $sql=mainModel::conectar()->prepare("CALL SP_LISTAR_DESTINO");
        $sql->execute();
        return $sql->fetchAll(); //a nivel de arreglos->
    }  

    public function listar_concepto_prestacion(){
        $sql=mainModel::conectar()->prepare("CALL SP_LISTAR_PRESTACION");
        $sql->execute();
        return $sql->fetchAll(); //a nivel de arreglos->
    }  

    
}