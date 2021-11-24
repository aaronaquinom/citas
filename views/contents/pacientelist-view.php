<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i>Pacientes <small>personas</small></h1>
	</div>
	<p class="lead">
	Lista de pacientes registrados en la base de datos
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
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR PACIENTE
	  		</a>
	  	</li>
	</ul>
</div>
<?php
require_once "./controladores/pacienteControlador.php";
$insPaciente= new pacienteControlador();
?>
<!-- Panel listado de administradores -->
<div class="container-fluid">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE PACIENTES</h3>
		</div>
		<div class="panel-body">
			
				<?php
					$pagina = explode("/", $_GET['views']);
					echo $insPaciente->paginador_paciente_controlador($pagina[1], 10, $_SESSION['privilegio_sli'], " ");
				?>
		
		</div>
	</div>
</div>