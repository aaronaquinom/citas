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
	  		<a href="<?php echo SERVERURL;?>patient/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVO PACIENTE
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>patient-list/"class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE PACIENTES
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL;?>patient-search/" class="btn btn-primary">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR PACIENTE
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
			<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE PACIENTES</h3>
		</div>
		<table id="example" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>paDNI</th>
					<th>paName</th>
					<th>paLastName</th>
					<th>paAge</th>
					<th>paAdress</th>
					<th>paSisYesNo</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>paDNI</th>
					<th>paName</th>
					<th>paLastName</th>
					<th>paAge</th>
					<th>paAdress</th>
					<th>paSisYesNo</th>
				</tr>
        	</tfoot>
			<tbody>
			</tbody>
		</table>
	</div>
</div>


<script>
$(document).ready(function(){
    listar_pacientes();  
});
</script>