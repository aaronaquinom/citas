<?php
if ($peticionAjax){
    require_once "../core/mainModel.php";
} else{
    require_once "./core/mainModel.php";
}
class resultModel extends mainModel
{
    protected function agregar_resultadofinal_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO results (reCodeLamina,
        idDetailSpecimen, reObsSpecimen, 
        idDetailClassification, reObsrClassification, idDetailScail,
        reCarcinoma, idDetailGlandular, reAdenocarcinomaType, reNeoplasmsMalignant,idDetailBenign,
        reObsBenign, idDetailHormonal, reObsHornomal, 
        idConclusion, reObsConclusion,  
        reNewSampleYesNo, reDateResult,
        idEmployee, idFirstreading )
        VALUES(:CodLamina, :Especimen, :ObsEspecimen,
        :ClasificacionGeneral, :ObsClasificacion, :CeEscamosa, :Carcicoma,
        :CeGlandular, :CelulasGlandulares,  :NeoplasiasMalignas, :CelulasBenignas,
        :ObsBenigno, :Hormonal, :ObsHormonal,
        :Conclusiones, :ObsConclusiones, :NuevamuestraSiNo, :FechaResultado,
        :Empleado,:Lectura)");
        $sql->bindParam("CodLamina", $datos['CodLamina']);
        
        $sql->bindParam("Especimen", $datos['Especimen']);
        $sql->bindParam("ObsEspecimen", $datos['ObsEspecimen']);
        $sql->bindParam("ClasificacionGeneral", $datos['ClasificacionGeneral']);
        $sql->bindParam("ObsClasificacion", $datos['ObsClasificacion']);
        $sql->bindParam("CeEscamosa", $datos['CeEscamosa']);
        $sql->bindParam("Carcicoma", $datos['Carcicoma']);
        $sql->bindParam("CeGlandular", $datos['CeGlandular']);
        $sql->bindParam("CelulasGlandulares", $datos['CelulasGlandulares']);
        $sql->bindParam("NeoplasiasMalignas", $datos['NeoplasiasMalignas']);
     
        $sql->bindParam("CelulasBenignas", $datos['CelulasBenignas']);
        $sql->bindParam("ObsBenigno", $datos['ObsBenigno']);
       
        $sql->bindParam("Hormonal", $datos['Hormonal']);
        $sql->bindParam("ObsHormonal", $datos['ObsHormonal']);
        
        
        $sql->bindParam("Conclusiones", $datos['Conclusiones']);
        $sql->bindParam("ObsConclusiones", $datos['ObsConclusiones']);

        $sql->bindParam("NuevamuestraSiNo", $datos['NuevamuestraSiNo']);
        $sql->bindParam("FechaResultado", $datos['FechaResultado']);
        $sql->bindParam("Empleado", $datos['Empleado']);
        $sql->bindParam("Lectura", $datos['Lectura']);
        $sql->execute();
        
