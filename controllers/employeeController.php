<?php
if ($peticionAjax){
    require_once "../models/employeeModel.php";
} else{
    require_once "./models/employeeModel.php";
}
class employeeController extends employeeModel{
    public function agregar_empleado_controlador(){
       
        $nombre=mainModel::limpiar_cadena($_POST['nombre-reg']);
        $apellido=mainModel::limpiar_cadena($_POST['apellido-reg']);
        $dni=mainModel::limpiar_cadena($_POST['dni-reg']);
        $profesion=mainModel::limpiar_cadena($_POST['especialista-reg']);
        $observacion=mainModel::limpiar_cadena($_POST['obs-reg']);

        $usuario=mainModel::limpiar_cadena($_POST['usuario-reg']);
        $password1=mainModel::limpiar_cadena($_POST['password1-reg']);
        $password2=mainModel::limpiar_cadena($_POST['password2-reg']);
        $rutaimprimir="../views/assets/firmas/administrador.jpg";
        

        $genero=mainModel::limpiar_cadena($_POST['optionsGenero']);
        $privilegio=mainModel::decryption($_POST['optionsPrivilegio']);
        $tipousuario=mainModel::decryption($_POST['optionsUserType']);
        switch($tipousuario){
            case "1":
            $typeusuario="Administrador";
            break;
            case "2":
            $typeusuario="Registrador";            
            break;
        }
        $privilegio=mainModel::limpiar_cadena($privilegio);
        if($genero=="Masculino"){
            $foto="Male3Avatar.png";

        }else{
            $foto="Female3Avatar.png";
        }
        if($privilegio<1 || $privilegio>2)
        {
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un error inesperado",
                "Texto"=>"El Nivel de privilegio es incorrecto",
                "Tipo"=>"error"
            ];
        }
        else
        {
             if($password1!=$password2){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Contraseñas no coinciden",
                    "Tipo"=>"error"
                ];

            }else{
                if(mainModel::verificar_datos("[0-9]{8}",$dni))
                    {
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrió un error inesperado",
                        "Texto"=>"El DNI no coincide con el formato solicitado 8 digitos",
                        "Tipo"=>"error"
                    ];
                    
                    }
                else{
                    $consulta1=mainModel::ejecutar_consulta_simple("SELECT emDNI  FROM employees WHERE emDNI='$dni'");
                    $c1=$consulta1->rowCount();
    
                    
                    if($c1>=1){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"El DNI ya existe, revise porfavor",
                            "Tipo"=>"error"
                            ];
                    }
                    else{
                    $consulta2=mainModel::ejecutar_consulta_simple("SELECT usNickname  FROM users WHERE usNickname='$usuario'");
                    $c2=$consulta2->rowCount();
                        if($c2>=1){
                            $alerta=[
                                "Alerta"=>"simple",
                                "Titulo"=>"Ocurrio un error inesperado",
                                "Texto"=>"El usuario ya existe, revise porfavor",
                                "Tipo"=>"error"
                                ];
                        }
                        else{
                            $consulta3=mainModel::ejecutar_consulta_simple("SELECT iduser FROM users");
                            $numero=($consulta3->rowCount())+1 ;
                            /*$id=mainModel::generar_codigo_id($numero);*/
                            $cod=mainModel::generar_codigo_aleatorio("AC", 7, $numero);
                            $clave=mainModel::encryption($password1);
                            //move_uploaded_file($archivo, $ruta);
                            $dataAC=[                                
                                "Codigo"=>$cod,
                                "Nickname"=>$usuario,
                                "Pass"=>$clave,
                                "Estado"=>"Activo",
                                "Privilegio"=>$privilegio,
                                "Foto"=>$foto,
                                "Tipo"=>$typeusuario,
                                "Genero"=>$genero,
                                "ImgFirma"=>$rutaimprimir
                            ];
    
                            $guardarCuenta=mainModel::agregar_cuenta($dataAC);
                            
                            $gc=$guardarCuenta->rowCount();
                            if($gc>=1){
                                $datosEmpleado=[
                                    "Nombre"=>$nombre,
                                    "Apellido"=>$apellido,
                                    "DNI"=>$dni,
                                    "Observacion"=>$observacion,
                                    "Profesion"=>$profesion,
                                    "Oficina"=>$observacion,
                                    "Cuenta"=>$cod
                                ];
                                $guardarEmpleado=employeeModel::agregar_empleado_modelo($datosEmpleado);
                                $em=$guardarEmpleado->rowCount();
                                if($em>=1){
                                    $alerta=[ 
                                        "Alerta"=>"limpiar",
                                        "Titulo"=>"Empleado registrado",
                                        "Texto"=>"El empleado se ha registro con exito",
                                        "Tipo"=>"success"
                                        ];
                                }else{
                                    mainModel::eliminar_cuenta($cod);
                                    $alerta=[
                                        "Alerta"=>"simple",
                                        "Titulo"=>"Ocurrio un error inesperado",
                                        "Texto"=>"El empleado no ha ingresado",
                                        "Tipo"=>"error"
                                        ]; 
                                }
                            
                            }
                            else
                            
                            {
                                $alerta=[
                                    "Alerta"=>"simple",
                                    "Titulo"=>"Ocurrio un error inesperado",
                                    "Texto"=>"El usuario no ha ingresado",
                                    "Tipo"=>"error"
                                    ]; 
                            }
                        }
                    
                    }

                }
               

            }
        }
        return mainModel::sweet_alert($alerta);
    }  

    public function datos_empleado_controlador($tipo, $codigo){ 
        $codigo=mainModel::decryption ($codigo);
        $tipo=mainModel::limpiar_cadena($tipo);

        return employeeModel::datos_empleado_modelo($tipo, $codigo);
    }
    //controlador paginar empleado usuarios
    public function paginador_empleado_controlador($pagina, $registros, $privilegio, $id, $url, $busqueda)
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
				$consulta="SELECT  SQL_CALC_FOUND_ROWS * FROM employees
				           WHERE ((idEmployee!='$id' AND usCode!='1') 
						   AND (emDNI LIKE '%$busqueda%'))
						   ORDER BY idEmployee ASC LIMIT $inicio,$registros";

			}else{
				$consulta="SELECT  SQL_CALC_FOUND_ROWS * FROM employees WHERE idEmployee!='$id' AND usCode!='1'
                           ORDER BY idEmployee ASC LIMIT $inicio,$registros";
                           
                           

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
                        <th class="text-center">NOMBRES</th>
                        <th class="text-center">APELLIDOS</th>
                        <th class="text-center">DNI</th>
                        <th class="text-center">TELÉFONO</th>
                        <th class="text-center">ESPECIALIDAD</th>
                        <th class="text-center">MATRICULA</th>';
                    if($privilegio<=2){
                        $tabla.='
                    
                        <th class="text-center">A. CUENTA</th>
                        <th class="text-center">A. DATOS</th>
                        
                        ';
                    }
                    if($privilegio==1){
                        $tabla.='
                        <th class="text-center">ELIMINAR</th>
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
                            <td>'.$rows['emName'].'</td>
                            <td>'.$rows['emLastName'].'</td>
                            <td>'.$rows['emDNI'].'</td>
                            <td>'.$rows['emObservation'].'</td>   
                            <td>'.$rows['emProfession'].'</td>
                            <td>'.$rows['emLicense'].'</td>';
                            if($privilegio<=2){
                            $tabla.='
                            <td>
                                <a href="'.SERVERURL.'myaccount/admin/'.mainModel::encryption($rows['usCode']).'/" class="btn btn-success btn-raised btn-xs">
                                    <i class="zmdi zmdi-refresh"></i>
                                </a>
                            </td>
                            <td>
                                <a href="'.SERVERURL.'mydata/admin/'.mainModel::encryption($rows['usCode']).'/" class="btn btn-success btn-raised btn-xs">
                                    <i class="zmdi zmdi-refresh"></i>
                                </a>
                            </td>
                            ';
                            }
                            if($privilegio==1){
                            $tabla.='
                            <td>
                                <form action="'.SERVERURL.'ajax/empleadoAjax.php" method="POST" data-form="delete" class="FormularioAjax"  entype="multipart/form-data" autocomplete="off">
                                <input type="hidden"  name="codigo-del" value="'.mainModel::encryption($rows['usCode']).'" ></imput>
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
            $tabla.='</tbody></table></div>';
            if($total>=1 && $pagina<=$Npaginas){
                $tabla.=mainModel::paginar_tablas($pagina,$Npaginas,$url);
                
            }

            return $tabla;
         
    }   
    

    //controlador eliminar empleado
    public function eliminar_empleado_controlador(){
        $cuenta=mainModel::decryption($_POST['codigo-del']);
        $emprivilegio=mainModel::decryption($_POST['privilegio-admin']);
        $cuenta=mainModel::limpiar_cadena($cuenta);
        $emprivilegio=mainModel::limpiar_cadena($emprivilegio);
        if($emprivilegio==1){
             $query1=mainModel::ejecutar_consulta_simple("SELECT emCuenta FROM empleado WHERE emCuenta='$cuenta'");
             $datosAdmin=$query1->fetch();
             if($datosAdmin['emCuenta']!=1){ //cuidar eliminar el usuario administrador
                     $DelAdmin=empleadoModelo::eliminar_empleado_modelo($cuenta);
                     mainModel::eliminar_bitacora($cuenta);
                     if($DelAdmin->rowCount()>=1){
                         $DelUsuario=mainModel::eliminar_cuenta($cuenta);
                         if($DelUsuario->rowCount()>=1){
                             $alerta=[
                                 "Alerta"=>"recargar",
                                 "Titulo"=>"Empleado eliminado",
                                 "Texto"=>"El empleado fue eliminado con exito del sistema",
                                 "Tipo"=>"success"
                             ];
                         }else{
                             $alerta=[
                                 "Alerta"=>"simple",
                                 "Titulo"=>"Ocurrio un error inesperado",
                                 "Texto"=>"No se puedo eliminar este usuario en este momento",
                                 "Tipo"=>"error"
                             ];
                         }
 
                     }else{
                          $alerta=[
                          "Alerta"=>"simple",
                          "Titulo"=>"Ocurrio un error inesperado",
                          "Texto"=>"No se puedo eliminar empleado en este momento",
                          "Tipo"=>"error"
                          ];
                     }
             }else{
                 $alerta=[
                 "Alerta"=>"simple",
                 "Titulo"=>"Ocurrio un error inesperado",
                 "Texto"=>"No se puede eliminar el empleado administrador principal",
                 "Tipo"=>"error"
                 ];
             }                 
         }else{
             $alerta=[
                 "Alerta"=>"simple",
                 "Titulo"=>"Ocurrio un error inesperado",
                 "Texto"=>"No tiene permisos necesarios para esta operación",
                 "Tipo"=>"error"
             ];
         }
        return mainModel::sweet_alert($alerta);
     }
}
