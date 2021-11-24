<?php
$peticionAjax=true;
require('../pdf/fpdf.php');
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/printModel.php";
/*$imprimirmuestra->laCodigo;*/
class PDF extends FPDF
{
//tabla
        protected $B = 0;
        protected $I = 0;
        protected $U = 0;
        protected $HREF = '';
    

    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../views/assets/img/irenlogo.png',10,8,23);
        // Arial bold 15
        $this->SetFont('Arial','B',18);
        // Movernos a la derecha
        $this->Cell(42);
        // Título
        $this->Cell(110,10,' REPORTE DE  RESULTADO FINAL',1,0,'C');
        $this->Ln(8);
        $this->SetFont('Arial','B',8);
        $this->Cell(200,10, utf8_decode('INSTITUTO REGIONAL DE ENFERMEDADES NEOPLÁSICAS'),0,1,'C');
        $this->Cell(200,1, utf8_decode('Av. Progreso N° 1235, 1237, 1239 Sector Palo Seco - Concepción-Junín'),0,1,'C');
        
        // Salto de línea
        $this->Ln(5);
        
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    function WriteHTML($html){
        // Intérprete de HTML
        $html = str_replace("\n",' ',$html);
        $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e){
        if($i%2==0){
        // Text
        if($this->HREF)
        $this->PutLink($this->HREF,$e);
        else
        $this->Write(5,$e);
        }else{
        // Etiqueta
        if($e[0]=='/')
        $this->CloseTag(strtoupper(substr($e,1)));
        else{
        // Extraer atributos
        $a2 = explode(' ',$e);
        $tag = strtoupper(array_shift($a2));
        $attr = array();
        foreach($a2 as $v){
        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
        $attr[strtoupper($a3[1])] = $a3[2];
        }
        $this->OpenTag($tag,$attr);
        }
        }
        }
    }
    function OpenTag($tag, $attr){
        // Etiqueta de apertura
        if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
        if($tag=='A')
        $this->HREF = $attr['HREF'];
        if($tag=='BR')
        $this->Ln(5);
        }
        
        function CloseTag($tag){
        // Etiqueta de cierre
        if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
        if($tag=='A')
        $this->HREF = '';
        
        }
        
        function SetStyle($tag, $enable){
        // Modificar estilo y escoger la fuente correspondiente
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach(array('B', 'I', 'U') as $s){
        if($this->$s>0)
        $style .= $s;
        }
        $this->SetFont('',$style);
        }
        
        function PutLink($URL, $txt){
        // Escribir un hiper-enlace
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
        }
}

$id=$_REQUEST['id'];
$codigoM=mainModel::decryptions($id);
$imprimirmuestra = new printModel();
$data=$imprimirmuestra->imprimir_resultado_modelo($codigoM);
$rows=$data->fetch();

//print_r($cuadrante);
//die();

$codigoLamina=$rows['reCodeLamina'];
$nombres=$rows['paName'];
$apellidos=$rows['paLastName'];
$paDNI=$rows['paDNI'];
$paDomicilio=$rows['paAdress'];
$paDistrito=$rows['disName'];
$paTelefono=$rows['paPhone'];
$paFechaNacimiento=$rows['paBirthdate'];
$paEdad=$rows['paAge'];

$hgFechaRegla=$rows['hgDateMestruation'];
$embarazada=$rows['hgPregnant'];
$anticonceptivo=$rows['hgContraceptive'];
$tipoanticonceptivo=$rows['hgTypeContraceptive'];
$exameng=$rows['hgExaminationNormalAb'];
$espexameng=$rows['hgSpecifyExamination'];
$responsableM=$rows['MResponsableNombre'];
$responsableA=$rows['MResponsableApellido'];
$profesion=$rows['ProfesionM'];
$colNormal= $rows['hgColposcopyYesNo'];
$papAnterior= $rows['hgPapPrevius'];
$Especifiquecol= $rows['hgSpecifyColposcopy'];
$hgFechaPapAnterior=$rows['hgDatePapPrevius']; 
$hgFechaMuestra=$rows['hgDateSample']; 

$hgSemanaEmbarazo=$rows['hgPregnantAge'];
$hgPartos=$rows['hgNumberPregnant'];
$hgAbortos=$rows['hgNumberAbortions'];

$hgIva=$rows['hgIva'];

