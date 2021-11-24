<?php
$peticionAjax=true;
require_once "../core/configGeneral.php";
if(isset($_POST['dni-pa']))
{
   require_once "../controllers/patientController.php";
   $insPaciente = new patientController();
   echo $insPaciente->agregar_paciente_controlador();
}else{
    session_start();
    session_destroy();
    echo'<script>window.location.href="'.SERVERURL.'login/"</script>';
    }