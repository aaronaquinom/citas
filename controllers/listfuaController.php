<?php
$peticionAjax=true;
require_once "../core/configGeneral.php";
require_once "../core/mainModel.php";
require_once "../models/fuaModel.php";



        $datas=new fuaModel();
        
        $consulta=$datas->listar_fua_modelo();     
        
        //$arreglo['data']=$consulta;
        //echo json_encode($arreglo);
        

        foreach($consulta as $row){
                $filter=array();
                $filter[]=$row["idfua"];
                $filter[]=$row["fuaNro"];
                $filter[]=$row["fuaDateAttentions"];
                $filter[]=$row["TipoDoc"];
                $filter[]=$row["Documento"];
                $filter[]=$row["ApellidoP"];
                
                $filter[]=$row["ApellidoM"];
                $filter[]=$row["Nombre"];
                $filter[]=$row["NombreDos"];
                $filter[]='<div class="col text-center"><a href="../fua-print/'.mainModel::encryptions($row["idfua"]).'" class="btn btn-success btn-raised btn-xs">
                <i class="zmdi zmdi-refresh"></i></a></div>';
                
               
                
                
             
                $data[]= $filter;

               

                


        }
        $arreglos['data']=$data;
        echo json_encode($arreglos);


        

      
        
?>