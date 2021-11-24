<?php
$id=base64_decode($_POST['id']);
$connect=mysqli_connect("localhost", "root", "", "mydblaminas");
$query= "SELECT * FROM celulasglandulares WHERE idMCelulasGlandulares='$id'";
$result= mysqli_query($connect, $query);
$html="";
foreach($result as $row):?>
  <?php $html.="<option id='".$row['idCelulasGlandulares']."gla' value='".$row['idCelulasGlandulares']."'>".$row['cgNombre']."</option>";?>

<?php endforeach;
echo $html;?>