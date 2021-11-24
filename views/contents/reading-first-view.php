<div class="container-fluid">
	<div class="page-header">
	<h1 class="text-titles"><i class="zmdi zmdi-book  zmdi-hc-fw"></i>Lectura <small>registrar formulario</small></h1>
	</div>
	<p class="lead">
	Registre la primera lectura de las muestras que ya han sido aceptadas por el IREN CENTRO
	</p>
</div>
<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
	  	<li>
	  		<a href="<?php echo SERVERURL;?>reading/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; REGISTRAR  1ra LECTURA
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>reading-list/"class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA 1RA LECTURA
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>reading-search/" class="btn btn-primary">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR 1ra LECTURA
	  		</a>
	  	</li>
	</ul>
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
		if($datos[0]=="reading-first"):
			
			if($_SESSION['tipo_sli']!="Administrador" && $_SESSION['tipo_sli']!="Tecnologo")
			{
			echo $lc->forzar_cierre_session_controlador();
			}
			require_once "./controllers/receptionController.php";
			
			$classResultado= new receptionController();
			
			$filesP=$classResultado->datos_recepcion_controlador("Unico",$datos[1]);

			if($filesP->rowCount()==1){
				$campos=$filesP->fetch();
		
				?>
			
				<div class="panel panel-info">
					<div class="panel-heading">
							<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVA MUESTRA</h3>
					</div>
						<div class="panel-body">				
							<form action ="<?php echo SERVERURL;?>ajax/firstreadingAjax.php"  method="POST" data-form="" class="FormularioAjax" >
								<input type="hidden" name="cod-registro" value="<?php echo $datos[1]; ?>">
								<input type="hidden" name="cod-empleado" value="<?php echo $lc->encryption($_SESSION['codigo_cuenta_sli']);?>">
								
								
								
									<fieldset>
										<legend><i class="zmdi zmdi-account-box"></i> &nbsp; Usted va dar los resultados de:</legend>
										
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
													<label class="control-label" style="font-size:10px">Fecha de recepción de la muestra</label>
													<label></label>
													<input type="date"  class="form-control" name="fecharegla-reg" required="" value="<?php echo $campos['srDateReception']; ?>" maxlength="30"  readonly>
													</div>
												</div>

										
												
											</div>
										</div>
									</fieldset>
									<br>
									<br>
									<fieldset>
										<legend><i class="zmdi zmdi-key"></i> &nbsp;Datos de 1ra lectura de la Muestra</legend>
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
								                    <label class="control-label">1.- Calidad de especimen* <i class="zmdi zmdi-triangle-down"></i> </label>
												    <select class="js-especimen-basic-single" name="cmbEspecimendos" style="width:100%" id="sel_especimen">
													
												    </select>	
								                     </div>                    
                                                </div>

												<div class="col-xs-12 col-sm-6">
                                                    <div class="form-group label-floating">
								                    <label class="control-label">Detalle especimen* <i class="zmdi zmdi-triangle-down"></i> </label>
												    <select class="js-especimen-basic-single" name="cmbEspecimen" style="width:100%" id="sel_detalleespecimen">
													
												    </select>
								                    </div>
                                    
												</div>
                                                <div class="col-xs-12 col-sm-12">
													<div class="form-group">
                                                    <label class="control-label">Especifique más si lo desea</label>
														<input class="form-control" type="text" name="obsespecimen-reg" id="txtespecimen" placeholder="....">
														
														
													</div>
                                    
												</div>											
											</div>
										</div>
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group label-floating">
								                    <label class="control-label">2.-Clasificación general <i class="zmdi zmdi-triangle-down"></i> </label>
												    <select class="js-clasificacion-basic-single" name="sel_cla" style="width:100%" id="sel_clasificacion">
													
												    </select>	
								                    </div>
                                                </div>     
												<div class="col-xs-12 col-sm-6">
                                                    <div class="form-group label-floating">
								                    <label class="control-label">Detalle clasificacion* <i class="zmdi zmdi-triangle-down"></i> </label>
												    <select class="js-clasificacion-basic-single" name="cmbClasificacion" style="width:100%" id="sel_detalleclasificacion">
													
												    </select>
								                    </div>
                                    			</div>
                                                <div class="col-xs-12 col-sm-12">
													<div class="form-group">
                                                    <label class="control-label">Especifique más si lo desea</label>
														<input class="form-control" type="text" name="obsclasificacion-reg" id="txtclasificacion" placeholder="....">
														
														
													</div>
                                    
												</div>
                                            </div>
                                        </div>
										<div class="container-fluid">
											<div class="row">
                                                <div class="col-xs-12 col-sm-12">
                                                <label class="control-label">3.-Interpretación descriptiva</label>
                                                </div>
												<br>
												<div class="col-xs-12 col-sm-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">3.1.1.-Anormalidades de células epiteliales (células escamosas)<i class="zmdi zmdi-triangle-down"></i> </label>
                                                    	<br>
                                                        <select class="js-escamosa-basic-single" name="sel_esc" style="width:100%" id="sel_escamosa">
													
												        </select>                                          
                                                    </div>
                								</div>
												<div class="col-xs-12 col-sm-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Especifique celulas escamosas <i class="zmdi zmdi-triangle-down"></i> </label>
                                                    	<br>
                                                        <select class="js-escamosa-basic-single" name="cmbescamoso" style="width:100%" id="sel_detalleescamosa">
													
												        </select>                                                
                                                    </div>
                                                                    
												</div>
												<div class="col-xs-12 col-sm-12">
													<div class="form-group">
														<input class="form-control" type="text" name="tipoescamoso-reg" id="txtescamoso" placeholder="Carcinona (tipo)">
														
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
                                                        <select class="js-glandular-basic-single" name="sel_gla" style="width:100%" id="sel_glandular">
													
												        </select> 
                                                        
                                                    </div>
                								</div>
												<div class="col-xs-12 col-sm-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Especifique celulas glandulares <i class="zmdi zmdi-triangle-down"></i> </label>
                                                    	<br>
                                                        <select class="js-glandular-basic-single" name="cmbglandular" style="width:100%" id="sel_detalleglandular">
													
                                                        </select> 
                                                    </div>            
												</div>
											
												<div class="col-xs-12 col-sm-12">
													<div class="form-group">
														<input class="form-control" type="text" name="tipoglandular-reg" id="txtglandular" placeholder="Adenocarcinoma tipo">														
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
                                                        <select class="js-benigno-basic-single" name="sel_ben" style="width:100%" id="sel_benigno">
													
                                                        </select> 
                                                        
                                                    </div>
                                                                    
                                                </div>

												<div class="col-xs-12 col-sm-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Especifique celulas benignas<i class="zmdi zmdi-triangle-down"></i> </label>
                                                    <br>
                                                    <select class="js-benigno-basic-single" name="cmbBenignos" style="width:100%" id="sel_detallebenigno">
													
                                                    </select>
													</div>
                                    
												</div>
                                                <div class="col-xs-12 col-sm-12">
												    <div class="form-group label-floating">
												    <label class="control-label" style="font-size:10px">Especifique si asi lo desea </label>
												
													<div class="form-group">
														<input class="form-control" type="text" name="obsbenigno-reg" id="txtbenignos" placeholder="......">
													</div>
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
                                                        <select class="js-hormonal-basic-single" name="sel_hor" style="width:100%" id="sel_hormonal">
													
                                                        </select>
                                                        
                                                    </div>
                                                                    
                                                </div>

												<div class="col-xs-12 col-sm-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Especifique evaluación hormonal<i class="zmdi zmdi-triangle-down"></i> </label>
                                                    <br>
                                                    <select class="js-hormonal-basic-single" name="cmbHormonal" style="width:100%" id="sel_detallehormonal">
													
                                                    </select>
														
													</div>
                                    
												</div>
                                                <div class="col-xs-12 col-sm-12">
												    <div class="form-group label-floating">
												    <label class="control-label" style="font-size:10px">Especifique más si asi lo desea </label>
												
													<div class="form-group">
														<input class="form-control" type="text" name="obshormonal" id="txthormonal" placeholder="......">
													</div>
												    </div>
                                    			</div>
	
											</div>
										</div>
										<div class="container-fluid">
											<div class="row">
                                            <div class="col-xs-12 col-sm-12">
												<div class="form-group label-floating">
												<label class="control-label" style="font-size:10px">Conclusiones y sugerencias*</label>
												
                                                    <select class="js-conclusion-basic-single" name="cmbconclusiones" style="width:100%" id="sel_conclusion">
													
                                                    </select>
												</div>
                                    			</div>
                                                    
                            					<div class="col-xs-12 col-sm-12">
												<div class="form-group label-floating">
												<label class="control-label" style="font-size:10px">Especifique más si asi lo desea</label>
												
													<div class="form-group">
														<input class="form-control" type="text" name="conclusiones-reg" id="txtconclusiones" placeholder="->Conclusiones y sugerencias" autocomplete="off">
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
<script>
$(document).ready(function(){
	$('.js-especimen-basic-single').select2();
    listar_especimenes();  
});
</script>
<script>
$(document).ready(function(){
	$('.js-clasificacion-basic-single').select2();
    listar_clasificaciones();  
});
</script>  
<script>
$(document).ready(function(){
	$('.js-escamosa-basic-single').select2();
    listar_escamosas();   
});
</script>
<script>
$(document).ready(function(){
	$('.js-glandular-basic-single').select2();
    listar_glandular();  
});
</script>
<script>
$(document).ready(function(){
	$('.js-benigno-basic-single').select2();
    listar_benigno();  
});
</script>
<script>
$(document).ready(function(){
	$('.js-hormonal-basic-single').select2();
    listar_hormonal();  
});
</script>    
<script>
$(document).ready(function(){
	$('.js-conclusion-basic-single').select2();
    listar_conclusiones();
});
</script>