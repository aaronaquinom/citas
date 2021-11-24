<?php
$peticionAjax=true;
require('../pdf/fpdf.php');
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../modelos/imprimirModelo.php";
/*$resultadopdf->laCodigo;*/
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
        $this->Image('../vistas/assets/img/irenlogo.png',10,8,23);
        // Arial bold 15
        $this->SetFont('Arial','B',18);
        // Movernos a la derecha
        $this->Cell(52);
        // Título
        $this->Cell(93,10,' REPORTE DE LECTURA',1,0,'C');
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
$codigob=mainModel::decryptions($id);
$resultadopdf = new imprimirModelo();
$data=$resultadopdf->imprimir_resultado_modelo($codigob);
$rows=$data->fetch();

//print_r($cuadrante);
//die();

$codLamina=$rows['reCodiLamina'];
$nombres=$rows['paNombre'];
$apellidos=$rows['paApellidos'];
$paDNI=$rows['paDNI'];
$paDomicilio=$rows['paDomicilio'];
$paDistrito=$rows['paDistrito'];
$paTelefono=$rows['paTelefono'];
$paFechaNacimiento=$rows['paFechaNacimiento'];
$paEdad=$rows['paEdad'];

$hgFechaRegla=$rows['hgFechaRegla'];
$embarazada=$rows['hgEmbarazada'];
$anticonceptivo=$rows['hgAnticonceptivo'];
$tipoanticonceptivo=$rows['hgTipoAnticonceptivo'];
$exameng=$rows['hgExamenGinecologicoSiNo'];
$espexameng=$rows['hgEspecifiqueGinecologico'];
$responsable=$rows['Responsable'];
$profesion=$rows['Profesion'];
//$colposcopia=$rows['Profesion'];
$colNormal= $rows['hgColposcopiaSiNo'];
$papAnterior= $rows['hgPapAnterior'];
$Especifiquecol= $rows['hgEspecifiqueColposcopia'];
$hgFechaPapAnterior=$rows['hgFechaPapAnterior']; 
$hgFechaMuestra=$rows['hgFechaMuestra']; 
$especimen=$rows['Especimen'];
$reEspecimenInsatisfactorio=$rows['reEspecimenInsatisfactorio'];
$reEspecimenRechazado=$rows['reEspecimenRechazado'];
$reEspecimenProcesadoRechazado=$rows['reEspecimenProcesadoRechazado'];
$glandular=$rows['Glandular'];
$cgNombre=$rows['cgNombre'];
$reCelulasGlandulares=$rows['reCelulasGlandulares'];
$clageneral=$rows['Clasifiacion'];
$reClagAnormalidades=$rows['reClagAnormalidades'];
$reClagClandularEscamoso=$rows['reClagClandularEscamoso'];
$reNeoplasiasMalignas=$rows['reNeoplasiasMalignas'];
$reCarcinoma=$rows['reCarcinoma'];
$escamosa=$rows['Escamosa'];
$benignos=$rows['Benignas'];
$reBenignoInfeccion=$rows['reBenignoInfeccion'];
$reInflamacionSiNo=$rows['reInflamacionSiNo'];
$reOtrosBenigno=$rows['reOtrosBenigno'];
$hormonal=$rows['Hormonal'];
$rePatronHormonal=$rows['rePatronHormonal'];
$reValoracionHormonal=$rows['reValoracionHormonal'];
$reConclusiones=$rows['reConclusiones'];
$reObservacion=$rows['reObservacion'];
$reFechaResultado=$rows['reFechaResultado'];
$reNuevaMuestraSiNo=$rows['reNuevaMuestraSiNo'];

$nombreR=$rows['NombreR'];
$apellidoR=$rows['ApellidoR'];
$colegiatura=$rows['Colegiatura'];
$firmat=$rows['imagenfirma'];







