<?php 
    if ($peticionAjax){
        require_once "../core/configApp.php";
    } else{
        require_once "./core/configApp.php";
    }
 class mainModel{
    protected function conectar(){
        $enlace=new PDO(SGDB, USER, PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        //importante utf8 para mostrar las ñ y acentos
        return $enlace;
    }
    protected function ejecutar_consulta_simple($consulta){
        $respuesta=self::conectar()->prepare($consulta);
        $respuesta->execute();
        return $respuesta;

    }
    protected function agregar_cuenta($datos){
        $sql=self::conectar()->prepare("INSERT INTO users (iduser, usNickname, usPassword, usState, usPrivilege, 
        usPhoto, usType, usGender, usStamp) 
        VALUES (:Codigo, :Nickname, :Pass, :Estado, :Privilegio, :Foto, :Tipo, :Genero, :ImgFirma)");
        
        $sql->bindParam (":Codigo",$datos['Codigo']);
        $sql->bindParam (":Nickname",$datos['Nickname']);
        $sql->bindParam (":Pass",$datos['Pass']);
        $sql->bindParam (":Estado",$datos['Estado']);
        $sql->bindParam (":Privilegio",$datos['Privilegio']);
        $sql->bindParam (":Foto",$datos['Foto']);
        $sql->bindParam (":Tipo",$datos['Tipo']);
        $sql->bindParam (":Genero",$datos['Genero']);
        $sql->bindParam (":ImgFirma",$datos['ImgFirma']);
        $sql->execute();
        return $sql;
    } 
    protected static function verificar_datos($filtro,$cadena){
        if(preg_match("/^".$filtro."$/", $cadena)){
            return false;
        }else{
            return true;
        }
    }
    protected  function eliminar_cuenta($codigo)
    {
        $sql=self::conectar()->prepare("DELETE from users WHERE iduser=:Codigo");
        $sql->bindParam(":Codigo",$codigo);
        $sql->execute();
        return $sql;

    }
    protected function guardar_bitacora($datos){
        $sql=self::conectar()->prepare("INSERT INTO logs (loName, loDate, loStartTime, loFinalTime, 
        loType, loYear, iduser) VALUES(:Codigo, :Fecha, :HoraInicio, :HoraFinal, :Tipo, :Anio, :Cuenta)");
         $sql->bindParam (":Codigo",$datos['Codigo']);
         $sql->bindParam (":Fecha",$datos['Fecha']);
         $sql->bindParam (":HoraInicio",$datos['HoraInicio']);
         $sql->bindParam (":HoraFinal",$datos['HoraFinal']);
         $sql->bindParam (":Tipo",$datos['Tipo']);
         $sql->bindParam (":Anio",$datos['Anio']);
         $sql->bindParam (":Cuenta",$datos['Cuenta']);
         $sql->execute();
         return $sql;
    }
    protected function actualizar_bitacora($codigo, $hora){
        $sql=self::conectar()->prepare("UPDATE logs SET loFinalTime=:Hora WHERE loName=:Codigo");
        $sql->bindParam (":Hora", $hora);
        $sql->bindParam (":Codigo",$codigo);
        $sql->execute();
        return $sql;
    }
    protected function eliminar_bitacora($codigo){
        $sql=self::conectar()->prepare("DELETE FROM bitacora WHERE biCuenta=:Cuenta");
        $sql->bindParam (":Cuenta",$codigo);
        $sql->execute();
        return $sql;
    }
    public function encryption($string) {
        $output=FALSE;
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV),0,16);
        $output=openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output=base64_encode($output);
        return $output;
    }
    public function decryption ($string){
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV),0,16);
        $output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }

    public static function encryptions($string) {
        $output=FALSE;
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV),0,16);
        $output=openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output=base64_encode($output);
        return $output;
    }
    public static function decryptions ($string){
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV),0,16);
        $output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }
    protected function generar_codigo_id($num)
    {
        return $num;
    }
    protected function generar_codigo_aleatorio($letra, $longitud, $num){
        for ($i=1; $i<=$longitud; $i++){
            $numero=rand(0,9);
            $letra.=$numero;
        }
        return $letra.$num;
    
    }

    protected function generar_codigo_muestra($letra, $num){
        //return $letra."0".$num;
           return "M".$letra.$num;
    }

    protected function generar_codigo_historiag($letra, $num){
        //return $letra."0".$num;
           return $letra.$num;
    }
    protected function generar_codigo_lamina($letra, $num){
        return $letra."-0".$num;
    }
    protected function limpiar_cadena($cadena){
        $cadena=trim($cadena);
        $cadena=stripcslashes($cadena);
        $cadena=str_ireplace("<script>", "", $cadena);
        $cadena=str_ireplace("<script src>", "", $cadena);
        $cadena=str_ireplace("<script type>", "", $cadena);
        $cadena=str_ireplace("SELECT * FROM", "", $cadena);
        $cadena=str_ireplace("DELETE * FROM", "", $cadena);
        $cadena=str_ireplace("INSERT INTO * FROM", "", $cadena);
        $cadena=str_ireplace("--", "", $cadena);
        $cadena=str_ireplace("==", "", $cadena);
        $cadena=str_ireplace(";", "", $cadena);
        return $cadena;

    }
    public function fecha_cadena($fecha){
        $date = date_create_from_format('Y-m-d',$fecha);
        $newFormat = date_format($date,"dmY");
        return  $newFormat;
        
    }
    public function fecha_cadena_hora($fechahora){
        $date = date_create_from_format('Y-m-d H:i:s',$fechahora);
        $newFormat = date_format($date,"dmY");
        return  $newFormat;   
    }
    public function hora_cadena($hora){
        $date = date_create_from_format('H:i:s',$hora);
        $newFormat = date_format($date,"Hi");
        return  $newFormat;   
    }

    
    /*--------- Funcion paginador de tablas ---------*/
        protected static function paginar_tablas($pagina,$Npaginas,$url){
            $tabla='
                <nav class="text-center">
                    <ul class="pagination pagination-sm">
                ';
                if($pagina==1){
                    $tabla.='<li class="disabled"><a><i class="zmdi zmdi-arrow-left"></i></a></li>';
                }else {
                    $tabla.='<li><a href="'.$url.'/'.($pagina-1).'/"><i class="zmdi zmdi-arrow-left"></i></a></li>';
                }
                for($i=1; $i<=$Npaginas; $i++){
                    if($pagina==$i){
                        $tabla.='<li class="active"><a href="'.$url.'/'.$i.'/">'.$i.'</a></li>';
                    }else{
                        $tabla.='<li><a href="'.$url.'/'.$i.'/">'.$i.'</a></li>';
                    }
                }
                if($pagina==$Npaginas){
                    $tabla.='<li class="disabled"><a><i class="zmdi zmdi-arrow-right"></i></a></li>';
                }else {
                    $tabla.='<li><a href="'.$url.'/'.($pagina+1).'/"><i class="zmdi zmdi-arrow-right"></i></a></li>';
                }
                $tabla.='
                    </ul>
                </nav>
                ';
            return $tabla;
        }
		protected static function paginador_tablas($pagina,$Npaginas,$url,$botones){
			$tabla='<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';

			if($pagina==1){
				$tabla.='<li class="page-item disabled"><a class="page-link"><i class="zmdi zmdi-arrow-left"></i></a></li>';
			}else{
				$tabla.='
				<li class="page-item"><a class="page-link" href="'.$url.'1/"><i class="zmdi zmdi-arrow-left"></i></a></li>
				<li class="page-item"><a class="page-link" href="'.$url.($pagina-1).'/">Anterior</a></li>
				';
			}


			$ci=0;
			for($i=$pagina; $i<=$Npaginas; $i++){
				if($ci>=$botones){
					break;
				}

				if($pagina==$i){
					$tabla.='<li class="page-item"><a class="page-link active" href="'.$url.$i.'/">'.$i.'</a></li>';
				}else{
					$tabla.='<li class="page-item"><a class="page-link" href="'.$url.$i.'/">'.$i.'</a></li>';
				}

				$ci++;
			}


			if($pagina==$Npaginas){
				$tabla.='<li class="page-item disabled"><a class="page-link"><i class="zmdi zmdi-arrow-right"></i></a></li>';
			}else{
				$tabla.='
				<li class="page-item"><a class="page-link" href="'.$url.($pagina+1).'/">Siguiente</a></li>
				<li class="page-item"><a class="page-link" href="'.$url.$Npaginas.'/"><i class="zmdi zmdi-arrow-right"></i></a></li>
				';
			}

			$tabla.='</ul></nav>';
			return $tabla;
		}
        protected function sweet_alert($datos){
        if($datos['Alerta']=="simple"){
            $alerta="
            <script>
                swal(
                    '".$datos['Titulo']."',
                    '".$datos['Texto']."',
                    '".$datos['Tipo']."'
                );
            </script>
            ";
        }elseif($datos['Alerta']=="recargar"){
            $alerta="
            <script>
            swal({
                title: '".$datos['Titulo']."',
                text: '".$datos['Texto']."',
                type: '".$datos['Tipo']."',
                confirmButtonText: 'Aceptar'
              }).then(function (){
                location.reload();                
              });
            </script>
            ";
        }elseif($datos['Alerta']=="limpiar"){
            $alerta="
            <script>
            swal({
                title: '".$datos['Titulo']."',
                text: '".$datos['Texto']."',
                type: '".$datos['Tipo']."',
                confirmButtonText: 'Aceptar'
              }).then(function (){
                $('.FormularioAjax')[0].reset(); 
                $('.js-ubigeo-basic-single').val(1).trigger('change');
                $('.js-ubigeoc-basic-single').val(1).trigger('change'); 
                $('.js-fua-basic-single').val(1).trigger('change');
                $('.etnia').val(1).trigger('change');
                //location.reload();              
              });
            </script>
            ";
        } 
        return $alerta;
    }

 }