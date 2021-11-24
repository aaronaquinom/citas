<?php
if ($peticionAjax){
    require_once "../models/patientModel.php";
} else{
    require_once "./models/patientModel.php";
}
//modificar patients en modelos
class patientController extends patientModel
{
    public function obtener_datos_paciente_controlador()
    {
        $dni=mainModel::limpiar_cadena($_POST['dnib-reg']);
        $buscarp=mainModel::ejecutar_consulta_simple("SELECT * FROM patients WHERE paDNI='$dni'");
        $numpaciente=$buscarp->rowCount();
        if($numpaciente>=1)
        {

            $unicoPaciente=patientModel::obtener_datos_paciente_modelo($dni);
            
            return $unicoPaciente;
            //return json_encode ($unicoPaciente);
            /*return $buscarp->fetchAll(PDO::FETCH_OBJ);
            /*$resultado=$buscarp->fetch();
            return $resultado;
            /*$campo=$buscarp->fetch();
             return $campo['paDNI']; problema imprime un array */
           /* return $buscarp; */
           /* return patientModel::obtener_datos_paciente_modelo($dni);
           echo'<script>window.location.href="'.SERVERURL.'historiag/"</script>';*/
        }
        else
        {
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un error inesperado",
                "Texto"=>"El paciente no esta registrado",
                "Tipo"=>"error"
                ]; 
        }
        return mainModel::sweet_alert($alerta); 
    }
    //   agregar paciente
    public function agregar_paciente_controlador(){
        
        $padni=mainModel::limpiar_cadena($_POST['dni-pa']);
        $paNombre=mainModel::limpiar_cadena($_POST['nombre-pa']);
        $paApellidos=mainModel::limpiar_cadena($_POST['apellido-pa']);
        $paDomicilio=mainModel::limpiar_cadena($_POST['domicilio-pa']);
        //ingresar sis si o no
        $paSisSiNo=mainModel::limpiar_cadena(base64_decode(isset($_POST['optionSis'])?$_POST['optionSis']:null));
        $paTelefono=mainModel::limpiar_cadena($_POST['telefono-pa']);
        $paFechaNacimiento=mainModel::limpiar_cadena($_POST['fechanacimiento-pa']);
        $paEdad=mainModel::limpiar_cadena($_POST['edad-pa']);
        $paObservacion=mainModel::limpiar_cadena($_POST['obs-pa']);
        $padistrito=mainModel::limpiar_cadena($_POST['sel_dist']);
        $idEstablecimiento=mainModel::limpiar_cadena(isset($_POST['cmbEstablecimiento'])?$_POST['cmbEstablecimiento']:null);

        
        if(mainModel::verificar_datos("[0-9]{8}",$padni)){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"El DNI no coincide con el formato solicitado 8 digitos",
                "Tipo"=>"error"
            ];
            
            }
        else{
            $consulta=mainModel::ejecutar_consulta_simple("SELECT paDNI FROM patients WHERE paDNI='$padni'");
            $C1=$consulta->rowCount();
            if($C1>=1){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El DNI ya existe, revise porfavor",
                    "Tipo"=>"error"
                ];
            }else{
                if(!isset($_POST['optionSis']))
                {
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"Ingresar Sis Si o No",
                        "Tipo"=>"error"
                    ];
                }
                else{
                    $consulta2=mainModel::ejecutar_consulta_simple("SELECT paCode FROM patients");
                    $numero=($consulta2->rowCount())+1 ;
                    $id=mainModel::generar_codigo_id($numero);
                    $historia=mainModel::generar_codigo_historiag("PA", $numero);
                    $datos=[
                        "Id"=>$id,
                        "Historia"=>$historia,
                        "DNI"=>$padni,
                        "Nombre"=>$paNombre,
                        "Apellidos"=>$paApellidos,
                        "Domicilio"=>$paDomicilio,
                        "Sis"=>$paSisSiNo,
                        "Telefono"=>$paTelefono,
                        "FechaNacimiento"=>$paFechaNacimiento,
                        "Edad"=>$paEdad,
                        "Observacion"=>$paObservacion,
                        "Dis"=>$padistrito,
                        "Establecimiento"=>$idEstablecimiento
                                     
                    ];
                    $agregarpaciente=patientModel::agregar_paciente_modelo($datos);
                        $pa=$agregarpaciente->rowCount();
                    if($pa>=1){
                        $alerta=[ 
                            "Alerta"=>"limpiar",
                            "Titulo"=>"Paciente registrado",
                            "Texto"=>"El paciente se ha registro con exito",
                            "Tipo"=>"success"
                            ];
                    }else{
                       
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"El paciente no ha ingresado",
                            "Tipo"=>"error"
                            ]; 
                    }
    
                }
            
        
            }
        }
        

        return mainModel::sweet_alert($alerta);

    }


    //controlador datos del paciente
    public function datos_paciente_controlador($tipo, $codigo){ 
        $codigo=mainModel::decryption ($codigo);
        $tipo=mainModel::limpiar_cadena($tipo);

        return patientModel::datos_paciente_modelo($tipo, $codigo);
    }
    //controlador para paginar pacientes
    public function paginador_paciente_controlador($pagina, $registros, $privilegio, $id, $url, $busqueda)
    {

        $pagina=mainModel::limpiar_cadena($pagina);
        $registros=mainModel::limpiar_cadena($registros);
        $privilegio=mainModel::limpiar_cadena($privilegio);
        $id=mainModel::limpiar_cadena($id);

        $url=mainModel::limpiar_cadena($url);
        $url=SERVERURL.$url."/";

        $busqueda=mainModel::limpiar_cadena($busqueda);
        $tabla="";

        $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
			$inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

			if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM patients WHERE (paDNI LIKE '%$busqueda%' OR paLastName LIKE '%$busqueda%' )
                ORDER BY paCode DESC
                LIMIT $inicio, $registros";
                           

			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM patients ORDER BY paCode DESC
                LIMIT $inicio, $registros";                     
			}
			$conexion = mainModel::conectar();

			$datos = $conexion->query($consulta);

			$datos = $datos->fetchAll();

			$total=$conexion->query("SELECT FOUND_ROWS()");
			$total = (int) $total->fetchColumn();

            $Npaginas=ceil($total/$registros);
            $tabla.='
            <div class="table-responsive">
                <table id="example" class="table table-hover text-center">
                <thead>
                    <tr>
                    <th class="text-center">#</th>
                    <!-- <th class="text-center">CODIGO</th>-->
                    <th class="text-center">DNI</th>
                     <th class="text-center">NOMBRES</th>
                     <th class="text-center">APELLIDOS</th>
                     <th class="text-center">EDAD</th>
                     
                     <th class="text-center">FECHA NAC.</th>
                     <th class="text-center">TELÉFONO</th>
                     <th class="text-center">DOMICILIO</th>
                     <th class="text-center">SIS</th>
                     <th class="text-center">OBS.</th>
                     <th class="text-center">A. MUESTRA</th>';
                    if($privilegio<=2){
                        $tabla.='
                        <th class="text-center">A. MODIFICAR</th>                        
                        ';
                    }
                    if($privilegio==1){
                        $tabla.='
                        <th class="text-center">A. ELIMINAR</th>
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
                    $tabla.='
                        <tr>
                            <td>'.$contador.'</td>
                            <td>'.$rows['paDNI'].'</td>
                            <td>'.$rows['paName'].'</td>
                            <td>'.$rows['paLastName'].'</td>
                            <td>'.$rows['paAge'].'</td>
                            <td>'.$rows['paBirthdate'].'</td>
                            <td>'.$rows['paPhone'].'</td>
                            <td>'.$rows['paAdress'].'</td>
                            <td>'.$rows['paSisYesNo'].'</td>
                            <td>'.$rows['paObservation'].'</td>
                            <td>
                            <a href="'.SERVERURL.'sample/'.mainModel::encryption($rows['paCode']).'/" class="btn btn-success btn-raised btn-xs">
                                <i class="zmdi zmdi-refresh"></i>
                            </a>
                            </td>
                            '; 

                            if($privilegio<=2){
                            $tabla.='
                            <td>
                                <a href="'.SERVERURL.'patient-update/'.mainModel::encryption($rows['paCode']).'/" class="btn btn-success btn-raised btn-xs">
                                    <i class="zmdi zmdi-refresh"></i>
                                </a>
                            </td>
                            ';
                            }
                            if($privilegio==1){
                            $tabla.='
                            <td>
                                <form action="'.SERVERURL.'ajax/empleadoAjax.php" method="POST" data-form="delete" class="FormularioAjax"  entype="multipart/form-data" autocomplete="off">
                                <input type="hidden"  name="codigo-del" value="'.mainModel::encryption($rows['paCode']).'" ></imput>
                                <input type="hidden"  name="privilegio-admin" value="'.mainModel::encryption($privilegio).'" ></imput>
                                
                                <button name="submit" type="submit" value="submit" class="btn btn-danger btn-raised btn-xs">
                                        <i class="zmdi zmdi-delete"></i>
                                </button>
                                <div class="RespuestaAjax"></div>
                                </form>
                                
                            </td> 
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
                        <td coslpan="7">No hay registro</td>
                    </tr>
                    ';
                }
                
               
            }
            $tabla.='</tbody>
            <tfoot>
             <tr>
                    <th class="text-center">#</th>
                    <!-- <th class="text-center">CODIGO</th>-->
                    <th class="text-center">DNI</th>
                     <th class="text-center">NOMBRES</th>
                     <th class="text-center">APELLIDOS</th>
                     <th class="text-center">EDAD</th>
                     
                     <th class="text-center">FECHA NAC.</th>
                     <th class="text-center">TELÉFONO</th>
                     <th class="text-center">DOMICILIO</th>
                     <th class="text-center">SIS</th>
                     <th class="text-center">OBS.</th>
                     <th class="text-center">A. MUESTRA</th>
            </tfoot>
            </table></div>';
            /*if($total>=1 && $pagina<=$Npaginas){
                $tabla.=mainModel::paginar_tablas($pagina,$Npaginas,$url);
                
            }*/

            return $tabla;
         
    } 
    
}
