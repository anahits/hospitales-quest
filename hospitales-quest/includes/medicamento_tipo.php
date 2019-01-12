<?php
include("bd_conection.php");
$medic_selected=$_POST['medic_selected'];
$result=mysqli_query($con, "SELECT tipo_medicamento FROM medicamentos_tipo WHERE idmedicamentos_tipo='$medic_selected'");

  while ($fila = @mysqli_fetch_assoc($result)) {
    $tipo_medica = utf8_encode($fila["tipo_medicamento"]);
    echo  $tipo_medica ;
  }
?>