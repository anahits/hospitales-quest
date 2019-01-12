<?php
// Create connection


	function conectarBase ($bd_host, $bd_user, $bd_pass, $bd_name) {
		if (!$enlace = @mysqli_connect($bd_host, $bd_user, $bd_pass, $bd_name)){
			return false;
		}else{
			return $enlace;
		}
	}
	function consultar($conexion, $consulta){
		if (!$datos = mysqli_query($conexion, $consulta) or mysqli_num_rows($datos)<1){
			return false;
		}else{
			return $datos;
		}
	}
	function generarHospitales($datos) {
		$template = '<label for="hospitales"><strong>1. </strong>HOSPITALES</label>'. "\n";
		$template = $template. '<div class="form-group">
									<div class="col-sm-7">
										<select class="form-control" id="hospitales" name="hospitales">' . "\n";
										while ($fila = @mysqli_fetch_array($datos)) {
											$id = $fila["idhospitales"];
											$name = utf8_encode($fila["hospital_nombre"]);
											$template = $template.'<option value="'.$name.'">'.$name.'</option>'."\n";
										}
										$template = $template."</select>\n";
					return $template;
	}
	if ($con = conectarBase($bd_host, $bd_user, $bd_pass, $bd_name)) {
		$hospitales = "SELECT * FROM hospitales";
		if($consulHosp = consultar($con, $hospitales)) {
		}else{
		echo "<p>No se encontraron datos</p>";
		}
	}else{
		echo "<p>Servicio interrumpido</p>";
	}
	// Manda select de genero
	$generos = array('0' => '-Selecciona un genero-', '1' => 'Mujer', '2' => 'Hombre');


	function generarOcupaciones($datos) {

		$template = '<label class="col-sm-3 col-form-label" for="ocupacion"><strong>2.5. </strong>Ocupación</label>'. "\n";
		$template = $template. '
			<div class="col-sm-3">
				<select class="form-control ocupacion" id="ocupaciones" name="ocupaciones">' . "\n";
				while ($fila = @mysqli_fetch_array($datos)) {
					$id = $fila["idocupaciones"];
					$name = utf8_encode($fila["ocupacion_tipo"]);
					$template = $template.'<option value="'.$name.'">'.$name.'</option>';
				}
				$template = $template.'<option value="0">Otra</option></select>
                            </div><div class="col-sm-5">
                                <input type="text" class="form-control" id="otra_ocupacion" name="otra_ocupacion" placeholder="Especifique" hidden="true">
                            </div>';
		return $template;
	}
	if ($con = conectarBase($bd_host, $bd_user, $bd_pass, $bd_name)) {
		$ocupaciones = "SELECT * FROM ocupaciones";
		if($consulOcup = consultar($con, $ocupaciones)) {
		}else{
		echo "<p>No se encontraron datos</p>";
		}
	}else{
		echo "<p>Servicio interrumpido</p>";
	}

		// Manda select de ocupacion
	function generarEscolaridades($datos) {
		$template = '<label class="col-sm-3 col-form-label" for="escolaridad"><strong>2.6. </strong>Escolaridad</label>'. "\n";
		$template = $template. '
			<div class="col-sm-4">
				<select class="form-control escolaridad" id="Escolaridad" name="escolaridad">' . "\n";
					while ($fila = @mysqli_fetch_array($datos)) {
					$id = $fila["idescolaridad"];
					$name = utf8_encode($fila["escolaridad_nivel"]);
					$template = $template.'<option value="'.$name.'">'.$name.'</option>';
					}
					$template = $template.'<option value="0">Otra ¿Cuál?</option></select></div>';
		return $template;
	}
	if ($con = conectarBase($bd_host, $bd_user, $bd_pass, $bd_name)) {
		$escolaridad = "SELECT * FROM escolaridad";
		if($consulEscol = consultar($con, $escolaridad)) {
		}else{
		echo "<p>No se encontraron datos</p>";
		}
	}else{
		echo "<p>Servicio interrumpido</p>";
	}
	// Manda select de residencias
	$residencias = array( 'local' => 'Local', 'foraneo' => 'Foraneo');

	// Manda select de genero
	$grados_da = array('0' => 'Moderada', '1' => 'Grave', '2' => 'Sin información');

	// name de las herramientas
	$herramientas = array('3.3.1. SCORAD' => 'scorad_calculo', '3.3.2 Solo porcentaje de superficie corporal afectada (BSA)' =>'bsa_calculo', '3.3.3. EASI' => 'easi_calculo', '3.3.4. IGA' => 'iga_calculo','3.3.5. No utiliza 3.3.5.1. Calculo de IGA modificado' => 'iga_modificado_calculo');


	////////
	function generarEstuLab($datos) {
		$template = '<label for="estudios_laboratorio" class="col-sm-3"><strong>4.1. </strong>ESTUDIOS DE LABORATORIO</label>'. "\n";
		$template = $template. '<div class="col-sm-6">
					<select class="form-control" id="estudiosLabSelect" name="estudiosLabSelect">' . "\n";
					while ($fila = @mysqli_fetch_array($datos)) {
					$id = $fila["idestudios_laboratorio_tipos"];
					$name = utf8_encode($fila["tipo_estudio_laboratorio"]);
					$template = $template.'<option value="'.$name.'">'.$name.'</option>';
					}
				$template = $template.'<option value="0">Otros ¿Cuáles?</option></select>
					<div class="mt-2">
						<input type="text" class="form-control" id="otro_estudio_lab" name="otro_estudio_lab" placeholder="Especifique" hidden="true">
					</div></div>';
		return $template;
	}
	if ($con = conectarBase($bd_host, $bd_user, $bd_pass, $bd_name)) {
		$estudios_laboratorio_tipos = "SELECT * FROM estudios_laboratorio_tipos";
		if($consulEstuLab = consultar($con, $estudios_laboratorio_tipos)) {
		}else{
		echo "<p>No se encontraron datos</p>";
		}
	}else{
		echo "<p>Servicio interrumpido</p>";
	}

	//////
	function generarPruebAlerg($datos) {
		$template = '<label for="pruebas_alergia" class="col-sm-3"><strong>4.2. </strong>PRUEBAS DE ALERGIA</label>'. "\n";
		$template = $template. '<div class="col-sm-6">
					<select class="form-control" id="pruebAlergSelect" name="pruebAlergSelect">' . "\n";
					while ($fila = @mysqli_fetch_array($datos)) {
					$id = $fila["idpruebas_alergia_tipos"];
					$name = utf8_encode($fila["tipo_prueba_alergia"]);
					$template = $template.'<option value="'.$name.'">'.$name.'</option>';
					}
				$template = $template.'<option value="0">Otras ¿Cuáles?</option></select>
					<div class="mt-2">
						<input type="text" class="form-control" id="otra_prueb_alerg" name="otra_prueb_alerg" placeholder="Especifique" hidden="true">
					</div></div>';
		return $template;
	}
	if ($con = conectarBase($bd_host, $bd_user, $bd_pass, $bd_name)) {
		$pruebas_alergia = "SELECT * FROM pruebas_alergia_tipos";
		if($consulPruebAlerg = consultar($con, $pruebas_alergia)) {
		}else{
		echo "<p>No se encontraron datos</p>";
		}
	}else{
		echo "<p>Servicio interrumpido</p>";
	}

	////	
	function generarEstuGab($datos) {
		$template = '<label for="estudios_gabinete" class="col-sm-3"><strong>4.3. </strong>ESTUDIOS DE GABINETE</label>'. "\n";
		$template = $template. '<div class="col-sm-6">
					<select class="form-control" id="estudiosGabSelect" name="estudiosGabSelect">' . "\n";
					while ($fila = @mysqli_fetch_array($datos)) {
					$id = $fila["idtipo_estudio_gabinete"];
					$name = utf8_encode($fila["tipo_estudio_gabinete"]);
					$template = $template.'<option value="'.$name.'">'.$name.'</option>'."\n";
					}
				$template = $template.'<option value="0">Otros ¿Cuáles?</option></select>
					<div class="mt-2">
						<input type="text" class="form-control" id="otro_estudio_gab" name="otro_estudio_gab" placeholder="Especifique" hidden="true">
					</div></div>';
		return $template;
	}
	if ($con = conectarBase($bd_host, $bd_user, $bd_pass, $bd_name)) {
		$estudios_gabinete_tipos = "SELECT * FROM estudios_gabinete_tipos";
		if($consulEstuGab = consultar($con, $estudios_gabinete_tipos)) {
		}else{
		echo "<p>No se encontraron datos</p>";
		}
	}else{
		echo "<p>Servicio interrumpido</p>";
	}

