<?php
if ($peticionAjax){
    require_once "../core/mainModel.php";
} else{
    require_once "./core/mainModel.php";
}
class printModel extends mainModel
{
    
    public function imprimir_fua_modelo($codigoM){

        $sql=mainModel::conectar()->prepare("SELECT idfua, fuaNro, fuas.idplatform, fuas.idtprovision, fuas.idattentions, ipressllegada.ipressCode as Impresscodigollegada, ipressllegada.ipressName as Nombreipressllegada, fuaSheetReferene,
        paciente.patientTypeDocument as TipoDoc,  paciente.patientDocument as Documento, patientDiresa, patientTypeSIS, patientNroSIS, 
        paciente.patientLastName as ApellidoP, paciente.patientSecondSurname as ApellidoM , paciente.patientName as Nombre, paciente.patientNameOther as NombreDos,
        paciente.patientGender as Genero, paciente.patientDateBirth as fNacimiento, paciente.patientDateDeath as fMuerte, paciente.patientHistoryClinic as hClinica, paciente.patientEtnia as Etnia, 
        fuaDateAttentions, fuaTime, fuaDateHospitalization, fuaDateHospExit,
        fuas.idbconcept, fuas.iddestination, ipressdestino.ipressCode as Impresscodigodestino, ipressdestino.ipressName as nombreipressdestino, fuaSheetCounter, doctores.doctorDNI, doctores.doctorName, doctores.doctorLastName, doctores.doctorColegiatura, doctores.doctorResponsable, doctores.doctorEspecialty, doctores.doctorRNE, doctores.doctorGraduate
        FROM fuas INNER JOIN platforms as plataforma on fuas.idplatform=plataforma.idplatform
                  INNER JOIN provisions as provisiones on fuas.idtprovision=provisiones.idtprovision 
                  INNER JOIN attentions as atenciones on fuas.idattentions = atenciones.idattentions
                  INNER JOIN ipresses as ipressllegada on fuas.idipress =ipressllegada.idipress
                  INNER JOIN ipresses as ipressdestino on fuas.idipressDestination=ipressdestino.idipress
                  INNER JOIN benefitconcepts as prestacional on fuas.idbconcept = prestacional.idbconcept
                  INNER JOIN destinations as destino on fuas.iddestination=destino.iddestination
                  INNER JOIN doctors as doctores on fuas.iddoctor=doctores.iddoctor
                  INNER JOIN patients as paciente on fuas.idpatient=paciente.idpatient  
        WHERE idfua=:CodigoM");
        $sql->bindParam(":CodigoM", $codigoM);
        $sql->execute();
        return $sql;
    }
    
    
    public function imprimir_muestra_modelo($codigoM){
        $sql=mainModel::conectar()->prepare("
                WHERE idGynecologicalHistory=:CodigoM");
        $sql->bindParam(":CodigoM", $codigoM);
        $sql->execute();
        return $sql;
    }
    
    public function imprimir_lectura_modelo($codigoR){
        

            $sql=mainModel::conectar()->prepare("SELECT idFirstreading, hgRecepcionYesNo, frCodeLamina, frNewSampleYesNo, frDateFirstreading, tecnologo.emName as Lectura, 
            tecnologo.emLicense as ColegiaturaT, 
            usStamp, higy.idGynecologicalHistory,
            paDNI,tecnologo.emLastName as LecturaA, hgDateSample, hgDateMestruation, hgPregnant, hgContraceptive, hgTypeContraceptive,
            hgExaminationNormalAb, hgSpecifyExamination, hgColposcopyYesNo, hgPapPrevius, hgSpecifyColposcopy, hgDatePapPrevius,
            hgStateSample, hgStarSexualRelacion, hgPartnersSexual, hgPregnantAge, hgNumberPregnant, hgNumberAbortions, hgIva,
            paName, paLastName, paAdress, paPhone, paBirthdate, paAge, disName, esName, tabla1.emName as MResponsableNombre,
            tabla1.emLastName as MResponsableApellido,tabla1.emProfession as ProfesionM, hgDateSample, hgStateSample,
            especimenesg.idSpecimen as Especimen,especimen.dsName as NombreEspecimen, frObsSpecimen, clasificaciones.idClassification as Clasificacion , claName, dcName, frObsrClassification, 
            escamosa.idDetailScail as Escamosa, escamosa.dsName as NombreEscamosa, frCarcinoma, glandular.idDetailGlandular as Glandular, dgName, frAdenocarcinomaType, frNeoplasmsMalignant, benigno.idBenign as Benigno, dbName, frObsBenign, hormonal.idhormonal as Hormonal, dhName, 
            frObsHornomal, coName, frObsConclusion 
            FROM firstreadings inner join detailspecimens as especimen on  firstreadings.idDetailSpecimen=especimen.idDetailSpecimen
            inner join specimens as especimenesg on especimen.idSpecimen=especimenesg.idSpecimen
            inner join detailclassifications on firstreadings.idDetailClassification=detailclassifications.idDetailClassification
            inner join classifications as clasificaciones on clasificaciones.idClassification=detailclassifications.idClassification
            inner join  detailscails as escamosa on firstreadings.idDetailScail=escamosa.idDetailScail
            inner join detailglandulars as glandular on firstreadings.idDetailGlandular=glandular.idDetailGlandular
            inner join detailbenigns on firstreadings.idDetailBenign=detailbenigns.idDetailBenign
            inner join benigns as benigno on  benigno.idBenign=detailbenigns.idBenign
            inner join detailhormonals on firstreadings.idDetailHormonal=detailhormonals.idDetailHormonal
            inner join hormonals as hormonal on hormonal.idhormonal=detailhormonals.idhormonal
            inner join conclusions on firstreadings.idConclusion=conclusions.idConclusion
            inner join receptionsamples on firstreadings.idReceptionSample=receptionsamples.idReceptionSample 
            inner join employees as tecnologo on firstreadings.idEmployee=tecnologo.idEmployee
            inner join users on tecnologo.usCode=users.usCode
            inner join gynecologicalhistorys as higy on receptionsamples.idgynecologicalhistory=higy.idGynecologicalHistory 
            inner join patients on patients.paCode=higy.paCode
            inner join  districts on patients.idDistric=districts.idDistric 
            inner join employees as tabla1 on higy.idEmployee=tabla1.idEmployee
            inner join establishments on patients.idEstablishment=establishments.idEstablishment
            inner join employees as tabla2 on receptionsamples.idEmployee=tabla2.idEmployee
            WHERE idFirstreading=:CodigoR");
        $sql->bindParam(":CodigoR", $codigoR);
        $sql->execute();
        return $sql;
    }
    public function imprimir_cuadrante_modelo($idhg){
        $query=mainModel::conectar()->prepare("SELECT  idGynecologicalHistory, cgyName, COUNT(*) AS cuadro
        FROM gynecologicalcuadrants 
        WHERE idGynecologicalHistory=:idHg
        group by cgyName");
        $query->bindParam(":idHg", $idhg);
        $query->execute();
        return $query;

    }
    public function imprimir_resultadofinal_modelo($codigoR)
    {  
        $sql=mainModel::conectar()->prepare("SELECT idResult, hgRecepcionYesNo, reObsConclusion, reCodeLamina, reNewSampleYesNo, reDateResult, 
        tecnologo.emName as Lectura, tecnologo.emLicense as ColegiaturaT, srDateReception,
        usuariot.usStamp as FirmaT, usuariom.usStamp as FirmaM, higy.idGynecologicalHistory, medico.emLastName as ResultadoA, medico.emName as ResultadoN, medico.emLicense as ColegiaturaM,
        paDNI,tecnologo.emLastName as LecturaA, hgDateSample, hgDateMestruation, hgPregnant, hgContraceptive, hgTypeContraceptive,
        hgExaminationNormalAb, hgSpecifyExamination, hgColposcopyYesNo, hgPapPrevius, hgSpecifyColposcopy, hgDatePapPrevius,
        hgStateSample, hgStarSexualRelacion, hgPartnersSexual, hgPregnantAge, hgNumberPregnant, hgNumberAbortions, hgIva,
        paName, paLastName, paAdress, paPhone, paBirthdate, paAge, disName, esName, tabla1.emName as MResponsableNombre,
        tabla1.emLastName as MResponsableApellido,tabla1.emProfession as ProfesionM, hgDateSample, hgStateSample,
        especimenesg.idSpecimen as Especimen,especimen.dsName as NombreEspecimen, frObsSpecimen, clasificaciones.idClassification as Clasificacion , claName, dcName, frObsrClassification, 
        escamosa.idDetailScail as Escamosa, escamosa.dsName as NombreEscamosa, reCarcinoma, glandular.idDetailGlandular as Glandular, dgName, reAdenocarcinomaType, frNeoplasmsMalignant, benigno.idBenign as Benigno, dbName, frObsBenign, hormonal.idhormonal as Hormonal, dhName, 
        frObsHornomal, coName, frObsConclusion 
        FROM results inner join firstreadings on results.idFirstreading=firstreadings.idFirstreading
        inner join detailspecimens as especimen on  firstreadings.idDetailSpecimen=especimen.idDetailSpecimen
        inner join specimens as especimenesg on especimen.idSpecimen=especimenesg.idSpecimen
        inner join detailclassifications on firstreadings.idDetailClassification=detailclassifications.idDetailClassification
        inner join classifications as clasificaciones on clasificaciones.idClassification=detailclassifications.idClassification
        inner join  detailscails as escamosa on firstreadings.idDetailScail=escamosa.idDetailScail
        inner join detailglandulars as glandular on firstreadings.idDetailGlandular=glandular.idDetailGlandular
        inner join detailbenigns on firstreadings.idDetailBenign=detailbenigns.idDetailBenign
        inner join benigns as benigno on  benigno.idBenign=detailbenigns.idBenign
        inner join detailhormonals on firstreadings.idDetailHormonal=detailhormonals.idDetailHormonal
        inner join hormonals as hormonal on hormonal.idhormonal=detailhormonals.idhormonal
        inner join conclusions on firstreadings.idConclusion=conclusions.idConclusion
        inner join receptionsamples on firstreadings.idReceptionSample=receptionsamples.idReceptionSample 
        inner join employees as tecnologo on firstreadings.idEmployee=tecnologo.idEmployee
        inner join employees as medico on results.idEmployee=medico.idEmployee
        inner join users as usuariot on tecnologo.usCode=usuariot.usCode
        inner join users as usuariom on medico.usCode=usuariom.usCode
        inner join gynecologicalhistorys as higy on receptionsamples.idgynecologicalhistory=higy.idGynecologicalHistory 
        inner join patients on patients.paCode=higy.paCode
        inner join  districts on patients.idDistric=districts.idDistric 
        inner join employees as tabla1 on higy.idEmployee=tabla1.idEmployee
        inner join establishments on patients.idEstablishment=establishments.idEstablishment
        inner join employees as tabla2 on receptionsamples.idEmployee=tabla2.idEmployee
        WHERE idResult=:CodigoR");
        $sql->bindParam(":CodigoR", $codigoR);
        $sql->execute();
    return $sql;
    }  
    public function imprimir_resultado_modelo($codigoR)
    {  
        $sql=mainModel::conectar()->prepare("SELECT idResult, hgRecepcionYesNo, reObsConclusion, reCodeLamina, reNewSampleYesNo, reDateResult, 
        tecnologo.emName as Lectura, tecnologo.emLicense as ColegiaturaT, 
        usuariot.usStamp as FirmaT, usuariom.usStamp as FirmaM, higy.idGynecologicalHistory, medico.emLastName as ResultadoA, medico.emName as ResultadoN, medico.emLicense as ColegiaturaM,
        paDNI,tecnologo.emLastName as LecturaA, hgDateSample, hgDateMestruation, hgPregnant, hgContraceptive, hgTypeContraceptive,
        hgExaminationNormalAb, hgSpecifyExamination, hgColposcopyYesNo, hgPapPrevius, hgSpecifyColposcopy, hgDatePapPrevius,
        hgStateSample, hgStarSexualRelacion, hgPartnersSexual, hgPregnantAge, hgNumberPregnant, hgNumberAbortions, hgIva,
        paName, paLastName, paAdress, paPhone, paBirthdate, paAge, disName, esName, tabla1.emName as MResponsableNombre,
        tabla1.emLastName as MResponsableApellido,tabla1.emProfession as ProfesionM, hgDateSample, hgStateSample,
        especimenesg.idSpecimen as Especimen,especimen.dsName as NombreEspecimen, frObsSpecimen, clasificaciones.idClassification as Clasificacion , claName, dcName, frObsrClassification, 
        escamosa.idDetailScail as Escamosa, escamosa.dsName as NombreEscamosa, frCarcinoma, glandular.idDetailGlandular as Glandular, dgName, frAdenocarcinomaType, frNeoplasmsMalignant, benigno.idBenign as Benigno, dbName, frObsBenign, hormonal.idhormonal as Hormonal, dhName, 
        frObsHornomal, coName, frObsConclusion 
        FROM results inner join firstreadings on results.idFirstreading=firstreadings.idFirstreading
        inner join detailspecimens as especimen on  firstreadings.idDetailSpecimen=especimen.idDetailSpecimen
        inner join specimens as especimenesg on especimen.idSpecimen=especimenesg.idSpecimen
        inner join detailclassifications on firstreadings.idDetailClassification=detailclassifications.idDetailClassification
        inner join classifications as clasificaciones on clasificaciones.idClassification=detailclassifications.idClassification
        inner join  detailscails as escamosa on firstreadings.idDetailScail=escamosa.idDetailScail
        inner join detailglandulars as glandular on firstreadings.idDetailGlandular=glandular.idDetailGlandular
        inner join detailbenigns on firstreadings.idDetailBenign=detailbenigns.idDetailBenign
        inner join benigns as benigno on  benigno.idBenign=detailbenigns.idBenign
        inner join detailhormonals on firstreadings.idDetailHormonal=detailhormonals.idDetailHormonal
        inner join hormonals as hormonal on hormonal.idhormonal=detailhormonals.idhormonal
        inner join conclusions on firstreadings.idConclusion=conclusions.idConclusion
        inner join receptionsamples on firstreadings.idReceptionSample=receptionsamples.idReceptionSample 
        inner join employees as tecnologo on firstreadings.idEmployee=tecnologo.idEmployee
        inner join employees as medico on results.idEmployee=medico.idEmployee
        inner join users as usuariot on tecnologo.usCode=usuariot.usCode
        inner join users as usuariom on medico.usCode=usuariom.usCode
        inner join gynecologicalhistorys as higy on receptionsamples.idgynecologicalhistory=higy.idGynecologicalHistory 
        inner join patients on patients.paCode=higy.paCode
        inner join  districts on patients.idDistric=districts.idDistric 
        inner join employees as tabla1 on higy.idEmployee=tabla1.idEmployee
        inner join establishments on patients.idEstablishment=establishments.idEstablishment
        inner join employees as tabla2 on receptionsamples.idEmployee=tabla2.idEmployee
        WHERE idResult=:CodigoR");
        $sql->bindParam(":CodigoR", $codigoR);
        $sql->execute();
    return $sql;
    }   
    public function obtener_datos_paciente_modelo($dni){
        $query=mainModel::conectar()->prepare("SELECT * FROM Paciente WHERE paDNI=:DNI");
        $query->bindParam(":DNI", $dni);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
     }
}