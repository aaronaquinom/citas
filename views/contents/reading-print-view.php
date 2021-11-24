<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>Primera<small> Lectura</small></h1>
	</div>
	<p class="lead">
	Estos son los datos del paciente que va imprimir su primera lectura
	</p>
</div>

<div class="container-fluid">
	<!--<ul class="breadcrumb breadcrumb-tabs">
	  	<li>
	  		<a href="<?php echo SERVERURL;?>paciente/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVO PACIENTE
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>muestralist/"class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE MUESTRAS
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>pacientesearch/" class="btn btn-primary">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR PACIENTES
	  		</a>
	  	</li>
	</ul>-->
</div>

<!-- Panel nuevo cliente -->
<div class="container-fluid">
<?php
		$datos=explode("/", $_GET['vistas']);
		/*if($datos[1]=="admin"){

		}elseif($datos[1]=="user"){

		}else{

		}*/
		//ADMINISTRADOR
		if($datos[0]=="reading-print"):
			
			if($_SESSION['tipo_sli']!="Administrador" && $_SESSION['tipo_sli']!="Tecnologo" && $_SESSION['tipo_sli']!="Medico")
			{
			echo $lc->forzar_cierre_session_controlador();
			}
			require_once "./controllers/firstreadingController.php";
			
			$classResultado= new firstreadingController();
			
			$filesP=$classResultado->datos_lectura_controlador("Unico",$datos[1]);

			if($filesP->rowCount()==1){
				$campos=$filesP->fetch();
		
				?>
			
				<div class="panel panel-info">
					<div class="panel-heading">
							<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVA MUESTRA</h3>
					</div>
						<div class="panel-body">				
							<form action =""  method="POST" data-form="" class="FormularioAjax" >
								<input type="hidden" name="cod-resultado" value="<?php echo $datos[1]; ?>">
								<input type="hidden" name="cod-empleado" value="<?php echo $lc->encryption($_SESSION['codigo_cuenta_sli']);?>">
								
									<fieldset>
										<legend><i class="zmdi zmdi-account-box"></i> &nbsp; Usted va imprimir la primera lectura de:</legend>
										
										<div class="container-fluid">
											<div class="row">
                                                <div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
														<label class="control-label">Codigo Lamina*</label>
														<input pattern="[0-9-]{1,30}" class="form-control" type="text" id="codigo-lamina" name="codigolamina-reg" required="" value="<?php echo $campos['frCodeLamina']; ?>" readonly>
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
														<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombre-reg" required="" value="<?php echo $campos['paName']; ?>"  readonly>
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
														<label class="control-label">Apellidos *</label>
														<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="apellido-reg" required="" value="<?php echo $campos['paLastName']; ?>" readonly>
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
													<label class="control-label" style="font-size:10px">Fecha del resultado de la 1ra lectura</label>
													<label></label>
													<input type="date"  class="form-control" name="fecharegla-reg" required="" value="<?php echo $campos['frDateFirstreading']; ?>" readonly>
													</div>
												</div>
                                                <div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
													<label class="control-label" style="font-size:10px">Lugar de Procedencia</label>
													<label></label>
													<input type="text"class="form-control" name="procedencia-reg" required="" value="<?php echo $campos['esName']; ?>" maxlength="30"  readonly>
													</div>
												</div>

										
												
											</div>
										</div>
									</fieldset>
									<br>
									<br>
									<fieldset>
										<legend><i class="zmdi zmdi-key"></i> &nbsp;Resultados dados por:</legend>
									
										<div class="container-fluid">
											<div class="row">
                            					
                                                <div class="col-xs-12 col-sm-6">
												<div class="form-group label-floating">
												<label class="control-label" style="font-size:10px">Nombres</label>
													<div class="form-group">
														<input class="form-control" type="text" name="neomalignas-reg" id="txtmalignas" value="<?php echo $campos['Lectura'];?>" readonly>
													</div>
												</div>
                                    			</div>
                                                <div class="col-xs-12 col-sm-6">
												<div class="form-group label-floating">
												<label class="control-label" style="font-size:10px">Apellidos</label>
													<div class="form-group">
														<input class="form-control" type="text" name="neomalignas-reg" id="txtmalignas" value="<?php echo $campos['LecturaA'];?>" readonly>
													</div>
												</div>
                                    			</div>
											</div>
										</div>
										
									</fieldset>
									<br>
									<fieldset>
										<!--	<legend><i class="zmdi zmdi-star"></i> &nbsp; Nivel de privilegios</legend>-->
										
										
									</fieldset>
									
									<p class="text-center" style="margin-top: 20px;">
										
										
									</p>
									
							</form>

						</div>
						
				</div>
				<div class="text-center">
				
										
										
									
										<a href="<?php echo SERVERURL;?>prints/print-firstreading.php?id=<?php echo $datos[1]; ?>" target="_blank" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-local-printshop zmdi-hc-fw"></i>IMPRIMIR</a>
				
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
