<?php
include("bd_conection.php");

$consult_selected=$_POST['consult_selected'];
$result=mysqli_query($con,"SELECT * FROM especialidad_tipo WHERE tipo_consulta='$consult_selected'");

while($est = @mysqli_fetch_assoc($result))
{   
    echo '<option value="'.utf8_encode($est['tipo_especialidad']).'" id="'.utf8_encode($est['idespecialidad_tipo']).'">'.utf8_encode($est['tipo_especialidad']).'</option>';
}
	
?>

