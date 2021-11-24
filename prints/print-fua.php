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
    /*function Header()
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
        }*/
}

$id=$_REQUEST['id'];
$codigofua=mainModel::decryptions($id);
$imprimirfua = new printModel();
$data=$imprimirfua->imprimir_fua_modelo($codigofua);
$rows=$data->fetch();

$fuaNro=$rows['fuaNro'];
$idplatform=$rows['idplatform'];
$idtprovision=$rows['idtprovision'];
$idattentions=$rows['idattentions'];
$Impresscodigollegada=$rows['Impresscodigollegada'];
$Nombreipressllegada=$rows['Nombreipressllegada'];
$fuaSheetReferene=$rows['fuaSheetReferene'];
$TipoDoc=$rows['TipoDoc'];
$Documento=$rows['Documento'];
$patientDiresa=$rows['patientDiresa'];
$patientTypeSIS=$rows['patientTypeSIS'];
$patientNroSIS=$rows['patientNroSIS'];
$ApellidoP=$rows['ApellidoP'];
$ApellidoM=$rows['ApellidoM'];
$Nombre=$rows['Nombre'];
$NombreDos=$rows['NombreDos'];
$Genero=$rows['Genero'];
$hClinica=$rows['hClinica'];
$Etnia=$rows['Etnia'];
$fNacimiento=$rows['fNacimiento'];
$cadenanac=new mainModel();
$fechanacimiento=$cadenanac->fecha_cadena($fNacimiento);
//$cadenaDate = date('d m Y', strtotime($fNacimiento));
$fnac1 = substr("$fechanacimiento", -8, 1);
$fnac2 = substr("$fechanacimiento", -7, 1);
$fnac3 = substr("$fechanacimiento", -6, 1);
$fnac4 = substr("$fechanacimiento", -5, 1);
$fnac5 = substr("$fechanacimiento", -4, 1);
$fnac6 = substr("$fechanacimiento", -3, 1);
$fnac7 = substr("$fechanacimiento", -2, 1);
$fnac8 = substr("$fechanacimiento", -1, 1);

$fMuerte=$rows['fMuerte'];
if($fMuerte!=NULL){
    $cadenamuerte=new mainModel();
    $fechamuerte=$cadenamuerte->fecha_cadena($fMuerte);
    $fmuerte1 = substr("$fechamuerte", -8, 1);
    $fmuerte2 = substr("$fechamuerte", -7, 1);
    $fmuerte3 = substr("$fechamuerte", -6, 1);
    $fmuerte4 = substr("$fechamuerte", -5, 1);
    $fmuerte5 = substr("$fechamuerte", -4, 1);
    $fmuerte6 = substr("$fechamuerte", -3, 1);
    $fmuerte7 = substr("$fechamuerte", -2, 1);
    $fmuerte8 = substr("$fechamuerte", -1, 1);
}

$fuaDateAttentions=$rows['fuaDateAttentions'];
$cadenaatencion=new mainModel();
$fechaatencion=$cadenaatencion->fecha_cadena_hora($fuaDateAttentions);
$fatencion1 = substr("$fechaatencion", -8, 1);
$fatencion2 = substr("$fechaatencion", -7, 1);
$fatencion3 = substr("$fechaatencion", -6, 1);
$fatencion4 = substr("$fechaatencion", -5, 1);
$fatencion5 = substr("$fechaatencion", -4, 1);
$fatencion6 = substr("$fechaatencion", -3, 1);
$fatencion7 = substr("$fechaatencion", -2, 1);
$fatencion8 = substr("$fechaatencion", -1, 1);

$fuaTime=$rows['fuaTime'];
$cadenahora=new mainModel();
$horatencion=$cadenahora->hora_cadena($fuaTime);
$hora1 = substr("$horatencion", -4, 2);
$hora2 = substr("$horatencion", -2, 2);

$fuaDateHospitalization=$rows['fuaDateHospitalization'];
if($fuaDateHospitalization!=NULL){
    $cadenahosp=new mainModel();
    $fechahosp=$cadenahosp->fecha_cadena($fuaDateHospitalization);
    $fhosp1 = substr("$fechahosp", -8, 1);
    $fhosp2 = substr("$fechahosp", -7, 1);
    $fhosp3 = substr("$fechahosp", -6, 1);
    $fhosp4 = substr("$fechahosp", -5, 1);
    $fhosp5 = substr("$fechahosp", -4, 1);
    $fhosp6 = substr("$fechahosp", -3, 1);
    $fhosp7 = substr("$fechahosp", -2, 1);
    $fhosp8 = substr("$fechahosp", -1, 1);
}

