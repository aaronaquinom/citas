<?php
if ($peticionAjax){
    require_once "../models/firstreadingModel.php";
} else{
    require_once "./models/firstreadingModel.php";
}
class firstreadingController extends firstreadingModel{
    public function agregar_resultado_controlador()
    {
        $fecharesultado=mainModel::limpiar_cadena($_POST['fecha-resultado']);
       
        
        $obsespecimen=mainModel::limpiar_cadena(isset($_POST['obsespecimen-reg'])?$_POST['obsespecimen-reg']:null);
       

        
        $cmbClasificacion=mainModel::limpiar_cadena(isset($_POST['cmbClasificacion'])?$_POST['cmbClasificacion']:null);
        $obsclasificacion=mainModel::limpiar_cadena(isset($_POST['obsclasificacion-reg'])?$_POST['obsclasificacion-reg']:null);//vacio
        
        
        
        $cmbescamoso=mainModel::limpiar_cadena(isset($_POST['cmbescamoso'])?$_POST['cmbescamoso']:null);//vacio;
        $tipoescamoso=mainModel::limpiar_cadena(isset($_POST['tipoescamoso-reg'])?$_POST['tipoescamoso-reg']:null);//vacio

        
        $cmbglandular=mainModel::limpiar_cadena(isset($_POST['cmbglandular'])?$_POST['cmbglandular']:null);//vacio
        $tipoeglandular=mainModel::limpiar_cadena(isset($_POST['tipoeglandular-reg'])?$_POST['tipoglandular-reg']:null);//vacio

        $neomalignas=mainModel::limpiar_cadena(isset($_POST['neomalignas-reg'])?$_POST['neomalignas-reg']:null);//vacio

        $cmbBenignos=mainModel::limpiar_cadena(isset($_POST['cmbBenignos'])?$_POST['cmbBenignos']:null);//vacio
        $obsBenigno=mainModel::limpiar_cadena(isset($_POST['obsbenigno-reg'])?$_POST['obsbenigno-reg']:null);//vacio
        
        $cmbHormonal=mainModel::limpiar_cadena(isset($_POST['cmbHormonal'])?$_POST['cmbHormonal']:null);//vacio
        $obsHormonal=mainModel::limpiar_cadena(isset($_POST['obshormonal-reg'])?$_POST['obshormonal']:null);//vacio 

        $conclusiones=mainModel::limpiar_cadena(isset($_POST['cmbconclusiones'])?$_POST['cmbconclusiones']:null);//no vacio 
        $obsConclusiones=mainModel::limpiar_cadena(isset($_POST['conclusiones-reg'])?$_POST['conclusiones-reg']:null);//no vacio
    
        //$obsHormonal=mainModel::limpiar_cadena(base64_decode(isset($_POST['obshormonal-reg'])?$_POST['obshormonal']:null));//vacio 
        $optionsNuevam="";
       


       if(!isset($_POST['optionsNuevam'])){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un error inesperado",
                "Texto"=>"Especifique si o no para nueva muestra",
                "Tipo"=>"error"
            ];
        }
        else{
                $optionsNuevam=mainModel::limpiar_cadena(base64_decode($_POST['optionsNuevam']));
                if($optionsNuevam=="Si"){

                    
                    $fecharesultado=mainModel::limpiar_cadena($_POST['fecha-resultado']);
                    if(!isset($_POST['cmbEspecimen'])){

                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"Especifique la calidad del especimen",
                            "Tipo"=>"error"
                            ]; 
                        
                        //

                    }
                    else
                    {
                        $cmbEspecimen=mainModel::limpiar_cadena($_POST['cmbEspecimen']); 
                                        $codigoR=mainModel::limpiar_cadena($_POST['cod-registro']);
                                        $codigoE=mainModel::limpiar_cadena($_POST['cod-empleado']);
                                        $codigoR=mainModel::decryption ($codigoR);
                                        $codigoE=mainModel::decryption ($codigoE);

                                        //$codigoR es igual al idRecepcionSample 
                            
                                        $querye=mainModel::ejecutar_consulta_simple("SELECT idEmployee FROM employees WHERE usCode ='$codigoE'");
                                        $c1=$querye->rowCount();
                                            if($c1>=1)
                                            {
                                                                                 
                                               
                                                $consulta1=mainModel::ejecutar_consulta_simple("SELECT idgynecologicalhistory FROM receptionsamples WHERE idReceptionSample='$codigoR'");
                                                $recepcionmuestra=$consulta1->fetch();
                                                $idgynecologicalhistory=$recepcionmuestra['idgynecologicalhistory'];

                                                $consulta2=mainModel::ejecutar_consulta_simple("SELECT idFirstreading  FROM firstreadings");
                                                $numero=($consulta2->rowCount())+1 ;
                                                //$codlamina=mainModel::generar_codigo_lamina($letra, $numero);
                                                $codlamina=mainModel::limpiar_cadena($_POST['codlamina-reg']);
                                                $cmbEspecimen=mainModel::limpiar_cadena($_POST['cmbEspecimen']); 
                                                
                                              
                                                $cmbClasificacion="11";
                                                $obsclasificacion="";
                                                
                                                $namecmbepiteliales="1";//condiciona segundo select
                                                $cmbescamoso="1";
                                                $tipoescamoso="";//vacio
                    
                                                $namecmbglandulares="1"; //condiciona segundo select 
                                                $cmbglandular="1";
                                                $tipoeglandular="";//vacio
                    
                                                $neomalignas="";//vacio
                    
                                                $cmbBenignos="21";
                                                $obsBenigno="";
                                                
                                                $cmbHormonal="4";
                                                $obsHormonal="";
                                            
                                                $conclusiones=mainModel::limpiar_cadena($_POST['cmbconclusiones']);//vacio 
                                                $obsconclusiones=mainModel::limpiar_cadena($_POST['conclusiones-reg']);//vacio 
                    
                                                //$tecnologo=mainModel::limpiar_cadena(base64_decode($_POST['cmbTecnologo']));
                    
                                                $datosEmpleado=$querye->fetch();
                                                $idEmpleado=$datosEmpleado['idEmployee'];
                                                    $datos=[                
                                                    "CodLamina"=>$codlamina,
                                                    "Estado"=>"No",
                                                   
                                                    "Especimen"=>$cmbEspecimen,
                                                    "ObsEspecimen"=> $obsespecimen,
                                                    
                    
                                                    "ClasificacionGeneral"=> $cmbClasificacion,
                                                    "ObsClasificacion"=> $obsclasificacion,
                                                    
                                                    "CeEscamosa"=> $cmbescamoso,
                                                    "Carcicoma"=> $tipoescamoso,

                                                    "CeGlandular" =>$cmbglandular,
                                                    "CelulasGlandulares" => $tipoeglandular,
            
                                                    "NeoplasiasMalignas"=>$neomalignas,
                    
                                                    "CelulasBenignas"=> $cmbBenignos,
                                                    "ObsBenigno"=>$obsBenigno,
                                                    
                    
                                                    "Hormonal"=> $cmbHormonal,
                                                    "ObsHormonal"=> $obsHormonal,
                                                    
                    
                                                    "Conclusiones"=> $conclusiones,
                                                    "ObsConclusiones"=>$obsConclusiones,
                                                    "NuevamuestraSiNo"=> $optionsNuevam,
                                                    "FechaResultado"=> $fecharesultado,
                                                    "Empleado"=>$idEmpleado,
                                                    "RecepcionMuestra"=>$codigoR
                                                ];
                                                                            
                                                $guardarmuestra=firstreadingModel::agregar_resultado_modelo($datos); 
                                                $modificarmuestra=firstreadingModel::modificar_muestra_modelo($idgynecologicalhistory);//modificar muestra                           
                                                    $alerta=[ 
                                                    "Alerta"=>"limpiar",
                                                    "Titulo"=>"Lectura registrada",
                                                    "Texto"=>"Primera lectura se ha guardado",
                                                    "Tipo"=>"success"
                                                    ];   
                                            }else
                                            {
                                                $alerta=[
                                                    "Alerta"=>"simple",
                                                    "Titulo"=>"Lectura no registrada",
                                                    "Texto"=>"Tenemos inconvenientes",
                                                    "Tipo"=>"error"
                                                    ]; 
                                                
                                                //
                                            }  
                                    
                                
                            
                                
                            
                                
                            
                        
                    }
                  
              
                    

                }
                else{
                    if($optionsNuevam=="No")
                    {
                        $optionsNuevam=mainModel::limpiar_cadena(base64_decode($_POST['optionsNuevam']));
                        $fecharesultado=mainModel::limpiar_cadena($_POST['fecha-resultado']);
                        if(!isset($_POST['cmbEspecimen'])){

                            $alerta=[
                                "Alerta"=>"simple",
                                "Titulo"=>"Ocurrio un error inesperado",
                                "Texto"=>"Especifique la calidad del especimen",
                                "Tipo"=>"error"
                                ]; 
                            
                            //
    
                        }
                        else
                        {
                            
                            
                                        $codigoR=mainModel::limpiar_cadena($_POST['cod-registro']);
                                        $codigoE=mainModel::limpiar_cadena($_POST['cod-empleado']);
                                        $codigoR=mainModel::decryption ($codigoR);
                                        $codigoE=mainModel::decryption ($codigoE);
                            
                                        $querye=mainModel::ejecutar_consulta_simple("SELECT idEmployee FROM employees WHERE usCode ='$codigoE'");
                                        $c1=$querye->rowCount();
                                            if($c1>=1)
                                            {
                                                                                 
                                                $consulta1=mainModel::ejecutar_consulta_simple("SELECT idgynecologicalhistory FROM receptionsamples WHERE idReceptionSample='$codigoR'");
                                                $recepcionmuestra=$consulta1->fetch();
                                                $idgynecologicalhistory=$recepcionmuestra['idgynecologicalhistory'];

                                                $consulta2=mainModel::ejecutar_consulta_simple("SELECT idFirstreading  FROM firstreadings");
                                                $numero=($consulta2->rowCount())+1 ;
                                                //$codlamina=mainModel::generar_codigo_lamina($letra, $numero);
                                                $codlamina=mainModel::limpiar_cadena($_POST['codlamina-reg']);
                                                $cmbEspecimen=mainModel::limpiar_cadena($_POST['cmbEspecimen']); 
                                                
                                              
                                             
                                            
                                                $conclusiones=mainModel::limpiar_cadena($_POST['cmbconclusiones']);//vacio 
                                                $obsconclusiones=mainModel::limpiar_cadena($_POST['conclusiones-reg']);//vacio 
                    
                                                //$tecnologo=mainModel::limpiar_cadena(base64_decode($_POST['cmbTecnologo']));
                    
                                                $datosEmpleado=$querye->fetch();
                                                $idEmpleado=$datosEmpleado['idEmployee'];
                                                    $datos=[                
                                                    "CodLamina"=>$codlamina,
                                                    "Estado"=>"No",
                                                   
                                                    "Especimen"=>$cmbEspecimen,
                                                    "ObsEspecimen"=> $obsespecimen,
                                                    
                    
                                                    "ClasificacionGeneral"=> $cmbClasificacion,
                                                    "ObsClasificacion"=> $obsclasificacion,
                                                    
                                                    "CeEscamosa"=> $cmbescamoso,
                                                    "Carcicoma"=> $tipoescamoso,

                                                    "CeGlandular" =>$cmbglandular,
                                                    "CelulasGlandulares" => $tipoeglandular,
            
                                                    "NeoplasiasMalignas"=>$neomalignas,
                    
                                                    "CelulasBenignas"=> $cmbBenignos,
                                                    "ObsBenigno"=>$obsBenigno,
                                                    
                    
                                                    "Hormonal"=> $cmbHormonal,
                                                    "ObsHormonal"=> $obsHormonal,
                                                    
                    
                                                    "Conclusiones"=> $conclusiones,
                                                    "ObsConclusiones"=>$obsConclusiones,
                                                    "NuevamuestraSiNo"=> $optionsNuevam,
                                                    "FechaResultado"=> $fecharesultado,
                                                    "Empleado"=>$idEmpleado,
                                                    "RecepcionMuestra"=> $codigoR
                                                ];
                                                                            
                                                $guardarmuestra=firstreadingModel::agregar_resultado_modelo($datos); 
                                                $modificarmuestra=firstreadingModel::modificar_muestra_modelo($idgynecologicalhistory);//modificar muestra                           
                                                    $alerta=[ 
                                                    "Alerta"=>"limpiar",
                                                    "Titulo"=>"Lectura registrada",
                                                    "Texto"=>"Primera lectura se ha guardado",
                                                    "Tipo"=>"success"
                                                    ];   
                                            }else
                                            {
                                                $alerta=[
                                                    "Alerta"=>"simple",
                                                    "Titulo"=>"Lectura no registrada",
                                                    "Texto"=>"Tenemos inconvenientes",
                                                    "Tipo"=>"error"
                                                    ]; 
                                                
                                                //
                                            }  
                           
                            
                                    
                                
                                    
                                
                            
                        }

                    }
                    else
                    {
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Resultado no registrada",
                            "Texto"=>"Llame al administrador",
                            "Tipo"=>"error"
                            ]; 
                        
                        //
                    }
                 

                }

            }
            return mainModel::sweet_alert($alerta); 
    }
   
    
    public function datos_lectura_controlador($tipo, $codigo){ 
        $codigo=mainModel::decryption ($codigo);
        $tipo=mainModel::limpiar_cadena($tipo);

        return firstreadingModel::datos_lectura_modelo($tipo, $codigo);
    }
    public function datos_resultadodos_controlador($tipo, $codigo){ 
        $codigo=mainModel::decryption ($codigo);
        $tipo=mainModel::limpiar_cadena($tipo);

        return resultadoModelo::datos_resultadodos_modelo($tipo, $codigo);
    }
     //controlador para paginar recepcion de muestras
    
     public function paginador_lectura_controlador($pagina, $registros, $privilegio, $url, $tipoempleado, $empleado, $busqueda)
     {
         $pagina=mainModel::limpiar_cadena($pagina);
         $registros=mainModel::limpiar_cadena($registros);
         $privilegio=mainModel::limpiar_cadena($privilegio);
 
         $url=mainModel::limpiar_cadena($url);
         $url=SERVERURL.$url."/";
 
         
         $tipoempleado=mainModel::limpiar_cadena($tipoempleado);
         $empleado=mainModel::limpiar_cadena($empleado);
         $busqueda=mainModel::limpiar_cadena($busqueda);
         $tabla="";
 
         $pagina= (isset($pagina)&& $pagina>0) ? (int) $pagina : 1;
         $inicio=($pagina>0) ? (($pagina*$registros)-$registros)  : 0 ;
 
         if(isset($busqueda) && $busqueda!=""){
             $consulta="SELECT SQL_CALC_FOUND_ROWS  idFirstreading, hgRecepcionYesNo, frCodeLamina, frDateFirstreading, tecnologo.emName as Lectura, paDNI,
                 paName, paLastName, esName, tabla1.emName as Muestra, hgDateSample, hgStateSample
               FROM firstreadings inner join receptionsamples on firstreadings.idReceptionSample=receptionsamples.idReceptionSample 
               inner join employees as tecnologo on firstreadings.idEmployee=tecnologo.idEmployee
               inner join gynecologicalhistorys on receptionsamples.idgynecologicalhistory=gynecologicalhistorys.idGynecologicalHistory 
               inner join patients on patients.paCode=gynecologicalhistorys.paCode
               inner join employees as tabla1 on gynecologicalhistorys.idEmployee=tabla1.idEmployee
               inner join establishments on patients.idEstablishment=establishments.idEstablishment
               inner join employees as tabla2 on receptionsamples.idEmployee=tabla2.idEmployee WHERE (paName LIKE '%$busqueda%' or paDNI LIKE '%$busqueda%')
            ORDER BY idFirstreading DESC
           
            LIMIT $inicio, $registros";
             
 
         }else{ 
             
            //ojo solo para ver de los patientss
            
            switch($tipoempleado){
                case "Administrador":
                 $consulta="SELECT SQL_CALC_FOUND_ROWS  idFirstreading, hgRecepcionYesNo, frCodeLamina, frDateFirstreading, tecnologo.emName as Lectura, paDNI,
                 paName, paLastName, esName, tabla1.emName as Muestra, hgDateSample, hgStateSample
               FROM firstreadings inner join receptionsamples on firstreadings.idReceptionSample=receptionsamples.idReceptionSample 
               inner join employees as tecnologo on firstreadings.idEmployee=tecnologo.idEmployee
               inner join gynecologicalhistorys on receptionsamples.idgynecologicalhistory=gynecologicalhistorys.idGynecologicalHistory 
               inner join patients on patients.paCode=gynecologicalhistorys.paCode
               inner join employees as tabla1 on gynecologicalhistorys.idEmployee=tabla1.idEmployee
               inner join establishments on patients.idEstablishment=establishments.idEstablishment
               inner join employees as tabla2 on receptionsamples.idEmployee=tabla2.idEmployee
               WHERE hgStateSample='3' or hgStateSample='4'
               ORDER BY frDateFirstreading DESC
                 LIMIT $inicio, $registros";
                break;
               
                case "Recepcionador":
                 $consulta="";
                break;
                case "Tecnologo":
                 $consulta="SELECT SQL_CALC_FOUND_ROWS  idFirstreading, hgRecepcionYesNo, frCodeLamina, frDateFirstreading, tecnologo.emName as Lectura, paDNI,
                 paName, paLastName, esName, tabla1.emName as Muestra, hgDateSample, hgStateSample
               FROM firstreadings inner join receptionsamples on firstreadings.idReceptionSample=receptionsamples.idReceptionSample 
               inner join employees as tecnologo on firstreadings.idEmployee=tecnologo.idEmployee
               inner join gynecologicalhistorys on receptionsamples.idgynecologicalhistory=gynecologicalhistorys.idGynecologicalHistory 
               inner join patients on patients.paCode=gynecologicalhistorys.paCode
               inner join employees as tabla1 on gynecologicalhistorys.idEmployee=tabla1.idEmployee
               inner join establishments on patients.idEstablishment=establishments.idEstablishment
               inner join employees as tabla2 on receptionsamples.idEmployee=tabla2.idEmployee
               WWHERE hgStateSample='3' or hgStateSample='4'
               ORDER BY idFirstreading DESC
                
                 LIMIT $inicio, $registros";
                break;

                case "Medico":
                    $consulta="SELECT SQL_CALC_FOUND_ROWS  idFirstreading, hgRecepcionYesNo, frCodeLamina, frDateFirstreading, tecnologo.emName as Lectura, paDNI,
                    paName, paLastName, esName, tabla1.emName as Muestra, hgDateSample, hgStateSample
                  FROM firstreadings inner join receptionsamples on firstreadings.idReceptionSample=receptionsamples.idReceptionSample 
                  inner join employees as tecnologo on firstreadings.idEmployee=tecnologo.idEmployee
                  inner join gynecologicalhistorys on receptionsamples.idgynecologicalhistory=gynecologicalhistorys.idGynecologicalHistory 
                  inner join patients on patients.paCode=gynecologicalhistorys.paCode
                  inner join employees as tabla1 on gynecologicalhistorys.idEmployee=tabla1.idEmployee
                  inner join establishments on patients.idEstablishment=establishments.idEstablishment
                  inner join employees as tabla2 on receptionsamples.idEmployee=tabla2.idEmployee
                 WHERE hgStateSample='3' or hgStateSample='4'
                  ORDER BY frDateFirstreading DESC
                   
                    LIMIT $inicio, $registros";
                   break;

              
               
            }
           
           
         }
 
            $conexion = mainModel::conectar();
 
            $datos = $conexion->query($consulta);
 
            $datos = $datos->fetchAll();
 
            $total=$conexion->query("SELECT FOUND_ROWS()");
            $total = (int) $total->fetchColumn();
 
        $Npaginas=ceil($total/$registros);
 
        $tabla.='
        <div class="table-responsive">
            <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">COD.</th>
                    <th class="text-center">FECHA LECTURA</th>
                   <!-- <th class="text-center">RESPONSABLE LECTURA</th>-->
                    <th class="text-center">DNI PACIENTE</th>
                    
         
                    <th class="text-center">NOMBRES</th>
                    <th class="text-center">APELLIDOS</th>
                    <th class="text-center">LUGAR PROCEDENCIA</th>
                    
                    <!--<th class="text-center">FECHA MUESTRA</th>-->                   
                    
                    <th class="text-center">RESPONSABLE</th>
 
                    <th class="text-center">DATOS MUESTRA</th>
                    <th class="text-center">ESTADO</th>
                    <th class="text-center">DATOS LECTURA</th>
                    
                    
                    ';
                
                if($privilegio<=2){
                    $tabla.='
                
                  <!-- <th class="text-center">MODIFICAR</th>-->
                    
                    ';
                }
                if($privilegio==1){
                    $tabla.='
                   <!-- <th class="text-center">ELIMINAR</th>-->
                    ';
                }
        $tabla.='  
                </tr>
            </thead>
            <tbody>'
        ;
        
        if($total>=1 && $pagina<=$Npaginas){
            $contador=$inicio+1;
            foreach($datos as $rows){
                $estadomuestra=$rows['hgStateSample'];
                $tabla.='
                    <tr>
                        <td>'.$contador.'</td>
                        <td>'.$rows['frCodeLamina'].'</td>
                        <td>'.$rows['frDateFirstreading'].'</td>
                        
                        <td>'.$rows['paDNI'].'</td>
                        <td>'.$rows['paName'].'</td>   
                        <td>'.$rows['paLastName'].'</td>
                        <td>'.$rows['esName'].'</td>  
                        
                   
                        <td>'.$rows['Lectura'].'</td>';                   
                        
                        $tabla.='
                        <td>
                        <a href="'.SERVERURL.'sample-print/'.mainModel::encryption($rows['idFirstreading']).'/" class="btn btn-success btn-raised btn-xs">
                            <i class="zmdi zmdi-refresh"></i>
                        </a>
                        </td>';
                       
                       
                        switch($estadomuestra){
                            case "0":
                                $tabla.='
                                <td>
                                <li class="btn btn-danger btn-raised btn-xs">NO LLEGA</li>
                                </td>
                                ';
                            break;
                            case "1":
                                $tabla.='
                                   
                                ';
                            break;
                            case "2":
                             
                             switch ($tipoempleado) {
                                 case 'Administrador':
                                     $tabla.='
                                    
                                     '; 
                                     break;
                                 case 'Tecnologo':
                                     $tabla.='
                                     <td>
                                         <a href="'.SERVERURL.'reading-first/'.mainModel::encryption($rows['idReceptionSample']).'/" class="btn btn-danger btn-raised btn-xs">
                                         PROCESAR
                                         </a>
                                     </td>
                                     '; 
                                     break;
                                 
                                 default:
                                 $tabla.='
                                 <td>
                                 <li class="btn btn-danger btn-raised btn-xs">POR PROCESAR</li>
                                 </td>
                                 ';
                                     break;
                             }
                                
                             
                                
                            break;
                            case "3":
                                 switch ($tipoempleado) {
                                 case 'Administrador':
                                     $tabla.='
                                     <td>
                                     <a href="'.SERVERURL.'result-end/'.mainModel::encryption($rows['idFirstreading']).'/" class="btn btn-danger btn-raised btn-xs">
                                     LECTURA
                                     </a>
                                    </td>
                                     '; 
                                     break;
                                 case 'Medico':
                                     $tabla.='
                                     <td>
                                         <a href="'.SERVERURL.'result-end/'.mainModel::encryption($rows['idFirstreading']).'/" class="btn btn-danger btn-raised btn-xs">
                                         LECTURA
                                         </a>
                                     </td>
                                     '; 
                                     break;
                                 
                                 default:
                                 $tabla.='
                                 <td>
                                 <li class="btn btn-danger btn-raised btn-xs">LECTURA</li>
                                 </td>
                                 ';
                                     break;
                             }
                            
                            break;
                            case "4":
                                $tabla.='
                                <td>
                                <li class="btn btn-danger btn-raised btn-xs">RESULTADO</li>
                                </td>
                                ';                          
                            break;
                        }
                        if($rows['hgRecepcionYesNo']=="0"){
                            if($tipoempleado=="Recepcionador" || $tipoempleado=="Administrador" ){
                                $tabla.='
                                <td>
                                    <a class="btn btn-danger btn-raised btn-xs"> href="'.SERVERURL.'reception-sample/'.mainModel::encryption($rows['idFirstreading']).'/">
                                    NO
                                    </a>
                                </td>
                                '; 
                            }else{
                                $tabla.='
                                <td>
                                <li class="btn btn-danger btn-raised btn-xs">NO</li>
                                </td>
                                '; 
                            }
                           
                        }
                        else{
                            $tabla.='
                            <td>
                             <a href="'.SERVERURL.'reading-print/'.mainModel::encryption($rows['idFirstreading']).'/" class="btn btn-success btn-raised btn-xs">
                            <i class="zmdi zmdi-refresh"></i>
                            </a>
                            </td>';
                        }
                      
                                              
                        if($privilegio<=2){
                           
                        $tabla.='
                        <!--<td>
                        <a href="'.SERVERURL.'sample-update/'.mainModel::encryption($rows['idFirstreading']).'/" class="btn btn-success btn-raised btn-xs">
                            <i class="zmdi zmdi-refresh"></i>
                        </a>
                        </td>-->
                        ';
                        }
                        if($privilegio==1){
                        $tabla.='
                        <!--<td>
                           <form>
                               <button type="submit" class="btn btn-danger btn-raised btn-xs">
                                   <i class="zmdi zmdi-delete"></i>
                               </button>
                           </form>
                       </td> -->
                        ';  
                        }
                        $tabla.='
                        </tr>
                        ';
                ;$contador ++;
            }
 
        }else{
            if($total>=1){
                $tabla.='
                <tr>
                    <td coslpan="7">
                        <a href="'.SERVERURL.$paginaurl.'/" class="btn btn-sm btn-info btn-raised">
                         Haga clic para recargar el listado
                        </a>
                    </td>
                </tr>
                ';
            }else{
                 $tabla.='
                <tr>
                    <td coslpan="7">No hay registro de la muestra del paciente</td>
                </tr>
                ';
            }
           
        }
        $tabla.='</tbody></table></div>';
        if($total>=1 && $pagina<=$Npaginas){
            $tabla.=mainModel::paginar_tablas($pagina,$Npaginas,$url);
        }
        return $tabla;
     }
  
  
    
}