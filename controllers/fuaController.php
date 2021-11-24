<?php
if ($peticionAjax){
    require_once "../models/fuaModel.php";
} else{
    require_once "./models/fuaModel.php";
}
class fuaController extends fuaModel{
    public function agregar_fua_controlador()
    {
       
        $patdi=mainModel::limpiar_cadena($_POST['tdi-pa']);
        $padni=mainModel::limpiar_cadena($_POST['dni-pa']);
        $pagenero=mainModel::limpiar_cadena($_POST['genero-pa']);
        $pafecna=mainModel::limpiar_cadena($_POST['nac-pa']);
        $fecborn=NULL;
        $fechacorte=NULL;

        $panhc=mainModel::limpiar_cadena($_POST['nhc-pa']);
        $paetnia=mainModel::limpiar_cadena($_POST['etnia']);
              
        
        $paapellido1=mainModel::limpiar_cadena($_POST['apellido1-pa']);
        $paapellido2=mainModel::limpiar_cadena($_POST['apellido2-pa']);      
        $panombre1=mainModel::limpiar_cadena($_POST['nombre1-pa']);
        $panombre2=mainModel::limpiar_cadena($_POST['nombre2-pa']);

        $padiresa=mainModel::limpiar_cadena($_POST['diresa-pa']); //tabla fua
        $patiposeguro=mainModel::limpiar_cadena($_POST['tiposeguro-pa']); //tabla fua
        $panroseguro=mainModel::limpiar_cadena($_POST['nroseguro-pa']); //tabla fua
        

        $idipress=mainModel::limpiar_cadena(isset($_POST['sel_ipress'])?$_POST['sel_ipress']:null);
        $nroref=mainModel::limpiar_cadena($_POST['nroref']);

        $idatiende=mainModel::limpiar_cadena(isset($_POST['cmbAtiende'])?$_POST['cmbAtiende']:null);
        $idlugaratencion=mainModel::limpiar_cadena(isset($_POST['cmbLugar'])?$_POST['cmbLugar']:null);
        $idtipoatencion=mainModel::limpiar_cadena(isset($_POST['cmbTipoatencion'])?$_POST['cmbTipoatencion']:null);                  
        
        
       
        $fechaatencion=mainModel::limpiar_cadena($_POST['fechaatencionalta']);
        $horaatecion = date('H:i:s',strtotime($fechaatencion));
        

        $idconcepto=mainModel::limpiar_cadena(isset($_POST['cmbConcepto'])?$_POST['cmbConcepto']:null);   
        $iddestino=mainModel::limpiar_cadena(isset($_POST['cmbDestino'])?$_POST['cmbDestino']:null);    


        //medicos
        $iddoctor=mainModel::limpiar_cadena(isset($_POST['cmbDoctores'])?$_POST['cmbDoctores']:null);
        
        $idipressDestination=mainModel::limpiar_cadena(isset($_POST['sel_ipressc'])?$_POST['sel_ipressc']:null);
        $nroconref=mainModel::limpiar_cadena($_POST['nroconref']);
        
        $idtipofua=mainModel::limpiar_cadena(isset($_POST['cmbTipofua'])?$_POST['cmbTipofua']:null);
        $fuanro=mainModel::limpiar_cadena($_POST['numero-fua']);
        
        $identidad=1;
        //previas validaciones
        if($iddestino=="9")
        {
            $pafecdeath=mainModel::limpiar_cadena($_POST['fechaatencionalta']);
            
        } 
        else
        {
            $pafecdeath=NULL;
        }

        if($idtipofua=="3" || $idtipofua=="4")
        {
            
            
            $fechaingreso=mainModel::limpiar_cadena($_POST['fechaingreso']);
            if($fechaingreso==""){
                $fechaingreso=NULL;
                $fechaalta=NULL;
            }
            else
            
            {

                $fechaalta=mainModel::limpiar_cadena(isset($_POST['fechaatencionalta'])?$_POST['fechaatencionalta']:null);
            }
            
                        
        }
        else
        {
            //$fechaalta=mainModel::limpiar_cadena($_POST['fechaatencionalta']);
            $fechaalta=NULL;
            $fechaingreso=NULL;
        }
       
        //ingresar datos
        $codigoE=mainModel::limpiar_cadena($_POST['cod-empleado']);
        $codigoE=mainModel::decryption ($codigoE);
        $querye=mainModel::ejecutar_consulta_simple("SELECT idemployee FROM employees WHERE iduser='$codigoE'");
        $de=$querye->rowCount();
        $datosempleado=$querye->fetch();
        $idempleado=$datosempleado['idemployee'];
        if($de!=1)
        {
            $alerta=[
                "Alerta"=>"error",
                "Titulo"=>"Usuario no activo",
                "Texto"=>"Tenemos inconvenientes",
                "Tipo"=>"error"
                ]; 
        }
        else
        {
            
            if($padni=="")
            
            {
                $consultaapellido=mainModel::ejecutar_consulta_simple("SELECT idpatient FROM patients WHERE patientName='$panombre1' AND patientNameOther='$panombre2' AND  patientLastName='$paapellido1' AND 	patientSecondSurname='$paapellido2'");
                $ca=$consultaapellido->rowCount();
                
                if($ca>1)
                {

                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Error comuniquese con Leo",
                        "Texto"=>"Hay más de 2 pacientes con los mismos datos",
                        "Tipo"=>"error"
                        ];
                }

                else
                {

                    //si no hay paciente sin dni tdi=0, primero paciente luego, triaje, luego fua
                    $patdi=0;
                    $datos=[
                        "patientName"=> $panombre1,
                        "patientNameOther"=> $panombre2,
                        "patientLastName"=> $paapellido1,
                        "patientSecondSurname"=> $paapellido2, 
                        "patientDocument"=> $padni,
                        "patientTypeDocument"=> $patdi,
                        "patientGender"=> $pagenero,
                        "patientDateBirth"=> $pafecna,
                        "patientDateDeath"=> $pafecdeath,
                        "patientDateBorn"=> $fecborn,
                        "patientHistoryClinic"=> $panhc,
                        "patientEtnia"=> $paetnia, 
                        "patientMembership1"=> "",
                        "patientMembership2"=> "",
                        "patientMembership3"=> "",
                        "patientIAFAS"=> "",
                        "patientIAFASseguro"=> "",
                        "patientObs"=> ""   
                    ];
    
                    $guardarpaciente=fuaModel::agregar_paciente_modelo($datos); 
                    //buscar ultimo id del paciente recien registrado 
                    $ultimoid=mainModel::ejecutar_consulta_simple("SELECT idpatient FROM patients ORDER BY idpatient DESC LIMIT 1");
                    $datospaciente=$ultimoid->fetch();
                    $idpatient=$datospaciente['idpatient'];
                    
                    /*
                    $datost=[                
                        "historydate"=>
                        "historyweight"=>
                        "historyheight"=>
                        "historyPA"=>
                        "idpatient"=>$idpatient
                    
                    ];
    
                    $guardartriaje=fuaModel::agregar_triaje_modelo($datost);
                    */
                    //luego ingresas su fua
                    $ultimoidfua=mainModel::ejecutar_consulta_simple("SELECT idfua FROM fuas ORDER BY idfua DESC LIMIT 1");
                    $datosfua=$ultimoidfua->fetch();
                    $idfua= $datosfua['idfua']+1;
                   
                    $datosf=[
                        "idfua"=>$idfua,
                        "patientDiresa"=> $padiresa,
                        "patientTypeSIS"=>$patiposeguro,
                        "patientNroSIS"=> $panroseguro,
                        "fuaNro"=>$fuanro,
                        "fuaSheetReferene"=> $nroref,
                        "fuaDateAttentions"=> $fechaatencion,
                        "fuaTime"=> $horaatecion,
                        "fuaUPS"=> "",
                        "fuaCodPresta"=> "",
                        "fuaCodPrestaAdditional"=> "",
                        "fuaDateHospitalization"=> $fechaingreso,
                        "fuaDateHospExit"=>$fechaalta,
                        "fuaDateHospCurt"=>$fechacorte, 
                        "fuaCodAuthorization"=>"", 
                        "fuaLink"=>"", 
                        "fuaCoverage"=>"",
                        "fuaAmount"=>NULL,
                        "fuaSheetCounter"=>$nroconref,
                        "fuaObs"=> "",
                        "identitys"=> $identidad,
                        "idattentions"=>$idtipoatencion,
                        "idtprovision"=>$idlugaratencion, 
                        "idplatform"=>$idatiende, 
                        "idipress"=>$idipress,
                        "idemployee"=>$idempleado,
                        "iddoctor"=>$iddoctor, 
                        "idpatient"=>$idpatient,
                        "idipressDestination"=>$idipressDestination,
                        "idbconcept"=>$idconcepto, 
                        "iddestination"=>$iddestino,  
                        "idtypefua"=>$idtipofua
                    //idtriaje
                        ];                            
                    $guardarfua=fuaModel::agregar_fua_modelo($datosf);
                        $alerta=[ 
                        "Alerta"=>"limpiar",
                        "Titulo"=>"Paciente sin DNI",
                        "Texto"=>"Paciente registrado sin DNI $idpatient",
                        "Tipo"=>"success"
                        ];

                }
                
                
            }

            else
            {
                $consultadni=mainModel::ejecutar_consulta_simple("SELECT idpatient FROM patients WHERE patientDocument='$padni'");
                $c1=$consultadni->rowCount();
                
                
               
                 if($c1!=1)
                 {
                    $datos=[
                        "patientName"=> $panombre1,
                        "patientNameOther"=> $panombre2,
                        "patientLastName"=> $paapellido1,
                        "patientSecondSurname"=> $paapellido2, 
                        "patientDocument"=> $padni,
                        "patientTypeDocument"=> $patdi,
                        "patientGender"=> $pagenero,
                        "patientDateBirth"=> $pafecna,
                        "patientDateDeath"=> $pafecdeath,
                        "patientDateBorn"=> $fecborn,
                        "patientHistoryClinic"=> $panhc,
                        "patientEtnia"=> $paetnia, 
                        "patientMembership1"=> "",
                        "patientMembership2"=> "",
                        "patientMembership3"=> "",
                        "patientIAFAS"=> "",
                        "patientIAFASseguro"=> "",
                        "patientObs"=> ""   
                    ];
    
                    $guardarpaciente=fuaModel::agregar_paciente_modelo($datos); 
                    //buscar ultimo id del paciente recien registrado 
                    $ultimoid=mainModel::ejecutar_consulta_simple("SELECT idpatient FROM patients ORDER BY idpatient DESC LIMIT 1");
                    $datospaciente=$ultimoid->fetch();
                    $idpatient=$datospaciente['idpatient'];
                    
                    /*
                    $datost=[                
                        "historydate"=>
                        "historyweight"=>
                        "historyheight"=>
                        "historyPA"=>
                        "idpatient"=>$idpatient
                    
                    ];
    
                    $guardartriaje=fuaModel::agregar_triaje_modelo($datost);
                    */
                    //luego ingresas su fua
                    $ultimoidfua=mainModel::ejecutar_consulta_simple("SELECT idfua FROM fuas ORDER BY idfua DESC LIMIT 1");
                    $datosfua=$ultimoidfua->fetch();
                    $idfua= $datosfua['idfua']+1;
                   
                    $datosf=[
                        "idfua"=>$idfua,
                        "patientDiresa"=> $padiresa,
                        "patientTypeSIS"=>$patiposeguro,
                        "patientNroSIS"=> $panroseguro,
                        "fuaNro"=>$fuanro,
                        "fuaSheetReferene"=> $nroref,
                        "fuaDateAttentions"=> $fechaatencion,
                        "fuaTime"=> $horaatecion,
                        "fuaUPS"=> "",
                        "fuaCodPresta"=> "",
                        "fuaCodPrestaAdditional"=> "",
                        "fuaDateHospitalization"=> $fechaingreso,
                        "fuaDateHospExit"=>$fechaalta,
                        "fuaDateHospCurt"=>$fechacorte, 
                        "fuaCodAuthorization"=>"", 
                        "fuaLink"=>"", 
                        "fuaCoverage"=>"",
                        "fuaAmount"=>NULL,
                        "fuaSheetCounter"=>$nroconref,
                        "fuaObs"=> "",
                        "identitys"=> $identidad,
                        "idattentions"=>$idtipoatencion,
                        "idtprovision"=>$idlugaratencion, 
                        "idplatform"=>$idatiende, 
                        "idipress"=>$idipress,
                        "idemployee"=>$idempleado,
                        "iddoctor"=>$iddoctor, 
                        "idpatient"=>$idpatient,
                        "idipressDestination"=>$idipressDestination,
                        "idbconcept"=>$idconcepto, 
                        "iddestination"=>$iddestino,  
                        "idtypefua"=>$idtipofua
                    //idtriaje
                        ];                            
                    $guardarfua=fuaModel::agregar_fua_modelo($datosf);
                    
                    
                    
                    $alerta=[ 
                        "Alerta"=>"limpiar",
                        "Titulo"=>"DNI no hay",
                        "Texto"=>"no hay $c1 $idpatient,$fechaingreso",
                        "Tipo"=>"success"
                    ];
                    
                    
                 } 
                 else
                 {
                    
                    $datospaciente=$consultadni->fetch();
                    $idpatient=$datospaciente['idpatient'];
                    
                    /*
                    $datost=[                
                        "historydate"=>
                        "historyweight"=>
                        "historyheight"=>
                        "historyPA"=>
                        "idpatient"=>$idpatient
                    
                    ];
    
                    $guardartriaje=fuaModel::agregar_triaje_modelo($datost);
                    */
                    //luego ingresas su fua
                    $ultimoidfua=mainModel::ejecutar_consulta_simple("SELECT idfua FROM fuas ORDER BY idfua DESC LIMIT 1");
                    $datosfua=$ultimoidfua->fetch();
                    $idfua= $datosfua['idfua']+1;
                   
                    $datosf=[
                        "idfua"=>$idfua,
                        "patientDiresa"=> $padiresa,
                        "patientTypeSIS"=>$patiposeguro,
                        "patientNroSIS"=> $panroseguro,
                        "fuaNro"=>$fuanro,
                        "fuaSheetReferene"=> $nroref,
                        "fuaDateAttentions"=> $fechaatencion,
                        "fuaTime"=> $horaatecion,
                        "fuaUPS"=> "",
                        "fuaCodPresta"=> "",
                        "fuaCodPrestaAdditional"=> "",
                        "fuaDateHospitalization"=> $fechaingreso,
                        "fuaDateHospExit"=>$fechaalta,
                        "fuaDateHospCurt"=>$fechacorte, 
                        "fuaCodAuthorization"=>"", 
                        "fuaLink"=>"", 
                        "fuaCoverage"=>"",
                        "fuaAmount"=>NULL,
                        "fuaSheetCounter"=>$nroconref,
                        "fuaObs"=> "",
                        "identitys"=> $identidad,
                        "idattentions"=>$idtipoatencion,
                        "idtprovision"=>$idlugaratencion, 
                        "idplatform"=>$idatiende, 
                        "idipress"=>$idipress,
                        "idemployee"=>$idempleado,
                        "iddoctor"=>$iddoctor, 
                        "idpatient"=>$idpatient,
                        "idipressDestination"=>$idipressDestination,
                        "idbconcept"=>$idconcepto, 
                        "iddestination"=>$iddestino,  
                        "idtypefua"=>$idtipofua
                    //idtriaje
                        ];                            
                    $guardarfua=fuaModel::agregar_fua_modelo($datosf);
                    
                    //var_dump($datosf);
                    
                    $alerta=[ 
                        "Alerta"=>"limpiar",
                        "Titulo"=>"Fua registrado",
                        "Texto"=>"Fua registro con exito $padni $c1",
                        "Tipo"=>"success"
                    ];
                 }   

            }   
            
        }
        return mainModel::sweet_alert($alerta);
    }  
    public function datos_fua_controlador($tipo, $codigo){ 
        $codigo=mainModel::decryption($codigo);
        $tipo=mainModel::limpiar_cadena($tipo);

        return fuaModel::datos_fua_modelo($tipo, $codigo);
    }
     
    

    
}
