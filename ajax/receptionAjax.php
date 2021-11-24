<?php
   $peticionAjax=true;
   require_once "../core/configGeneral.php";
   if(isset($_POST['cod-muestra']))
   {
      require_once "../controllers/receptionController.php";
      $insHospital = new receptionController();
      echo $insHospital->agregar_recepcion_muestra_controlador();
      
      /*if(isset($_POST['optionsEmbarazada']) && isset($_POST['optionsAnticonceptivo'])){
           
      }*/
   }else{
       session_start();
       session_destroy();
       echo'<script>window.location.href="'.SERVERURL.'login/"</script>';
       }