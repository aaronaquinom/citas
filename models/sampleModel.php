<?php
if ($peticionAjax){
    require_once "../core/mainModel.php";
} else{
    require_once "./core/mainModel.php";
}
class sampleModel extends mainModel
{
    protected function agregar_muestra_modelo($datos){
        
        $sql=mainModel::conectar()->prepare("INSERT INTO gynecologicalhistorys (hgCodeLamina, hgDateSample, hgDateMestruation, hgExaminationNormalAb, 
        hgSpecifyExamination, hgColposcopyYesNo, hgSpecifyColposcopy, hgPapPrevius, hgDatePapPrevius, hgStarSexualRelacion, hgPartnersSexual, hgPregnant,
        hgContraceptive, hgTypeContraceptive, hgPregnantAge, hgNumberPregnant, hgNumberAbortions, hgiva, hgRecepcionYesNo, hgStateRemove, hgStateSample,
        paCode, idEmployee)
        VALUES(:CodigoMuestra, :FechaMuestra, :FechaRegla, :ExamenGinecologicoSiNo, :EspecifiqueGinecologico, :ColposcopiaSiNo, 
        :EspecifiqueColposcopia, :PapAnterior,:FechaPapAnterior, :Inrese, :Parsexual, :Embarazada,
        :Anticonceptivo, :TipoAnticonceptivo, :SemanaEmbarazo, :Partos, :Abortos, :Iva, :Recepcion, :Removido, :EstadoMuestra,
        :Paciente, :Empleado)");

        
        $sql->bindParam("CodigoMuestra", $datos['CodigoMuestra']);
        $sql->bindParam("FechaMuestra", $datos['FechaMuestra']);
        
        $sql->bindParam("FechaRegla", $datos['FechaRegla']);
        $sql->bindParam("ExamenGinecologicoSiNo", $datos['ExamenGinecologicoSiNo']);
        $sql->bindParam("EspecifiqueGinecologico", $datos['EspecifiqueGinecologico']);
        $sql->bindParam("ColposcopiaSiNo", $datos['ColposcopiaSiNo']);
        $sql->bindParam("EspecifiqueColposcopia", $datos['EspecifiqueColposcopia']);
        
        $sql->bindParam("PapAnterior", $datos['PapAnterior']);
        $sql->bindParam("FechaPapAnterior", $datos['FechaPapAnterior']);

        $sql->bindParam("Inrese", $datos['Inrese']); //nuevo
        $sql->bindParam("Parsexual", $datos['Parsexual']); //nuevo

        $sql->bindParam("Embarazada", $datos['Embarazada']);
        $sql->bindParam("Anticonceptivo", $datos['Anticonceptivo']);
        $sql->bindParam("TipoAnticonceptivo", $datos['TipoAnticonceptivo']);

        $sql->bindParam("SemanaEmbarazo", $datos['SemanaEmbarazo']);

        //$sql->bindParam("MaterialUtilizado", $datos['MaterialUtilizado']);
        //$sql->bindParam("FijadorUtilizado", $datos['FijadorUtilizado']);
        
        $sql->bindParam("Partos", $datos['Partos']);
        $sql->bindParam("Abortos", $datos['Abortos']);
        $sql->bindParam("Iva", $datos['Iva']);

        $sql->bindParam("Recepcion", $datos['Recepcion']);//historiaclinica
        $sql->bindParam("Removido", $datos['Removido']);//nuevo
        $sql->bindParam("EstadoMuestra", $datos['EstadoMuestra']);//nuevo

        $sql->bindParam("Paciente", $datos['Paciente']); //HistoriaG
        $sql->bindParam("Empleado", $datos['Empleado']);
        
        
        $sql->execute();
        return $sql;
    }

    protected function agregar_cuadrante_modelo($nombre, $idhistoriaClinica){
        $query=mainModel::conectar()->prepare("INSERT INTO gynecologicalcuadrants(cgyName, idGynecologicalHistory)
        VALUES('$nombre', '$idhistoriaClinica')");
    
        $query->execute();
        return $query;
    }
 
    protected function datos_muestra_modelo($tipo, $codigo)
    {
        if($tipo=="Unico"){
            $query=mainModel::conectar()->prepare("SELECT idGynecologicalHistory, hgDateSample, hgStateSample, hgCodeLamina, higy.paCode as paciente, hgRecepcionYesNo, paDNI, 
            paName, paLastName, esName, emName, empleadoi.emName as MResponsableNombre, empleadoi.emLastName as MResponsableApellido
            FROM gynecologicalhistorys as higy inner join patients as paciente  on higy.paCode=paciente.paCode 
            inner join employees as empleadoi on higy.idEmployee=empleadoi.idEmployee 
            inner join establishments on empleadoi.idEstablishment=establishments.idEstablishment
            WHERE idGynecologicalHistory=:Codigo");
            $query->bindParam(":Codigo", $codigo);
        }elseif($tipo=="Conteo")
        {
            $query=mainModel::conectar()->prepare("SELECT idGynecologicalHistory FROM gynecologicalhistorys");
        }
        $query->execute();
        return $query;
    }

}