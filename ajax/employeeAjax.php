<?php
$peticionAjax=true;
require_once "../core/configGeneral.php";
if(isset($_POST['dni-reg']) || isset($_POST['codigo-del']))
{
   require_once "../controllers/employeeController.php";
   $insEmpleado = new employeeController();
   if(isset($_POST['dni-reg']))
   {
      echo $insEmpleado->agregar_empleado_controlador();
   }
      if(isset($_POST['codigo-del']) && isset($_POST['privilegio-admin']))
      {
      echo $insEmpleado->eliminar_empleado_controlador();
   }   
}
else{
 session_start();
    session_destroy();
    echo'<script>window.location.href="'.SERVERURL.'login/"</script>';  
}