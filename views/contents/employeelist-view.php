<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Usuarios <small>ADMINISTRADORES</small></h1>
	</div>
	<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates officiis sapiente sunt dolorem, velit quos a qui nobis sed, dignissimos possimus!</p>
</div>

<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
	  	<li>
	  		<a href="<?php echo SERVERURL;?>empleado/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVO COLOBORADOR
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>empleadolist/" class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE COLABORADORES
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>empleadosearch/" class="btn btn-primary">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR COLOBORADOR
	  		</a>
	  	</li>
	</ul>
</div>
<?php
require_once "./controllers/employeeController.php";
$insEmpleado= new employeeController();
?>
<!-- Panel listado de administradores -->
<div class="container-fluid">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE EMPLEADOS</h3>
		</div>
		<div class="panel-body">
			
				<?php
					$pagina = explode("/", $_GET['vistas']);
					echo $insEmpleado->paginador_empleado_controlador($pagina[1], 2, $_SESSION['privilegio_sli'], $_SESSION['usuario_id'], $pagina[0],"");
				?>
		</div>
	</div>
</div>