        return $sql;
    }
    public function seleccionar_especimen_modelo(){
        $sql=mainModel::conectar()->prepare("SELECT * FROM especimen");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
    public function seleccionar_clasificacion_modelo(){
        $sql=mainModel::conectar()->prepare("SELECT * FROM clasificaciongeneral");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
    public function seleccionar_epiteliales_modelo(){
        $sql=mainModel::conectar()->prepare("SELECT * FROM celulasepiteliales");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
    public function seleccionar_escamoso_modelo(){
        $sql=mainModel::conectar()->prepare("SELECT * FROM ceescamosa WHERE idCelulasEpiteliales=$id"); //corregir mvc
        $query->bindParam(":ID", $id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
    public function seleccionar_glandulares_modelo(){
        $sql=mainModel::conectar()->prepare("SELECT * FROM mcelulasglandulares");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
    public function seleccionar_benignas_modelo(){
        $sql=mainModel::conectar()->prepare("SELECT * FROM celulasbenignas");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
    public function seleccionar_hormonal_modelo(){
        $sql=mainModel::conectar()->prepare("SELECT * FROM hormonal");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
    public function seleccionar_tecnologo_modelo(){
        $sql=mainModel::conectar()->prepare("SELECT * FROM tecnologo");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    protected function datos_lectura_modelo($tipo, $codigo){
        if($tipo=="Unico"){
            $query=mainModel::conectar()->prepare("SELECT SQL_CALC_FOUND_ROWS  idFirstreading, hgRecepcionYesNo, frCodeLamina, frDateFirstreading, tecnologo.emName as Lectura, 
            paDNI,tecnologo.emLastName as LecturaA,
            paName, paLastName, esName, tabla1.emName as Muestra, hgDateSample, hgStateSample
          FROM firstreadings inner join receptionsamples on firstreadings.idReceptionSample=receptionsamples.idReceptionSample 
          inner join employees as tecnologo on firstreadings.idEmployee=tecnologo.idEmployee
          inner join gynecologicalhistorys on receptionsamples.idgynecologicalhistory=gynecologicalhistorys.idGynecologicalHistory 
          inner join patients on patients.paCode=gynecologicalhistorys.paCode
          inner join employees as tabla1 on gynecologicalhistorys.idEmployee=tabla1.idEmployee
          inner join establishments on patients.idEstablishment=establishments.idEstablishment
          inner join employees as tabla2 on receptionsamples.idEmployee=tabla2.idEmployee
          WHERE idFirstreading=:Codigo");
            $query->bindParam(":Codigo", $codigo);
        }elseif($tipo=="Conteo")
        {
            $query=mainModel::conectar()->prepare("SELECT idRecepcionMuestra FROM recepcionmuestra");
         }
        $query->execute();
        return $query;
    }
    //abajo para imprimir resultado final
    protected function datos_resultado_modelo($tipo, $codigo){
        if($tipo=="Unico"){
            $query=mainModel::conectar()->prepare("SELECT SQL_CALC_FOUND_ROWS  idResult, reCodeLamina, reDateResult, tecnologo.emName as Lectura, 
            paDNI,tecnologo.emLastName as LecturaA, medico.emLastName as ResultadoA, medico.emName as ResultadoN,
            paName, paLastName, esName, tabla1.emName as Muestra, hgDateSample, hgStateSample
          FROM results inner join firstreadings on results.idFirstreading=firstreadings.idFirstreading
          inner join receptionsamples on firstreadings.idReceptionSample=receptionsamples.idReceptionSample 
          inner join employees as tecnologo on firstreadings.idEmployee=tecnologo.idEmployee
          inner join employees as medico on results.idEmployee=medico.idEmployee
          inner join gynecologicalhistorys on receptionsamples.idgynecologicalhistory=gynecologicalhistorys.idGynecologicalHistory 
          inner join patients on patients.paCode=gynecologicalhistorys.paCode
          inner join employees as tabla1 on gynecologicalhistorys.idEmployee=tabla1.idEmployee
          inner join establishments on patients.idEstablishment=establishments.idEstablishment
          inner join employees as tabla2 on receptionsamples.idEmployee=tabla2.idEmployee
          WHERE idResult=:Codigo");
            $query->bindParam(":Codigo", $codigo);
        }elseif($tipo=="Conteo")
        {
            //contar cuantos resultados
            $query=mainModel::conectar()->prepare("SELECT idResultadodos FROM resultadodos");
         }
        $query->execute();
        return $query;
    }
    protected function modificar_muestra_modelo($idMuestra){
        $sql=mainModel::conectar()->prepare("UPDATE gynecologicalhistorys SET hgStateSample='4'
        WHERE idGynecologicalHistory=:IDMUESTRA");
        $sql->bindParam(":IDMUESTRA", $idMuestra);
        
        $sql->execute();
        return $sql;
    }
    protected function modificar_lectura_modelo($idLectura){
        $sql=mainModel::conectar()->prepare("UPDATE firstreadings SET frState='Si'
        WHERE idFirstreading=:IDLECTURA");
        $sql->bindParam(":IDLECTURA", $idLectura);
        
        $sql->execute();
        return $sql;
    }

    
}