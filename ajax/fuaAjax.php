<?php
$peticionAjax=true;
require_once "../core/configGeneral.php";
if(isset($_POST['tdi-pa']))
{
   require_once "../controllers/fuaController.php";
   $insPaciente = new fuaController();
   echo $insPaciente->agregar_fua_controlador();
}else{
    session_start();
    session_destroy();
    echo'<script>window.location.href="'.SERVERURL.'login/"</script>';
    }