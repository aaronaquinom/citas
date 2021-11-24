<section class="vprincipal">
	<section class="flotando">
	<div class="logoentradapanel">
		<div class="logoentrada"><img src="<?php echo SERVERURL; ?>views/assets/img/irenlogo.png"></div>
		<div class="entexto"></div>
	</div>
	<div class="estadoentradas">
		<div id="irpaguno" class="encirculo activo">1</div>
		<div id="irpagdos" class="encirculo desactivo">2</div>
		<div id="irpagtres" class="encirculo desactivo">3</div>
		<div id="irpagcuatro" class="encirculo desactivo">4</div>
		<div id="irpagcinco" class="encirculo desactivo">5</div>
	</div>
	<section class="zlidrcenter" id="zldrcontent">
			<div id="pos1" class="panelshow formulas">
				<h2>INGRESE SU DNI</h2>
	 			<input pattern="[0-9-]{1,30}" type="text" id="eldni" name="tipo-eve" >
	 			<button id="btnVerififca" type="submit" class="btn">Consultar</button>
	 	  </div>
			<div id="pos2" class="panelshowdos formulas">
	 			<h2>Datos del asegurado</h2>
				<div class="lineaform">
				  	<label class="control-label" >Número de documento</label>
						<input pattern="[0-9-]{1,30}" type="text" id="dni-pa" name="dni-pa" maxlength="15" readonly>
				</div>
				<div class="lineaform">
					<label class="control-label">Apellido Paterno</label>
					<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" type="text" id="apPaterno" name="apellido1-pa"  maxlength="40" readonly>
				</div>
				<div class="lineaform">
					<label class="control-label">Apellido Materno</label>
					<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" type="text" id="apMaterno" name="apellido2-pa"  maxlength="40" readonly>
				</div>
				<div class="lineaform">
					<label class="control-label">Primer Nombre</label>
					<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}"  type="text" id="nombre1" name="nombre1-pa"  maxlength="30" readonly>
				</div>
				<div class="lineaform">
					<label class="control-label">Otros Nombres</label>
					<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" type="text"  id="nombres" name="nombre2-pa" maxlength="30" readonly>
				</div>
				<div class="lineaform">
					<label class="control-label">Fecha de Nacimiento</label>
					<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" type="text"  id="nombres" name="nombre2-pa" maxlength="30" readonly>
				</div>


	 			<button id="btnVerififca" type="submit" class="btn">Siguiente</button>
 			</div>

			<div id="pos3" class="panelshowdos formulas">
				<h2>Comuniquémonos</h2>
	 			<h3>Para confirmar su cita, escriba su correo electrónico y numero de celular</h3>
				<div class="lineaformlarge">
					<label class="control-label">Correo electrónico*</label>
					<input pattern="+@+." type="text" id="email" name="correo-pa" required="" value="" maxlength="100">
				</div>
				<div class="lineaformcorto">
					<label class="control-label">Celular*</label>
					<input pattern="[0-9-]{1,30}" type="text" id="celular" name="celular-pa" required="" value="" maxlength="9">
				</div>
	 			<button id="btnVerififca" type="submit" class="btn">Siguiente</button>
 			</div>
		<div  id="pos4" class="panelshow formulas">
			<h2>Es usted</h2>
			<h3>¿Paciente nuevo o continuador?</h3>
			<div class="lineaformlarge">
				<label class="control-label">Seleccione*</label>
				<select class='inscripcion' name='genero-pa' style="width:100%">
							<option value=''> </option>
							<option value='0'>Soy nuevo paciente</option>
							<option value='1'>Soy un paciente continuador</option>
				</select>
				<label class="control-label">Usted requiere cita para*</label>
				<select class='inscripcion' name='genero-pa' style="width:100%">
							<option value=''> </option>
							<option value='0'>Cirugía oncológica</option>
							<option value='1'>Soy un paciente continuador</option>
				</select>
			</div>

			<button id="btnVerififca" type="submit" class="btn">Siguiente</button>
		</div>
  	<div id="pos5" class="panelshow formulas">
	 			<h2>Paso 5</h2>

	 		  <button id="btnVerififca" type="submit" class="btn"> Consultar</button>
 			</div>

	</section>
	<div class="tutorial">
		<div class="videos">

		</div>
	</div>
</section>

<script>
// $('#pos1').show();
$(window).on("resize", methodToFixLayout);

function methodToFixLayout( e ) {
 var win = $(window).width();
 $('#zldrcontent').width(win);
 $('#pos1').width(win);
 $('#pos2').width(win);
 $('#pos3').width(win);
 $('#pos4').width(win);
 $('#pos5').width(win);
}

$('#irpaguno').click(function() {
   event.preventDefault();
 	$('#pos2').fadeOut("slow");
 	$('#pos4').fadeOut("slow");
 	$('#pos3').fadeOut("slow");
 	$('#pos5').fadeOut("slow");
	// $('#pos1').show();
 	$('#pos1').fadeIn("slow");
});
$('#irpagdos').click(function() {
   event.preventDefault();
	 $('#pos1').fadeOut("slow");
	 $('#pos2').fadeOut("slow");
	 $('#pos4').fadeOut("slow");
	 $('#pos5').fadeOut("slow");
	 // $('#pos2').show();
	 $('#pos2').fadeIn("slow");
});
$('#irpagtres').click(function() {
	event.preventDefault();
	 $('#pos1').fadeOut("slow");
	 $('#pos2').fadeOut("slow");
	 $('#pos4').fadeOut("slow");
	 $('#pos5').fadeOut("slow");
	 // $('#pos3').show();
	 $('#pos3').fadeIn("slow");

});
$('#irpagcuatro').click(function() {
	event.preventDefault();
	 $('#pos1').fadeOut("slow");
	 $('#pos2').fadeOut("slow");
	 $('#pos3').fadeOut("slow");
	 $('#pos5').fadeOut("slow");
	 // $('#pos4').show();
	 $('#pos4').fadeIn("slow");
});
$('#irpagcinco').click(function() {
	event.preventDefault();
	 $('#pos1').fadeOut("slow");
	 $('#pos2').fadeOut("slow");
	 $('#pos3').fadeOut("slow");
	 $('#pos4').fadeOut("slow");
	 // $('#pos5').show();
	 $('#pos5').fadeIn("slow");
});


</script>
