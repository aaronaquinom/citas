<div class="container-fluid">
	<div class="page-header">
	<h1 class="text-titles"><i class="zmdi zmdi-gamepad zmdi-hc-fw"></i>Muestras <small>buscar</small></h1>
	</div>
	<p class="lead">
	Busque si el paciente tiene ya una muestra registrada
	</p>
</div>
<div class="container-fluid">
    <ul class="breadcrumb breadcrumb-tabs">
	  	<li>
	  		<a href="<?php echo SERVERURL;?>sample-list/" class="btn btn-info">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA  MUESTRAS
	  		</a>
	  	</li>
		<li>
	  		<a href="<?php echo SERVERURL;?>sample-reg/" class="btn btn-primary">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; REGISTRAR MUESTRA
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>sample-search/"class="btn btn-success">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR MUESTRA
	  		</a>
	  	</li>
	  
	</ul>
</div>
<?php
require_once "./controllers/sampleController.php";
$insMuestra= new sampleController();
if(isset($_POST['busqueda_inicial_muestra'])){
$_SESSION['busqueda_muestra']=$_POST['busqueda_inicial_muestra'];
}
if(isset($_POST['eliminar_busqueda_muestra'])){
unset($_SESSION['busqueda_muestra']);
}
if(!isset($_SESSION['busqueda_muestra']) && empty($_SESSION['busqueda_muestra'])):
?>
<div class="container-fluid">
	<form class="well" method="POST" action="">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<div class="form-group label-floating">
					<span class="control-label">¿Busque si paciente tiene muestra?</span>
					<input class="form-control" type="text" name="busqueda_inicial_muestra" required="">
				</div>
			</div>
			<div class="col-xs-12">
				<p class="text-center">
					<button type="submit" class="btn btn-primary btn-raised btn-sm"><i class="zmdi zmdi-search"></i> &nbsp; Buscar</button>
				</p>
			</div>
		</div>
	</form>
</div>
<?php
else:
?>
<div class="container-fluid">
	<form class="well" method ="POST" action="">
		<p class="lead text-center">Su última búsqueda  fue <strong>"<?php echo $_SESSION['busqueda_muestra']?>"</strong></p>
		<div class="row">
			<input class="form-control"  type="hidden" name="eliminar_busqueda_muestra" value="1">
			<div class="col-xs-12">
				<p class="text-center">
					<button type="submit" class="btn btn-danger btn-raised btn-sm"><i class="zmdi zmdi-delete"></i> &nbsp; Eliminar búsqueda</button>
				</p>
			</div>
		</div>
	</form>
</div>

<!-- Panel listado de busqueda de administradores -->
<div class="container-fluid">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-search"></i> &nbsp; BUSCAR MUESTRA</h3>
		</div>
		<div class="panel-body">
				<?php
					$pagina = explode("/", $_GET['vistas']);
						echo $insMuestra->paginador_muestra_controlador($pagina[1], 10, $_SESSION['privilegio_sli'], $pagina[0], "", "", $_SESSION['busqueda_muestra']);
										
				?>
		</div>
	</div>
</div>
<?php endif;?>