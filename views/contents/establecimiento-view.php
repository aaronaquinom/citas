<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Centros de salud <small>(Terceros)</small></h1>
	</div>
	<p class="lead">
	Este formulario sirve para registrar los centros de salud de donde traeran las laminas para ser analizadas en el IREN CENTRO,
	tenga en cuenta que es necesario este proceso previo para saber la procedencia de las laminas.
	</p>
</div>

<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
	  	<li>
	  		<a href="<?php echo SERVERURL;?>establecimiento/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVO CENTRO DE SALUD
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>establecimientolist/" class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE CENTRO DE SALUD
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>establecimientosearch/" class="btn btn-primary">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR CENTRO DE SALUD
	  		</a>
	  	</li>
	</ul>
</div>

<!-- Panel nuevo administrador -->
<div class="container-fluid">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVO CENTRO DE SALUD</h3>
		</div>
		<div class="panel-body">
			<form action="<?php echo SERVERURL;?>ajax/establecimientoAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off"
			enctype="multipart/form-data">
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-account-box"></i> &nbsp; Datos Generales</legend>
		    		<div class="container-fluid">
		    			<div class="row">
		    				<div class="col-xs-12">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Nombre Centro Salud *</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombre-reg" required="" maxlength="30">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Alguna Observación</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="obs-reg"  maxlength="30">
								</div>
		    				</div>
		    		
		    			</div>
		    		</div>
		    	</fieldset>
		    	<br>
		    	
			    <p class="text-center" style="margin-top: 20px;">
			    	<button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
			    </p>
				<div class="RespuestaAjax">

				</div>
			</form>
		</div>
	</div>
</div>