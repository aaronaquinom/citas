<?php
if ($peticionAjax){
    require_once "../core/mainModel.php";
} else{
    require_once "./core/mainModel.php";
}
class printModel extends mainModel
{
    
    public function imprimir_muestra_modelo($codigoM){
        $sql=mainModel::conectar()->prepare("SELECT idGynecologicalHistory, hgDateSample, hgDateMestruation, hgPregnant, hgContraceptive, hgTypeContraceptive,
        hgExaminationNormalAb, hgSpecifyExamination, hgColposcopyYesNo, hgPapPrevius, hgSpecifyColposcopy, hgDatePapPrevius,
        hgStateSample, hgStarSexualRelacion, hgPartnersSexual, hgPregnantAge, hgNumberPregnant, hgNumberAbortions, hgIva,
        hgCodeLamina, higy.paCode as 
                paciente, hgRecepcionYesNo, paDNI, paName, paLastName, paAdress, paPhone, paBirthdate, paAge, disName, esName, emName, 
                empleadoi.emName as MResponsableNombre, empleadoi.emLastName as MResponsableApellido, empleadoi.emProfession as ProfesionM 
                FROM gynecologicalhistorys 
                as higy inner join patients as paciente on higy.paCode=paciente.paCode
                inner join  districts on paciente.idDistric=districts.idDistric 
                inner join employees as empleadoi on higy.idEmployee=empleadoi.idEmployee
                inner join establishments on empleadoi.idEstablishment=establishments.idEstablishment
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
    public function imprimir_resultado_modelo($codigoR){
        

        $sql=mainModel::conectar()->prepare("SELECT idResult, hgRecepcionYesNo, reCodeLamina, reObsConclusion, reNewSampleYesNo, reDateResult, 
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