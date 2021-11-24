<div class="container-fluid">
	<div class="page-header">
	<h1 class="text-titles"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i>Pacientes <small>busqueda</small></h1>
	</div>
	<p class="lead">
	Busque al paciente si no lo ubica debe registrarlo previamente.
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
<?php
require_once "./controllers/employeeController.php";
$insEmpleado= new employeeController();
if(isset($_POST['busqueda_inicial_empleado'])){
$_SESSION['busqueda_empleado']=$_POST['busqueda_inicial_empleado'];
}
if(isset($_POST['eliminar_busqueda_empleado'])){
unset($_SESSION['busqueda_empleado']);
}
if(!isset($_SESSION['busqueda_empleado']) && empty($_SESSION['busqueda_empleado'])):
?>
<div class="container-fluid">
	<form class="well" method="POST" action="">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<div class="form-group label-floating">
					<span class="control-label">¿A quién estas buscando?</span>
					<input class="form-control" type="text" name="busqueda_inicial_empleado" required="">
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
		<p class="lead text-center">Su última búsqueda  fue <strong>"<?php echo $_SESSION['busqueda_empleado']?>"</strong></p>
		<div class="row">
			<input class="form-control"  type="hidden" name="eliminar_busqueda_empleado" value="1">
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
			<h3 class="panel-title"><i class="zmdi zmdi-search"></i> &nbsp; BUSCAR EMPLEADO</h3>
		</div>
		<div class="panel-body">
				<?php
					$pagina = explode("/", $_GET['vistas']);
                    echo $insEmpleado->paginador_empleado_controlador($pagina[1], 10, $_SESSION['privilegio_sli'], $_SESSION['usuario_id'], $pagina[0], $_SESSION['busqueda_empleado']);
				?>
		</div>
	</div>
</div>
<?php endif;?>