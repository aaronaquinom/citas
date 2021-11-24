
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Muestras <small></small></h1>
	</div>
	<p class="lead">
	Este formulario le permite registrar las muestras que se enviarán al IREN CENTRO,si no encuentra los datos del paciente, necesita
	previamente registrarlo en el aplicativo.
	</p>
</div>

<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
	  	<li>
	  		<a href="<?php echo SERVERURL;?>paciente/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVO PACIENTE
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>pacientelist/"class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE PACIENTES
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>pacientesearch/" class="btn btn-primary">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR PACIENTES
	  		</a>
	  	</li>
	</ul>
</div>

<!-- Panel nuevo cliente -->
<div class="container-fluid">
<?php
		$datos=explode("/", $_GET['views']);
		/*if($datos[1]=="admin"){

		}elseif($datos[1]=="user"){

		}else{

		}*/
		//ADMINISTRADOR
		if($datos[0]=="historiag"):
			
			if($_SESSION['tipo_sli']!="Administrador")
			{
			echo $lc->forzar_cierre_session_controlador();
			}
			require_once "./controladores/pacienteControlador.php";
			
			$classPaciente= new pacienteControlador();
			
			$filesP=$classPaciente->datos_paciente_controlador("Unico",$datos[1]);

			if($filesP->rowCount()==1){
				$campos=$filesP->fetch();
		
				?>
			
				<div class="panel panel-info">
					<div class="panel-heading">
							<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVA MUESTRA</h3>
					</div>
						<div class="panel-body">				
							<form action ="<?php echo SERVERURL;?>ajax/muestraAjax.php"  method="POST" data-form="" class="FormularioAjax" >
								<input type="hidden" name="cod-paciente" value="<?php echo $datos[1]; ?>">
								<input type="hidden" name="cod-empleado" value="<?php echo $lc->encryption($_SESSION['codigo_cuenta_sli']);?>">
								
									<fieldset>
										<legend><i class="zmdi zmdi-account-box"></i> &nbsp; Usted va registrar la muestra de:</legend>
										
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-12">
													<div class="form-group label-floating">
														<label class="control-label">DNI*</label>
														<input pattern="[0-9-]{1,30}" class="form-control" type="text" id="dni-paciente" name="dni-reg" required="" value="<?php echo $campos['paDNI']; ?>" readonly>
													</div>
													
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
														<label class="control-label">Nombres *</label>
														<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombre-reg" required="" value="<?php echo $campos['paNombre']; ?>" maxlength="30" readonly>
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
														<label class="control-label">Apellidos *</label>
														<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="apellido-reg" required="" value="<?php echo $campos['paApellidos']; ?>" maxlength="30"  readonly>
													</div>
												</div>

										
												
											</div>
										</div>
									</fieldset>
									<br>
									<br>
									<fieldset>
										<legend><i class="zmdi zmdi-key"></i> &nbsp;Datos de la Muestra</legend>
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
													<label class="control-label" style="font-size:10px">Fecha de ultima regla</label>
													<label></label>
													<input type="date"  class="form-control" name="fecharegla-reg" required="">
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group">
														<label class="control-label">¿Embarazada?</label>
														<div class="radio radio-primary">
															<label>
																<input type="radio" name="optionsEmbarazada" id="optionsRadios1" value="<?php echo base64_encode('No')?>" checked="">
																&nbsp; No
															</label>
															<label>
																<input type="radio" name="optionsEmbarazada" id="optionsRadios2" value="<?php echo base64_encode('Si')?>">
																&nbsp; Si
															</label>
														</div>
													
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group">
														<label class="control-label">Uso de anticonceptivo?</label>
														<div class="radio radio-primary">
															<label>
																<input type="radio" name="optionsAnticonceptivo" id="chkNo" value="No" checked="">
																&nbsp; No
															</label>
															<label>
																<input type="radio" name="optionsAnticonceptivo" id="chkYes" value="Si">
																&nbsp; Si
															</label>
														</div>
													
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group">
														<label class="control-label">Especifique tipo de metodo anticonceptivo</label>
														<input class="form-control" type="text" name="anti-reg" id="txtanticonceptivo" disabled="disabled"  maxlength="70">
													</div>
												</div>
												<div class="col-xs-12 col-sm-4">
													<div class="form-group">
														<label class="control-label">Examen Ginecológico*</label>
														<div class="radio radio-primary">
															<label>
																<input type="radio" name="optionsExameng" id="No" value="Normal" checked="">
																&nbsp; Normal
															</label>
															<label>
																<input type="radio" name="optionsExameng" id="Yes" value="Anormal">
																&nbsp; Anormal
															</label>
														</div>
													
													</div>
												</div>
												
												<div class="col-xs-12 col-sm-4">
													<div id="cuadrante" class="form-group">
														<label class="control-label">Especifique cuadrante</label>
														<div  id="cuadrante" class="checkbox">
															<label><input type="checkbox" name="check_lista[]" id="chk0" disabled="disabled" value="I"> I</label>
															<label><input type="checkbox" name="check_lista[]" id="chk1" disabled="disabled" value="II"> II</label>
															<label><input type="checkbox" name="check_lista[]" id="chk2" disabled="disabled" value="III"> III</label>
															<label><input type="checkbox" name="check_lista[]" id="chk3" disabled="disabled" value="IV"> IV</label>
														</div>
													</div>
												</div>
												<div class="col-xs-12 col-sm-4">
													<div class="form-group">
														<label class="control-label">Especifique Examen </label>
														<input class="form-control" type="text" name="espexameng-reg" id="txtexameng" disabled="disabled"  maxlength="70">
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group">
														<label class="control-label">Colposcopia anterior*</label>
														<div class="radio radio-primary">
															<label>
																<input type="radio" name="optionsColposcopia" value="No" checked=""> <!--valor vacio-->
																&nbsp; No
															</label>
															<label>
																<input type="radio" name="optionsColposcopia" id="Not" value="Normal" >
																&nbsp; Normal
															</label>
															<label>
																<input type="radio" name="optionsColposcopia" id="Sip" value="Anormal">
																&nbsp; Anormal
															</label>
														</div>
													
													</div>
												</div>
											
												<div class="col-xs-12 col-sm-6">
													<div class="form-group">
														<label class="control-label">Especifique</label>
														<input class="form-control" type="text" name="anormalcolposcopia-reg" id="txtcolposcopia" disabled="disabled"  maxlength="70">
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group">
														<label class="control-label">Diagnostico anterior</label>
														<input class="form-control" type="text" name="colposcopianterior-reg" id="txtcolposcopiadiag" disabled="disabled"  maxlength="70">
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
													<label class="control-label" style="font-size:10px">Fecha de diagnostico anterior</label>
													<label></label>
													<input type="date"  class="form-control" name="fechadiagnostico-reg" id="fechadiagnostico" disabled="disabled">
													</div>
												</div>
												<div class="col-xs-12 col-sm-12">
													<div class="form-group label-floating">
													<label class="control-label" style="font-size:10px">Fecha de obtención de muestra</label>
													<label></label>
													<input type="date"  class="form-control" name="fechamuestra-reg" id="fechamuestra" required="">
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
										<button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
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
		<?php endif;?>
</div>
