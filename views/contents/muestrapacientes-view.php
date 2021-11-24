<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-gamepad zmdi-hc-fw"></i>Muestras <small>pacientes</small></h1>
	</div>
	<p class="lead">
	Esta es la lista de todas los pacientes con muestras registradas en los distintos Centros de Salud (terceros)
	</p>
</div>

<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
	  	<li>
	  		<a href="<?php echo SERVERURL;?>muestrapacientes/" class="btn btn-info">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA  MUESTRAS
	  		</a>
	  	</li>
		<li>
	  		<a href="<?php echo SERVERURL;?>regmuestras/" class="btn btn-primary">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; REGISTRAR MUESTRA
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>muestrasearchs/"class="btn btn-success">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR MUESTRA
	  		</a>
	  	</li>
	  
	</ul>
</div>
<?php
require_once "./controladores/muestraControlador.php";
$insPaciente= new muestraControlador();
?>
<!-- Panel listado de administradores -->
<div class="container-fluid">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE MUESTRAS</h3>
		</div>
		<div class="panel-body">
			
				<?php
					$pagina = explode("/", $_GET['views']);
					echo $insPaciente->paginador_muestra_controlador_admin($pagina[1], 10, $_SESSION['privilegio_sli'], " ");
				?>
		
		</div>
	</div>
</div>