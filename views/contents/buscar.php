<?php
require_once "../../core/configGeneral.php";
require_once "../../core/configApp.php";
$enlace= new PDO(SGDB, USER, PASS);
$connect=mysqli_connect("localhost", "root", "", "mydblaminas");
$query= "SELECT paDNI FROM paciente WHERE paDNI='23266792'";
$result= mysqli_query($connect, $query);
while($row=mysqli_fetch_array($result))
{
   $data["DNI"]=$row["paDNI"];
}
//echo $data['DNI'];
echo json_encode($data);
