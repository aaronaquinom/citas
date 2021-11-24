<?php
if ($peticionAjax){
    require_once "../core/mainModel.php";
} else{
    require_once "./core/mainModel.php";
}
class loginModel extends mainModel 
{
    protected function iniciar_sesion_modelo($datos){
        $sql=mainModel::conectar()->prepare("SELECT * FROM users WHERE usNickname=:Usuario AND usPassword=:Clave 
        AND usState='Activo'");
        $sql->bindParam('Usuario', $datos['Usuario']);
        $sql->bindParam('Clave', $datos['Clave']);
        $sql->execute ();
        return $sql;
    }
    protected function cerrar_session_modelo($datos){
        if($datos['Usuario']!="" && $datos['Token_S']==$datos['Token'])
        {
           $Abitacora=mainModel::actualizar_bitacora($datos['Codigo'], $datos['Hora']);
           $abi=$Abitacora->rowCount();
           if($abi==1){
            session_unset();
            session_destroy();
            $respuesta="true";
          }else{
            $respuesta="false";
          }

        }else{
            $respuesta="false"; /*no es booleano*/
        }
        return $respuesta;
    }
}
