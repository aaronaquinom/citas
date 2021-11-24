<div class="container-fluid">
	<div class="page-header">
	<h1 class="text-titles"><i class="zmdi zmdi-book  zmdi-hc-fw"></i>Resultado <small>buscar</small></h1>
      
	</div>
	<p class="lead">
	Busque si ya se encuentra la muestra en el Iren Centro.
	</p>
</div>
<div class="container-fluid">
    <ul class="breadcrumb breadcrumb-tabs">
        <li>
	  		<a href="<?php echo SERVERURL;?>result-sample/" class="btn btn-primary">
              <i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA RESULTADO
	  		</a>
	  	</li>
          
    
        <li>
	  		<a href="<?php echo SERVERURL;?>buscar-resultado/" class="btn btn-primary">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR RESULTADO
	  		</a>
	  	</li>
	</ul>
</div>
<?php
require_once "./controllers/resultController.php";
$insLectura= new resultController();
if(isset($_POST['busqueda_inicial_resultado'])){
$_SESSION['busqueda_resultado']=$_POST['busqueda_inicial_resultado'];
}
if(isset($_POST['eliminar_busqueda_resultado'])){
unset($_SESSION['busqueda_resultado']);
}
if(!isset($_SESSION['busqueda_resultado']) && empty($_SESSION['busqueda_resultado'])):
?>
<div class="container-fluid">
	<form class="well" method="POST" action="">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<div class="form-group label-floating">
					<span class="control-label">¿Busque si la muestra tiene resultado?</span>
					<input class="form-control" type="text" name="busqueda_inicial_resultado" required="">
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
		<p class="lead text-center">Su última búsqueda  fue <strong>"<?php echo $_SESSION['busqueda_resultado']?>"</strong></p>
		<div class="row">
			<input class="form-control"  type="hidden" name="eliminar_busqueda_resultado" value="1">
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
			<h3 class="panel-title"><i class="zmdi zmdi-search"></i> &nbsp; MUESTRAS CON LECTURA</h3>
		</div>
		<div class="panel-body">
				<?php
					$pagina = explode("/", $_GET['vistas']);
                    echo $insLectura->paginador_resultado_controlador($pagina[1], 10, $_SESSION['privilegio_sli'], $pagina[0], $_SESSION['tipo_sli'], $_SESSION['codigo_cuenta_sli'],$_SESSION['busqueda_resultado']);
				?>
		</div>
	</div>
</div>
<?php endif;?>