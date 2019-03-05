<?php
include("bd_conection.php");

$result=mysqli_query($con,"SELECT * FROM especialidad_tipo ORDER BY tipo_especialidad ASC");

while($esp = @mysqli_fetch_assoc($result))
{   
    echo '<option value="'.utf8_encode($esp['tipo_especialidad']).'" id="'.utf8_encode($esp['idespecialidad_tipo']).'">'.utf8_encode($esp['tipo_especialidad']).'</option>';
}
	
?>
