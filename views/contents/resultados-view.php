<div class="container-fluid">
	<div class="page-header">
	<h1 class="text-titles"><i class="zmdi zmdi-book  zmdi-hc-fw"></i>Resultado <small>para imprimir</small></h1>
	</div>
	<p class="lead">Esta es la lista de las muestras que ya tienen RESULTADO
    </p>
</div>
<div class="container-fluid">
    <ul class="breadcrumb breadcrumb-tabs">
	  	<li>
	  		<a href="<?php echo SERVERURL;?>resultadofinal/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; REGISTRAR  RESULTADO
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>resultados/"class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA RESULTADO
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>resultadobuscar/" class="btn btn-primary">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR RESULTADO
	  		</a>
	  	</li>
	</ul>
</div>	
<?php
require_once "./controladores/resultadofinalControlador.php";
$insMuestra= new resultadodosControlador();
?>
<!-- Panel listado de administradores -->
<div class="container-fluid">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE MUESTRAS CON 1RA LECTURA</h3>
		</div>
		<div class="panel-body">
			
				<?php
					$pagina = explode("/", $_GET['views']);
					echo $insMuestra->paginador_resultadodos_controlador($pagina[1], 10, $_SESSION['privilegio_sli'], " ");
				?>
		
		</div>
	</div>
</div>