$fuaDateHospExit=$rows['fuaDateHospExit'];
if($fuaDateHospExit!=NULL){
    $cadenahospalta=new mainModel();
    $fechalta=$cadenahospalta->fecha_cadena($fuaDateHospExit);
    $falta1 = substr("$fechalta", -8, 1);
    $falta2 = substr("$fechalta", -7, 1);
    $falta3 = substr("$fechalta", -6, 1);
    $falta4 = substr("$fechalta", -5, 1);
    $falta5 = substr("$fechalta", -4, 1);
    $falta6 = substr("$fechalta", -3, 1);
    $falta7 = substr("$fechalta", -2, 1);
    $falta8 = substr("$fechalta", -1, 1);
}
$idbconcept=$rows['idbconcept'];
$iddestination=$rows['iddestination'];
$Impresscodigodestino=$rows['Impresscodigodestino'];
$nombreipressdestino=$rows['nombreipressdestino'];
$fuaSheetCounter=$rows['fuaSheetCounter'];

$doctorDNI=$rows['doctorDNI'];
$doctorName=$rows['doctorName'];
$doctorLastName=$rows['doctorLastName'];
$doctorColegiatura=$rows['doctorColegiatura'];
$doctorResponsable=$rows['doctorResponsable'];
$doctorEspecialty=$rows['doctorEspecialty'];
$doctorRNE=$rows['doctorRNE'];
$doctorGraduate=$rows['doctorGraduate'];


$pdf = new PDF();
//$pdf->AliasNbPages();
//$pdf->SetMargins(10, 10);
$pdf->SetTopMargin(48);
$pdf->AddPage();


$pdf->SetFont('Arial','B',8);

switch ($idplatform) {
    case "1":
       
    
    break;
    case "2":
        $pdf->SetLeftMargin(23);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        
    
    break;
    case "3":
        $pdf->Ln(4);
        $pdf->SetLeftMargin(23);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(-4);
    
    break;
    case "4":
        $pdf->Ln(8);
        $pdf->SetLeftMargin(23);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(-8);
    break;
  
}
switch ($idtprovision){
    case "1":
       
    break;
    case "2":
        $pdf->SetLeftMargin(74);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
    
    break;
    case "3":
        $pdf->Ln(4);
        $pdf->SetLeftMargin(74);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(-4);
    
    break;
  
}

switch ($idattentions) {
    case "1":
       
    
    break;
    case "2":
        $pdf->SetLeftMargin(98);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        
    
    break;
    case "3":
        $pdf->Ln(4);
        $pdf->SetLeftMargin(98);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(-4);
    
    break;
    case "4":
        $pdf->Ln(8);
        $pdf->SetLeftMargin(98);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(-8);
    break;
  
}

$pdf->Ln(8);
$pdf->SetLeftMargin(118);
$pdf->Cell(10,10, "$Impresscodigollegada" ,0 ,0, 'L');
$pdf->SetFont('Arial','',7);
$pdf->MultiCell(60, 3.5, utf8_decode("$Nombreipressllegada"), 0,  'C');
//$pdf->Cell(70,10, "$Nombreipressllegada" ,1 ,0, 'C');
$pdf->SetY(53);
$pdf->SetX(195);
$pdf->Cell(10,10, "$fuaSheetReferene" ,0 ,0, 'L');
//$pdf->Ln(5);
$pdf->SetFont('Arial','',8);
$pdf->SetY(70);
$pdf->SetX(5);
$pdf->Cell(16,10, "$TipoDoc" ,0 ,0, 'C');
$pdf->Cell(30,10, "$Documento" ,0 ,0, 'C');
$pdf->Cell(12,10, "$patientDiresa" ,0 ,0, 'C');
$pdf->Cell(18,10, "$patientTypeSIS" ,0 ,0, 'C');
$pdf->Cell(16,10, "$patientNroSIS" ,0 ,0, 'C');
$pdf->Ln(5);
$pdf->SetY(76);
$pdf->SetX(5);
$pdf->SetLeftMargin(10);
$pdf->Cell(90,10, utf8_decode("$ApellidoP") ,0 ,0, 'C');
$pdf->Cell(105,10, utf8_decode("$ApellidoM") ,0 ,0, 'C');
$pdf->Ln(10);
$pdf->Cell(90,10, utf8_decode("$Nombre") ,0 ,0, 'C');
$pdf->Cell(105,10, utf8_decode("$NombreDos") ,0,0, 'C');
$pdf->Ln(7);
$pdf->SetFont('Arial','B',8);
if($Genero=='Masculino'){
    $pdf->SetLeftMargin(21);
    $pdf->Cell(16,10, "X" ,0 ,0, 'C');
}
else{
    $pdf->Ln(3);
    $pdf->SetLeftMargin(21);
    $pdf->Cell(16,10, "X" ,0 ,0, 'C');
    $pdf->Ln(-3);
}
$pdf->SetFont('Arial','',8);
//definir hc con Documento
$pdf->Ln(1);
$pdf->SetLeftMargin(110);
$pdf->Cell(50,10, "$hClinica" ,0 ,0, 'C');
$pdf->Cell(50,10, "$Etnia" ,0 ,0, 'C');
//fechanacimiento
$pdf->SetY(102);
$pdf->SetX(58);

