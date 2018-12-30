<?php


include("bd_conection.php");
$result=mysqli_query($con,"SELECT * FROM medicamentos_tipo");
//Manda medidas del medicamento
  $medidas_medicamento = array( 'miligramos' => 'Miligramos', 'mililitros' => 'Mililitros', 'microgramos' => 'Microgramos');

    echo'<div class="row col"><div class="col-sm-7">
          <select class="form-control" id="medicamentosSelect" name="medicamentosSelect[]">' . "\n";
          while ($fila = @mysqli_fetch_assoc($result)) {
          $id = $fila["idmedicamentos_tipo"];
          $name = utf8_encode($fila["tipo_medicamento"]);
          echo '<option value="'.$name.'" id="'.$id.'">'.$name.'</option>'."\n";
          }
        echo'</select></div>
        <div class="col-sm-2">
          <input id="cantidadMedicamento" name="cantidadMedicamento[]" class="form-control"  type="number" min="0" placeholder="Cantidad">
          <span id="canti_medic_vacio" style="color: red;" hidden>No ingresaste cantidad de medicamento</span>
        </div>';
        echo '<div class="col-sm-3">
          <select class="form-control" id="medidasMedicamento" name="medidasMedicamento[]">';
       foreach( $medidas_medicamento as $medida => $medida_medicamento): 
          echo '<option value="'.$medida.'">'. $medida_medicamento.'</option>';
        endforeach;
        echo '</select></div></div>';



?>