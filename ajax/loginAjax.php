<?php
$peticionAjax=true;
require_once "../core/configGeneral.php";
if(isset($_GET['Token']))
{
  require_once "../controllers/loginController.php";
  $logout= new loginController();
  echo $logout->cerrar_session_controlador();
}else{
    session_start();
    session_destroy();
    echo'<script>window.location.href="'.SERVERURL.'login/"</script>';
    }