//$pdf->Cell(16,10, date('d m Y', strtotime($fNacimiento)) ,1 ,0, 'C');
//$pdf->Cell(16,10, "$stringcadena" ,1 ,0, 'C');
$pdf->Cell(8,8, "$fnac1" ,0 ,0, 'C');
$pdf->Cell(8,8, "$fnac2" ,0 ,0, 'C');
$pdf->Cell(8,8, "$fnac3" ,0 ,0, 'C');
$pdf->Cell(8,8, "$fnac4" ,0 ,0, 'C');
$pdf->Cell(8,8, "$fnac5" ,0 ,0, 'C');
$pdf->Cell(8,8, "$fnac6" ,0 ,0, 'C');
$pdf->Cell(8,8, "$fnac7" ,0 ,0, 'C');
$pdf->Cell(8,8, "$fnac8" ,0 ,0, 'C');
if($fMuerte!=NULL)
{
    $pdf->Ln(6);
    $pdf->SetX(58);
    $pdf->Cell(8,8, "$fmuerte1" ,0 ,0, 'C');
    $pdf->Cell(8,8, "$fmuerte2" ,0 ,0, 'C');
    $pdf->Cell(8,8, "$fmuerte3" ,0 ,0, 'C');
    $pdf->Cell(8,8, "$fmuerte4" ,0 ,0, 'C');
    $pdf->Cell(8,8, "$fmuerte5" ,0 ,0, 'C');
    $pdf->Cell(8,8, "$fmuerte6" ,0 ,0, 'C');
    $pdf->Cell(8,8, "$fmuerte7" ,0 ,0, 'C');
    $pdf->Cell(8,8, "$fmuerte8" ,0 ,0, 'C');
}
else{
    $pdf->Ln(20);
}
$pdf->SetY(126);
$pdf->SetX(9);
$pdf->Cell(6,6, "$fatencion1" ,0 ,0, 'C');
$pdf->Cell(6,6, "$fatencion2" ,0 ,0, 'C');
$pdf->Cell(6,6, "$fatencion3" ,0 ,0, 'C');
$pdf->Cell(6,6, "$fatencion4" ,0 ,0, 'C');
$pdf->Cell(6,6, "$fatencion5" ,0 ,0, 'C');
$pdf->Cell(6,6, "$fatencion6" ,0 ,0, 'C');
$pdf->Cell(6,6, "$fatencion7" ,0 ,0, 'C');
$pdf->Cell(6,6, "$fatencion8" ,0 ,0, 'C');

$pdf->SetX(62);
$pdf->Cell(10,6, "$hora1" ,0 ,0, 'C');
$pdf->Cell(10,6, "$hora2" ,0 ,0, 'C');

