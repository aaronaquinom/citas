<!DOCTYPE html>
<html lang="es">
<head>
	<title><?php echo COMPANY; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="<?php echo SERVERURL; ?>views/css/main.css">
	<link rel="stylesheet" href="<?php echo SERVERURL; ?>views/css/select2.css">
	<link rel="stylesheet" href="<?php echo SERVERURL; ?>views/css/datatables.min.css">
	<link rel="stylesheet" href="<?php echo SERVERURL; ?>views/css/citas.css">
	<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,900;1,400&family=Poppins:wght@300&display=swap" rel="stylesheet">

	<!--===== Scripts -->
	<?php include "./views/modules/script.php";?>
</head>
<body>
	<?php

		$peticionAjax=false;

		require_once "./controllers/viewController.php";

		$vt = new viewController();
		$vistasR=$vt->obtener_vistas_controlador();
		if($vistasR=="login" || $vistasR=="404" || $vistasR=="cita" ):
			if($vistasR=="login"){
				require_once "./views/contents/login-view.php";
			}
			else
			if($vistasR=="cita")
			{
		 require_once "./views/contents/cita-view.php";
		 }
			else{
				require_once "./views/contents/404-view.php";

			}
		else:
			session_start(['name'=>'SLI']);
			require_once "./controllers/loginController.php";
			$lc=new loginController();
			if(!isset($_SESSION['token_sli']) || !isset($_SESSION['usuario_sli']) ){
				echo $lc->forzar_cierre_session_controlador();
			}
	?>
	<!-- SideBar -->
	<?php include "./views/modules/navlateral.php"; ?>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">

		<!-- NavBar -->
		<?php include "./views/modules/navbar.php"; ?>

		<!-- Content page -->
		<?php require_once $vistasR; ?>

	</section>
	<?php
		include "./views/modules/logoutScript.php";
		endif;
	?>

	<!--===== Scripts -->

	<script>
	$.material.init();
	</script>

</body>
</html>
