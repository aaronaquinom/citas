<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i>Pacientes <small>datos</small></h1>
	</div>
	<p class="lead">
	Formulario para el registro de los datos de la persona</p>
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
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR PACIENTE
	  		</a>
	  	</li>
	</ul>
</div>

<!-- Panel nuevo cliente -->
<?php

?>
<div class="container-fluid">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVO PACIENTE</h3>
		</div>
		<div class="panel-body">				

			
			<form action ="<?php echo SERVERURL;?>ajax/pacienteAjax.php"  method="POST" data-form="" class="FormularioAjax" >
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-account-box"></i> &nbsp; Información personal</legend>
					
		    		<div class="container-fluid">
		    			<div class="row">
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">DNI*</label>
								  	<input pattern="[0-9-]{1,30}" class="form-control" type="text" id="dni-paciente" name="dni-pa" required="" value="">
								</div>
		    				</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group label-floating">
									<label class="control-label">SIS*</label>
										<div class="radio radio-primary">
											<label>
												<input type="radio" name="optionSis" id="chkNo" value="<?php echo base64_encode('Si')?>">
																&nbsp; Si
											</label>				
											<label>
												<input type="radio" name="optionSis" id="chkYes" value="<?php echo base64_encode('No')?>">
																&nbsp; No
											</label>
										</div>				
								</div>
		    				</div>
						</div>
						<div class="row">		
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Nombres *</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombre-pa" required="" maxlength="30">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
								<div class="form-group label-floating">
								  	<label class="control-label">Apellidos *</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="apellido-pa" required="" maxlength="30">
								</div>
		    				</div>
							<div class="col-xs-12 col-sm-12">
								<div class="form-group label-floating">
								  	<label class="control-label">Domicilio *</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ-z0-9]{1,30}" class="form-control" type="text" name="domicilio-pa" required="" maxlength="30">
								</div>
		    				</div>
						</div>	
						<div class="row">
		    				<div class="col-xs-12 col-sm-4">
							
								<div class="form-group label-floating">
								<label class="control-label">Departamento * <i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-ubigeo-basic-single" name="sel_depa" style="width:100%" id="sel_departamento">
													
												</select>	
								</div>
												
							</div>
							<div class="col-xs-12 col-sm-4">
								<div class="form-group label-floating">
								<label class="control-label">Provincia * <i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-ubigeo-basic-single" name="sel_prov" style="width:100%" id="sel_provincia">
													
												</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4">
								<div class="form-group label-floating">
								<label class="control-label">Distrito *<i class="zmdi zmdi-triangle-down"></i> </label>
												<select class="js-ubigeo-basic-single" name="sel_dist" style="width:100%" id="sel_distrito">
													
												</select>
								</div>
							</div>
						</div>
						<div class="row">
						<div class="col-xs-12 col-sm-6">
								<div class="form-group label-floating">
								  	<label class="control-label">Teléfono *</label>
								  	<input pattern="[0-9+]{1,15}" class="form-control" type="text" name="telefono-pa" required="" maxlength="15">
								</div>
		    				</div>
							
							<div class="col-xs-12 col-sm-6">
								<div class="form-group label-floating">
								  	<label class="control-label">Edad*</label>
								  	<input pattern="[0-9+]{1,15}" class="form-control" type="text" name="edad-pa" required="" maxlength="15">
								</div>
		    				</div>
							<div class="col-xs-12 col-sm-6">
								
								<div class="form-group label-floating">
								<label class="control-label" style="font-size:10px">Fecha de Nacimiento</label>
								<label></label>
							  	<input type="date"  class="form-control" name="fechanacimiento-pa" required="" value="">
								</div>
		    				</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group label-floating">
								  	<label class="control-label">Observaciones</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="obs-pa" required="" maxlength="30">
								</div>
		    				</div>
						
						</div>
		    		</div>
		    	</fieldset>
		    	<br>
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
</div>
<script>
$(document).ready(function(){
	$('.js-ubigeo-basic-single').select2();
    listar_departamento();  
});
</script>