if($fuaDateHospitalization!=NULL){
   $pdf->Ln(-1);
    $pdf->SetLeftMargin(164);
    $pdf->Cell(5,5, "$fhosp1" ,0 ,0, 'C');
    $pdf->Cell(5,5, "$fhosp2" ,0 ,0, 'C');
    $pdf->Cell(5,5, "$fhosp3" ,0 ,0, 'C');
    $pdf->Cell(5,5, "$fhosp4" ,0 ,0, 'C');
    $pdf->Cell(5,5, "$fhosp5" ,0 ,0, 'C');
    $pdf->Cell(5,5, "$fhosp6" ,0 ,0, 'C');
    $pdf->Cell(5,5, "$fhosp7" ,0 ,0, 'C');
    $pdf->Cell(5,5, "$fhosp8" ,0 ,0, 'C');
}
else{
    $pdf->Ln(-1);
}


if($fuaDateHospExit!=NULL){
    $pdf->Ln(5);
    $pdf->SetLeftMargin(128);
    $pdf->Cell(5,5, "$falta1" ,0 ,0, 'C');
    $pdf->Cell(5,5, "$falta2" ,0 ,0, 'C');
    $pdf->Cell(5,5, "$falta3" ,0 ,0, 'C');
    $pdf->Cell(5,5, "$falta4" ,0 ,0, 'C');
    $pdf->Cell(5,5, "$falta5" ,0 ,0, 'C');
    $pdf->Cell(5,5, "$falta6" ,0 ,0, 'C');
    $pdf->Cell(5,5, "$falta7" ,0 ,0, 'C');
    $pdf->Cell(5,5, "$falta8" ,0 ,0, 'C');
}
else{
    $pdf->Ln(5);
}
$pdf->Ln(15);
//ver lineas abajo si no hay fecha de hospitalización
switch ($idbconcept) 
{
    case "1":
       
    
    break;
    case "2":
        $pdf->SetX(20);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(10);
        
    
    break;
    case "3":
        $pdf->SetX(118);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(10);
    
    break;
    case "4":
        
        $pdf->SetX(148);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(10);
        
    break;
    case "5":
        
        $pdf->SetX(168);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(10);
        
    break;
    case "6":
        
        $pdf->SetX(188);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(10);
        
    break;
  
}

switch ($iddestination) 
{
    case "1":
       
    
    break;
    case "2":
        $pdf->Ln(2);
        $pdf->SetX(10);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(8);
        
    
    break;
    case "3":
        $pdf->Ln(2);
        $pdf->SetX(25);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(8);
    
    break;
    case "4":
        $pdf->Ln(2);
        $pdf->SetX(52);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(8);
        
    break;
    case "5":
        $pdf->Ln(2);
        $pdf->SetX(74);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(8);
        
    break;
    case "6":
        $pdf->Ln(2);
        $pdf->SetX(99);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(8);
        
    break;
    case "7":
        $pdf->Ln(2);
        $pdf->SetX(125);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(8);
        
    break;
    case "8":
        
        $pdf->SetX(149);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(10);
        
    break;
    case "9":
        
        $pdf->SetX(172);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(10);
        
    break;
    case "10":
        
        $pdf->SetX(192);
        $pdf->Cell(16,10, "X" ,0 ,0, 'C');
        $pdf->Ln(10);
        
    break;
  
}
$pdf->Ln(2);
$pdf->SetX(10);
$pdf->Cell(40,10, "$Impresscodigodestino" ,0 ,0, 'C');
$pdf->MultiCell(120,10,utf8_decode("$nombreipressdestino") ,0, 'C');
$pdf->SetY(167);
$pdf->SetX(175);
$pdf->Cell(30,10, "$fuaSheetCounter" ,0 ,0, 'C');
$pdf->Ln(80);
$pdf->SetX(10);

$pdf->Cell(20,10, "$doctorDNI" ,0 ,0, 'C');
$pdf->Cell(150,10, utf8_decode ("$doctorName, $doctorLastName") ,0 ,0, 'C');

$pdf->Cell(20,10, "$doctorColegiatura" ,0 ,0, 'C');
$pdf->Ln(4.5);
$pdf->SetX(42);

$pdf->Cell(20,10, "$doctorResponsable" ,0 ,0, 'C');
$pdf->SetLeftMargin(100);
$pdf->Cell(20,10, utf8_decode("$doctorEspecialty") ,0 ,0, 'C');
$pdf->SetLeftMargin(142);
$pdf->Cell(20,10, "$doctorRNE" ,0 ,0, 'C');
$pdf->Cell(20,10, "$doctorGraduate" ,0 ,0, 'C');


$html="";
//$pdf->WriteHTML($html);
$pdf->Output();
?>