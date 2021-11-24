<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>Resultado<small> registrar</small></h1>
	</div>
	<p class="lead">
	Estos son los datos del paciente que va registrar su resultado final
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
	  		<a href="<?php echo SERVERURL;?>muestralist/"class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE MUESTRAS
	  		</a>
	  	</li>
	  	<li>
	  		<!--<a href="<?php echo SERVERURL;?>pacientesearch/" class="btn btn-primary">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR PACIENTES
	  		</a>-->
	  	</li>
	</ul>
</div>

<!-- Panel nuevo cliente -->
<div class="container-fluid">
<?php
		$datos=explode("/", $_GET['views']);
	
		if($datos[0]=="resultadof"):
			
			if($_SESSION['tipo_sli']!="Administrador")
			{
			echo $lc->forzar_cierre_session_controlador();
			}
			require_once "./controladores/resultadoControlador.php";
			
			$classResultado= new resultadoControlador();
			
			$filesP=$classResultado->datos_resultado_controlador("Unico",$datos[1]);

			if($filesP->rowCount()==1){
				$campos=$filesP->fetch();
		
				?>
			
				<div class="panel panel-info">
					<div class="panel-heading">
							<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVA MUESTRA</h3>
					</div>
						<div class="panel-body">				
							<form action ="<?php echo SERVERURL;?>ajax/resultadodosAjax.php"  method="POST" data-form="" class="FormularioAjax" >
								<input type="hidden" name="cod-resultado" value="<?php echo $datos[1]; ?>">
								<input type="hidden" name="cod-empleado" value="<?php echo $lc->encryption($_SESSION['codigo_cuenta_sli']);?>">
								<input type="hidden" name="cod-recepcion" value="<?php echo $lc->encryption($campos['Modificar']);?>">
								
								
									<fieldset>
										<legend><i class="zmdi zmdi-account-box"></i> &nbsp; Usted va dar el resultado definitivo de:</legend>
										
										<div class="container-fluid">
											<div class="row">
                                                <div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
														<label class="control-label">Codigo Lamina*</label>
														<input pattern="[0-9-]{1,30}" class="form-control" type="text" id="cod-lamina" name="codlamina-reg" required="" value="<?php echo $campos['reCodiLamina']; ?>" readonly>
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
														<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombre-reg" required="" value="<?php echo $campos['paNombre']; ?>" maxlength="30" readonly>
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
														<label class="control-label">Apellidos *</label>
														<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="apellido-reg" required="" value="<?php echo $campos['paApellidos']; ?>" maxlength="30"  readonly>
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
													<label class="control-label" style="font-size:10px">Fecha de resultado de la muestra</label>
													<label></label>
													<input type="date"  class="form-control" name="fecharegla-reg" required="" value="<?php echo $campos['reFeChaResultado']; ?>" maxlength="30"  readonly>
													</div>
												</div>
                                                <div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
													<label class="control-label" style="font-size:10px">Lugar de Procedencia</label>
													<label></label>
													<input type="text"class="form-control" name="procedencia-reg" required="" value="<?php echo $campos['esnombre']; ?>" maxlength="30"  readonly>
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
												<label class="control-label" style="font-size:10px">Primera Lectura</label>
													<div class="form-group">
														<input class="form-control" type="text" name="neomalignas-reg" id="txtmalignas" value="<?php echo $campos['Resultado'];?>" readonly>
													</div>
												</div>
                                    			</div>
											</div>
										</div>
										
									</fieldset>
									<br>
                                    <br>
									<fieldset>
										<legend><i class="zmdi zmdi-key"></i> &nbsp;Datos de resultados de la Muestra</legend>
										<div class="container-fluid">
											<div class="row">
                            					<div class="col-xs-12 col-sm-6">
													<div class="form-group">
														<label class="control-label">Obtener nueva muestra si o no </label>
														<div class="radio radio-primary">
															<label>
																<input type="radio" name="optionsNuevam" id="nuevaYes" value="<?php echo base64_encode('Si')?>">
																&nbsp; Si
															</label>
															<label>
																<input type="radio" name="optionsNuevam" id="nuevaNo" value="<?php echo base64_encode('No')?>">
																&nbsp; No
															</label>
														</div>
													
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group label-floating">
													<label class="control-label" style="font-size:10px">Fecha del resultado</label>
													<label></label>
													<input type="date"  class="form-control" name="fecha-resultado" required="">
													</div>
												</div>

											</div>
										</div>
										<div class="container-fluid">
											<div class="row">
												
												
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">1.-Calidad de especimen * <i class="zmdi zmdi-triangle-down"></i> </label>
                                                    	<br>
                                                            <?php 
                                                            require_once "./controladores/resultadoControlador.php";
                                                            $this->mode = new resultadoControlador();
                                                            ?>
                                                            
                                                            <select id="select-esp" name="cmbEspecimen" class="form-control" data-width="auto" size="4" disabled="disabled">
                                                                
                                                                <?php foreach ($this->mode->seleccionar_especimen_modelo() as $k) :?>
                                                                    <option title="<?php echo $k->esNombre;?> "id="<?php echo $k->idEspecimen ?>"value="<?php echo base64_encode($k->idEspecimen);?>">
                                                                        <?php echo utf8_encode($k->espNombre);?> <!--encode-->
                                                                    </option>
                                                                <?php endforeach;?>
                                                            </select>
                                                        
                                                    </div>
                                                                    
                                                </div>

												<div class="col-xs-12 col-sm-6">
													<div class="form-group">
														<input class="form-control" type="text" name="insatisfactorio-reg" id="txtinsatisfactorio" disabled="disabled"  placeholder="Insatisfactorio por">
														<input class="form-control" type="text" name="rechazado-reg" id="txtrechazado" disabled="disabled"   placeholder="Rechazado por">
														<input class="form-control" type="text" name="noprocesado-reg" id="txtprocesadorechazado" disabled="disabled"  placeholder="Procesado insatisfactorio">
													</div>
                                    
												</div>
	
												<div class="col-xs-12 col-sm-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">2.-Clasificación general <i class="zmdi zmdi-triangle-down"></i> </label>
                                                    	<br>
                                                            <?php 
                                                            require_once "./controladores/resultadoControlador.php";
                                                            $this->mode = new resultadoControlador();
                                                            ?>
                                                            
                                                            <select id="select-clas" name="cmbClasificacion" class="form-control" data-width="auto" size="3" disabled="disabled">
                                                                
                                                                <?php foreach ($this->mode->seleccionar_clasificacion_modelo() as $k) :?>
                                                                    <option title="<?php echo $k->clagNombre;?> " id="<?php echo $k->idClasificacionGeneral?>cla" value="<?php echo base64_encode($k->idClasificacionGeneral);?>">
                                                                        <?php echo $k->clagNombre;?>
                                                                    </option>
                                                                <?php endforeach;?>
                                                            </select>
                                                        
                                                    </div>
                                                                    
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="form-group">
														<input class="form-control" type="text" name="anormalidades-reg" id="txtanormalidades" disabled="disabled"  placeholder="Celulas epiteliales">
														<input class="form-control" type="text" name="otros-reg" id="txtotros" disabled="disabled"   placeholder="Glandular o escamoso">
														
													</div>
                                    
												</div>
										
											
												
											</div>
										</div>
										<div class="container-fluid">
											<div class="row">
											<br>
												<br>
												<div class="col-xs-12 col-sm-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">3.1.1.-Anormalidades de células epiteliales (células escamosas)<i class="zmdi zmdi-triangle-down"></i> </label>
                                                    	<br>
                                                            <?php 
                                                            require_once "./controladores/resultadoControlador.php";
                                                            $this->mode = new resultadoControlador();
                                                            ?>
                                                            
                                                            <select id="idcmbepiteliales" name="namecmbepiteliales" class="form-control" data-width="auto" disabled="disabled">
															
																<?php foreach ($this->mode->seleccionar_epiteliales_modelo() as $k) :?>
																	
                                                                    <option title="<?php echo $k->ceNombre;?> " id="<?php echo $k->idCelulasEpiteliales?>epi" value="<?php echo base64_encode($k->idCelulasEpiteliales);?>">
                                                                        <?php echo $k->ceNombre;?>
                                                                    </option>
                                                                <?php endforeach;?>
                                                            </select>
                                                        
                                                    </div>
                								</div>
												<div class="col-xs-12 col-sm-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Especifique celulas escamosas <i class="zmdi zmdi-triangle-down"></i> </label>
                                                    	<br>
                                                            <?php 
                                                            require_once "./controladores/resultadoControlador.php";
                                                            $this->mode = new resultadoControlador();
                                                            ?>
                                                            
                                                            <select id="cmbescamoso" name="cmbescamoso" class="form-control">
                                                                
                                    
                                                            </select>
                                                        
                                                    </div>
                                                                    
												</div>
											
												<div class="col-xs-12 col-sm-12">
													<div class="form-group">
														<input class="form-control" type="text" name="tipoescamoso-reg" id="txtescamoso" disabled="disabled"  placeholder="Carinona (tipo)">
														
														
													</div>
                                    
												</div>
											
											</div>
										</div>
										<div class="container-fluid">
											<div class="row">
											<br>
												<br>
												<div class="col-xs-12 col-sm-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">3.1.2.-Anormalidades de células epiteliales (células glandulares) <i class="zmdi zmdi-triangle-down"></i> </label>
                                                    	<br>
                                                            <?php 
                                                            require_once "./controladores/resultadoControlador.php";
                                                            $this->mode = new resultadoControlador();
                                                            ?>
                                                            
                                                            <select id="idcmbglandulares" name="namecmbglandulares" class="form-control" data-width="auto" disabled="disabled">
															
																<?php foreach ($this->mode->seleccionar_glandulares_modelo() as $k) :?>
																	
                                                                    <option title="<?php echo $k->mcgNombre;?> " id="<?php echo $k->idMCelulasGlandulares?>" value="<?php echo base64_encode($k->idMCelulasGlandulares);?>">
                                                                        <?php echo $k->mcgNombre;?>
                                                                    </option>
                                                                <?php endforeach;?>
                                                            </select>
                                                        
                                                    </div>
                								</div>
												<div class="col-xs-12 col-sm-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Especifique celulas glandulares <i class="zmdi zmdi-triangle-down"></i> </label>
                                                    	<br>
                                                            <?php 
                                                            require_once "./controladores/resultadoControlador.php";
                                                            $this->mode = new resultadoControlador();
                                                            ?>
                                                            
                                                            <select id="cmbglandular" name="cmbglandular" class="form-control">
                                                             </select>
                                                    </div>            
												</div>
											
												<div class="col-xs-12 col-sm-6">
													<div class="form-group">
														<input class="form-control" type="text" name="tipoeglandular-reg" id="txtglandular" disabled="disabled"  placeholder="Adenocarcicoma tipo">														
													</div>
												</div>
												
											</div>
										</div>
										<div class="container-fluid">
											<div class="row">
                            					<div class="col-xs-12 col-sm-12">
												<div class="form-group label-floating">
												<label class="control-label" style="font-size:10px">3.2.-Otras neoplasias malignas (especifique) </label>
												
													<div class="form-group">
														<input class="form-control" type="text" name="neomalignas-reg" id="txtmalignas" placeholder="->Otras neoplasias malignas (especifique)" disabled="disabled">
													</div>
												</div>
                                    			</div>
											</div>
										</div>
										<div class="container-fluid">
											<div class="row">
												
												
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">3.3.-Cambios celulares benignos<i class="zmdi zmdi-triangle-down"></i> </label>
                                                    	<br>
                                                            <?php 
                                                            require_once "./controladores/resultadoControlador.php";
                                                            $this->mode = new resultadoControlador();
                                                            ?>
                                                            
                                                            <select id="select-benignos" name="cmbBenignos" class="form-control" data-width="auto" size="6" disabled="disabled">
                                                                
                                                                <?php foreach ($this->mode->seleccionar_benignas_modelo() as $k) :?>
                                                                    <option title="<?php echo $k->cbNombre;?> "id="<?php echo $k->idCelulasBenignas?>ben" value="<?php echo base64_encode($k->idCelulasBenignas);?>">
                                                                        <?php echo $k->cbNombre;?>
                                                                    </option>
                                                                <?php endforeach;?>
                                                            </select>
                                                        
                                                    </div>
                                                                    
                                                </div>

												<div class="col-xs-12 col-sm-6">
													<div class="form-group">
														<input class="form-control" type="text" name="infeccionbe-reg" id="txtinfeccionbe" disabled="disabled"  placeholder="Tipo de microorganismo si lo hubiese">
														<input class="form-control" type="text" name="atrofiabe-reg" id="txtatrofiabe" disabled="disabled"   placeholder="Atrofia con inflación o sin inflamacion ">
														<input class="form-control" type="text" name="otrosbe-reg" id="txtotrosbe" disabled="disabled"  placeholder="Otros especifique">
													</div>
                                    
												</div>
	
											</div>
										</div>
										<div class="container-fluid">
											<div class="row">
												
												
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">4.-Evaluación hormonal <i class="zmdi zmdi-triangle-down"></i> </label>
                                                    	<br>
                                                            <?php 
                                                            require_once "./controladores/resultadoControlador.php";
                                                            $this->mode = new resultadoControlador();
                                                            ?>
                                                            
                                                            <select id="select-hormonal" name="cmbHormonal" class="form-control" data-width="auto" size="3" disabled="disabled">
                                                                
                                                                <?php foreach ($this->mode->seleccionar_hormonal_modelo() as $k) :?>
                                                                    <option title="<?php echo $k->hoNombre;?> "id="<?php echo $k->idHormonal?>hor" value="<?php echo base64_encode($k->idHormonal);?>">
                                                                        <?php echo $k->hoNombre;?>
                                                                    </option>
                                                                <?php endforeach;?>
                                                            </select>
                                                        
                                                    </div>
                                                                    
                                                </div>

												<div class="col-xs-12 col-sm-6">
													<div class="form-group">
														<input class="form-control" type="text" name="hormonaledad-reg" id="txthormonaledad" disabled="disabled"  placeholder="Discrepancia con la edad (especifique) ">
														<input class="form-control" type="text" name="hormonalno-reg" id="txthormonalno" disabled="disabled"   placeholder="Valoración hormonal no posible por">
														
													</div>
                                    
												</div>
	
											</div>
										</div>
										<div class="container-fluid">
											<div class="row">
                            					<div class="col-xs-12 col-sm-12">
												<div class="form-group label-floating">
												<label class="control-label" style="font-size:10px">Conclusiones y sugerencias</label>
												
													<div class="form-group">
														<input class="form-control" type="text" name="conclusiones-reg" id="txtconclusiones" placeholder="->Conclusiones y sugerencias" required>
													</div>
												</div>
                                    			</div>
											
											</div>
										</div>
									

										
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