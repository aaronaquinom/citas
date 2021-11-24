<?php 
	if($_SESSION['tipo_sli']!="Administrador")
	{
	echo $lc->forzar_cierre_session_controlador();
	}
?>
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Colaboradores <small>Usuarios</small></h1>
	</div>
	<p class="lead">
	Formulario para ingresar usuarios del sistema
	</p>
</div>

<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
	  	<li>
	  		<a href="<?php echo SERVERURL;?>employee/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVO COLOBORADOR
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>employee-list/" class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE COLABORADORES
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>employee-search/" class="btn btn-primary">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR COLOBORADOR
	  		</a>
	  	</li>
	</ul>
</div>

<!-- Panel nuevo cliente -->
<div class="container-fluid">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVO USUARIO</h3>
		</div>
		<div class="panel-body">
			<form action ="<?php echo SERVERURL;?>ajax/employeeAjax.php"  method="POST" data-form="" class="FormularioAjax" enctype="multipart/form-data" >
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-account-box"></i> &nbsp; Información personal</legend>
		    		<div class="container-fluid">
		    			<div class="row">
		    				<div class="col-xs-12">
						    	<div class="form-group label-floating">
								  	<label class="control-label">DNI*</label>
								  	<input pattern="[0-9-]{1,30}" class="form-control" type="text" name="dni-reg" required="" maxlength="30">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Nombres *</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombre-reg" required="" maxlength="30">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
								<div class="form-group label-floating">
								  	<label class="control-label">Apellidos *</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="apellido-reg" required="" maxlength="30">
								</div>
		    				</div>
		    			
							<div class="col-xs-12 col-sm-6">
								<div class="form-group label-floating">
								  	<label class="control-label">Profesión</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="especialista-reg" maxlength="15">
								</div>
		    				</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group label-floating">
								  	<label class="control-label">Unidad/oficina</label>
								  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="obs-reg" maxlength="15">
								</div>
		    				</div>
						</div>
					
		    			
		    		</div>
		    	</fieldset>
		    	<br>
				<br>
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-key"></i> &nbsp; Datos de la cuenta</legend>
		    		<div class="container-fluid">
		    			<div class="row">
		    				<div class="col-xs-12">
					    		<div class="form-group label-floating">
								  	<label class="control-label">Nombre de usuario *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{1,15}" class="form-control" type="text" name="usuario-reg" required="" maxlength="15">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
								<div class="form-group label-floating">
								  	<label class="control-label">Contraseña *</label>
								  	<input class="form-control" type="password" name="password1-reg" required="" maxlength="70">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
								<div class="form-group label-floating">
								  	<label class="control-label">Repita la contraseña *</label>
								  	<input class="form-control" type="password" name="password2-reg" required="" maxlength="70">
								</div>
		    				</div>
							
		    				
		    				<!--<div class="col-xs-12 col-sm-6">
								<div class="form-group label-floating">
								  	<label class="control-label">E-mail</label>
								  	<input class="form-control" type="email" name="email-reg" maxlength="50">
								</div>
		    				</div>-->
		    				<div class="col-xs-12">
								<div class="form-group">
									<label class="control-label">Genero</label>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="optionsGenero" id="optionsRadios1" value="Masculino" checked="">
											<i class="zmdi zmdi-male-alt"></i> &nbsp; Masculino
										</label>
									</div>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="optionsGenero" id="optionsRadios2" value="Femenino">
											<i class="zmdi zmdi-female"></i> &nbsp; Femenino
										</label>
									</div>
								</div>
		    				</div>
		    			</div>
		    		</div>
		    	</fieldset>
		    	<br>
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-star"></i> &nbsp; Nivel de privilegios</legend>
		    		<div class="container-fluid">
		    			<div class="row">
		    				<div class="col-xs-12 col-sm-6">
							<?php if( $_SESSION['privilegio_sli']==1):
								
							?>
								<div class="radio radio-primary">
									<p class="text-left">
										<div class="label label-success">Nivel 1</div> Control total del sistema
									</p>
								</div>
							<?php
								endif;
							?>

							<?php if( $_SESSION['privilegio_sli']<=2):
							?>
								<div class="radio radio-primary">
									<p class="text-left">
			                        <div class="label label-primary">Nivel 2</div> Permiso para registro 
			                    </p>
								</div>
							<?php endif?>

					    		
			                    
			                 
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
								<?php if( $_SESSION['privilegio_sli']==1):
								
								?>
								<div class="radio radio-primary">
									<label>
										<input type="radio" name="optionsPrivilegio" id="optionsRadios1" value="<?php echo $lc->encryption(1);?>">
										<i class="zmdi zmdi-star"></i> &nbsp; Nivel 1
									</label>
								</div>
								<?php
								endif;
								?>
								<?php if( $_SESSION['privilegio_sli']<=2):
								?>
								<div class="radio radio-primary">
									<label>
										<input type="radio" name="optionsPrivilegio" id="optionsRadios2" value="<?php echo $lc->encryption(2);?>">
										<i class="zmdi zmdi-star"></i> &nbsp; Nivel 2
									</label>
								</div>
								<?php endif?>
								
		    				</div>
		    			</div>
		    		</div>
		    	</fieldset>
				<fieldset>
		    		<legend><i class="zmdi zmdi-star"></i> &nbsp; Tipo de Usuario</legend>
		    		<div class="container-fluid">
		    			<div class="row">
						<div class="col-xs-12 col-sm-6">
							<?php if( $_SESSION['privilegio_sli']==1):
								
							?>
								<div class="radio radio-primary">
									<p class="text-left">
									<div class="label label-info">Administrador</div> Registro de usuarios
									</p>
								</div>
							<?php
								endif;
							?>

							<?php if( $_SESSION['privilegio_sli']<=2):
							?>
								<div class="radio radio-primary">
									<p class="text-left">
			                        <div class="label label-info">Registrador</div> Registro de fuas
			                    </p>
								</div>
							<?php endif?>

					    		
			                    
			                 
		    				</div>
		    			<div class="col-xs-12 col-sm-6">
								<?php if( $_SESSION['privilegio_sli']==1):
								
								?>
								<div class="radio radio-primary">
									<label>
										<input type="radio" name="optionsUserType" id="optionsUsers1" value="<?php echo $lc->encryption(1);?>">
										<i class="zmdi zmdi-star"></i> &nbsp; Administrador
									</label>
								</div>
								<?php
								endif;
								?>
								<?php if( $_SESSION['privilegio_sli']<=2):
								?>
								<div class="radio radio-primary">
									<label>
										<input type="radio" name="optionsUserType" id="optionsUsers2" value="<?php echo $lc->encryption(2);?>">
										<i class="zmdi zmdi-star"></i> &nbsp; Registrador
									</label>
								</div>
								<?php endif?>
							
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
$(document).ready(function(){
	$('.js-example-basic-single').select2();
    listar_red();  
});
</script>