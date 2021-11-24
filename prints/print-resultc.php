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
        $this->Ln(1);
        
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
$data=$imprimirmuestra->imprimir_resultadofinal_modelo($codigoM);
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


$fecharecepcion=$rows['srDateReception'];

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
$frCarcinoma=$rows['reCarcinoma'];
$glandular=$rows['Glandular'];
$frAdenocarcinoma=$rows['reAdenocarcinomaType'];

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
$pdf->SetFont('Times','B',10);
$pdf->Cell(190,10, utf8_decode('DATOS DEL PACIENTE'),0,1,'C');

$pdf->Cell(0,5, "Cod. del Lab: $codigoLamina ",1,0,'L');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(40,5,"Apellidos y Nombres:",1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(150,5,utf8_decode("$apellidos, $nombres"),1 ,0, 'C');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(18,5, "Domicilio:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(70,5, utf8_decode($paDomicilio) ,1 ,0, 'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(15,5, "Distrito:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(87,5, $paDistrito ,1 ,0, 'L');


$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(40,5, "Fecha de Nacimiento:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(48,5, $paFechaNacimiento ,1 ,0, 'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(15,5, "DNI:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(18,5, $paDNI ,1 ,0, 'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(17,5, "Edad:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(10,5, $paEdad ,1 ,0, 'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(18,5, "Telefono:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(24,5, $paTelefono ,1 ,0, 'L');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);

$pdf->Cell(88,5, utf8_decode("Responsable de la obtención de las muestras:") ,1,'C');
$pdf->SetFont('Times','',10);
$pdf->Cell(102,5, utf8_decode("$responsableM, $responsableA"), 1, 0,'L');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(48,5, utf8_decode("Fecha de toma de muestra:"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(40,5, $hgFechaMuestra ,1 ,0, 'C');
$pdf->SetFont('Times','B',10);
$pdf->Cell(50,5, utf8_decode("Fecha de recepción:"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(52,5, $fecharecepcion ,1 ,0, 'C');
$pdf->Ln(5);


$pdf->SetFont('Times','B',10);
$pdf->Cell(190,10, utf8_decode('INFORME DE DIAGNÓSTICO CITÓLOGICO CÉRVICO UTERINO'),0,1,'C');

$pdf->SetFont('Times','B',10);
$pdf->Cell(88,5, utf8_decode('1) CALIDAD DEL ESPÉCIMEN:') ,1, 0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(102,5, utf8_decode('1.1 Detalle:') ,1, 0,'L');
$pdf->SetFont('Times','',10);
$pdf->Ln(5);
switch($especimen){
    case "1":
    $e1="X";
    $f1="";
    $g1="";
    $h1="";
    $pdf->Cell(10,5,"$e1",1 ,0, 'C');
    $pdf->Cell(78,5,utf8_decode("Espécimen satisfactorio para la evaluación"),1 ,0, 'L');
    $pdf->Cell(102,5,utf8_decode("$detalleespecimen"),1 ,0, 'L');
    break;
    case "2":
    $f1="X";
    $e1="";
    $g1="";
    $h1="";
    $pdf->Cell(10,5,"$f1",1 ,0, 'C');
    $pdf->Cell(78,5,utf8_decode("Espécimen insatisfactorio para la evaluacion"),1 ,0, 'L');
    $pdf->Cell(102,5,utf8_decode("$detalleespecimen"),1 ,0, 'L');
    break;
    case "3":
    $g1="X";
    $e1="";
    $f1="";
    $h1="";
    $pdf->Cell(10,5,"$g1",1 ,0, 'C');
    $pdf->Cell(78,5,utf8_decode("Espécimen rechazado no procesado por:"),1 ,0, 'L');
    $pdf->Cell(102,5,utf8_decode("$detalleespecimen"),1 ,0, 'L');
    break;
    case "4":
    $h1="X";
    $g1="";
    $e1="";
    $f1="";
    $pdf->Cell(10,5,"$h1",1 ,0, 'C');
    $pdf->Cell(78,5,utf8_decode("Espécimen procesado y examinado pero insatisfactorio"),1 ,0, 'L');
    $pdf->Cell(102,5,utf8_decode("$detalleespecimen"),1 ,0, 'L');    
    break;
}
$pdf->Ln(5);
$pdf->MultiCell(190,5,  utf8_decode("Descripción detalle: $frObsSpecimen") ,1,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,5, utf8_decode('2) CLASIFICACION GENERAL:') ,1, 0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(102,5, utf8_decode('2.1 Detalle:') ,1, 0,'L');
$pdf->SetFont('Times','',10);
$pdf->Ln(5);
switch ($clasificacion) {
    case "1":
    $cg1="X";
    $cg2="";
    $cg3="";
    $cg4="";
    
    $pdf->Cell(10,5,"$cg1",1 ,0, 'C');
    $pdf->Cell(78,5,utf8_decode("Negativo para lesiones intraepiteliales o malignidad"),1 ,0, 'L');
    $pdf->Cell(102,5,utf8_decode("$declasificacion"),1 ,0, 'L');
    
    break;
    case "2":
    $cg1="";
    $cg2="X";
    $cg3="";
    $cg4="";
    
    $pdf->Cell(10,5,"$cg2",1 ,0, 'C');
    $pdf->Cell(78,5,utf8_decode("Anormalidades en células epiteliales:"),1 ,0, 'L');
    $pdf->Cell(102,5,utf8_decode("$declasificacion"),1 ,0, 'L');    
    
    
    
    break;
    case "3":
    $cg1="";
    $cg2="";
    $cg3="X";
    $cg4="";
    $pdf->Cell(10,5,"$cg3",1 ,0, 'C');
    $pdf->Cell(78,5,utf8_decode("Otros"),1 ,0, 'L');
    $pdf->Cell(102,5,utf8_decode("$declasificacion"),1 ,0, 'L');  
    
    break;
    case "4":
    $cg1="";
    $cg2="";
    $cg3="";
    $cg4="";
    $pdf->Cell(10,5,"$cg4",1 ,0, 'C');
    $pdf->Cell(78,5,utf8_decode("Negativo para lesiones intraepiteliales o malignidad"),1 ,0, 'L');
    $pdf->Cell(102,5,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,5,"$cg4",1 ,0, 'C');
    $pdf->Cell(78,5,utf8_decode("Anormalidades en células epiteliales:"),1 ,0, 'L');
    $pdf->Cell(102,5,utf8_decode(""),1 ,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(10,5,"$cg4",1 ,0, 'C');
    $pdf->Cell(78,5,utf8_decode("Otros"),1 ,0, 'L');
    $pdf->Cell(102,5,utf8_decode(""),1 ,0, 'L');
    break;
  
}
$pdf->Ln(5);
$pdf->MultiCell(190,5,  utf8_decode("Descripción detalle: $frObsClasificacion") ,1,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(190,5, utf8_decode("3) INTERPRETACIÓN DESCRIPTIVA:") ,1, 0,'L');
$pdf->Ln(5);
$pdf->Cell(190,5, utf8_decode("3.1. ANORMALIDADES DE CELULAS EPITELIALES") ,1, 0,'L');
$pdf->Ln(5);
$pdf->Cell(88,5, utf8_decode("3.1.1.Células escamosas:") ,1, 0,'L');

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
    $pdf->Cell(102,5, utf8_decode("-------------") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("De significación indeterminada (CEASI, equivale a ASCUS)") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("ASC-H no excluye LEIAG") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("HPV") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("Displasia leve (NIC I)") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("HPV con atipia") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("Displasia Morada (NIC II)") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("Displacia Severa (NIC III)") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("Carcinoma in situ") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("Carcinoma de Células Escamosas (Tipo:)") ,1, 0,'L');
    $pdf->Ln(5);
    $pdf->MultiCell(190,5,  utf8_decode("Descripción carcinoma: $frCarcinoma") ,1,'L');
    $pdf->Ln(5);
    break;
}
$pdf->Cell(88,5, utf8_decode("3.1.2.Células glandulares:") ,1, 0,'L');
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
    $pdf->Cell(102,5, utf8_decode("-------------") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("Células endometriales benignas de tipo epitelial") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("Células endometriales benignas de tipo estromal") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("Células endometriales benignas de tipo epitelial, en mujer postmenopáusica") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("Endocervicales") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("Endometriales") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("Otro tipo no especifico") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("Adenocarcicoma endocervical in situ") ,1, 0,'L');
    $pdf->Ln(5);
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
    $pdf->Cell(102,5, utf8_decode("Adenocarcicoma, tipo") ,1, 0,'L');
    $pdf->Ln(5);
    $pdf->MultiCell(190,5,  utf8_decode("Descripción adenocarcinoma: $frAdenocarcinoma") ,1,'L');
    $pdf->Ln(5);
    break;
}
$pdf->SetFont('Times','B',10);
$pdf->Cell(190,5, utf8_decode("3.2 OTRAS NEOPLASIAS MALIGNAS (especifique):") ,1, 0,'L');
$pdf->Ln(5);
$pdf->SetFont('Times','',10);
$pdf->Cell(190,5, utf8_decode("$frNeoplasiasMalignas") ,1, 0,'L');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,5, utf8_decode('3.3 CAMBIOS CELULARES BENIGNOS:') ,1, 0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(102,5, utf8_decode('3.3.1 Detalle:') ,1, 0,'L');
$pdf->SetFont('Times','',10);

switch ($benigno) 
{
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
        $pdf->Ln(5);
        break;
        case "2":
        $ceb1="";
        $ceb2="X";
        $ceb3="";
        $ceb4="";
        $ceb5="";
        $ceb6="";   
        $pdf->Cell(10,10,"$ceb2",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Inflamación"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode("$debenigno"),1 ,0, 'L'); 
        $pdf->Ln(5);    
        break;
        case "3":
        $ceb1="";
        $ceb2="";
        $ceb3="X";
        $ceb4="";
        $ceb5="";
        $ceb6="";
        $pdf->Cell(10,10,"$ceb3",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Atrofia con:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode("$debenigno"),1 ,0, 'L');
        $pdf->Ln(5);       
        break;
        case "4":
        $ceb1="";
        $ceb2="";
        $ceb3="";
        $ceb4="X";
        $ceb5="";
        $ceb6="";
        
        $pdf->Cell(10,10,"$ceb4",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Radiación"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode("$debenigno"),1 ,0, 'L');
        $pdf->Ln(5); 
                
        break;
        case "5":
        $ceb1="";
        $ceb2="";
        $ceb3="";
        $ceb4="";
        $ceb5="X";
        $ceb6="";
        
        $pdf->Cell(10,10,"$ceb5",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("DIU"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode("$debenigno"),1 ,0, 'L');       
        $pdf->Ln(5); 
        break;
        case "6":
        $ceb1="";
        $ceb2="";
        $ceb3="";
        $ceb4="";
        $ceb5="";
        $ceb6="X";
        $pdf->Cell(10,10,"$ceb6",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Otros:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode("$debenigno"),1 ,0, 'L');
        $pdf->Ln(5);
        break;
        case "7":
        $ceb1="";
        $ceb2="";
        $ceb3="";
        $ceb4="";
        $ceb5="";
        $ceb6="";
        $lineab="";
        $pdf->Ln(5);
        break;
}
$pdf->MultiCell(190,10,  utf8_decode("Descripción detalle: $frObsBenigno") ,1,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,5, utf8_decode('4) EVALUACION HORMONAL:') ,1, 0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(102,5, utf8_decode('4.1 Detalle:') ,1, 0,'L');
$pdf->SetFont('Times','',10);

switch ($hormonal) {

    case "1":
        $ho1="X";
        $ho2="";
        $ho3="";
        $ho4="";
        $pdf->Cell(10,10,"$ho1",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Patron Hormonal compatible"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode("$dehormonal"),1 ,0, 'L'); 
        $pdf->Ln(5);
        break;
        case "2":
        $ho1="";
        $ho2="X";
        $ho3="";
        $ho4="";
        $pdf->Cell(10,10,"$ho2",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Patron Hormonal discrepancia con edad y clinica:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode("$dehormonal"),1 ,0, 'L'); 
       
        $pdf->Ln(5);    
        
        break;
        case "3":
        $ho1="";
        $ho2="";
        $ho3="X";
        $ho4="";   
        $pdf->Cell(10,10,"$ho3",1 ,0, 'C');
        $pdf->Cell(78,10,utf8_decode("Valoración hormonal:"),1 ,0, 'L');
        $pdf->Cell(102,10,utf8_decode("$dehormonal"),1 ,0, 'L'); 
        $pdf->Ln(5);
        
        break;
        case "4":
        $ho1="";
        $ho2="";
        $ho3="";
        $ho4="V";
        $pdf->Ln(5);
        break;    
}
$pdf->SetFont('Times','B',10);
$pdf->Cell(0,5, "CONCLUSIONES Y SUGERENCIAS" ,1, 0,'L');
$pdf->Ln(5);
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,10, utf8_decode("$observacion,$conclusion") ,1,'L');

$pdf->SetFont('Times','B',10);
$pdf->Cell(25,5, "Nueva muestra" ,1,'C');
$pdf->SetFont('Times','',10);

if($reNuevaMuestraSiNo=="Si"){
    $pdf->Cell(15,5, "Si" ,1 ,0, 'C');
    $pdf->Cell(16,5, "X" ,1 ,0, 'C');
    $pdf->Cell(17,5, "No " ,1 ,0, 'C');
    $pdf->Cell(15,5, " " ,1 ,0, 'C');
}else{
    $pdf->Cell(15,5, "Si" ,1 ,0, 'C');
    $pdf->Cell(16,5, " " ,1 ,0, 'C');
    $pdf->Cell(17,5, "No " ,1 ,0, 'C');
    $pdf->Cell(15,5, "X" ,1 ,0, 'C');
}
$pdf->Cell(102,5,utf8_decode("Observación:"),1 ,0, 'L');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,5, utf8_decode("Diagnostico Realizado en el laboratorio:") ,1, 0,'L');
$pdf->SetFont('Times','',8);
$pdf->Cell(102,5, utf8_decode(" IREN CENTRO") ,1, 0,'L');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,5, utf8_decode("Fecha:") ,1, 0,'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(102,5, utf8_decode("$fecharesultado") ,1, 0,'L');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(0,5,utf8_decode("DATOS DEL PROFESIONAL RESPONSABLE"),1 ,0, 'L');
$pdf->Ln(5);
$pdf->Cell(88,5,utf8_decode("Apellidos y Nombres:"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(102,5, utf8_decode("$nombret $apellidot") ,1, 0,'L');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,5,utf8_decode("Colegiatura:"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(102,5, utf8_decode("$colegiaturat") ,1, 0,'L');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(0,5,utf8_decode("DATOS DEL PROFESIONAL QUE CONFIRMA"),1 ,0, 'L');
$pdf->Ln(5);
$pdf->Cell(88,5,utf8_decode("Apellidos y Nombres:"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(102,5, utf8_decode("$nombrem $apellidom") ,1, 0,'L');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,5,utf8_decode("Colegiatura:"),1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(102,5, utf8_decode("$colegiaturam") ,1, 0,'L');
$pdf->Ln(12);
$pdf->Cell(62,30, utf8_decode("") ,0, 0,'L');
$pdf->Cell(64,30, $pdf->Image("$firmam",$pdf->GetX(), $pdf->GetY(),50),0, 'C');
$pdf->Cell(34,30, $pdf->Image("$firmat",$pdf->GetX(), $pdf->GetY(),50),0, 'C');
$html="";
$pdf->WriteHTML($html);
$pdf->Output();
?>