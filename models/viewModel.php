<?php
	class viewModel{
		protected function obtener_vistas_modelo($vistas)
		{
			$listaBlanca=["home","homeuser", "fua", "employee", "employee-list", "employee-search","patient", "fua-list", "fua-print", "patient-list", "patient-search",
						"sample", "sample-reg","sample-list", "sample-search", "sample-print", "reception", "reception-sample","reception-filter",
						"reception-confirmed", "reception-search", "no-reception", "reading", "reading-first",
						"reading-list", "reading-search", "reading-print", "result", "result-end", "result-list", "result-search", "result-print", "result-sample", "buscar-resultado"];
						if(in_array($vistas, $listaBlanca)){
							if(is_file("./views/contents/".$vistas."-view.php")){
								$contenido="./views/contents/".$vistas."-view.php";
							}else{
								$contenido="login";
							}
						}elseif($vistas=="login"){
							$contenido="login";
						}elseif($vistas=="index"){
							$contenido="index";
							}
							elseif($vistas=="cita"){
								$contenido="cita";
						}else{
							$contenido="404";
						}
						return $contenido;
					}
				}
