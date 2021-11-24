<?php
   $peticionAjax=true;
   require_once "../core/configGeneral.php";
   if(isset($_POST['cod-registro']))
   {
      require_once "../controllers/firstreadingController.php";
      $insHospital = new firstreadingController();
      echo $insHospital->agregar_resultado_controlador();
      
      /*if(isset($_POST['optionsEmbarazada']) && isset($_POST['optionsAnticonceptivo'])){
           
      }*/
   }else{
       session_start();
       session_destroy();
       echo'<script>window.location.href="'.SERVERURL.'login/"</script>';
       }