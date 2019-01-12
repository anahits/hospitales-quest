<?php


include("bd_conection.php");
$result=mysqli_query($con,"SELECT * FROM medicamentos_tipo ORDER BY medicamento ASC");
//Manda medidas del medicamento
  $medidas_medicamento = array( 'miligramos' => 'Miligramos', 'mililitros' => 'Mililitros', 'microgramos' => 'Microgramos');

  echo'<div class="row" style="height: 40px;">
        <div class="row col">
          <label class="col-sm-2 col-form-label" for="medicamento">Medicamento</label>                    
          <select class="form-control col-sm-4 medicamentosSelect" name="medicamentosSelect[]">' . "\n";
            while ($fila = @mysqli_fetch_assoc($result)) {
              $id = $fila["idmedicamentos_tipo"];
              $medicamento = utf8_encode($fila["medicamento"]);
              $tipo_medica = utf8_encode($fila["tipo_medicamento"]);
              echo '<option value="'.$medicamento.'" id="'.$id.'">'.$medicamento.'</option>';
            }
            echo '<option value="0">Otro ¿Cuál?</option>
          </select>           
          <label class="col-sm-2 col-form-label" for="tipo_medicamento">Tipo Medicamento</label>                    
          <p class="medicaTipoContainer form-control col-sm-4">'.$tipo_medica .'</p>          
        </div>
      </div>
      <div class="otro_medicamNtipo row" style="display:none;">                      
        <div class="row mt-1 col-sm-6" style="height: 40px;">
          <label id="otro_medicamentoLabel" class="col-sm-4 col-form-label" for="medicamento">Medicamento</label>      
          <input type="text" class="form-control col-sm-8 otro_medicamento" name="otro_medicamento[]" placeholder="Especifique">
        </div>                       
        <div class="row mt-1 col-sm-6" style="height: 40px;">
          <label id="otro_tipo_medicaLabel" class="col-sm-4 col-form-label" for="tipo_medica">Tipo Medicamento</label>      
          <input type="text" class="form-control col-sm-8 otro_tipo_medica" name="otro_tipo_medica" placeholder="Especifique">
        </div>            
      </div>
      <div class="row mt-2" style="justify-content: space-around;">
        <div class="col-sm-2">
          <input name="cantidadMedicamento[]" class="cantidadMedicamento form-control"  type="number" min="1" placeholder="Cantidad">
        </div>
        <div class="col-sm-2">
          <select class="form-control medidasMedicamento" id="medidasMedicamento" name="medidasMedicamento[]">';
       foreach( $medidas_medicamento as $medida => $medida_medicamento): 
          echo '<option value="'.$medida.'">'. $medida_medicamento.'</option>';
        endforeach;
        echo '</select>
        </div>
          <div class="col-sm-4 row" style="justify-content: space-between;">
            <label class="col-sm-2 col-form-label" for="cada">Cada</label>                    
            <div class="col-sm-4">
              <input name="porHoras[]" class="cantidadHoras form-control"  type="number" min="1" placeholder="#">
            </div>
            <div class="col-sm-5">
              <p class="horas form-control">horas</p>
            </div> 
          </div> 
          <div class="col-sm-4 row" style="justify-content: space-between;">
            <label class="col-sm-2 col-form-label" for="durante">Durante</label>
            <div class="col-sm-4">
              <input name="duranteDias[]" class="cantidadDias form-control"  type="number" min="1" placeholder="#">
            </div>
            <div class="col-sm-5">
              <p class="dias form-control">días</p>
            </div>
          </div></div>';



?>