$hgEdadReaciones=$rows['hgStarSexualRelacion']; 
$hgParejasSexuales=$rows['hgPartnersSexual'];

$resultcuadrante=new printModel();
$idhg=$rows['idGynecologicalHistory'];
$cuadrante=$resultcuadrante->imprimir_cuadrante_modelo($idhg);

$especimen=$rows['Especimen'];
$detalleespecimen=$rows['NombreEspecimen'];
$frObsSpecimen=$rows['frObsSpecimen'];

$clasificacion=$rows['Clasificacion'];
$declasificacion=$rows['dcName'];
$frObsClasificacion=$rows['frObsrClassification'];

$escamosa=$rows['Escamosa'];
$frCarcinoma=$rows['frCarcinoma'];
$glandular=$rows['Glandular'];
$frAdenocarcinoma=$rows['frAdenocarcinomaType'];

$frNeoplasiasMalignas=$rows['frNeoplasmsMalignant'];

$benigno=$rows['Benigno'];
$debenigno=$rows['dbName'];
$frObsBenigno=$rows['frObsBenign'];

$hormonal=$rows['Hormonal'];
$dehormonal=$rows['dhName'];
$frObsHormonal=$rows['frObsHornomal'];

$fecharesultado=$rows['reDateResult'];

$nombret=$rows['Lectura'];
$apellidot=$rows['LecturaA'];
$colegiaturat=$rows['ColegiaturaT'];

$firmat=$rows['FirmaT'];


$nombrem=$rows['ResultadoN'];
$apellidom=$rows['ResultadoA'];
$colegiaturam=$rows['ColegiaturaM'];

$firmam=$rows['FirmaM'];

$observacion=$rows['coName'];
$conclusion=$rows['reObsConclusion'];

$reNuevaMuestraSiNo=$rows['reNewSampleYesNo'];



