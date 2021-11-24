<?php
$id=base64_decode($_POST['id']);
$connect=mysqli_connect("localhost", "root", "", "mydblaminas");
$query= "SELECT * FROM ceescamosa WHERE idCelulasEpiteliales='$id'";
$result= mysqli_query($connect, $query);
$html="";
foreach($result as $row):?>
  <?php $html.="<option id='".$row['idCeEscamosa']."esc' value='".$row['idCeEscamosa']."'>".$row['cesNombre']."</option>";?>

<?php endforeach;
echo $html;?>

