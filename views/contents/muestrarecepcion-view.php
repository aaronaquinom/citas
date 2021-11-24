<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-truck zmdi-hc-fw"></i>Recepción <small> de muestras</small></h1>
	</div>
	<p class="lead">
	Lista de muestras registradas en los distintos Centros de Salud (terceros), para ser recepcionadas
	seleccione en el boton NO
	</p>
</div>
<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
	  	<li>
	  		<a href="<?php echo SERVERURL;?>muestrarecepcion/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; RECEPCIONAR  MUESTRAS
	  		</a>
	  	</li>
		  
		  <li>
	  		<a href="<?php echo SERVERURL;?>muestralistar/"class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTAR X ESTABLECIMIENTO
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>recepcionlist/"class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; MUESTRAS RECEPCIONADAS
	  		</a>
	  	</li>
		
	  	<li>
	  		<a href="<?php echo SERVERURL;?>recepcionsearch/" class="btn btn-primary">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR RECEPCION
	  		</a>
	  	</li>
	</ul>
</div>
<?php
require_once "./controladores/muestraControlador.php";
$insMuestra= new muestraControlador();
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
					echo $insMuestra->paginador_muestra_controlador_no($pagina[1], 10, $_SESSION['privilegio_sli'], " ");
				?>
		
		</div>
	</div>
</div>