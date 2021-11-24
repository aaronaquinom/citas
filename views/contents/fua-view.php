<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i>Pacientes <small>datos</small></h1>
	</div>
	<p class="lead">
	Formulario para el registro de fua de los pacientes ehCOS</p>
</div>

<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
	  	<li>
	  		<a href="<?php echo SERVERURL;?>fua/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVO FUA
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>fua-list/"class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE FUAS
	  		</a>
	  	</li>
	  	
	</ul>
</div>

<!-- Panel nuevo cliente -->
<?php

?>
<div class="container-fluid">
		<header>
			<h4 class="text-primary py-3 text-center bg-light border-bottom border-primary border-4">CONSULTA AFILIADOS SIS</h4>
		</header>
		<!-- INICIO TABS -->
	  	<div class="row">

		  <form id ="frmConsultaSISdoc"  action="">
		    	
		    	<fieldset>
		    	
					
					<div class="container-fluid">	
						<div class="row">
                            
		    				<div class="col-xs-12 col-sm-3">
                                
								<div class="form-group label-floating">
									<label class="control-label">Tipo de documento * <i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-busqueda-basic-single" name="selTipoDoc" style="width:100%" id="selTipoDoc">
													<option value="1">DNI</option>
													<option value="3">Carnet extranjeria</option>
												</select>	
								</div>
												
							</div>
							
							<div class="col-xs-12 col-sm-3">
								<div class="form-group label-floating">
								  	<label class="control-label">Nro de documento*</label>
								  	<input pattern="[0-9+]{1,15}" class="form-control" type="text" id="txtNroDoc" name="txtNroDoc" required minlength="8">
								</div>
		    				</div>

							<div class="col-xs-12 col-sm-3">
								<p class="text-center" style="margin-top: 20px;">
									<button type="submit" class="btn btn-primary btn-raised btn-sm"><i class="zmdi zmdi-search"></i> Consultar</button>
								</p>
							</div>
							
						</div>
						
						
						
		    		</div>	
		    		
		    	</fieldset>	
			    
                
		    </form>
			
		<!-- FIN TABS -->
			<article>
				<section>
					
				</section>
				<section>
					<h3 class="text-primary bg-light p-3">Resultado de la consulta</h3>
					<div id="resultado" class="fs-3 fw-bold">
					
					</div>
				</section>
			</article>
		</div>