$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Times','B',11);
$pdf->Ln(2);
$pdf->Cell(0,10, "Cod. del Lab: $codigoLamina ",1,0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(0,10, 'DATOS DEL PACIENTE:' ,1, 0,'L');
$pdf->SetFont('Times','',10);
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(40,10,"Apellidos y Nombres:",1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(150,10,utf8_decode("$apellidos, $nombres"),1 ,0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(18,10, "Domicilio:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(70,10, utf8_decode($paDomicilio) ,1 ,0, 'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(15,10, "Distrito:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(87,10, $paDistrito ,1 ,0, 'L');


$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(40,10, "Fecha de Nacimiento:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(48,10, $paFechaNacimiento ,1 ,0, 'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(15,10, "DNI:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(18,10, $paDNI ,1 ,0, 'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(17,10, "Edad:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(10,10, $paEdad ,1 ,0, 'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(18,10, "Telefono:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(24,10, $paTelefono ,1 ,0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode('HISTORIA GINECOLÓGICA:') ,1, 0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(102,10, utf8_decode('Examen Ginecológico:') ,1, 0,'L');
$pdf->SetFont('Times','',10);
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(40,10,"Fecha de ultima regla:",1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(48,10, $hgFechaRegla ,1 ,0, 'C');
if($exameng=="Normal"){
    $pdf->Cell(12,10, "Normal" ,1 ,0, 'C');
    $pdf->Cell(12,10, "X" ,1 ,0, 'C');
    $pdf->Cell(14,10, "Anormal " ,1 ,0, 'C');
    $pdf->Cell(12,10, " " ,1 ,0, 'C');
}
else{
    $pdf->Cell(12,10, "Normal" ,1 ,0, 'C');
    $pdf->Cell(12,10, " " ,1 ,0, 'C');
    $pdf->Cell(14,10, "Anormal " ,1 ,0, 'C');
    $pdf->Cell(12,10, "X" ,1 ,0, 'C');

}
$pdf->SetFont('Times','B',10);
$pdf->Cell(52,10,"Cuadrante:",1 ,0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(25,10, "Embarazada:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
if($embarazada=="Si"){
    $pdf->Cell(15,10, "Si" ,1 ,0, 'C');
    $pdf->Cell(16,10, "X" ,1 ,0, 'C');
    $pdf->Cell(17,10, "No " ,1 ,0, 'C');
    $pdf->Cell(15,10, " " ,1 ,0, 'C');
}else{
    $pdf->Cell(15,10, "Si" ,1 ,0, 'C');
    $pdf->Cell(16,10, " " ,1 ,0, 'C');
    $pdf->Cell(17,10, "No" ,1 ,0, 'C');
    $pdf->Cell(15,10, "X" ,1 ,0, 'C');
}
$pdf->SetFont('Times','B',10);
$pdf->Cell(50,10,"Especifique:",1 ,0, 'L');

$pdf->SetFont('Times','',10);
$c1=$cuadrante->rowCount();

if($c1>=1){
    $pdf->Cell(52,10,"",1 ,0, 'C');
    $pdf->SetY(106);
    $pdf->SetX(148);
    while($row=$cuadrante->fetch()){
        
        $pdf->Cell(13,10, $row['cgyName'],1,0,'L'); 
        }   
}
else{
    $pdf->Cell(52,10,"NO PRESENTA ",1 ,0, 'C');
}
//
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);

$pdf->SetY(116);

$pdf->MultiCell(25,10, "Anticonceptivo" ,1,'C');
$pdf->SetY(116);
$pdf->SetX(35);
$pdf->SetFont('Times','',10);
if($anticonceptivo=="Si"){
    $pdf->Cell(15,10, "Si" ,1 ,0, 'C');
    $pdf->Cell(16,10, "X" ,1 ,0, 'C');
    $pdf->Cell(17,10, "No " ,1 ,0, 'C');
    $pdf->Cell(15,10, " " ,1 ,0, 'C');
}else{
    $pdf->Cell(15,10, "Si" ,1 ,0, 'C');
    $pdf->Cell(16,10, " " ,1 ,0, 'C');
    $pdf->Cell(17,10, "No " ,1 ,0, 'C');
    $pdf->Cell(15,10, "X" ,1 ,0, 'C');
}

$pdf->SetY(116);
$pdf->SetX(98);
$pdf->MultiCell(50, 15,"$espexameng",0, 'L');
$pdf->SetY(116);
$pdf->SetX(148);
$pdf->MultiCell(52,30, $pdf->Image('../views/assets/img/cuadrante.jpg',160,115,30), 1,'C');
$pdf->Ln(-20);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(88,10, "Especifique tipo de metodo anticonceptivo y tiempo:" ,1,'C');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(88,10, "$tipoanticonceptivo" ,1,'C');
$pdf->SetFont('Times','B',10);


$pdf->Cell(35,10, "Inicio Relaciones" ,1 ,0, 'C');
$pdf->SetFont('Times','',10);
$pdf->Cell(16,10, "$hgEdadReaciones" ,1 ,0, 'C');
$pdf->SetFont('Times','B',10);
$pdf->Cell(22,10, "Parejas " ,1 ,0, 'C');
$pdf->SetFont('Times','',10);
$pdf->Cell(15,10, "$hgParejasSexuales " ,1 ,0, 'C');
$pdf->SetFont('Times','B',10);
$pdf->Cell(15,10, "Partos" ,1 ,0, 'C');
$pdf->SetFont('Times','',10);
$pdf->Cell(10,10, "$hgPartos" ,1 ,0, 'C');
$pdf->SetFont('Times','B',10);
$pdf->Cell(15,10, "Abortos " ,1 ,0, 'C');
$pdf->SetFont('Times','',10);
$pdf->Cell(10,10, "$hgAbortos " ,1 ,0, 'C');
$pdf->SetFont('Times','B',10);
$pdf->Cell(22,10, "IVA " ,1 ,0, 'C');
$pdf->SetFont('Times','',10);
$pdf->Cell(30,10, "$hgIva" ,1 ,0, 'C');


$pdf->ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode("Responsable de la obtención de las muestras:") ,1,'C');
$pdf->Cell(102,10, utf8_decode('Colposcopia:') ,1, 0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(25,10,"Nombre:",1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(63,10, "$responsableM, $responsableA",1 ,0, 'L');
switch($colNormal){
    case "Normal":
    $pdf->Cell(12,10, "Normal" ,1 ,0, 'C');
    $pdf->Cell(12,10, "X" ,1 ,0, 'C');
    $pdf->Cell(14,10, "Anormal " ,1 ,0, 'C');
    $pdf->Cell(12,10, " " ,1 ,0, 'C');
    break;
    case "Anormal":
    $pdf->Cell(12,10, "Normal" ,1 ,0, 'C');
    $pdf->Cell(12,10, " " ,1 ,0, 'C');
    $pdf->Cell(14,10, "Anormal " ,1 ,0, 'C');
    $pdf->Cell(12,10, "X" ,1 ,0, 'C');
    break;
    case "No":   
    $pdf->Cell(12,10, "Normal" ,1 ,0, 'C');
    $pdf->Cell(12,10, " " ,1 ,0, 'C');
    $pdf->Cell(14,10, "Anormal " ,1 ,0, 'C');
    $pdf->Cell(12,10, " " ,1 ,0, 'C'); 
    break;
}

$pdf->Cell(52,10,"$papAnterior",1 ,0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(25,10,utf8_decode("Profesión/cargo:"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(63,10, $profesion ,1 ,0, 'L');
$pdf->Cell(102,10, utf8_decode("Especifique:$Especifiquecol") ,1, 0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(48,10, utf8_decode("Fecha de oteción de Muestras:"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(40,10, $hgFechaMuestra ,1 ,0, 'C');
$pdf->SetFont('Times','B',10);
$pdf->Cell(50,10, utf8_decode("Fecha de diagnostico anterior:"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(52,10, $hgFechaPapAnterior ,1 ,0, 'C');
$pdf->Ln(10);


$pdf->SetFont('Times','B',10);
$pdf->Cell(190,10, utf8_decode('INFORME DE DIAGNÓSTICO CITÓLOGICO CÉRVICO UTERINO'),0,1,'C');

$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode('1) CALIDAD DEL ESPÉCIMEN:') ,1, 0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(102,10, utf8_decode('1.1 Detalle:') ,1, 0,'L');
$pdf->SetFont('Times','',10);
$pdf->Ln(10);
switch($especimen){
    case "1":
    $e1="X";
    $f1="";
    $g1="";
    $h1="";
    $pdf->Cell(10,10,"$e1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Espécimen satisfactorio para la evaluación"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode("$detalleespecimen"),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$f1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Espécimen insatisfactorio para la evaluacion"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$g1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Espécimen rechazado no procesado por:"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$h1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Espécimen procesado y examinado pero insatisfactorio"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    break;
    case "2":
    $f1="X";
    $e1="";
    $g1="";
    $h1="";
    $pdf->Cell(10,10,"$e1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Espécimen satisfactorio para la evaluación"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$f1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Espécimen insatisfactorio para la evaluacion"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode("$detalleespecimen"),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$g1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Espécimen rechazado no procesado por:"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$h1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Espécimen procesado y examinado pero insatisfactorio"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    break;
    case "3":
    $g1="X";
    $e1="";
    $f1="";
    $h1="";
    $pdf->Cell(10,10,"$e1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Espécimen satisfactorio para la evaluación"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$f1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Espécimen insatisfactorio para la evaluacion"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$g1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Espécimen rechazado no procesado por:"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode("$detalleespecimen"),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$h1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Espécimen procesado y examinado pero insatisfactorio"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    break;
    case "4":
    $h1="X";
    $g1="";
    $e1="";
    $f1="";
    $pdf->Cell(10,10,"$e1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Espécimen satisfactorio para la evaluación"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$f1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Espécimen insatisfactorio para la evaluacion"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$g1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Espécimen rechazado no procesado por:"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$h1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Espécimen procesado y examinado pero insatisfactorio"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode("$detalleespecimen"),1 ,0, 'L');
    $pdf->Ln(10);
    
    break;
}
$pdf->Ln(10);
$pdf->MultiCell(190,10,  utf8_decode("Descripción detalle: $frObsSpecimen") ,1,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode('2) CLASIFICACION GENERAL:') ,1, 0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(102,10, utf8_decode('2.1 Detalle:') ,1, 0,'L');
$pdf->SetFont('Times','',10);
$pdf->Ln(10);
switch ($clasificacion) {
    case "1":
    $cg1="X";
    $cg2="";
    $cg3="";
    $cg4="";
    
    $pdf->Cell(10,10,"$cg1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Negativo para lesiones intraepiteliales o malignidad"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode("$declasificacion"),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$cg2",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Anormalidades en células epiteliales:"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$cg3",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Otros"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    
    break;
    case "2":
    $cg1="";
    $cg2="X";
    $cg3="";
    $cg4="";
    $pdf->Cell(10,10,"$cg1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Negativo para lesiones intraepiteliales o malignidad"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$cg2",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Anormalidades en células epiteliales:"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode("$declasificacion"),1 ,0, 'L');    
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$cg3",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Otros"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    
    break;
    case "3":
    $cg1="";
    $cg2="";
    $cg3="X";
    $cg4="";
    $pdf->Cell(10,10,"$cg1",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Negativo para lesiones intraepiteliales o malignidad"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$cg2",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Anormalidades en células epiteliales:"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$cg3",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Otros"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode("$declasificacion"),1 ,0, 'L');  
    
    break;
    case "4":
    $cg1="";
    $cg2="";
    $cg3="";
    $cg4="";
    $pdf->Cell(10,10,"$cg4",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Negativo para lesiones intraepiteliales o malignidad"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$cg4",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Anormalidades en células epiteliales:"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,10,"$cg4",1 ,0, 'C');
    $pdf->Cell(78,10,utf8_decode("Otros"),1 ,0, 'L');
    $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
    break;
  
}
$pdf->Ln(10);
$pdf->MultiCell(190,10,  utf8_decode("Descripción detalle: $frObsClasificacion") ,1,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(190,10, utf8_decode("3) INTERPRETACIÓN DESCRIPTIVA:") ,1, 0,'L');
$pdf->Ln(10);
$pdf->Cell(190,10, utf8_decode("3.1. ANORMALIDADES DE CELULAS EPITELIALES") ,1, 0,'L');
$pdf->Ln(10);
$pdf->Cell(88,10, utf8_decode("3.1.1.Células escamosas:") ,1, 0,'L');
$pdf->Cell(102,10, utf8_decode("3.1.2.Células glandulares:") ,1, 0,'L');
switch($escamosa){
    case "1":
    $lineas="";
    $ce1="";
    $ce2="";
    $ce3="";
    $ce4="";
    $ce5="";
    $ce6="";
    $ce7="";
    $ce8="";
    $ce9="";
    break;
    case "2":
    $ce1="X";
    $ce2="";
    $ce3="";
    $ce4="";
    $ce5="";
    $ce6="";
    $ce7="";
    $ce8="";
    $ce9="";
    
    break;
    case "3":
    $ce1="";
    $ce2="X";
    $ce3="";
    $ce4="";
    $ce5="";
    $ce6="";
    $ce7="";
    $ce8="";
    $ce9="";
    break;
    case "4":
    $ce1="";
    $ce2="";
    $ce3="X";
    $ce4="";
    $ce5="";
    $ce6="";
    $ce7="";
    $ce8="";
    $ce9="";
    break;
    case "5":
    $ce1="";
    $ce2="";
    $ce3="";
    $ce4="X";
    $ce5="";
    $ce6="";
    $ce7="";
    $ce8="";
    $ce9="";
    break;
    case "6":
    $ce1="";
    $ce2="";
    $ce3="";
    $ce4="";
    $ce5="X";
    $ce6="";
    $ce7="";
    $ce8="";
    $ce9="";
    break;
    case "7":
    $ce1="";
    $ce2="";
    $ce3="";
    $ce4="";
    $ce5="";
    $ce6="X";
    $ce7="";
    $ce8="";
    $ce9="";
    break;
    case "8":
    $ce1="";
    $ce2="";
    $ce3="";
    $ce4="";
    $ce5="";
    $ce6="";
    $ce7="X";
    $ce8="";
    $ce9="";
    break;
    case "9":
    $ce1="";
    $ce2="";
    $ce3="";
    $ce4="";
    $ce5="";
    $ce6="";
    $ce7="";
    $ce8="X";
    $ce9="";
    break;
    case "10":
    $ce1="";
    $ce2="";
    $ce3="";
    $ce4="";
    $ce5="";
    $ce6="";
    $ce7="";
    $ce8="";
    $ce9="X";
    break;
}
switch($glandular){
    case "1":
    $m1="X";
    $n1="";
    $o1="";
    $p1="";
    $q1="";
    $r1="";
    $s1="";
    $t1="";
    $v1="";
       break;
    case "2":
    $m1="";
    $n1="X";
    $o1="";
    $p1="";
    $q1="";
    $r1="";
    $s1="";
    $t1="";
    $v1="";
    
    break;
    case "3":
    $m1="";
    $n1="";
    $o1="X";
    $p1="";
    $q1="";
    $r1="";
    $s1="";
    $t1="";
    $v1="";
    break;
    case "4":
    $m1="";
    $n1="";
    $o1="";
    $p1="X";
    $q1="";
    $r1="";
    $s1="";
    $t1="";
    $v1="";
    break;
    case "5":
    $m1="";
    $n1="";
    $o1="";
    $p1="";
    $q1="X";
    $r1="";
    $s1="";
    $t1="";
    $v1="";
    break;
    case "6":
    $m1="";
    $n1="";
    $o1="";
    $p1="";
    $q1="";
    $r1="X";
    $s1="";
    $t1="";
    $v1="";
    break;
    case "7":
    $m1="";
    $n1="";
    $o1="";
    $p1="";
    $q1="";
    $r1="";
    $s1="X";
    $t1="";
    $v1="";
    break;
    case "8":
    $m1="";
    $n1="";
    $o1="";
    $p1="";
    $q1="";
    $r1="";
    $s1="";
    $t1="X";
    $v1="";
    break;
    case "9":
    $m1="";
    $n1="";
    $o1="";
    $p1="";
    $q1="";
    $r1="";
    $s1="";
    $t1="";
    $v1="X";
    break;
}
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode("Células Escamosas atipicas") ,1, 0,'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','',10);
$pdf->Cell(5,10,"$ce1",1 ,0, 'C');
$pdf->Cell(83,10,utf8_decode("significación indeterminada(CEASI equivale ASCUS)"),1 ,0, 'L');
$pdf->Cell(10,10,"$n1",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Celulas endometriales benignas de tipo epitelial"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->Cell(5,10,"$ce2",1 ,0, 'C');
$pdf->SetFont('Times','',10);
$pdf->Cell(83,10,utf8_decode("No excluye LEIAG"),1 ,0, 'L');
$pdf->Cell(10,10,"$o1",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Celulas endometriales benignas de tipo estromal"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode("Lesión Escamosa Intraepitelial BAJO GRADO (LEIBG)") ,1, 0,'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(10,10,"$p1",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Celulas endometriales benignas  tipo epitelial postmenopáusica"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->Cell(5,10,"$ce3",1 ,0, 'C');
$pdf->Cell(83,10,utf8_decode("HPV"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(102,10,utf8_decode("Celulas glandulares atipicas AGC"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->Cell(5,10,"$ce4",1 ,0, 'C');
$pdf->Cell(83,10,utf8_decode("Displasia leve (NIC I)"),1 ,0, 'L');
$pdf->Cell(10,10,"$q1",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Endocervicales"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode("Lesión Escamosa Intraepitelial ALTO GRADO (LEIAG)") ,1, 0,'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(10,10,"$r1",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Endometriales"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->Cell(5,10,"$ce5",1 ,0, 'C');
$pdf->Cell(83,10,utf8_decode("HPV con atipia)"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(10,10,"$s1",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Otro tipo no especifico"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','',10);
$pdf->Cell(5,10,"$ce6",1 ,0, 'C');
$pdf->Cell(83,10,utf8_decode("Displasia Moderada (NIC II)"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
$pdf->Ln(10);
$pdf->Cell(5,10,"$ce7",1 ,0, 'C');
$pdf->Cell(83,10,utf8_decode("Displasia Severa (NIC III)"),1 ,0, 'L');
$pdf->Cell(10,10,"$t1",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Adenocarcicoma endocervical in situ"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->Cell(5,10,"$ce8",1 ,0, 'C');
$pdf->Cell(83,10,utf8_decode("Carcinoma in situ"),1 ,0, 'L');
$pdf->Cell(10,10,"$v1",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Adenocarcicoma tipo:"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$html1 = 'Carcinoma tipo';
$pdf->Cell(5,10,"$ce9",1 ,0, 'C');
$pdf->SetFont('Times','',10);
$pdf->Cell(83,10,utf8_decode("$html1, $frCarcinoma"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(190,10, utf8_decode("3.2 OTRAS NEOPLASIAS MALIGNAS (especifique):") ,1, 0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','',10);
$pdf->Cell(190,10, utf8_decode("$frNeoplasiasMalignas") ,1, 0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode('3.3 CAMBIOS CELULARES BENIGNOS:') ,1, 0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(102,10, utf8_decode('3.3.1 Detalle:') ,1, 0,'L');
$pdf->SetFont('Times','',10);
$pdf->Ln(10);

switch ($benigno) {


    case "1":
        $ceb1="X";
        $ceb2="";
        $ceb3="";
        $ceb4="";
        $ceb5="";
        $ceb6=""; 
        $pdf->Cell(10,10,"$ceb1",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Infección (tipo de microorganismo si lo hubiese):"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode("$debenigno"),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb2",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Inflamación"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb3",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Atrofia con:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb4",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Radiación"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb5",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("DIU"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb6",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Otros:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
            
        break;
        case "2":
        $ceb1="";
        $ceb2="X";
        $ceb3="";
        $ceb4="";
        $ceb5="";
        $ceb6="";
        $pdf->Cell(10,10,"$ceb1",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Infección (tipo de microorganismo si lo hubiese):"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb2",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Inflamación"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode("$debenigno"),1 ,0, 'L');
        
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb3",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Atrofia con:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb4",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Radiación"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb5",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("DIU"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb6",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Otros:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        
        
        break;
        case "3":
        $ceb1="";
        $ceb2="";
        $ceb3="X";
        $ceb4="";
        $ceb5="";
        $ceb6="";
        $pdf->Cell(10,10,"$ceb1",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Infección (tipo de microorganismo si lo hubiese):"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb2",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Inflamación"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb3",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Atrofia con:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode("$debenigno"),1 ,0, 'L');
        
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb4",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Radiación"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb5",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("DIU"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb6",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Otros:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        
       
        break;
        case "4":
        $ceb1="";
        $ceb2="";
        $ceb3="";
        $ceb4="X";
        $ceb5="";
        $ceb6="";
        $pdf->Cell(10,10,"$ceb1",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Infección (tipo de microorganismo si lo hubiese):"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb2",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Inflamación"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb3",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Atrofia con:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');       
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb4",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Radiación"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode("$debenigno"),1 ,0, 'L');
        
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb5",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("DIU"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb6",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Otros:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        
        
        
        break;
        case "5":
        $ceb1="";
        $ceb2="";
        $ceb3="";
        $ceb4="";
        $ceb5="X";
        $ceb6="";
        $pdf->Cell(10,10,"$ceb1",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Infección (tipo de microorganismo si lo hubiese):"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb2",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Inflamación"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb3",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Atrofia con:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');       
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb4",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Radiación"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb5",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("DIU"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode("$debenigno"),1 ,0, 'L');
        
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb6",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Otros:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        
        
        break;
        case "6":
        $ceb1="";
        $ceb2="";
        $ceb3="";
        $ceb4="";
        $ceb5="";
        $ceb6="X";
        $pdf->Cell(10,10,"$ceb1",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Infección (tipo de microorganismo si lo hubiese):"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb2",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Inflamación"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb3",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Atrofia con:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');       
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb4",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Radiación"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb5",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("DIU"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb6",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Otros:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode("$debenigno"),1 ,0, 'L');
        $pdf->Ln(10);
        break;
        case "7":
        $ceb1="";
        $ceb2="";
        $ceb3="";
        $ceb4="";
        $ceb5="";
        $ceb6="";
        $lineab="";
        $pdf->Cell(10,10,"$ceb1",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Infección (tipo de microorganismo si lo hubiese):"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb2",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Inflamación"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb3",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Atrofia con:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');       
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb4",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Radiación"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb5",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("DIU"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(10,10,"$ceb6",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Otros:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        break;
}

$pdf->MultiCell(190,10,  utf8_decode("Descripción detalle: $frObsBenigno") ,1,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode('4) EVALUACION HORMONAL:') ,1, 0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(102,10, utf8_decode('4.1 Detalle:') ,1, 0,'L');
$pdf->SetFont('Times','',10);
$pdf->Ln(10);
switch ($hormonal) {

    case "1":
        $ho1="X";
        $ho2="";
        $ho3="";
        $ho4="";
        $pdf->Cell(10,10,"$ho1",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Patron Hormonal compatible"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode("$dehormonal"),1 ,0, 'L'); 
        $pdf->Ln(10); 
        $pdf->Cell(10,10,"$ho2",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Patron Hormonal discrepancia con edad y clinica:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);    
        $pdf->Cell(10,10,"$ho3",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Valoración hormonal:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        break;
        case "2":
        $ho1="";
        $ho2="X";
        $ho3="";
        $ho4="";
        $pdf->Cell(10,10,"$ho1",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Patron Hormonal compatible"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10); 
        $pdf->Cell(10,10,"$ho2",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Patron Hormonal discrepancia con edad y clinica:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode("$dehormonal"),1 ,0, 'L'); 
       
        $pdf->Ln(10);    
        $pdf->Cell(10,10,"$ho3",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Valoración hormonal:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);
        
        break;
        case "3":
        $ho1="";
        $ho2="";
        $ho3="X";
        $ho4="";
        $pdf->Cell(10,10,"$ho1",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Patron Hormonal compatible"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10); 
        $pdf->Cell(10,10,"$ho2",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Patron Hormonal discrepancia con edad y clinica:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);    
        $pdf->Cell(10,10,"$ho3",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Valoración hormonal:"),1 ,0, 'L');
        
        $pdf->Cell(102,10,utf8_decode("$dehormonal"),1 ,0, 'L'); 
        $pdf->Ln(10);
        
        break;
        case "4":
        $ho1="";
        $ho2="";
        $ho3="";
        $ho4="V";
        $pdf->Cell(10,10,"$ho1",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Patron Hormonal compatible"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10); 
        $pdf->Cell(10,10,"$ho2",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Patron Hormonal discrepancia con edad y clinica:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');
        $pdf->Ln(10);    
        $pdf->Cell(10,10,"$ho3",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Valoración hormonal:"),1 ,0, 'L');
        
        $pdf->Cell(102,10,utf8_decode(""),1 ,0, 'L');; 
        $pdf->Ln(10);
        break;
    
}
$pdf->SetFont('Times','B',10);
$pdf->Cell(0,10, "CONCLUSIONES Y SUGERENCIAS" ,1, 0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,10, utf8_decode("$observacion,$conclusion") ,1,'L');

$pdf->SetFont('Times','B',10);
$pdf->Cell(25,10, "Nueva muestra" ,1,'C');
$pdf->SetFont('Times','',10);

if($reNuevaMuestraSiNo=="Si"){
    $pdf->Cell(15,10, "Si" ,1 ,0, 'C');
    $pdf->Cell(16,10, "X" ,1 ,0, 'C');
    $pdf->Cell(17,10, "No " ,1 ,0, 'C');
    $pdf->Cell(15,10, " " ,1 ,0, 'C');
}else{
    $pdf->Cell(15,10, "Si" ,1 ,0, 'C');
    $pdf->Cell(16,10, " " ,1 ,0, 'C');
    $pdf->Cell(17,10, "No " ,1 ,0, 'C');
    $pdf->Cell(15,10, "X" ,1 ,0, 'C');
}
$pdf->Cell(102,10,utf8_decode("Observación:"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode("Diagnostico Realizado en el laboratorio:") ,1, 0,'L');
$pdf->SetFont('Times','',8);
$pdf->Cell(102,10, utf8_decode(" IREN CENTRO") ,1, 0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode("Fecha:") ,1, 0,'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(102,10, utf8_decode("$fecharesultado") ,1, 0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(0,10,utf8_decode("DATOS DEL PROFESIONAL RESPONSABLE"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->Cell(88,10,utf8_decode("Apellidos y Nombres:"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(102,10, utf8_decode("$nombret $apellidot") ,1, 0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10,utf8_decode("Colegiatura:"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(102,10, utf8_decode("$colegiaturat") ,1, 0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(0,10,utf8_decode("DATOS DEL PROFESIONAL QUE CONFIRMA"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->Cell(88,10,utf8_decode("Apellidos y Nombres:"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(102,10, utf8_decode("$nombrem $apellidom") ,1, 0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10,utf8_decode("Colegiatura:"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(102,10, utf8_decode("$colegiaturam") ,1, 0,'L');
$pdf->Ln(12);
$pdf->Cell(62,30, utf8_decode("") ,0, 0,'L');
$pdf->Cell(64,30, $pdf->Image("$firmam",$pdf->GetX(), $pdf->GetY(),50),0, 'C');
$pdf->Cell(34,30, $pdf->Image("$firmat",$pdf->GetX(), $pdf->GetY(),50),0, 'C');
$html="";
$pdf->WriteHTML($html);
$pdf->Output();
?>