/*f($especimen=="Espécimen satisfactorio para la evaluación"){
$e1="X";
}
else{
    if($especimen=="Espécimen insatisfactorio para la evaluación por")
    $e2="X";
    else 
}*/

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$resultcuadrante=new imprimirModelo();
$idhg=$rows['Ginecologico'];
$cuadrante=$resultcuadrante->imprimir_cuadrante_modelo($idhg);
$pdf->SetFont('Times','B',11);
$pdf->Ln(2);
$pdf->Cell(0,10, "Cod. del Lab: $codLamina ",1,0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(0,10, 'DATOS DEL PACIENTE:' ,1, 0,'L');
$pdf->SetFont('Times','',10);
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(40,10,"Apellidos y Nombres:",1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(150,10, "$apellidos, $nombres" ,1 ,0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(18,10, "Domicilio:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(70,10, $paDomicilio ,1 ,0, 'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(15,10, "Distrito:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(35,10, $paDistrito ,1 ,0, 'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(18,10, "Telefono:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(34,10, $paTelefono ,1 ,0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(40,10, "Fecha de Nacimiento:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(48,10, $paFechaNacimiento ,1 ,0, 'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(15,10, "DNI:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(35,10, $paDNI ,1 ,0, 'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(18,10, "Edad:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(34,10, $paEdad ,1 ,0, 'L');
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
    while($row=$cuadrante->fetch()){
        $pdf->Cell(13,10, $row['cgiNombre'],1,0,'L'); 
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
$pdf->MultiCell(52,30, $pdf->Image('../vistas/assets/img/cuadrante.jpg',160,115,30), 1,'C');
$pdf->Ln(-20);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(88,10, "Especifique tipo de metodo anticonceptivo y tiempo:" ,1,'C');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(88,10, "$tipoanticonceptivo" ,1,'C');
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode("Responsable de la obtención de las muestras:") ,1,'C');
$pdf->Cell(102,10, utf8_decode('Colposcopia:') ,1, 0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(25,10,"Nombre:",1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(63,10, $responsable ,1 ,0, 'L');
if($colNormal=="Normal"){
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
$pdf->Cell(102,10, utf8_decode('3.1.2 Células Glandulares:') ,1, 0,'L');
$pdf->SetFont('Times','',10);
$pdf->Ln(10);

switch($especimen){
    case "1":
     $e1="X";
     $f1="";
    $g1="";
    $h1="";
    break;
    case "2":
    $f1="X";
    $e1="";
    $g1="";
    $h1="";
    
    break;
    case "3":
    $g1="X";
    $e1="";
    $f1="";
    $h1="";
    break;
    case "4":
    $h1="X";
    $g1="";
    $e1="";
    $f1="";

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
    $q1="X";
    $r1="";
    $s1="";
    $t1="";
    $v1="";
    break;
    case "7":
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
    case "8":
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
    case "9":
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
}
 //aca no deberia declarar esto y jalar de arriba
$pdf->Cell(10,10,"$e1",1 ,0, 'C');
$pdf->Cell(78,10,utf8_decode("Espécimen satisfactorio para la evaluación"),1 ,0, 'L');

$pdf->Cell(10,10,"$n1",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Celulas endometriales benignas de tipo epitelial"),1 ,0, 'L');
$pdf->Ln(10);

$pdf->Cell(10,10,"$f1",1 ,0, 'C');
$pdf->Cell(78,10,utf8_decode("Insatisfactorio por $reEspecimenInsatisfactorio"),1 ,0, 'L');


$pdf->Cell(10,10,"$o1",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Celulas endometriales benignas de tipo estromal"),1 ,0, 'L');
$pdf->Ln(10);

$pdf->Cell(10,10,"$g1",1 ,0, 'C');
$pdf->Cell(78,10,utf8_decode("Rechazado no procesado por $reEspecimenRechazado"),1 ,0, 'L');

$pdf->Cell(10,10,"$p1",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Celulas endometriales benignas  tipo epitelial postmenopáusica"),1 ,0, 'L');
$pdf->Ln(10);

$pdf->Cell(10,10,"$h1",1 ,0, 'C');
$pdf->Cell(78,10,utf8_decode("Procesado y examinado rechazado por: $reEspecimenProcesadoRechazado"),1 ,0, 'L');

$pdf->Cell(10,10,"$q1",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Celulas glandulares atipica (AGC): $cgNombre"),1 ,0, 'L');
$pdf->Ln(10);
switch($clageneral){
    case "1":
    $cg1="X";
    $cg2="";
    $cg3="";
    $cg4="";
    
    break;
    case "2":
    $cg1="";
    $cg2="X";
    $cg3="";
    $cg4="";
    
    break;
    case "3":
    $cg1="";
    $cg2="";
    $cg3="X";
    $cg4="";
    break;
    case "4":
    $cg1="";
    $cg2="";
    $cg3="";
    $cg4="V";
    break;
}
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode('2) CLASIFICACION GENERAL:') ,1, 0,'L');
$pdf->SetFont('Times','',10);

$pdf->Cell(10,10,"$r1",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Adenocarcicoma endocervical in situ"),1 ,0, 'L');
$pdf->Ln(10);

$pdf->Cell(10,10,"$cg1",1 ,0, 'C');
$pdf->Cell(78,10,utf8_decode("Negativo para lesiones intraepiteliales o malignidad"),1 ,0, 'L');

$pdf->Cell(10,10,"$s1",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Adenocarcicoma tipo: $reCelulasGlandulares "),1 ,0, 'L');
$pdf->Ln(10);

$pdf->Cell(10,10,"$cg2",1 ,0, 'C');
$pdf->Cell(78,10,utf8_decode("Anormalidades en células epiteliales: $reClagAnormalidades"),1 ,0, 'L');
$pdf->SetFont('Times','B',10);

$pdf->Cell(102,10, utf8_decode("3.2 OTRAS NEOPLASIAS MALIGNAS (especifique):") ,1, 0,'L');
$pdf->Ln(10);

$pdf->SetFont('Times','',10);
$pdf->Cell(10,10,"$cg3",1 ,0, 'C');
$pdf->Cell(78,10,utf8_decode("Otros indicar si es glandular o escamoso: $reClagClandularEscamoso"),1 ,0, 'L');

$pdf->SetFont('Times','',10);
$pdf->Cell(102,10, utf8_decode("$reNeoplasiasMalignas") ,1, 0,'L');
//$pdf->SetY(700);

$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode("3) INTERPRETACIÓN DESCRIPTIVA:") ,1, 0,'L');
$pdf->Cell(102,10,utf8_decode("3.3 CAMBIOS CELULARES BENIGNOS"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode("3.1. ANORMALIDADES DE CELULAS EPITELIALES") ,1, 0,'L');
$pdf->Cell(102,10,utf8_decode("3.3.1.Cambios asociados a:"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode("3.1.1.Células escamosas:") ,1, 0,'L');
$pdf->SetFont('Times','',10);
switch($benignos){
    case "1":
    $ceb1="X";
    $ceb2="";
    $ceb3="";
    $ceb4="";
    $ceb5="";
    $ceb6=""; 
    break;
    case "2":
    $ceb1="";
    $ceb2="X";
    $ceb3="";
    $ceb4="";
    $ceb5="";
    $ceb6="";
    
    
    break;
    case "3":
    $ceb1="";
    $ceb2="";
    $ceb3="X";
    $ceb4="";
    $ceb5="";
    $ceb6="";
    
   
    break;
    case "4":
    $ceb1="";
    $ceb2="";
    $ceb3="";
    $ceb4="X";
    $ceb5="";
    $ceb6="";
    
    
    break;
    case "5":
    $ceb1="";
    $ceb2="";
    $ceb3="";
    $ceb4="";
    $ceb5="X";
    $ceb6="";
    
    
    break;
    case "6":
    $ceb1="";
    $ceb2="";
    $ceb3="";
    $ceb4="";
    $ceb5="";
    $ceb6="X";
    
    
    break;
    case "7":
    $ceb1="";
    $ceb2="";
    $ceb3="";
    $ceb4="";
    $ceb5="";
    $ceb6="";
    $lineab="";
    break;
}
$pdf->Cell(10,10,"$ceb1",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Infección (tipo de microorganismo si lo hubiese):"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode("Células Escamosas atipicas") ,1, 0,'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(102,10,utf8_decode("$reBenignoInfeccion"),1 ,0, 'L');
$pdf->Ln(10);

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

$pdf->SetFont('Times','',10);
$pdf->Cell(5,10,"$ce1",1 ,0, 'C');
$pdf->Cell(83,10,utf8_decode("significación indeterminada(CEASI equivale ASCUS)"),1 ,0, 'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(102,10,utf8_decode("3.3.2 Cambios reactivos asociados a:"),1 ,0, 'L');
$pdf->Ln(10);

$pdf->Cell(5,10,"$ce2",1 ,0, 'C');
$pdf->SetFont('Times','',10);
$pdf->Cell(83,10,utf8_decode("No excluye LEIAG"),1 ,0, 'L');

$pdf->Cell(10,10,"$ceb2",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Inflamación"),1 ,0, 'L');
$pdf->Ln(10);

$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode("Lesión Escamosa Intraepitelial BAJO GRADO (LEIBG)") ,1, 0,'L');
$pdf->SetFont('Times','',10);

$pdf->Cell(10,10,"$ceb3",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Atrofia con: $reInflamacionSiNo"),1 ,0, 'L');
$pdf->Ln(10);

$pdf->Cell(5,10,"$ce3",1 ,0, 'C');
$pdf->Cell(83,10,utf8_decode("HPV"),1 ,0, 'L');

$pdf->Cell(10,10,"$ceb4",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Radiación"),1 ,0, 'L');
$pdf->Ln(10);

$pdf->Cell(5,10,"$ce4",1 ,0, 'C');
$pdf->Cell(83,10,utf8_decode("Displasia leve (NIC I)"),1 ,0, 'L');

$pdf->Cell(10,10,"$ceb5",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("DIU"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(88,10, utf8_decode("Lesión Escamosa Intraepitelial ALTO GRADO (LEIAG)") ,1, 0,'L');
$pdf->SetFont('Times','',10);

$pdf->Cell(10,10,"$ceb6",1 ,0, 'C');
$pdf->Cell(92,10,utf8_decode("Otros $reOtrosBenigno"),1 ,0, 'L');
$pdf->Ln(10);

$pdf->Cell(5,10,"$ce5",1 ,0, 'C');
$pdf->Cell(83,10,utf8_decode("HPV con atipia)"),1 ,0, 'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(102,10,utf8_decode("4) EVALUACION HORMONAL"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','',10);

$pdf->Cell(5,10,"$ce6",1 ,0, 'C');
$pdf->Cell(83,10,utf8_decode("Displasia Moderada (NIC II)"),1 ,0, 'L');

switch($hormonal){
    case "1":
    $ho1="X";
    $ho2="";
    $ho3="";
    $ho4="";
    
    break;
    case "2":
    $ho1="";
    $ho2="X";
    $ho3="";
    $ho4="";
    
    break;
    case "3":
    $ho1="";
    $ho2="";
    $ho3="X";
    $ho4="";
    break;
    case "4":
    $ho1="";
    $ho2="";
    $ho3="";
    $ho4="V";
    break;
}

$pdf->Cell(5,10,"$ho1",1 ,0, 'C');
$pdf->Cell(97,10,utf8_decode("Patron Hormonal compatible con edad y la Información Clinica"),1 ,0, 'L');
$pdf->Ln(10);

$pdf->Cell(5,10,"$ce7",1 ,0, 'C');
$pdf->Cell(83,10,utf8_decode("Displasia Severa (NIC III)"),1 ,0, 'L');

$pdf->Cell(5,10,"$ho2",1 ,0, 'C');
$pdf->Cell(97,10,utf8_decode("Patron Hormonal discrepancia con edad y clinica especifique"),1 ,0, 'L');
$pdf->Ln(10);

$pdf->Cell(5,10,"$ce8",1 ,0, 'C');
$pdf->Cell(83,10,utf8_decode("Carcinoma in situ"),1 ,0, 'L');

$pdf->Cell(102,10,utf8_decode("$rePatronHormonal"),1 ,0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$html1 = 'Carcinoma tipo';
$pdf->Cell(5,10,"$ce9",1 ,0, 'C');
$pdf->SetFont('Times','',10);
$pdf->Cell(83,10,utf8_decode("$html1,  $reCarcinoma"),1 ,0, 'L');
$pdf->SetFont('Times','',10);

$pdf->Cell(5,10,"$ho3",1 ,0, 'C');
$pdf->Cell(97,10,utf8_decode("Valoración hormonal no posible por: $reValoracionHormonal"),1 ,0, 'L');
$pdf->Ln(10);

$pdf->SetFont('Times','',10);
$pdf->Cell(0,10, "Conclusiones y Sugerencias: $reConclusiones" ,1, 0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','',10);
$pdf->Cell(25,10, "Nueva muestra" ,1,'C');
$pdf->SetFont('Times','',10);
$reNuevaMuestraSiNo="Si";
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
$pdf->Cell(62,10, utf8_decode("Diagnostico Realizado en el laboratorio:") ,1, 0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(128,10,utf8_decode("DATOS DEL PROFESIONAL RESPONSABLE"),1 ,0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Times','',8);
$pdf->Cell(62,10, utf8_decode(" IREN CENTRO") ,1, 0,'L');
$pdf->Cell(64,10,utf8_decode("$nombreR $apellidoR"),1 ,0, 'L');


$pdf->Ln(10);
$pdf->Cell(62,10, utf8_decode("Fecha: $reFechaResultado") ,1, 0,'L');
$pdf->Cell(64,10,utf8_decode("Colegiatura: $colegiatura"),1 ,0, 'L');

$pdf->Ln(12);
$pdf->Cell(62,30, utf8_decode("") ,0, 0,'L');
$pdf->Cell(64,30, $pdf->Image("$firmat",$pdf->GetX(), $pdf->GetY(),50),0, 'C');




/*$pdf->Ln(10);
$pdf->Cell(70,10, $codLamina ,1 ,0, 'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(15,10, "Distrito:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(35,10, $codLamina ,1 ,0, 'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(18,10, "Telefono:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(34,10, $codLamina ,1 ,0, 'L');*/

/*$pdf->Line(30,78,80,78);
$pdf->Cell(78,30, "Distrito");
$pdf->Cell(200,30, $codLamina);*/
$html="";
$pdf->WriteHTML($html);
$pdf->Output();
?>