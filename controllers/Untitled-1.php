<?php
if ($peticionAjax){
    require_once "../models/fuaModel.php";
} else{
    require_once "./models/fuaModel.php";
}
class fuaController extends fuaModel{
    public function agregar_fua_controlador(){
       
        $patdi=mainModel::limpiar_cadena($_POST['tdi-pa']);
        $padni=mainModel::limpiar_cadena($_POST['dni-pa']);
        $pagenero=mainModel::limpiar_cadena($_POST['genero-pa']);
        $pafecna=mainModel::limpiar_cadena($_POST['nac-pa']);
        $fecborn=NULL;
        $fechacorte=NULL;

        $panhc=mainModel::limpiar_cadena($_POST['nhc-pa']);
        $paetnia=mainModel::limpiar_cadena($_POST['etnia-pa']);      
        
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

        //obtener datos segun condicion 
        if($iddestino=="9")
        {
            $pafecdeath=mainModel::limpiar_cadena($_POST['fechaatencionalta']);
            
        }
        
        else
        {
            $pafecdeath=NULL;
        }
        if($idtipofua=="3"|| $idtipofua=="4")
        {
            $fechaalta=mainModel::limpiar_cadena($_POST['fechaatencionalta']);
            $fechaingreso=mainModel::limpiar_cadena($_POST['fechaingreso']);
            
        }
        else
        {
            //$fechaalta=mainModel::limpiar_cadena($_POST['fechaatencionalta']);
            $fechaalta=NULL;
            $fechaingreso=NULL;
        }
        //obtener datos segun condicion 
        if($patdi=="0")
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
                if($ca=0)
                {
                    //si no hay paciente sin dni tdi=0, primero paciente luego, triaje, luego fua
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


                }
                else
                {
                    
                    
                    $datosempleado=$consultaapellido->fetch();
                    $idpatient=$datosempleado['idpatient'];
                    
                    //existe ya un paciente sin dni tdni=0 en la bd ingresamos triaje 
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



                }

            }
        }
        else
        {
            //verificar error
            $consultadni=mainModel::ejecutar_consulta_simple("SELECT idpatient FROM patients WHERE paDNI='$padni'");
            $c1=$consultadni->rowCount();
            $datospaciente=$consultadni->fetch();
            if($c1>=1)
            {
                
                $idpatient=$datospaciente['idpatient'];
                //insertar triaje
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

            }
            else
            {
                //si no hay paciente, primero paciente luego, triaje, luego fua
                $idpatient=$datospaciente['idpatient'];
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
                //  
                $consultadni=mainModel::ejecutar_consulta_simple("SELECT idpatient FROM patients WHERE paDNI='$padni'");
                
                $datospaciente=$consultadni->fetch();
                $idpatient=$datospaciente['idpatient'];

                $codigoE=mainModel::limpiar_cadena($_POST['cod-empleado']);
                $codigoE=mainModel::decryption ($codigoE);
                $querye=mainModel::ejecutar_consulta_simple("SELECT idemployee FROM employees WHERE iduser='$codigoE'");
                $de=$querye->rowCount();
                if($de>0)
                {
                    $datosempleado=$querye->fetch();
                    $idempleado=$datosempleado['idemployee'];

                //insertar triaje

                //insertar fua
                    
                     /*   $datosf=[
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
                            "fuaAmount"=>"",
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
                        
*/
                            $datosfua=[
                                "patientDiresa"=> "170",
                                "patientTypeSIS"=>"2",
                                "patientNroSIS"=> "21247848",
                                "fuaNro"=> "6666",
                                "fuaSheetReferene"=> "12",
                                "fuaDateAttentions"=> "2021-08-07",
                                "fuaTime"=> "11:16:18",
                                "fuaUPS"=> "",
                                "fuaCodPresta"=> "",
                                "fuaCodPrestaAdditional"=> "",
                                "fuaDateHospitalization"=> "2021-08-04",
                                "fuaDateHospExit"=> "2021-08-07",
                                "fuaDateHospCurt"=> NULL, 
                                "fuaCodAuthorization"=> "", 
                                "fuaLink"=> "", 
                                "fuaCoverage"=> "",
                                "fuaAmount"=> NULL,
                                "fuaSheetCounter"=> "",
                                "fuaObs"=> "",
                                "identitys"=> "1",
                                "idattentions"=> "2",
                                "idtprovision"=> "2", 
                                "idplatform"=> "2", 
                                "idipress"=> "2",
                                "idemployee"=> "1",
                                "iddoctor"=> "2", 
                                "idpatient"=> "10",
                                "idipressDestination"=>"1",
                                "idbconcept"=> "2", 
                                "iddestination"=> "2",  
                                "idtypefua"=> "3"
                                //idtriaje
                            ];                            
                        $guardarfua=fuaModel::agregar_fua_modelo($datosfua);
                        $alerta=[ 
                            "Alerta"=>"limpiar",
                            "Titulo"=>"Fua registrado",
                            "Texto"=>"Fua registro con exito $idpatient",
                            "Tipo"=>"success"
                            ];

                }
                else{
                    $alerta=[
                        "Alerta"=>"error",
                        "Titulo"=>"Usuario no activo",
                        "Texto"=>"Tenemos inconvenientes",
                        "Tipo"=>"error"
                        ]; 
                }
              

            }
        }
        return mainModel::sweet_alert($alerta);
    }  

     
    

    
}
