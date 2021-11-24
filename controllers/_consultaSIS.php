<?php
	$nombres="";
	$apellidoPat="";
	$apellidoMat="";
	$tipoDoc="";
	$nroDoc="";

	/*$form="formDoc";
	$tipoDoc="1";
	$nroDoc="43197389";*/
	// $nroDoc="44218402";

	// $url = "http://dpidesalud.minsa.gob.pe/sis/afiliado/v1.0/afiliado?wsdl";
	$url = "https://ws3.pide.gob.pe/services/MinsaAfiliadoSis?wsdl";

	$tipoDoc=$_POST['selTipoDoc'];
	$nroDoc=$_POST['txtNroDoc'];
		try {
			$client = new SoapClient($url, [ "trace" => 1 ] );
			$result = $client->afiliadoSis( [ "tiDocumento" => $tipoDoc, "nuDocumento" => $nroDoc ] );
			//print_r($result);

		} catch ( SoapFault $e ) {
			echo $e->getMessage();
		};

		/*$nombres = $result->afiliadoDetalle->nombres;
		$apPat = $result->afiliadoDetalle->apePaterno;
		$apMat = $result->afiliadoDetalle->apeMaterno;
		$estado = $result->afiliadoDetalle->estado;
		$error = $result->afiliadoDetalle->codError;
		$contrato = $result->afiliadoDetalle->contrato;
		$disa = $result->afiliadoDetalle->disa;
		$eess = $result->afiliadoDetalle->eess." - ".$result->afiliadoDetalle->descEESS;
		$tipoSeguro = $result->afiliadoDetalle->descTipoSeguro;
		$fecNacimiento = $result->afiliadoDetalle->fecNacimiento;
		$fecNacimiento = substr($fecNacimiento,-2)."/".substr($fecNacimiento,-4,2)."/".substr($fecNacimiento,0,4);



	//echo PHP_EOL;*/
	//$arreglo["data"]=$result;
	echo json_encode($result);

?>
