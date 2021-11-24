<?php
if ($peticionAjax){
    require_once "../core/mainModel.php";
} else{
    require_once "./core/mainModel.php";
}
class employeeModel extends mainModel
{
    protected function agregar_empleado_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO employees (emName, emLastName, emDNI, emObservation, 
        emProfession, emOffice, iduser)
        VALUES(:Nombre, :Apellido, :DNI, :Observacion, :Profesion, :Oficina, :Cuenta)");
        $sql->bindParam("Nombre", $datos['Nombre']);
        $sql->bindParam("Apellido", $datos['Apellido']);
        $sql->bindParam("DNI", $datos['DNI']);
        $sql->bindParam("Observacion", $datos['Observacion']);
        $sql->bindParam("Profesion", $datos['Profesion']);
        $sql->bindParam("Oficina", $datos['Oficina']);
        $sql->bindParam("Cuenta", $datos['Cuenta']);  
        $sql->execute();
        return $sql;
    }
    protected function eliminar_empleado_modelo($cuenta){
        //*no eliminar empleado
        $query=mainModel::conectar()->prepare("DELETE FROM employees WHERE usCode=:Cuenta");
        $query->bindParam(":Cuenta", $cuenta);
        $query->execute();
        return $query;

    }

    protected function datos_empleado_modelo($tipo, $codigo){
        if($tipo=="Unico"){
            $query=mainModel::conectar()->prepare("SELECT * FROM employees WHERE usCode=:Codigo");
            $query->bindParam(":Codigo",$codigo);
        }elseif($tipo=="Conteo")
        {
            $query=mainModel::conectar()->prepare("SELECT idEmployee FROM employees WHERE idEmployee!='1'");
         }
        $query->execute();
        return $query;
    }

}