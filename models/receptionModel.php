<?php
if ($peticionAjax){
    require_once "../core/mainModel.php";
} else{
    require_once "./core/mainModel.php";
}
class receptionModel extends mainModel
{
    protected function agregar_recepcion_muestra_modelo($datos){
        

        $sql=mainModel::conectar()->prepare("INSERT INTO receptionsamples (srDateReception, idgynecologicalhistory,  
        srStateReception, srObservationReception,  idEmployee)
        VALUES(:FechaRecepcion, :Muestra, :EstadoRecepcion, :Observacion, :Empleado)");
        $sql->bindParam("FechaRecepcion", $datos['FechaRecepcion']);
        $sql->bindParam("Muestra", $datos['Muestra']);
        $sql->bindParam("EstadoRecepcion", $datos['EstadoRecepcion']);
        $sql->bindParam("Observacion", $datos['Observacion']);
        $sql->bindParam("Empleado", $datos['Empleado']);
        $sql->execute();
        return $sql;
    }
    protected function datos_recepcion_modelo($tipo, $codigo){
        if($tipo=="Unico"){
            $query=mainModel::conectar()->prepare("SELECT idReceptionSample, srDateReception, srObservationReception, hgCodeLamina, paName, paLastName, paDNI, recepcion.emName as Recepcionador,
            muestra.emName as Muestreador, muestra.emLastName as MuestreadorA, hg.idGynecologicalHistory,
            establecimiento.esName as Procedencia
                        FROM receptionsamples INNER JOIN employees as recepcion on receptionsamples.idEmployee=recepcion.idEmployee
                        INNER JOIN gynecologicalhistorys as hg ON 
                        receptionsamples.idgynecologicalhistory=hg.idGynecologicalHistory 
                        INNER JOIN employees as muestra on hg.idEmployee=muestra.idEmployee
                        INNER JOIN establishments as establecimiento on muestra.idEstablishment=establecimiento.idEstablishment
                        INNER JOIN patients ON hg.paCode=patients.paCode     
                        WHERE idReceptionSample=:Codigo");
            $query->bindParam(":Codigo", $codigo);
        }elseif($tipo=="Conteo")
        {
            $query=mainModel::conectar()->prepare("SELECT idReceptionSample FROM receptionsamples");
         }
        $query->execute();
        return $query;
    }
    protected function datos_norecepcionados_modelo($tipo, $codigo){
        if($tipo=="Unico"){
            $query=mainModel::conectar()->prepare("SELECT muestraid.idGynecologicalHistory, idReceptionSample, srDateReception, srObservationReception, hgCodeLamina, paName, paLastName, paDNI, recepcion.emName as Recepcionador,
            recepcion.emName as Recepcionador, recepcion.emLastName as RecepcionadorA,
            establecimiento.esName as Procedencia
                        FROM receptionsamples INNER JOIN employees as recepcion on receptionsamples.idEmployee=recepcion.idEmployee
                        INNER JOIN gynecologicalhistorys as muestraid ON 
                        receptionsamples.idgynecologicalhistory=muestraid.idGynecologicalHistory 
                        INNER JOIN employees as muestra on muestraid.idEmployee=muestra.idEmployee
                        INNER JOIN establishments as establecimiento on muestra.idEstablishment=establecimiento.idEstablishment
                        INNER JOIN patients ON muestraid.paCode=patients.paCode     
                        WHERE muestraid.idGynecologicalHistory=:Codigo");
            $query->bindParam(":Codigo", $codigo);
        }elseif($tipo=="Conteo")
        {
            $query=mainModel::conectar()->prepare("SELECT idReceptionSample FROM receptionsamples");
         }
        $query->execute();
        return $query;
    }

  

    protected function modificar_muestra_modelo($idMuestra, $estadoM){
        
        $sql=mainModel::conectar()->prepare("UPDATE gynecologicalhistorys SET hgRecepcionYesNo='1', hgStateSample=:ESTADOMUESTRA
        WHERE idGynecologicalHistory=:IDMUESTRA");
        $sql->bindParam(":IDMUESTRA", $idMuestra);
        $sql->bindParam(":ESTADOMUESTRA", $estadoM);
        
        $sql->execute();
        return $sql;
    }

}