<?php
	require_once "./models/viewModel.php";
	class viewController extends viewModel{

		public function obtener_plantilla_controlador(){
			return require_once "./views/template.php";
		}

		public function obtener_vistas_controlador(){
			if(isset($_GET['vistas'])){
				$ruta=explode("/", $_GET['vistas']);
				$respuesta=viewModel::obtener_vistas_modelo($ruta[0]);
			}else{
				$respuesta="login";
			}
			return $respuesta;
		}
		//obtener impresión
		public function obtener_impresion_controlador()
		{

			
		}
	}