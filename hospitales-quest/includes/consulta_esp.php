<?php
include("bd_conection.php");

$consult_selected=$_POST['consult_selected'];
echo $consult_selected;
$result=mysqli_query($con,"SELECT * FROM especialidad_tipo WHERE tipo_consulta=N'$consult_selected' ORDER BY tipo_especialidad ASC");

while($esp = @mysqli_fetch_assoc($result))
{   
    echo '<option value="'.utf8_encode($esp['tipo_especialidad']).'" id="'.utf8_encode($esp['idespecialidad_tipo']).'">'.utf8_encode($esp['tipo_especialidad']).'</option>';
}
	
?>

