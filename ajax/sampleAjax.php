<?php
$peticionAjax=true;
require_once "../core/configGeneral.php";
if(isset($_POST['dni-reg']))
{
   require_once "../controllers/sampleController.php";
   $insHospital = new sampleController();
   echo $insHospital->agregar_muestra_controlador();
   //echo $insHospital->enviar_muestra_controlador();
   /*if(isset($_POST['optionsEmbarazada']) && isset($_POST['optionsAnticonceptivo'])){
        
   }*/
}else{
    session_start();
    session_destroy();
    echo'<script>window.location.href="'.SERVERURL.'login/"</script>';
    }