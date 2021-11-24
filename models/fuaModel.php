<?php
if ($peticionAjax){
    require_once "../core/mainModel.php";
} else{
    require_once "./core/mainModel.php";
}
class fuaModel extends mainModel
{
    protected function agregar_triaje_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO patienhistory (historydate, historyweight, historyheight, historyPA, idpatient)
        VALUES(:idpatienhistory, :historydate,:historyweight, :historyheight, :historyPA, :idpatient)");
        $sql->bindParam("historydate", $datos['historydate']);
        $sql->bindParam("historyweight", $datos['historyweight']);
        $sql->bindParam("historyheight", $datos['historyheight']);
        $sql->bindParam("historyPA", $datos['historyPA']);
        $sql->bindParam("idpatient", $datos['idpatient']);
        $sql->execute();
        return $sql;
    }

    protected function agregar_paciente_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO patients (patientName, patientNameOther, patientLastName, patientSecondSurname, 
        patientDocument, patientTypeDocument, patientGender, patientDateBirth, patientDateDeath, patientDateBorn, 	patientHistoryClinic, 
        patientEtnia, patientMembership1, patientMembership2, patientMembership3, patientIAFAS, patientIAFASseguro, patientObs)
        VALUES(:patientName, :patientNameOther, :patientLastName, :patientSecondSurname, 
        :patientDocument, :patientTypeDocument, :patientGender, :patientDateBirth, :patientDateDeath, :patientDateBorn, :patientHistoryClinic, 
        :patientEtnia, :patientMembership1, :patientMembership2, :patientMembership3, :patientIAFAS, :patientIAFASseguro, :patientObs)");

        $sql->bindParam("patientName", $datos['patientName']);
        $sql->bindParam("patientNameOther", $datos['patientNameOther']);
        $sql->bindParam("patientLastName", $datos['patientLastName']);
        $sql->bindParam("patientSecondSurname", $datos['patientSecondSurname']);
        $sql->bindParam("patientDocument", $datos['patientDocument']);
        $sql->bindParam("patientTypeDocument", $datos['patientTypeDocument']);
        $sql->bindParam("patientGender", $datos['patientGender']);
        $sql->bindParam("patientDateBirth", $datos['patientDateBirth']);
        $sql->bindParam("patientDateDeath", $datos['patientDateDeath']);
        $sql->bindParam("patientDateBorn", $datos['patientDateBorn']);
        $sql->bindParam("patientHistoryClinic", $datos['patientHistoryClinic']);
        $sql->bindParam("patientEtnia", $datos['patientEtnia']);
        $sql->bindParam("patientMembership1", $datos['patientMembership1']);
        $sql->bindParam("patientMembership2", $datos['patientMembership2']);
        $sql->bindParam("patientMembership3", $datos['patientMembership3']);
        $sql->bindParam("patientIAFAS", $datos['patientIAFAS']);
        $sql->bindParam("patientIAFASseguro", $datos['patientIAFASseguro']);
        $sql->bindParam("patientObs", $datos['patientObs']);
        $sql->execute();
        return $sql;
        
    }
    public function agregar_fua_modelo($datos)
    {
        $sql=mainModel::conectar()->prepare("INSERT INTO fuas (idfua, patientDiresa, patientTypeSIS, patientNroSIS, fuaNro, 
        fuaSheetReferene, fuaDateAttentions, fuaTime, fuaUPS, fuaCodPresta, fuaCodPrestaAdditional, fuaDateHospitalization, 
        fuaDateHospExit, fuaDateHospCurt, fuaCodAuthorization, fuaLink, fuaCoverage, fuaAmount, fuaSheetCounter, fuaObs, identitys, 
        idattentions, idtprovision, idplatform, idipress, idemployee, iddoctor,  idpatient, idipressDestination, idbconcept, iddestination, idtypefua)
        VALUES(:idfua, :patientDiresa, :patientTypeSIS, :patientNroSIS, :fuaNro, 
        :fuaSheetReferene, :fuaDateAttentions, :fuaTime, :fuaUPS, :fuaCodPresta, :fuaCodPrestaAdditional, :fuaDateHospitalization, 
        :fuaDateHospExit, :fuaDateHospCurt, :fuaCodAuthorization, :fuaLink, :fuaCoverage, :fuaAmount, :fuaSheetCounter, :fuaObs, :identitys, 
        :idattentions, :idtprovision, :idplatform, :idipress, :idemployee, :iddoctor,  :idpatient, :idipressDestination, :idbconcept, :iddestination, :idtypefua)");
        $sql->bindParam("idfua", $datos['idfua']);
        $sql->bindParam("patientDiresa", $datos['patientDiresa']);
        $sql->bindParam("patientTypeSIS", $datos['patientTypeSIS']);
        $sql->bindParam("patientNroSIS", $datos['patientNroSIS']);
        $sql->bindParam("fuaNro", $datos['fuaNro']);
        $sql->bindParam("fuaSheetReferene", $datos['fuaSheetReferene']);
        $sql->bindParam("fuaDateAttentions", $datos['fuaDateAttentions']);
        $sql->bindParam("fuaTime", $datos['fuaTime']);
        $sql->bindParam("fuaUPS", $datos['fuaUPS']);
        $sql->bindParam("fuaCodPresta", $datos['fuaCodPresta']);
        $sql->bindParam("fuaCodPrestaAdditional", $datos['fuaCodPrestaAdditional']);
        $sql->bindParam("fuaDateHospitalization", $datos['fuaDateHospitalization']);
        $sql->bindParam("fuaDateHospExit", $datos['fuaDateHospExit']);
        $sql->bindParam("fuaDateHospCurt", $datos['fuaDateHospCurt']);
        $sql->bindParam("fuaCodAuthorization", $datos['fuaCodAuthorization']);
        $sql->bindParam("fuaLink", $datos['fuaLink']);
        $sql->bindParam("fuaCoverage", $datos['fuaCoverage']);
        $sql->bindParam("fuaAmount", $datos['fuaAmount']);
        $sql->bindParam("fuaSheetCounter", $datos['fuaSheetCounter']);
        $sql->bindParam("fuaObs", $datos['fuaObs']);
        $sql->bindParam("identitys", $datos['identitys']);
        $sql->bindParam("idattentions", $datos['idattentions']);
        $sql->bindParam("idtprovision", $datos['idtprovision']);
        $sql->bindParam("idplatform", $datos['idplatform']);
        $sql->bindParam("idipress", $datos['idipress']);
        $sql->bindParam("idemployee", $datos['idemployee']);
        $sql->bindParam("iddoctor", $datos['iddoctor']);
        $sql->bindParam("idpatient", $datos['idpatient']);
        $sql->bindParam("idipressDestination", $datos['idipressDestination']);
        $sql->bindParam("idbconcept", $datos['idbconcept']);
        $sql->bindParam("iddestination", $datos['iddestination']);
        $sql->bindParam("idtypefua", $datos['idtypefua']);
        $sql->execute();
        return $sql;
        
    }
    
    public function listar_fua_modelo()
    {
        $query=mainModel::conectar()->prepare("SELECT idfua, fuaNro, fuaDateAttentions, paciente.patientTypeDocument as TipoDoc, paciente.patientDocument as Documento,
        paciente.patientLastName as ApellidoP, paciente.patientSecondSurname as ApellidoM , paciente.patientName as Nombre, paciente.patientNameOther as NombreDos
        FROM fuas INNER join patients as paciente on fuas.idpatient=paciente.idpatient");
        $query->execute();
        //return $query;
        //return $query->fetchAll(PDO::FETCH_ASSOC);
        return $query->fetchAll();
     }

     protected function datos_fua_modelo($tipo, $codigo)
     {
         if($tipo=="Unico"){
             $query=mainModel::conectar()->prepare("SELECT idfua, fuaNro, fuaDateAttentions, paciente.patientTypeDocument as TipoDoc, paciente.patientDocument as Documento,
             paciente.patientLastName as ApellidoP, paciente.patientSecondSurname as ApellidoM , paciente.patientName as Nombre, paciente.patientNameOther as NombreDos
             FROM fuas INNER join patients as paciente on fuas.idpatient=paciente.idpatient
             WHERE idfua=:Codigo");
             $query->bindParam(":Codigo", $codigo);
         }elseif($tipo=="Conteo")
         {
             $query=mainModel::conectar()->prepare("SELECT idfua FROM fuas");
         }
         $query->execute();
         return $query;
     }

    
}