<?php
if ($peticionAjax){
    require_once "../models/receptionModel.php";
} else{
    require_once "./models/receptionModel.php";
}
class receptionController extends receptionModel{
    public function agregar_recepcion_muestra_controlador()
    { 

       /* $optrecepcion=mainModel::limpiar_cadena(base64_decode($_POST['optionsRecepcion']));
        $observacion=mainModel::limpiar_cadena($_POST['obs-reg']);*/
        $fecharecepcion=mainModel::limpiar_cadena($_POST['fecharecepcion']);
        $optrecepcion="";
        $observacion="";
        
        
       if(!isset($_POST['optionsRecepcion'])){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un error inesperado",
                "Texto"=>"Especifique si o no en la recepción",
                "Tipo"=>"error"
            ];
        }
        else{
                $optrecepcion=mainModel::limpiar_cadena(base64_decode($_POST['optionsRecepcion']));
                if($optrecepcion=="Si")
                {

                     $observacion="RECEPCIONADO";
                     $codigoM=mainModel::limpiar_cadena($_POST['cod-muestra']);
                     $codigoE=mainModel::limpiar_cadena($_POST['cod-empleado']);
                     $codigoM=mainModel::decryption ($codigoM);
                     $codigoE=mainModel::decryption ($codigoE);
                     $estadoM="2";
                     $querye=mainModel::ejecutar_consulta_simple("SELECT idEmployee FROM employees WHERE usCode='$codigoE'");
                     $c1=$querye->rowCount();                                                                                                           
                    if($c1>=1)
                    {
                        $datosEmpleado=$querye->fetch();
                        $idEmpleado=$datosEmpleado['idEmployee'];
                        //$datosEmpleado=$querye->fetch();
                        $datos=[
                                      
                            "FechaRecepcion"=>$fecharecepcion,
                            "Muestra"=>$codigoM,
                            "EstadoRecepcion"=>$optrecepcion,
                            "Observacion"=>$observacion,
                            "Empleado"=>$idEmpleado
                            
                        ];
                                                    
                        $guardarmuestra=receptionModel::agregar_recepcion_muestra_modelo($datos);   
                        $modificarhg=receptionModel::modificar_muestra_modelo($codigoM, $estadoM);                         
                            $alerta=[ 
                            "Alerta"=>"recargar",
                            "Titulo"=>"Muestra recepcionada",
                            "Texto"=>"Se ha registrado la recepción de la muestra",
                            "Tipo"=>"success"
                            ];   
                                               

                    }else{
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Muestra no recepcionada",
                            "Texto"=>"Tenemos inconvenientes",
                            "Tipo"=>"error"
                            ]; 
                        }
                }
                else{
                    if($_POST['obs-reg']==""){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"Especifique motivo de la no recepción",
                            "Tipo"=>"error"
                        ];
                    }else{
                        $observacion=mainModel::limpiar_cadena($_POST['obs-reg']);
                        $codigoM=mainModel::limpiar_cadena($_POST['cod-muestra']);
                        $codigoE=mainModel::limpiar_cadena($_POST['cod-empleado']);
                        $codigoM=mainModel::decryption ($codigoM);
                        $codigoE=mainModel::decryption ($codigoE);
                        $estadoM="1";
                        $querye=mainModel::ejecutar_consulta_simple("SELECT idEmployee FROM employees WHERE usCode='$codigoE'");
                        $c1=$querye->rowCount();                                                                                                           
                        if($c1>=1)
                        {
                            $datosEmpleado=$querye->fetch();
                            $idEmpleado=$datosEmpleado['idEmployee'];
                            $datosEmpleado=$querye->fetch();
                            $datos=[
                                        
                                "FechaRecepcion"=>$fecharecepcion,
                                "Muestra"=>$codigoM,
                                "EstadoRecepcion"=>$optrecepcion,
                                "Observacion"=>$observacion,
                                "Empleado"=>$idEmpleado
                                
                            ];
                                                    
                    
                        $guardarmuestra=receptionModel::agregar_recepcion_muestra_modelo($datos);   
                        $modificarhg=receptionModel::modificar_muestra_modelo($codigoM, $estadoM);                           
                            $alerta=[ 
                            "Alerta"=>"limpiar",
                            "Titulo"=>"Muestra registrada",
                            "Texto"=>"Se ha registrado la NO recepcion de la muestra",
                            "Tipo"=>"success"
                            ];   
                            /*echo'<script>window.location.href="'.SERVERURL.'muestralist/"</script>';*/                   

                    }else{
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Muestra no registrada",
                            "Texto"=>"Tenemos inconvenientes",
                            "Tipo"=>"error"
                            ]; 
                        }

                    }

                }
            
               
            }
        
            return mainModel::sweet_alert($alerta); 
        
        
        
      //FINALIZA LA FUNCION   
    }
        
    
 
    
    public function datos_recepcion_controlador($tipo, $codigo){ 
        $codigo=mainModel::decryption ($codigo);
        $tipo=mainModel::limpiar_cadena($tipo);

        return receptionModel::datos_recepcion_modelo($tipo, $codigo);
    }
   
    public function datos_norecepionado_controlador($tipo, $codigo){ 
        $codigo=mainModel::decryption ($codigo);
        $tipo=mainModel::limpiar_cadena($tipo);

        return receptionModel::datos_norecepcionados_modelo($tipo, $codigo);
    }

    public function paginador_registro_controlador($pagina, $registros, $privilegio, $url, $tipoempleado, $empleado, $busqueda)
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
            $consulta="SELECT SQL_CALC_FOUND_ROWS  idReceptionSample, srDateReception, srStateReception, rece.idGynecologicalHistory, 
            paDNI, esName,hgRecepcionYesNo,hgStateSample, hgCodeLamina, 
            paName, paLastName,  hgDateSample, tabla1.emName as Registro, tabla2.emName as Recepcion
            FROM receptionsamples as rece inner join gynecologicalhistorys on 			rece.idgynecologicalhistory=gynecologicalhistorys.idGynecologicalHistory
            inner join patients on patients.paCode=gynecologicalhistorys.paCode
            inner join employees as tabla1 on gynecologicalhistorys.idEmployee =tabla1.idEmployee 
            inner join establishments on tabla1.idEstablishment=establishments.idEstablishment
            inner join employees as tabla2 on rece.idEmployee=tabla2.idEmployee WHERE (paName LIKE '%$busqueda%' or paDNI LIKE '%$busqueda%')
           ORDER BY idGynecologicalHistory DESC
           LIMIT $inicio, $registros";
            

        }else{ 
            
           //ojo solo para ver de los patientss
           
           switch($tipoempleado){
               case "Administrador":
                $consulta="SELECT SQL_CALC_FOUND_ROWS  idReceptionSample, srDateReception, srStateReception, rece.idGynecologicalHistory, 
                paDNI, esName,hgRecepcionYesNo,hgStateSample, hgCodeLamina, 
                paName, paLastName,  hgDateSample, tabla1.emName as Registro, tabla2.emName as Recepcion
                FROM receptionsamples as rece inner join gynecologicalhistorys on rece.idgynecologicalhistory=gynecologicalhistorys.idGynecologicalHistory
                inner join patients on patients.paCode=gynecologicalhistorys.paCode
                inner join employees as tabla1 on gynecologicalhistorys.idEmployee =tabla1.idEmployee 
                inner join establishments on patients.idEstablishment=establishments.idEstablishment
                inner join employees as tabla2 on rece.idEmployee=tabla2.idEmployee 
                WHERE hgStateSample='2'
                ORDER BY srDateReception DESC
                LIMIT $inicio, $registros";
               break;
              
               case "Recepcionador":
                $consulta="SELECT SQL_CALC_FOUND_ROWS  idReceptionSample, srDateReception, srStateReception, rece.idGynecologicalHistory, 
                paDNI, esName,hgRecepcionYesNo,hgStateSample, hgCodeLamina, 
                paName, paLastName,  hgDateSample, tabla1.emName as Registro, tabla2.emName as Recepcion
                FROM receptionsamples as rece inner join gynecologicalhistorys on rece.idgynecologicalhistory=gynecologicalhistorys.idGynecologicalHistory
                inner join patients on patients.paCode=gynecologicalhistorys.paCode
                inner join employees as tabla1 on gynecologicalhistorys.idEmployee =tabla1.idEmployee 
                inner join establishments on patients.idEstablishment=establishments.idEstablishment
                inner join employees as tabla2 on rece.idEmployee=tabla2.idEmployee 
                ORDER BY idReceptionSample DESC
                LIMIT $inicio, $registros";
               break;
               case "Tecnologo":
                $consulta="SELECT SQL_CALC_FOUND_ROWS  idReceptionSample, srDateReception, srStateReception, rece.idGynecologicalHistory, 
                paDNI, esName,hgRecepcionYesNo,hgStateSample, hgCodeLamina, 
                paName, paLastName,  hgDateSample, tabla1.emName as Registro, tabla2.emName as Recepcion
                FROM receptionsamples as rece inner join gynecologicalhistorys on rece.idgynecologicalhistory=gynecologicalhistorys.idGynecologicalHistory
                inner join patients on patients.paCode=gynecologicalhistorys.paCode
                inner join employees as tabla1 on gynecologicalhistorys.idEmployee =tabla1.idEmployee 
                inner join establishments on patients.idEstablishment=establishments.idEstablishment
                inner join employees as tabla2 on rece.idEmployee=tabla2.idEmployee 
               
               /*WHERE hgStateSample='1' OR  hgStateSample='2'*/
                WHERE hgStateSample='2'
                ORDER BY srDateReception DESC
                LIMIT $inicio, $registros";
               break;
               
               case "Medico":
                $consulta="SELECT SQL_CALC_FOUND_ROWS  idReceptionSample, srDateReception, srStateReception, rece.idGynecologicalHistory, 
                paDNI, esName,hgRecepcionYesNo,hgStateSample, hgCodeLamina, 
                paName, paLastName,  hgDateSample, tabla1.emName as Registro, tabla2.emName as Recepcion
                FROM receptionsamples as rece inner join gynecologicalhistorys on rece.idgynecologicalhistory=gynecologicalhistorys.idGynecologicalHistory
                inner join patients on patients.paCode=gynecologicalhistorys.paCode
                inner join employees as tabla1 on gynecologicalhistorys.idEmployee =tabla1.idEmployee 
                inner join establishments on patients.idEstablishment=establishments.idEstablishment
                inner join employees as tabla2 on rece.idEmployee=tabla2.idEmployee 
               
               /*WHERE hgStateSample='1' OR  hgStateSample='2'*/
                WHERE hgStateSample='2'
                ORDER BY srDateReception DESC
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
                   <th class="text-center">FECHA RECEPCION</th>
                   <th class="text-center">DNI</th>
        
                   <th class="text-center">NOMBRES</th>
                   <th class="text-center">APELLIDOS</th>
                   <th class="text-center">FECHA MUESTRA</th>                   
                   <th class="text-center">LUGAR PROCEDENCIA</th>
                   <th class="text-center">RECEPCIONADO POR</th>

                   <th class="text-center">DATOS MUESTRA</th>
                   <th class="text-center">EN IREN</th>
                   <th class="text-center">ESTADO</th>
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
                       <td>'.$rows['hgCodeLamina'].'</td>
                       <td>'.$rows['srDateReception'].'</td>
                       <td>'.$rows['paDNI'].'</td>
                       <td>'.$rows['paName'].'</td>   
                       <td>'.$rows['paLastName'].'</td>
                       <td>'.$rows['hgDateSample'].'</td> 
                       <td>'.$rows['esName'].'</td>                     
                       <td>'.$rows['Recepcion'].'</td>';                   
                       
                       $tabla.='
                       <td>
                       <a href="'.SERVERURL.'sample-print/'.mainModel::encryption($rows['idGynecologicalHistory']).'/" class="btn btn-success btn-raised btn-xs">
                           <i class="zmdi zmdi-refresh"></i>
                       </a>
                       </td>';
                       if($rows['hgRecepcionYesNo']=="0"){
                           if($tipoempleado=="Recepcionador" || $tipoempleado=="Administrador" ){
                               $tabla.='
                               <td>
                                   <a href="'.SERVERURL.'reception-sample/'.mainModel::encryption($rows['idGynecologicalHistory']).'/" class="btn btn-danger btn-raised btn-xs">
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
                           <a href="" class="btn btn-primary btn-raised btn-xs">
                           SI
                            </a>
                           </td>
                           ';
                       }
                       
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
                                    <td>
                                        <a href="'.SERVERURL.'no-reception/'.mainModel::encryption($rows['idReceptionSample']).'/" class="btn btn-danger btn-raised btn-xs">
                                        NO RECEPCIONADO
                                        </a>
                                    </td>
                               ';
                           break;
                           case "2":
                            
                            switch ($tipoempleado) {
                                case 'Administrador':
                                    $tabla.='
                                    <td>
                                        <a href="'.SERVERURL.'reading-first/'.mainModel::encryption($rows['idReceptionSample']).'/" class="btn btn-danger btn-raised btn-xs">
                                        PROCESAR
                                        </a>
                                    </td>
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
                               $tabla.='
                               <td>
                               <li class="btn btn-danger btn-raised btn-xs">LECTURA</li>
                               </td>
                               ';
                           
                           break;
                           case "4":
                               $tabla.='
                               <td>
                               <li class="btn btn-danger btn-raised btn-xs">RESULTADO</li>
                               </td>
                               ';                          
                           break;
                       }
                     
                                             
                       if($privilegio<=2){
                          
                       $tabla.='
                       <!--<td>
                       <a href="'.SERVERURL.'sample-update/'.mainModel::encryption($rows['idGynecologicalHistory']).'/" class="btn btn-success btn-raised btn-xs">
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
     //controlador para paginar recepcion de muestras
   
}