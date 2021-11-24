<div class="container-fluid">
	<div class="page-header">
	<h1 class="text-titles"><i class="zmdi zmdi-truck zmdi-hc-fw"></i>Recepción <small> busqueda</small></h1>
      
	</div>
	<p class="lead">
	Busque si ya se encuentra la muestra en el Iren Centro.
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
require_once "./controladores/registroControlador.php";
$insPaciente= new registroControlador();
if(isset($_POST['busqueda_inicial_registro'])){
$_SESSION['busqueda_registro']=$_POST['busqueda_inicial_registro'];
}
if(isset($_POST['eliminar_busqueda_registro'])){
unset($_SESSION['busqueda_registro']);
}
if(!isset($_SESSION['busqueda_registro']) && empty($_SESSION['busqueda_registro'])):
?>
<div class="container-fluid">
	<form class="well" method="POST" action="">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<div class="form-group label-floating">
					<span class="control-label">¿Busque si se recepciono la muestra?</span>
					<input class="form-control" type="text" name="busqueda_inicial_registro" required="">
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
		<p class="lead text-center">Su última búsqueda  fue <strong>"<?php echo $_SESSION['busqueda_registro']?>"</strong></p>
		<div class="row">
			<input class="form-control"  type="hidden" name="eliminar_busqueda_registro" value="1">
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
			<h3 class="panel-title"><i class="zmdi zmdi-search"></i> &nbsp; MUESTRA RECEPCIONADAS</h3>
		</div>
		<div class="panel-body">
				<?php
					$pagina = explode("/", $_GET['views']);
					echo $insPaciente->paginador_registro_controlador($pagina[1], 10, $_SESSION['privilegio_sli'], $_SESSION['busqueda_registro']);
				?>
		</div>
	</div>
</div>
<?php endif;?>