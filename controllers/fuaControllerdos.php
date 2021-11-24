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

       
        //ingresar datos
        $codigoE=mainModel::limpiar_cadena($_POST['cod-empleado']);
        $codigoE=mainModel::decryption ($codigoE);
        $querye=mainModel::ejecutar_consulta_simple("SELECT idemployee FROM employees WHERE iduser='$codigoE'");
        $de=$querye->rowCount();
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
                
                if($ca>1){

                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Error comuniquese con Leo",
                        "Texto"=>"Hay más de 2 pacientes con los mismos datos",
                        "Tipo"=>"error"
                        ];
                }

                else{

                    
                    $fechaalta=NULL;
                    $fechaingreso=NULL;
                    $fechacorte=NULL;
                    $ultimoidfua=mainModel::ejecutar_consulta_simple("SELECT idfua FROM fuas ORDER BY idfua DESC LIMIT 1");
                    $datosfua=$ultimoidfua->fetch();
                    $idfua= $datosfua['idfua']+1;
                    $codigoE=mainModel::limpiar_cadena($_POST['cod-empleado']);
                    $codigoE=mainModel::decryption ($codigoE);
                    $querye=mainModel::ejecutar_consulta_simple("SELECT idemployee FROM employees WHERE iduser='$codigoE'");
                    $datosempleado=$querye->fetch();
                    $idempleado=$datosempleado['idemployee'];
                    $ultimoid=mainModel::ejecutar_consulta_simple("SELECT idpatient FROM patients ORDER BY idpatient DESC LIMIT 1");
                    $datospaciente=$ultimoid->fetch();
                    $idpatient=$datospaciente['idpatient'];
                    $datos=[
                            "idfua"=>$idfua,
                            "patientDiresa"=> $padiresa,
                            "patientTypeSIS"=>$patiposeguro,
                            "patientNroSIS"=> $panroseguro,
                            "fuaNro"=>$fuanro,
                            "fuaSheetReferene"=> $nroref,
                            "fuaDateAttentions"=> "2021-08-07",
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
                            "idpatient"=>"16",
                            "idipressDestination"=>$idipressDestination,
                            "idbconcept"=>$idconcepto, 
                            "iddestination"=>$iddestino,  
                            "idtypefua"=>$idtipofua
                        //idtriaje
                    ];                            
                        $guardarfua=fuaModel::agregar_fua_modelo($datos);
                        var_dump($guardarfua);

                        $alerta=[ 
                        "Alerta"=>"limpiar",
                        "Titulo"=>"Paciente sin DNI",
                        "Texto"=>"Paciente registrado sin DNI , $idfua, $idpatient",
                        "Tipo"=>"success"
                        ];

                       
                        //var_dump ($guardarfua);

                }
                
                
            }

            else
            {
                $consultadni=mainModel::ejecutar_consulta_simple("SELECT idpatient FROM patients WHERE patientDocument='$padni'");
                $c1=$consultadni->rowCount();
                $datospaciente=$consultadni->fetch();
                
               
                 if($c1!=1)
                 {
                   
                    $alerta=[ 
                        "Alerta"=>"limpiar",
                        "Titulo"=>"DNI no hay",
                        "Texto"=>"no hay $c1",
                        "Tipo"=>"success"
                    ];
                    
                    
                 } 
                 else
                 {
                    //insertar triaje
                    //$idpatient=$datospaciente['idpatient'];
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

     
    

    
}
