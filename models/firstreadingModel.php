<?php
if ($peticionAjax){
    require_once "../core/mainModel.php";
} else{
    require_once "./core/mainModel.php";
}
class firstreadingModel extends mainModel
{
    protected function agregar_resultado_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO firstreadings (frCodeLamina, frState,
        idDetailSpecimen, frObsSpecimen, 
        idDetailClassification, frObsrClassification, idDetailScail,
        frCarcinoma, idDetailGlandular, frAdenocarcinomaType, frNeoplasmsMalignant,idDetailBenign,
        frObsBenign, idDetailHormonal, frObsHornomal, 
        idConclusion, frObsConclusion,  
        frNewSampleYesNo, frDateFirstreading,
        idEmployee, idReceptionSample)
        VALUES(:CodLamina, :Estado, :Especimen, :ObsEspecimen,
        :ClasificacionGeneral, :ObsClasificacion, :CeEscamosa, :Carcicoma,
        :CeGlandular, :CelulasGlandulares,  :NeoplasiasMalignas, :CelulasBenignas,
        :ObsBenigno, :Hormonal, :ObsHormonal,
        :Conclusiones, :ObsConclusiones, :NuevamuestraSiNo, :FechaResultado,
        :Empleado,:RecepcionMuestra)");
        $sql->bindParam("CodLamina", $datos['CodLamina']);
        $sql->bindParam("Estado", $datos['Estado']);
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
        $sql->bindParam("RecepcionMuestra", $datos['RecepcionMuestra']);
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
    protected function datos_resultadodos_modelo($tipo, $codigo){
        if($tipo=="Unico"){
            $query=mainModel::conectar()->prepare("SELECT idResultadodos, redosCodiLamina, redosFeChaResultado, paDNI,
            paNombre, paApellidos, esnombre, tabla2.emNombre as Resultado, tabla3. emNombre as Resultadodos 
                     FROM resultadodos inner join resultado on resultadodos.idResultado=resultado.idResultado
                     inner join recepcionmuestra on resultado.idRecepcionMuestra=recepcionmuestra.idRecepcionMuestra
                     inner join historiaginecologica on recepcionmuestra.idHistoriaClinica=historiaginecologica.idHistoriaClinica
                     inner join paciente on paciente.paHistoriaG=historiaginecologica.hgHistoriaG
                     inner join empleado as tabla1 on historiaginecologica.idEmpleado=tabla1.idEmpleado
                     inner join establecimiento on tabla1.idEstablecimiento=establecimiento.idEstablecimiento 
                     inner join empleado as tabla2 on resultado.idEmpleado=tabla2.idEmpleado
                     inner join empleado as tabla3 on resultado.idEmpleado=tabla3.idEmpleado
                           WHERE idResultadodos=:Codigo");
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
        $sql=mainModel::conectar()->prepare("UPDATE gynecologicalhistorys SET hgStateSample='3'
        WHERE idGynecologicalHistory=:IDMUESTRA");
        $sql->bindParam(":IDMUESTRA", $idMuestra);
        
        $sql->execute();
        return $sql;
    }

    
}