<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>Fua<small> impresión</small></h1>
	</div>
	<p class="lead">
	Estos son los datos de la fua que va imprimir
	</p>
</div>

<div class="container-fluid">

</div>

<!-- Panel nuevo cliente -->
<div class="container-fluid">
<?php
		$datos=explode("/", $_GET['vistas']);
		
		if($datos[0]=="fua-print"):
			
			if($_SESSION['tipo_sli']!="Administrador"  && $_SESSION['tipo_sli']!="Registrador")
			{
			echo $lc->forzar_cierre_session_controlador();
			}
			require_once "./controllers/fuaController.php";
			
			$printfua= new fuaController();
			
			$filesP=$printfua->datos_fua_controlador("Unico",$datos[1]);

			if($filesP->rowCount()==1){
				$campos=$filesP->fetch();
		
				?>
			
				<div class="panel panel-info">
					<div class="panel-heading">
							<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; IMPRIMIR FUA</h3>
					</div>
						<div class="panel-body">				
							<form action =""  method="POST" data-form="" class="FormularioAjax" >
								<input type="hidden" name="cod-muestra" value="<?php echo $datos[1]; ?>">
								<input type="hidden" name="cod-empleado" value="<?php echo $lc->encryption($_SESSION['codigo_cuenta_sli']);?>">
								
									<fieldset>
										<legend><i class="zmdi zmdi-account-box"></i> &nbsp; Usted va imprimir la FUA de:</legend>
										
										<div class="container-fluid">
											<div class="row">
                                                <div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
														<label class="control-label">Nro de FUA*</label>
														<input pattern="[0-9-]{1,30}" class="form-control" type="text" id="codigo-lamina" name="codigolamina-reg" required="" value="<?php echo $campos['fuaNro']; ?>" readonly>
													</div>
													
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
														<label class="control-label">Nro Documento*</label>
														<input pattern="[0-9-]{1,30}" class="form-control" type="text" id="dni-paciente" name="dni-reg" required="" value="<?php echo $campos['Documento']; ?>" readonly>
													</div>
													
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
														<label class="control-label">Nombres *</label>
														<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="apellido-reg" required="" value="<?php echo $campos['Nombre'];?> <?php echo $campos['NombreDos']; ?>" maxlength="30" readonly>
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
														<label class="control-label">Apellidos *</label>
														
														<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombre-reg" required="" value="<?php echo $campos['ApellidoP'];?> <?php echo $campos['ApellidoM']; ?>" maxlength="30" readonly>
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
													<label class="control-label" style="font-size:10px">Fecha de atención/alta</label>
													<label></label>
													<input type="datetime"  class="form-control" name="fechamuestra-reg" required="" value="<?php echo $campos['fuaDateAttentions']; ?>" maxlength="30"  readonly>
													</div>
												</div>
                                              

										
												
											</div>
										</div>
									</fieldset>
									<br>
								
									<fieldset>
										<!--codigo-->
										
										
									</fieldset>
									
									<p class="text-center" style="margin-top: 20px;">
										
										
									</p>
									
							</form>

						</div>
						
				</div>
				<div class="text-center">
						<?php 
							/*require_once "./controllers/printController.php";
							$this->mode = new printController();*/
							
						?>
										
										
									
				<a href="<?php echo SERVERURL;?>prints/print-fua.php?id=<?php echo $datos[1]; ?>" target="_blank" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-local-printshop zmdi-hc-fw"></i>IMPRIMIR</a>
				</div>
						
				<?php						
			}else
			{
			?>
				<h1>lo sentimos ve</h1>
			<?php									
			}

						//USUARIOS
		elseif($datos[1]=="user"):
		//error
		else:
		?>	
			<h4>Lo sentimos</h4>
			<p>No se muestra</p>
		<?php endif;?>
</div>