//////
	function generarProced($datos) {
		$template = '<label for="procedimientos" class="col-sm-3"><strong>4.4. </strong>PROCEDIMIENTOS</label>'. "\n";
		$template = $template. '<div class="col-sm-6">
					<select class="form-control" id="procedSelect" name="procedSelect">' . "\n";
					while ($fila = @mysqli_fetch_array($datos)) {
					$id = $fila["idprocedimientos_tipos"];
					$name = utf8_encode($fila["tipo_procedimiento"]);
					$template = $template.'<option value="'.$name.'">'.$name.'</option>'."\n";
					}
				$template = $template.'<option value="0">Otros ¿Cuáles?</option></select>
					<div class="mt-2">
						<input type="text" class="form-control" id="otro_proced" name="otro_proced" placeholder="Especifique" hidden="true">
					</div></div>';
		return $template;
	}
	if ($con = conectarBase($bd_host, $bd_user, $bd_pass, $bd_name)) {
		$procedimientos = "SELECT * FROM procedimientos_tipos";
		if($consulProced = consultar($con, $procedimientos)) {
		}else{
		echo "<p>No se encontraron datos</p>";
		}
	}else{
		echo "<p>Servicio interrumpido</p>";
	}
	/////CONSULTAS
	// Manda select de tipo de consultas
	$tipo_consultas = array( 'noSelection'=>'-Selecciona un tipo de consulta-','Consulta General' => 'Consulta General', 'Interconsulta' => 'Interconsulta','Urgencias' => 'Urgencias');

	////////	
	
		function generarEspecialidad($datos) {
		$template = '<label for="especialidad" class="col-sm-2 col-form-label"><strong>5.2. </strong>Especialidad</label><div class="row col">'. "\n";
		$template = $template. '<div class="col-sm-6">
					<select class="form-control" id="especialidadSelect" name="especialidadSelect">' . "\n";
					while ($fila = @mysqli_fetch_array($datos)) {
					$id = $fila["idespecialidad_tipo"];
					$name = utf8_encode($fila["tipo_especialidad"]);
					$tipo = utf8_encode($fila["tipo_consulta"]);
					$template = $template.'<option value="'.$name.'">'.$name.'</option>'."\n";
					}
				$template = $template.'</select></div><div class="col-sm-3">
										<input id="tipo_consulta_especialidad" value="'.$tipo.'"  type="text" class="form-control" hidden>
                                        <input id="numConsult" type="number" min="0" class="form-control" placeholder="Número de consultas" ><div id="num_consulta_vacio" style="color: red;" >
	  <p>No ingresaste número de consultas</p>
	</div>
                                    </div>
                                </div>';
		return $template;
	}
	if ($con = conectarBase($bd_host, $bd_user, $bd_pass, $bd_name)) {
		$especialidad_tipo = "SELECT * FROM especialidad_tipo";
		if($consultEspecialidad = consultar($con, $especialidad_tipo)) {
		}else{
		echo "<p>No se encontraron datos</p>";
		}
	}else{
		echo "<p>Servicio interrumpido</p>";
	}


	// name de las herramientas
	$dias_perdidos = array('9.1. Días escolares' =>'dias_escol', '9.2. Días del acompañante' => 'dias_acomp', '9.3. Días de incapacidad' => 'dias_incap');


?>

