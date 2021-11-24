<div class="container-fluid">
	<div class="page-header">
	<h1 class="text-titles"><i class="zmdi zmdi-book  zmdi-hc-fw"></i>Resultado <small>para imprimir</small></h1>
	</div>
	<p class="lead">Esta es la lista del resultado final 
    </p>
</div>
<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
	  	<li>
	  		<a href="<?php echo SERVERURL;?>result/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; REGISTRAR  RESULTADO
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>result-list/"class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE RESULTADO
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>result-search/" class="btn btn-primary">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR RESULTADO
	  		</a>
	  	</li>
	</ul>
</div>	
<?php
require_once "./controllers/resultController.php";
$insMuestra= new resultController();
?>
<!-- Panel listado de administradores -->
<div class="container-fluid">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE MUESTRAS CON 1RA LECTURA</h3>
		</div>
		<div class="panel-body">
			
				<?php
					$pagina = explode("/", $_GET['vistas']);
                    echo $insMuestra->paginador_resultado_controlador($pagina[1], 10, $_SESSION['privilegio_sli'], $pagina[0], $_SESSION['tipo_sli'], $_SESSION['codigo_cuenta_sli'],"");
                    
				?>
		
		</div>
	</div>
</div>