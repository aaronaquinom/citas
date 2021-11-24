<?php
if ($peticionAjax){
    require_once "../core/mainModel.php";
} else{
    require_once "./core/mainModel.php";
}
 class patientModel extends mainModel 
 {
     protected function agregar_paciente_modelo($datos){
        $query=mainModel::conectar()->prepare("INSERT INTO patients (idPatient, paCode, paDNI, paName, paLastName, paAdress, paSisYesNo, paPhone,
        paBirthdate, paAge, paObservation, idDistric, idEstablishment) VALUES (:Id, :Historia, :DNI, :Nombre, :Apellidos, :Domicilio, :Sis, :Telefono,
        :FechaNacimiento, :Edad, :Observacion, :Dis, :Establecimiento)");
        $query->bindParam("Id", $datos['Id']);
        $query->bindParam("Historia", $datos['Historia']);
        $query->bindParam("DNI", $datos['DNI']);
        $query->bindParam("Nombre", $datos['Nombre']);
        $query->bindParam("Apellidos", $datos['Apellidos']);
        $query->bindParam("Domicilio", $datos['Domicilio']);
        $query->bindParam("Sis", $datos['Sis']);
        $query->bindParam("Telefono", $datos['Telefono']);
        $query->bindParam("FechaNacimiento", $datos['FechaNacimiento']);
        $query->bindParam("Edad", $datos['Edad']);      
        $query->bindParam("Observacion", $datos['Observacion']);
        $query->bindParam("Dis", $datos['Dis']);
        $query->bindParam("Establecimiento", $datos['Establecimiento']);
        $query->execute();
        return $query;
   
     }
     protected function datos_paciente_modelo($tipo, $codigo){
        if($tipo=="Unico"){
            $query=mainModel::conectar()->prepare("SELECT * FROM patients WHERE paCode=:Codigo");
            $query->bindParam(":Codigo",$codigo);
        }elseif($tipo=="Conteo")
        {
            $query=mainModel::conectar()->prepare("SELECT paCode FROM patients");
         }
        $query->execute();
        return $query;
    }
     public function obtener_datos_paciente_modelo($dni){
        $query=mainModel::conectar()->prepare("SELECT * FROM patients WHERE paDNI=:DNI");
        $query->bindParam(":DNI", $dni);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
     }
     public function listar_paciente_modelo(){
        $query=mainModel::conectar()->prepare("SELECT * FROM patients");
        $query->execute();
        return $query->fetchAll();
     }

 }
 