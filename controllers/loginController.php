<?php
if ($peticionAjax){
    require_once "../models/loginModel.php";
} else{
    require_once "./models/loginModel.php";
}
class loginController extends loginModel
{
    public function iniciar_sesion_controlador(){
        $usuario=mainModel::limpiar_cadena($_POST['usuario']);
        $clave=mainModel::limpiar_cadena($_POST['clave']);

        $clave=mainModel::encryption($clave);
        $datosLogin=[
            "Usuario"=>$usuario,
            "Clave"=>$clave
        ];
        $datosCuenta=loginModel::iniciar_sesion_modelo($datosLogin);
        $dc=$datosCuenta->rowCount();
        if($dc==1)
        {
            $row=$datosCuenta->fetch();

            $fechaActual=date("Y-m-d");
            $yearActual=date("Y");
            $horaActual=date("h:i:s a");

            $consulta1=mainModel::ejecutar_consulta_simple("SELECT idlog FROM logs");
            $numero=($consulta1->rowCount())+1;
            $codigoB=mainModel::generar_codigo_aleatorio("CB",7,$numero);

            $datosBitacora=[
                "Codigo"=>$codigoB,
                "Fecha"=>$fechaActual,
                "HoraInicio"=>$horaActual,
                "HoraFinal"=>"Sin registro",
                "Tipo"=>$row['usType'],
                "Anio"=>$yearActual,
                "Cuenta"=>$row['iduser']
            ];
            $insertaBitacora=mainModel::guardar_bitacora($datosBitacora);
            $ib=$insertaBitacora->rowCount();
            if($ib>=1)
            {
                session_start(['name'=>'SLI']);
                $_SESSION['usuario_id']=$row['idEmployee'];
                $_SESSION['usuario_sli']=$row['usNickname'];
                $_SESSION['tipo_sli']=$row['usType'];
                $_SESSION['privilegio_sli']=$row['usPrivilege'];
                $_SESSION['foto_sli']=$row['usPhoto'];
                $_SESSION['token_sli']=md5(uniqid(mt_rand(),true));
                $_SESSION['codigo_cuenta_sli']=$row['iduser'];
                $_SESSION['codigo_bitacora_sli']=$codigoB;
                if($row['usType']=="Administrador"){
                    $url=SERVERURL."home/";
                }else{
                    $url=SERVERURL."homeuser/";
                }
                return $urlLocation='<script>window.location.href="'.$url.'"</script>';
            }
            else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido iniciar la sesión, consulte al administrador",
                    "Tipo"=>"error"
                    ]; 
            }
        }
        else
        {
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un error inesperado",
                "Texto"=>"Usuario o contraseña no coinciden o su cuenta esta deshabilitada",
                "Tipo"=>"error"
                ]; 
            return mainModel::sweet_alert($alerta);
        }

    }
    public function cerrar_session_controlador(){
        session_start(['name'=>'SLI']);
        $token=$_GET['Token'];
        $hora=date("h:i:s a");
        $datos=[
            "Usuario"=>$_SESSION['usuario_sli'],
            "Token_S"=> $_SESSION['token_sli'],
            "Token"=>$token, /*token de la url*/
            "Codigo"=>$_SESSION['codigo_bitacora_sli'],
            "Hora"=>$hora
        ];
        return loginModel::cerrar_session_modelo($datos);
    }
    public function forzar_cierre_session_controlador(){
        //session_start(['name'=>'SLI']); ojo
        session_unset();
        session_destroy();
        //return header("Location: ".SERVERURL."login/");
        $redirect='<script>window.location.href="'.SERVERURL.'login/"</script>';
        return $redirect;
    }
    public function redireccionar_usuario_controlador(){
        if($tipo=="Administrador"){
            $redirect='<script>window.location.href="'.SERVERURL.'home/"</script>';
        }else{
            $redirect='<script>window.location.href="'.SERVERURL.'paciente/"</script>';
        }
        return $redirect;
    }

}
