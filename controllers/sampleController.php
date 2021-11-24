<?php
if ($peticionAjax){
    require_once "../models/sampleModel.php";
} else{
    require_once "./models/sampleModel.php";
}
class sampleController extends sampleModel{
    public function agregar_muestra_controlador()
    {  
        
        $fecharegla=mainModel::limpiar_cadena($_POST['fecharegla-reg']);
        $optembarazada=mainModel::limpiar_cadena(base64_decode($_POST['optionsEmbarazada']));
        //nuevas variables
       
        $inrese=mainModel::limpiar_cadena(isset($_POST['edad-rsexual'])?$_POST['edad-rsexual']:null);
        $parejasexual=mainModel::limpiar_cadena(isset($_POST['pareja-rsexual'])?$_POST['pareja-rsexual']:null);
        $semanaembarazo= mainModel::limpiar_cadena(isset($_POST['semana-embarazo'])?$_POST['semana-embarazo']:null);

        $numeropartos=mainModel::limpiar_cadena(isset($_POST['numero-partos'])?$_POST['numero-partos']:null);
        $numeroabortos=mainModel::limpiar_cadena(isset($_POST['numero-abortos'])?$_POST['numero-abortos']:null);
        //fin nuevas variables
        $optanticonceptivo=mainModel::limpiar_cadena($_POST['optionsAnticonceptivo']);
        $espanticonceptivo=mainModel::limpiar_cadena(isset($_POST['anti-reg'])?$_POST['anti-reg']:null);
        $optexameng=mainModel::limpiar_cadena($_POST['optionsExameng']);
        $espexameg=mainModel::limpiar_cadena(isset($_POST['espexameng-reg'])?$_POST['espexameng-reg']:null);
        $optcolposcopia=mainModel::limpiar_cadena($_POST['optionsColposcopia']);
        $espcolposcopia=mainModel::limpiar_cadena(isset($_POST['anormalcolposcopia-reg'])?$_POST['anormalcolposcopia-reg']:null);
        
        $colposcopianterior=mainModel::limpiar_cadena(isset($_POST['colposcopianterior-reg'])?$_POST['colposcopianterior-reg']:null);
        $fechacolanterior=mainModel::limpiar_cadena(isset($_POST['fechadiagnostico-reg'])?$_POST['fechadiagnostico-reg']:null);
        $fechamuestra=mainModel::limpiar_cadena($_POST['fechamuestra-reg']);
        //$insatisfactorio=mainModel::limpiar_cadena(isset($_POST['insatisfactorio-reg'])?$_POST['insatisfactorio-reg']:null);
        
        //$espanticonceptivo="";
        //$espexameg="";
        //$espcolposcopia="";
        //$fechacolanterior="";
        //$colposcopianterior="";
        $exameniva=mainModel::limpiar_cadena(isset($_POST['optionsIva'])?$_POST['optionsIva']:null); //mo asume null
        if(empty($fechacolanterior)){
            $fechacolanterior=NULL; 
        }
        if(empty($inrese)){
            $inrese=0; 
        }
        if(empty($parejasexual)){
            $parejasexual=0; 
        }
        if(empty($semanaembarazo)){
            $semanaembarazo=0; 
        }
        if(empty($numeropartos)){
            $numeropartos=0; 
        }
        if(empty($numeroabortos)){
            $numeroabortos=0; 
        }   
        if($optembarazada=="Si" && $_POST['semana-embarazo']=="")
        {
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un error inesperado",
                "Texto"=>"Especifique tiempo de embarazo en semanas",
                "Tipo"=>"error"
            ];
        }
        else
        {
            if($optanticonceptivo=="Si" && $_POST['anti-reg']=="")
            {
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Especifique metodo anticonceptivo",
                    "Tipo"=>"error"
                ];
            }
            else
            {
                
                 if($optexameng=="Anormal" && $_POST['check_lista']=="")
                {
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"Seleccione cuadrante",
                        "Tipo"=>"error"
                    ];
    
                }else
                {
                        if($optexameng=="Anormal" && $_POST['espexameng-reg']=="")
                        {
                            $alerta=[
                                "Alerta"=>"simple",
                                "Titulo"=>"Ocurrio un error inesperado",
                                "Texto"=>"Especifique examen anormal",
                                "Tipo"=>"error"
                            ];
                        }
                        else
                        {
                            if($optcolposcopia=="Normal" && $_POST['colposcopianterior-reg']=="")
                            {
                                $alerta=[
                                    "Alerta"=>"simple",
                                    "Titulo"=>"Ocurrio un error inesperado",
                                    "Texto"=>"No completo diagnostico anterior",
                                    "Tipo"=>"error"
                                ];
                            }
                            else
                            {
                                if( $optcolposcopia=="Normal" && $_POST['fechadiagnostico-reg']=="")
                                {
                                    $alerta=[
                                        "Alerta"=>"simple",
                                        "Titulo"=>"Ocurrio un error inesperado",
                                        "Texto"=>"Especifique fecha de PAP anterior",
                                        "Tipo"=>"error"
                                    ];
                                }
                                else
                                {
                                    if($optcolposcopia=="Anormal" && $_POST['anormalcolposcopia-reg']=="")
                                    {
                                        $alerta=[
                                            "Alerta"=>"simple",
                                            "Titulo"=>"Ocurrio un error inesperado",
                                            "Texto"=>"Especifique PAP ANORMAL",
                                            "Tipo"=>"error"
                                        ];
            
                                    }
                                    else
                                    {
                                        if($optcolposcopia=="Anormal" && $_POST['colposcopianterior-reg']=="" )
                                        {
                                            $alerta=[
                                                "Alerta"=>"simple",
                                                "Titulo"=>"Ocurrio un error inesperado",
                                                "Texto"=>"No completo diagnostico anterior ANORMAL",
                                                "Tipo"=>"error"
                                            ];
                                        }
                                        else
                                        {
                                            if($optcolposcopia=="Anormal" && $_POST['fechadiagnostico-reg']=="")
                                            {
                                                $alerta=[
                                                    "Alerta"=>"simple",
                                                    "Titulo"=>"Ocurrio un error inesperado",
                                                    "Texto"=>"No especifico fecha de PAP ANORMAL",
                                                    "Tipo"=>"error"
                                                ];
                                            }
                                            else
                                            {
    
                                                
                                                    $codigoP=mainModel::limpiar_cadena($_POST['cod-paciente']);
                                                    $codigoE=mainModel::limpiar_cadena($_POST['cod-empleado']);
                                                    $codigoP=mainModel::decryption ($codigoP);
                                                    $codigoE=mainModel::decryption ($codigoE);
    
                                                    $querye=mainModel::ejecutar_consulta_simple("SELECT idEmployee FROM employees WHERE usCode='$codigoE'");
                                                    $c1=$querye->rowCount();
                                                    if($c1>=0){
                                                        $letra=date("Y");
                                                        $consulta=mainModel::ejecutar_consulta_simple("SELECT idGynecologicalHistory  FROM 
                                                        gynecologicalhistorys");
                                                        
                                                        $numero=($consulta->rowCount())+1 ;
                                                        $codmuestra=mainModel::generar_codigo_muestra($letra, $numero);
                                                        $datosEmpleado=$querye->fetch();
                                                        $idEmpleado=$datosEmpleado['idEmployee'];
                                                        $datos=[
                                                            "CodigoMuestra"=>$codmuestra,
                                                            "FechaMuestra"=>$fechamuestra,
                                                            "FechaRegla"=>$fecharegla,
                                                            "ExamenGinecologicoSiNo"=>$optexameng,
                                                            "EspecifiqueGinecologico"=>$espexameg,
                                                            "ColposcopiaSiNo"=>$optcolposcopia,
                                                            "EspecifiqueColposcopia"=>$espcolposcopia,
                                                            
                                                            "PapAnterior"=>$colposcopianterior,
                                                            "FechaPapAnterior"=>$fechacolanterior,
    
                                                            "Inrese"=>$inrese,
                                                            "Parsexual"=>$parejasexual,
                                                            //"FechaUltimoRelacion"=>"",
    
                                                            "Embarazada"=>$optembarazada,
                                                            "Anticonceptivo"=>$optanticonceptivo,
                                                            "TipoAnticonceptivo"=>$espanticonceptivo,
                                                            
                                                            "SemanaEmbarazo"=>$semanaembarazo,
                                                            //"MaterialUtilizado"=>"",
                                                            //"FijadorUtilizado"=>"",
                                                            "Partos"=>$numeropartos,
                                                            "Abortos"=>$numeroabortos,
                                                            "Iva"=>$exameniva, 
    
                                                            "Recepcion"=>"0",
                                                            "Removido"=>"0",
                                                            "EstadoMuestra"=>"0",
    
                                                            "Paciente"=>$codigoP,
                                                            "Empleado"=>$idEmpleado                                                              
                                                        ];
                                                        
                                                        $guardarmuestra=sampleModel::agregar_muestra_modelo($datos);
                                                        $queryhg=mainModel::ejecutar_consulta_simple("SELECT idGynecologicalHistory  FROM 
                                                        gynecologicalhistorys ORDER by idGynecologicalHistory desc LIMIT 1");
                                                        //$idhistoriag=($queryhg->rowCount());
                                                        $datosHistoriaG=$queryhg->fetch();
                                                        $idhistoriag=$datosHistoriaG['idGynecologicalHistory'];
                                                        if(isset($_POST['check_lista']))
                                                        {
    
                                                            
                                                            if(is_array($_POST['check_lista']))
                                                            {
                                                                    foreach($_POST['check_lista'] as $key => $value)
                                                                    {
                                                                        $insertcuadrante=sampleModel::agregar_cuadrante_modelo($value, $idhistoriag);
                                                                    }   
                                                                $alerta=[
                                                                "Alerta"=>"limpiar",
                                                                "Titulo"=>"Muestra registrada",
                                                                "Texto"=>"se ha registrado la muestra con cuadrante",
                                                                "Tipo"=>"success"
                                                                ]; 
    
                                                                                                                      
                                                            } 
                                                            else
                                                            {
                                                                $alerta=[ 
                                                                    "Alerta"=>"error",
                                                                    "Titulo"=>"Muestra no registrada",
                                                                    "Texto"=>"Cuadrante",
                                                                    "Tipo"=>"error"
                                                                    ];   
                                                            }
                                                            
    
                                                        }else
                                                        {
    
                                                           
                                                            
                                                            $alerta=[
                                                                "Alerta"=>"limpiar",
                                                                "Titulo"=>"Muestra registrada",
                                                                "Texto"=>"se ha registrado la muestra con exito",
                                                                "Tipo"=>"success"
                                                                ]; 
                                                            
                                                                
                                                            
                                                            
                                                            //agregar los check
                                                        }
    
                                                    }
                                                    else
                                                    {
                                                        $alerta=[
                                                        "Alerta"=>"erro",
                                                        "Titulo"=>"Muestra registrada",
                                                        "Texto"=>"Tenemos inconvenientes",
                                                        "Tipo"=>"error"
                                                        ]; 
                                                    }
                              
                                            }
                                    
                                        }
                                       
                                        
                                    }
                                         
                                
                                }
                               
                            }
                        }
    
                   
    
                }
            }
        }
        
        
        return mainModel::sweet_alert($alerta);
      //FINALIZA LA FUNCION   
    }
    
    public function enviar_muestra_controlador(){
        $link='<script>window.location.href="'.SERVERURL.'muestrapaciente/"</script>';
        return $link;
    }
    
    public function datos_muestra_controlador($tipo, $codigo){ 
        $codigo=mainModel::decryption($codigo);
        $tipo=mainModel::limpiar_cadena($tipo);

        return sampleModel::datos_muestra_modelo($tipo, $codigo);
    }

    
    //controlador para paginar muestras
    public function paginador_muestra_controlador($pagina, $registros, $privilegio, $url, $tipoempleado, $empleado, $busqueda)  
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
           $consulta="SELECT SQL_CALC_FOUND_ROWS idGynecologicalHistory, hgDateSample, hgStateSample, hgCodeLamina, higy.paCode, hgRecepcionYesNo, paDNI,
           paName, paLastName, esName, emName
           FROM gynecologicalhistorys as higy inner join patients as paciente  on higy.paCode=paciente.paCode 
           inner join employees as empleadoi on higy.idEmployee=empleadoi.idEmployee 
           inner join establishments on empleadoi.idEstablishment=establishments.idEstablishment  WHERE (paDNI LIKE '%$busqueda%' OR hgDateSample LIKE '%$busqueda%' OR paLastName LIKE '%$busqueda%')
           ORDER BY idGynecologicalHistory DESC
           LIMIT $inicio, $registros";
            

        }else{ 
            
           //ojo solo para ver de los patientss
           
           switch($tipoempleado){
               case "Administrador":
                   $consulta="SELECT SQL_CALC_FOUND_ROWS higy.idGynecologicalHistory, hgDateSample, hgStateSample, hgCodeLamina, higy.paCode as codigopaciente, hgRecepcionYesNo, paDNI, 
                   paName, paLastName, esName, emName, empleadoi.idEmployee as idResponsableM
                   FROM gynecologicalhistorys as higy inner join patients as paciente  on higy.paCode=paciente.paCode 
                   inner join establishments on paciente.idEstablishment=establishments.idEstablishment
                   inner join employees as empleadoi on higy.idEmployee=empleadoi.idEmployee 
                   ORDER BY idGynecologicalHistory DESC
                   LIMIT $inicio, $registros";
               break;
               case "Muestreador":
                   $consulta="SELECT SQL_CALC_FOUND_ROWS higy.idGynecologicalHistory, hgDateSample, hgStateSample, hgCodeLamina, higy.paCode as codigopaciente, hgRecepcionYesNo, paDNI, 
                   paName, paLastName, esName, emName, empleadoi.idEmployee as idResponsableM
                   FROM gynecologicalhistorys as higy inner join patients as paciente  on higy.paCode=paciente.paCode 
                   inner join establishments on paciente.idEstablishment=establishments.idEstablishment
                   inner join employees as empleadoi on higy.idEmployee=empleadoi.idEmployee 
                   WHERE empleadoi.usCode='$empleado'
                   ORDER BY idGynecologicalHistory DESC
                   LIMIT $inicio, $registros";
               
               break;
               case "Recepcionador":
                   $consulta="SELECT SQL_CALC_FOUND_ROWS idGynecologicalHistory, hgDateSample, hgStateSample, hgCodeLamina, higy.paCode as codigopaciente, hgRecepcionYesNo, paDNI, 
                   paName, paLastName, esName, emName, empleadoi.idEmployee as idResponsableM
                   FROM gynecologicalhistorys as higy inner join patients as paciente  on higy.paCode=paciente.paCode 
                   inner join employees as empleadoi on higy.idEmployee=empleadoi.idEmployee 
                   inner join establishments on empleadoi.idEstablishment=establishments.idEstablishment
                   WHERE hgRecepcionYesNo='0'
                   ORDER BY idGynecologicalHistory DESC
                   LIMIT $inicio, $registros";
               break;
               case "Tecnologo":
               
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
                   <th class="text-center">FECHA MUESTRA</th>
                   
                   <th class="text-center">DNI</th>
                   <th class="text-center">NOMBRES</th>
                   <th class="text-center">APELLIDOS</th>
                   <th class="text-center">LUGAR PROCEDENCIA</th>
                   <th class="text-center">PERSONAL</th>
                   <th class="text-center">DATOS</th>
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
                       <td>'.$rows['hgDateSample'].'</td>                    
                       <td>'.$rows['paDNI'].'</td>
                       <td>'.$rows['paName'].'</td>   
                       <td>'.$rows['paLastName'].'</td>
                       <td>'.$rows['esName'].'</td>                     
                       <td>'.$rows['emName'].'</td>';
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
                              
                               <a href="'.SERVERURL.'no-reception/'.mainModel::encryption($rows['idGynecologicalHistory']).'/" class="btn btn-danger btn-raised btn-xs">
                                   NO RERECEPCIONADO
                                   </a>
                               </td>
                                ';
                           break;
                           case "2":
                               $tabla.='
                               <td>
                               <li class="btn btn-danger btn-raised btn-xs">POR PROCESAR</li>
                               </td>
                               ';
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
    public function paginador_muestra_recepcion($pagina, $registros, $privilegio, $url, $tipoempleado, $empleado, $busqueda)
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
            $consulta="SELECT SQL_CALC_FOUND_ROWS idGynecologicalHistory, hgDateSample, hgStateSample, hgCodeLamina, higy.paCode as codigopaciente, hgRecepcionYesNo, paDNI, 
            paName, paLastName, esName, emName, empleadoi.idEmployee as idResponsableM
            FROM gynecologicalhistorys as higy inner join patients as paciente  on higy.paCode=paciente.paCode 
            inner join establishments on paciente.idEstablishment=establishments.idEstablishment
            inner join employees as empleadoi on higy.idEmployee=empleadoi.idEmployee  WHERE (esName LIKE '%$busqueda%' AND hgRecepcionYesNo='0')
           ORDER BY idGynecologicalHistory DESC
           LIMIT $inicio, $registros";
            

        }else{ 
            
           //ojo solo para ver de los patientss
           
           switch($tipoempleado){
               case "Administrador":
                $consulta="SELECT SQL_CALC_FOUND_ROWS idGynecologicalHistory, hgDateSample, hgStateSample, hgCodeLamina, higy.paCode as codigopaciente, hgRecepcionYesNo, paDNI, 
                paName, paLastName, esName, emName, empleadoi.idEmployee as idResponsableM
                FROM gynecologicalhistorys as higy inner join patients as paciente  on higy.paCode=paciente.paCode 
                inner join establishments on paciente.idEstablishment=establishments.idEstablishment
                inner join employees as empleadoi on higy.idEmployee=empleadoi.idEmployee
                WHERE hgRecepcionYesNo='0'
                ORDER BY idGynecologicalHistory DESC
                LIMIT $inicio, $registros";
               break;
              
               case "Recepcionador":
                   $consulta="SELECT SQL_CALC_FOUND_ROWS idGynecologicalHistory, hgDateSample, hgStateSample, hgCodeLamina, higy.paCode as codigopaciente, hgRecepcionYesNo, paDNI, 
                   paName, paLastName, esName, emName, empleadoi.idEmployee as idResponsableM
                   FROM gynecologicalhistorys as higy inner join patients as paciente  on higy.paCode=paciente.paCode 
                   inner join establishments on paciente.idEstablishment=establishments.idEstablishment
                   inner join employees as empleadoi on higy.idEmployee=empleadoi.idEmployee
                   WHERE hgRecepcionYesNo='0'
                   ORDER BY idGynecologicalHistory DESC
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
                   <th class="text-center">FECHA MUESTRA</th>
                   
                   <th class="text-center">DNI</th>
                   <th class="text-center">NOMBRES</th>
                   <th class="text-center">APELLIDOS</th>
                   <th class="text-center">LUGAR PROCEDENCIA</th>
                   <th class="text-center">PERSONAL</th>
                   <th class="text-center">DATOS</th>
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
                       <td>'.$rows['hgDateSample'].'</td>                    
                       <td>'.$rows['paDNI'].'</td>
                       <td>'.$rows['paName'].'</td>   
                       <td>'.$rows['paLastName'].'</td>
                       <td>'.$rows['esName'].'</td>                     
                       <td>'.$rows['emName'].'</td>';
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
                               <li class="btn btn-danger btn-raised btn-xs">NO RECEPCIONADO</li>
                               </td>
                               ';
                           break;
                           case "2":
                               $tabla.='
                               <td>
                               <li class="btn btn-danger btn-raised btn-xs">POR PROCESAR</li>
                               </td>
                               ';
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
//fin de controladore paginar muestras
}