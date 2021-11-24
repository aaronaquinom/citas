<?php
   $peticionAjax=true;
   require_once "../core/configGeneral.php";
   if(isset($_POST['cod-registro']))
   {
      require_once "../controllers/resultController.php";
      $insHospital = new resultController();
      echo $insHospital->agregar_resultadofinal_controlador();
      
      /*if(isset($_POST['optionsEmbarazada']) && isset($_POST['optionsAnticonceptivo'])){
           
      }*/
   }else{
       session_start();
       session_destroy();
       echo'<script>window.location.href="'.SERVERURL.'login/"</script>';
       }