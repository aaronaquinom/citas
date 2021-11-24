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
        $this->Cell(52);
        // Título
        $this->Cell(98,10,' REPORTE TOMA DE MUESTRA',1,0,'C');
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
$data=$imprimirmuestra->imprimir_muestra_modelo($codigoM);
$rows=$data->fetch();

//print_r($cuadrante);
//die();

$codigoLamina=$rows['hgCodeLamina'];
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
$pdf->Cell(150,10, "$apellidos, $nombres" ,1 ,0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(18,10, "Domicilio:" ,1 ,0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(70,10, $paDomicilio ,1 ,0, 'L');
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
$pdf->Cell(62,30, utf8_decode("") ,0, 0,'L');

$html="";
$pdf->WriteHTML($html);
$pdf->Output();
?>