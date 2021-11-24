<div class="container-fluid">
	<div class="page-header">
    <h1 class="text-titles"><i class="zmdi zmdi-truck zmdi-hc-fw"></i>Recepción <small> denegado</small></h1>
	</div>
	<p class="lead">
	Datos del motivo de la no recepción de la lamina
	</p>
</div>

<div class="container-fluid">
	
</div>

<!-- Panel nuevo cliente -->
<div class="container-fluid">
<?php
		$datos=explode("/", $_GET['vistas']);
	
		if($datos[0]=="no-reception"):
			
			if($_SESSION['tipo_sli']!="Administrador" && $_SESSION['tipo_sli']!="Muestreador" && $_SESSION['tipo_sli']!="Recepcionador" && $_SESSION['tipo_sli']!="Tecnologo" && $_SESSION['tipo_sli']!="Medico")
			{
			echo $lc->forzar_cierre_session_controlador();
			}
			require_once "./controllers/receptionController.php";
			
			$norecepcionado= new receptionController();
			
			$filesP=$norecepcionado->datos_norecepionado_controlador("Unico",$datos[1]);

			if($filesP->rowCount()==1){
				$campos=$filesP->fetch();
		
				?>
			
				<div class="panel panel-info">
					<div class="panel-heading">
							<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVA MUESTRA</h3>
					</div>
						<div class="panel-body">				
							<form action =""  method="POST" data-form="" class="FormularioAjax" >
								<input type="hidden" name="cod-recepcion" value="<?php echo $datos[1]; ?>">
								<input type="hidden" name="cod-empleado" value="<?php echo $lc->encryption($_SESSION['codigo_cuenta_sli']);?>">
								
								
								
									<fieldset>
										<legend><i class="zmdi zmdi-account-box"></i> &nbsp; Datos de lamina no aceptada:</legend>
										
										<div class="container-fluid">
											<div class="row">
                                                <div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
														<label class="control-label">Codigo Lamina*</label>
														<input pattern="[0-9-]{1,30}" class="form-control" type="text" id="cod-lamina" name="codlamina-reg" required="" value="<?php echo $campos['hgCodeLamina']; ?>" readonly>
													</div>
													
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
														<label class="control-label">DNI*</label>
														<input pattern="[0-9-]{1,30}" class="form-control" type="text" id="dni-paciente" name="dni-reg" required="" value="<?php echo $campos['paDNI']; ?>" readonly>
													</div>
													
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
														<label class="control-label">Nombres *</label>
														<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombre-reg" required="" value="<?php echo $campos['paName']; ?>" maxlength="30" readonly>
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
														<label class="control-label">Apellidos *</label>
														<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="apellido-reg" required="" value="<?php echo $campos['paLastName']; ?>" maxlength="30"  readonly>
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
													<label class="control-label" style="font-size:10px">Fecha de llegada de la lamina</label>
													<label></label>
													<input type="date"  class="form-control" name="fecharecepcion-reg" required="" value="<?php echo $campos['srDateReception']; ?>" maxlength="30"  readonly>
													</div>
												</div>
                                                <div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
													<label class="control-label" style="font-size:10px">Lugar de Procedencia</label>
													<label></label>
													<input type="text"class="form-control" name="procedencia-reg" required="" value="<?php echo $campos['Procedencia']; ?>" maxlength="30"  readonly>
													</div>
												</div>
                                                <div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
													<label class="control-label" style="font-size:10px">Observación de la lamina</label>
													<label></label>
													<input type="text"class="form-control" name="procedencia-reg" required="" value="<?php echo $campos['srObservationReception']; ?>" maxlength="30"  readonly>
													</div>
												</div>

										
												
											</div>
										</div>
									</fieldset>
									<br>
									<br>
									<fieldset>
										<legend><i class="zmdi zmdi-key"></i> &nbsp;Lamina no recepcionada por:</legend>
									
										<div class="container-fluid">
											<div class="row">
                            					
                                                <div class="col-xs-12 col-sm-6">
												<div class="form-group label-floating">
												<label class="control-label" style="font-size:10px">Nombres</label>
													<div class="form-group">
														<input class="form-control" type="text" name="nombres-reg" id="txtmalignas" value="<?php echo $campos['Recepcionador'];?>" readonly>
													</div>
												</div>
                                    			</div>
                                                <div class="col-xs-12 col-sm-6">
												<div class="form-group label-floating">
												<label class="control-label" style="font-size:10px">Resultado</label>
													<div class="form-group">
														<input class="form-control" type="text" name="apellidos-reg" id="txtmalignas" value="<?php echo $campos['RecepcionadorA'];?>" readonly>
													</div>
												</div>
                                    			</div>
									        <br>

											</div>
										</div>
										
									</fieldset>
									<br>
                                    <br>
									
									<p class="text-center" style="margin-top: 20px;">
									
                                    
                                    <!--<a href="<?php echo SERVERURL;?>impresiones/imprimiresultado.php?id=<?php echo $datos[1]; ?>" target="_blank" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-local-printshop zmdi-hc-fw"></i>IMPRIMIR</a>
									-->	
									</p>
									<div class="RespuestaAjax">
									</div>
									
									
							</form>

						</div>
						
				</div>
				
						
				<?php						
			}else
				{
						?>
						<h1>lo sentimos vea</h1>
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