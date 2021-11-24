<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-account-circle zmdi-hc-fw"></i> MIS DATOS</small></h1>
	</div>
	<p class="lead">Formulario para actualizar sus datos</p>
</div>

<!-- Panel mis datos -->
<div class="container-fluid">
	<?php
		$datos=explode("/", $_GET['views']);
		/*if($datos[1]=="admin"){

		}elseif($datos[1]=="user"){

		}else{

		}*/
		//ADMINISTRADOR
		if($datos[1]=="admin"):
			
			if($_SESSION['tipo_sli']!="Administrador")
			{
			echo $lc->forzar_cierre_session_controlador();
			}
			require_once "./controladores/empleadoControlador.php";
			$classAdmin= new empleadoControlador();

			$filesE=$classAdmin->datos_empleado_controlador("Unico",$datos[2]);

			if($filesE->rowCount()==1){
				$campos=$filesE->fetch();
				if($campos['emCuenta']!=$_SESSION['codigo_cuenta_sli']){
					if( $_SESSION['privilegio_sli']<1 ||$_SESSION['privilegio_sli']>3 ){
						echo $lc->forzar_cierre_session_controlador();
					}

				}
		
				?>
			
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="zmdi zmdi-refresh"></i> &nbsp; MIS DATOS</h3>
						</div>
						<div class="panel-body">
							<form>
							<input type="hidden" name="cuenta-up" value="<?php echo $datos[2]; ?>">
								<fieldset>
									<legend><i class="zmdi zmdi-account-box"></i> &nbsp; Información personal</legend>
									<div class="container-fluid">
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group label-floating">
													<label class="control-label">DNI*</label>
													<input pattern="[0-9-]{1,30}" class="form-control" type="text" name="dni-up" value="<?php echo $campos['emDNI']; ?>"required=" " maxlength="30">
												</div>
											</div>
											<div class="col-xs-12 col-sm-6">
												<div class="form-group label-floating">
													<label class="control-label">Nombres *</label>
													<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombre-up" value="<?php echo $campos['emNombre']; ?> "required="" maxlength="30">
												</div>
											</div>
											<div class="col-xs-12 col-sm-6">
												<div class="form-group label-floating">
													<label class="control-label">Apellidos *</label>
													<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="apellido-up" value="<?php echo $campos['emApellido']; ?>"" required="" maxlength="30">
												</div>
											</div>
											<div class="col-xs-12 col-sm-6">
												<div class="form-group label-floating">
													<label class="control-label">Teléfono</label>
													<input pattern="[0-9+]{1,15}" class="form-control" type="text" name="telefono-up" value="<?php echo $campos['emObservacion'];?>" maxlength="15">
												</div>
											</div>
											<div class="col-xs-12">
												<div class="form-group label-floating">
													<label class="control-label">Dirección</label>
													<textarea name="direccion-up" class="form-control" rows="2" maxlength="100"></textarea>
												</div>
											</div>
										</div>
									</div>
								</fieldset>
								<p class="text-center" style="margin-top: 20px;">
									<button type="submit" class="btn btn-success btn-raised btn-sm"><i class="zmdi zmdi-refresh"></i> Actualizar</button>
								</p>
							</form>
						</div>
					</div>
			
			
			
				<?php

			
			}else{
				?>
				<h1>lo sentimos</h1>
			<?php	
			}

		//USUARIOS
		elseif($datos[1]=="user"):



		//error
		else:
	?>	
		<h4>Lo sentimos</h4>
		<p>No se muestra</p>
	<?php endif;
	?>
	
</div>