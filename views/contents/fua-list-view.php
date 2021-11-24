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
	  		<a href="<?php echo SERVERURL;?>fua/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVO FUA
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>fua-list/"class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE FUAS
	  		</a>
	  	</li>
	  	
	</ul>
</div>
<?php
require_once "./controllers/patientController.php";
$insPaciente= new patientController();
?>
<!-- Panel listado de administradores -->
<div class="container-fluid">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE FUAS</h3>
		</div>
		<table id="fuas" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>idfua</th>
					<th>fuaNro</th>
					<th>fuaDateAttentions</th>
                    <th>Tipo Documento</th>
                    <th>Documento</th>
                    <th>Apellido P.</th>
                    <th>Apellido M.</th>
                    <th>Nombre</th>
                    <th>Otros Nombres</th>
					<th>imprimir</th>
					
				</tr>
			</thead>
			<tfoot>
				<tr>
                    <th>idfua</th>
					<th>fuaNro</th>
					<th>fuaDateAttentions</th>
                    <th>Tipo Documento</th>
                    <th>Documento</th>
                    <th>Apellido P.</th>
                    <th>Apellido M.</th>
                    <th>Nombre</th>
                    <th>Otros Nombres</th>
                    <th>imprimir</th>
					
				</tr>
        	</tfoot>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<script>
$(document).ready(function(){
    listar_fuas();  
});
</script>