</div>
<div class="container-fluid">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; REGISTRO DEL FUA</h3>
		</div>
		<div class="panel-body">					
			<form action ="<?php echo SERVERURL;?>ajax/fuaAjax.php"  method="POST" data-form="" class="FormularioAjax">
				<input type="hidden" name="cod-empleado" value="<?php echo $lc->encryption($_SESSION['codigo_cuenta_sli']);?>">
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-account-box"></i> &nbsp; Información paciente</legend>
					
		    		<div class="container-fluid">
		    			<div class="row">
							<div class="col-xs-12 col-sm-12">
                            <label class="control-label-title">Datos generales:</label>
                            </div>
							<div class="col-xs-12 col-sm-1">
								<div class="form-group label-floating">
									<label class="control-label">TDI*</label>
									<input pattern="[0-9-]{1,30}" class="form-control" type="text" id="tdi-paciente"  name="tdi-pa" required="" value="">					
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-2">
						    	<div class="form-group label-floating">
								  	<label class="control-label">DNI*</label>
								  	<input pattern="[0-9-]{1,30}" class="form-control" type="text" id="dni-paciente" name="dni-pa"  value="">
								</div>
		    				</div>
							<div class="col-xs-12 col-sm-2">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Genero*</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" id="genero-paciente" name="genero-pa" required="" value="">
								</div>
		    				</div>
							<div class="col-xs-12 col-sm-2">
						    	<div class="form-group label-floating">
								  	<label class="control-label">F. Nacimiento*</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="date" id="nac-paciente" name="nac-pa" required="" value="">
								</div>
		    				</div>
							<div class="col-xs-12 col-sm-2">
						    	<div class="form-group label-floating">
								  	<label class="control-label">N.H. Clinica*</label>
								  	<input pattern="[0-9-]{1,30}" class="form-control" type="text" id="nhc-paciente" name="nhc-pa" required="" value="">
								</div>
		    				</div>
							<div class="col-xs-12 col-sm-3">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Etnia*</label>
								  	<!--<input pattern="[0-9-]{1,30}" class="form-control" type="text" id="etnia-paciente" name="etnia-pa" required="" value="">-->
									<select class='etnia' name='etnia' style="width:100%">
													<option value=''></option>
													<option value='56'>56 Afroperuano</option>
													<option value='57'>57 Blanco</option>
													<option value='58'>58 Mestizo</option>
													<option value='59'>59 Asiaticodescendiente</option>
													<option value='60'>60 Otro</option>
									</select>
								</div>
		    				</div>
							
						</div>
						<div class="row">		
							<div class="col-xs-12 col-sm-6">
								<div class="form-group label-floating">
								  	<label class="control-label">Apellido Paterno*</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" id="apPaterno" name="apellido1-pa" required="" maxlength="30">
								</div>
		    				</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group label-floating">
								  	<label class="control-label">Apellido Materno*</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" id="apMaterno" name="apellido2-pa" required="" maxlength="30">
								</div>
		    				</div>
							
							<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Primer Nombre*</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" id="nombre1" name="nombre1-pa" required="" maxlength="30">
								</div>
		    				</div>
							<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Otros Nombres</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text"  id="nombres" name="nombre2-pa" maxlength="30">
								</div>
		    				</div>
							</br>
		    				<div class="col-xs-12 col-sm-12">
                            <label class="control-label">Codigo del seguro:</label>
                            </div>
							<div class="col-xs-12 col-sm-4">
								<div class="form-group label-floating">
								  	<label class="control-label">Diresa/otros *</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ-z0-9]{1,30}" class="form-control" id="diresa" type="text" name="diresa-pa" required="" maxlength="30">
								</div>
		    				</div>
							<div class="col-xs-12 col-sm-4">
								<div class="form-group label-floating">
								  	<label class="control-label">Tipo *</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ-z0-9]{1,30}" class="form-control" id="tipoformato" type="text" name="tiposeguro-pa" required="" maxlength="30">
								</div>
		    				</div>
							<div class="col-xs-12 col-sm-4">
								<div class="form-group label-floating">
								  	<label class="control-label">Nro*</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ-z0-9]{1,30}" class="form-control" id="numerosis" type="text" name="nroseguro-pa" required="" maxlength="50">
								</div>
		    				</div>
						</div>			
		    		</div>
		    	</fieldset>
		    	<br>
		    	<br>
		    	<fieldset>
		    	
					<legend><i class="zmdi zmdi-star"></i> &nbsp; De la atención</legend>
					<div class="container-fluid">	
						<div class="row">
                            <div class="col-xs-12 col-sm-12">
                            <label class="control-label-title">Referencia realizada por:</label>
                            </div>
		    				<div class="col-xs-12 col-sm-2">
                                
								<div class="form-group label-floating">
								<label class="control-label">Departamento * <i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-ubigeo-basic-single" name="sel_depa" style="width:100%" id="sel_departamento">
													
												</select>	
								</div>
												
							</div>
							<div class="col-xs-12 col-sm-2">
								<div class="form-group label-floating">
								<label class="control-label">Provincia * <i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-ubigeo-basic-single" name="sel_prov" style="width:100%" id="sel_provincia">
													
												</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-2">
								<div class="form-group label-floating">
								<label class="control-label">Distrito *<i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-ubigeo-basic-single" name="sel_dist" style="width:100%" id="sel_distrito">
													
												</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-5">
								<div class="form-group label-floating">
								<label class="control-label">IPRESS *<i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-ubigeo-basic-single" name="sel_ipress" style="width:100%" id="sel_ipress">
													
												</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-1">
								<div class="form-group label-floating">
								  	<label class="control-label">H. Ref.</label>
								  	<input pattern="[0-9+]{1,15}" class="form-control" type="text" name="nroref"  maxlength="15">
								</div>
		    				</div>
							
						</div>
						
						<div class="row">
						  	
		    				<div class="col-xs-12 col-sm-2">
							
								<div class="form-group label-floating">
								<label class="control-label">Personal que atiende* <i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-fua-basic-single" name="cmbAtiende" style="width:100%" id="sel_atiende">
													
												</select>	
								</div>
												
							</div>
							<div class="col-xs-12 col-sm-2">
								<div class="form-group label-floating">
								<label class="control-label">Lugar de atención* <i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-fua-basic-single" name="cmbLugar" style="width:100%" id="sel_lugar">
													
												</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-2">
								<div class="form-group label-floating">
								<label class="control-label">Tipo de atención* <i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-fua-basic-single" name="cmbTipoatencion" style="width:100%" id="sel_tipoatencion">
													
												</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-3">
													<div class="form-group label-floating">
													<label class="control-label" style="font-size:10px">Fecha de ingreso</label>
													
													<input type="date"  class="form-control" name="fechaingreso">
													</div>
							</div>
							<div class="col-xs-12 col-sm-3">
													<div class="form-group label-floating">
													<label class="control-label" style="font-size:10px">Fecha de atención/alta</label>
													
													<input type="datetime-local"  class="form-control" name="fechaatencionalta" required="">
													</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-2">
								<div class="form-group label-floating">
								<label class="control-label">Concepto Prestacional* <i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-fua-basic-single" name="cmbConcepto" style="width:100%" id="sel_concepto">
													
												</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-2">
								<div class="form-group label-floating">
								<label class="control-label">Del destino* <i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-fua-basic-single" name="cmbDestino" style="width:100%" id="sel_destino">
													
												</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-8">
								<div class="form-group label-floating">
								<label class="control-label">Doctor* <i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-fua-basic-single" name="cmbDoctores" style="width:100%" id="sel_doctores">
													
												</select>
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12">
                            <label class="control-label-title">Se refiere/contrarefiere a:</label>
                            </div>
							<div class="col-xs-12 col-sm-2">
                                
								<div class="form-group label-floating">
								<label class="control-label">Departamento * <i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-ubigeoc-basic-single" name="sel_depac" style="width:100%" id="sel_departamentoc">
													
												</select>	
								</div>
												
							</div>
							<div class="col-xs-12 col-sm-2">
								<div class="form-group label-floating">
								<label class="control-label">Provincia * <i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-ubigeoc-basic-single" name="sel_provc" style="width:100%" id="sel_provinciac">
													
												</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-2">
								<div class="form-group label-floating">
								<label class="control-label">Distrito *<i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-ubigeoc-basic-single" name="sel_distc" style="width:100%" id="sel_distritoc">
													
												</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-5">
								<div class="form-group label-floating">
								<label class="control-label">IPRESS *<i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-ubigeoc-basic-single" name="sel_ipressc" style="width:100%" id="sel_ipressc">
													
												</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-1">
								<div class="form-group label-floating">
								  	<label class="control-label">C. Ref.</label>
								  	<input pattern="[0-9+]{1,15}" class="form-control" type="text" name="nroconref"  maxlength="30">
								</div>
		    				</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12">
                            	<label class="control-label-title">Tipo y nro de fua:</label>
                            </div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group label-floating">
									<label class="control-label">Fua impresa en* <i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-fua-basic-single" name="cmbTipofua" style="width:100%" id="sel_tipofua">
												
													
												</select>
								</div>
		    				</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group label-floating">
									<label class="control-label">Serie fua *</label>
									<input pattern="[0-9-]{1,30}" class="form-control" type="text" id="id-numerofua"  name="numero-fua" required="" value="">					
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
</div>
<script>

</script>