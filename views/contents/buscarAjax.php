<?php
require_once "../core/configGeneral.php";
if(isset($_POST['dnib-reg']))
{
   require_once "../controladores/pacienteControlador.php";
   $data=array();
   $insPaciente = new pacienteControlador();
   $data=$insPaciente->obtener_datos_paciente_controlador();
   echo json_encode($data);
}else{
    session_start();
    session_destroy();
    echo'<script>window.location.href="'.SERVERURL.'login/"</script>';
    }
