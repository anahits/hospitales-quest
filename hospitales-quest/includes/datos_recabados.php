<!DOCTYPE html>
<html lang="es">
	<head>
		<?php
		include("head-contents.php");
		include("scripts.php");
		require_once ('bd_conection.php');
		include("funciones.php");
		include("config.php");
		include("querys.php");?>
		<?php if(isset($_POST["submitTodo"])): ?>
		<meta charset="UTF-8"/>
		<title>Datos recabados</title>
	</head>
	<body>
		<header id="header" class="jumbotron">
			<h2 class="ml-3">DATOS RECABADOS</h2>
		</header><!-- /header -->
		<main class="container ml-2" id="main-content">			
			<h4 class="ml-3">DATOS PACIENTES</h4>
			<div class="mb-3 mt-3 ml-4">
				<div class="row ml-0">Hospital:<strong class="mr-2 ml-3"><?php isset($hospital) ? print $hospital : ""; ?></strong></div>
				<div class="row ml-0">RFC:<strong class="mr-2 ml-3"><?php  !empty($_POST["rfc_paciente"]) ? print $rfc : print ""; ?></strong></div>
				<div class="row ml-0">Iniciales:<strong class="mr-2 ml-3"><?php isset($iniciales) ? print $iniciales : print ""; ?></strong></div>
				<div class="row ml-0">Genero:<strong class="mr-2 ml-3"><?php ($id_genero == '0' ) ? print "" : print $genero; ?></strong></div>
				<div class="row ml-0">Edad:<strong class="mr-2 ml-3"><?php isset($edad) ? print $edad : ""; ?></strong></div>
				<div class="row ml-0">Ocupación:<strong class="mr-2 ml-3"><?php isset($ocupacion) ? print $ocupacion : "";  ?></strong></div>
				<div class="row ml-0">Escolaridad:<strong class="mr-2 ml-3"><?php isset($escolaridad) ? print $escolaridad : ""; ?></strong></div>
				<div class="row ml-0">Lugar de residencia<strong class="mr-2 ml-3"><?php isset($lugar_residencia) ? print $lugar_residencia: print "" ; ?></strong></div>
			</div>
			<hr>
			<div class="mb-3 mt-3 ml-4">
				<h5 class="mt-2">Periodo</h5>
				<div class="row mb-3 mt-3 ml-4">
					<p class="col-sm-2">Desde <?php echo $inicio_consultas;?></p>
					<p class="col-sm-2">hasta <?php echo $fin_consultas;?></p>		 
				</div>
			</div>
			<div class="mb-3 mt-3 ml-4">
				<h5 class="mt-2">Días perdidos</h5>
				<div class="mb-3 mt-3 ml-3">
					<div class="row ml-0">Días de consulta:<strong class="mr-2 ml-3"><?php isset($numMismaConsulta[$interconsulta]) || isset($numMismaConsulta[$consulta_general]) ? print $diasConsulta :  print ""; ?></strong></div>
					<div class="row ml-0">Días escolares:<strong class="mr-2 ml-3"><?php !empty($_POST["dias_escol"])  ? print $dias_escol : print "";  ?></strong></div>
					<div class="row ml-0">Días del acompañante:<strong class="mr-2 ml-3"><?php !empty($_POST["dias_acomp"])  ? print $dias_acomp : print "";  ?></strong></div>
					<div class="row ml-0">Días asistencia urgencias:<strong class="mr-2 ml-3"><?php  isset($numMismaConsulta[$urgencias]) ? print $diasUrgencias : print "";  ?></strong></div>
					<div class="row ml-0">Días de incapacidad:<strong class="mr-2 ml-3"><?php !empty($_POST["dias_incap"]) ? print $dias_incap : print "";  ?></strong></div>
				</div>
			</div>
			<hr>
			<h4 class="ml-3">CLASIFICACIÓN DE LA ENFERMEDAD</h4>
			<div class="mb-3 mt-3 ml-4">
				<div class="row ml-0">Años de evolución:<strong class="mr-2 ml-3"><?php isset($anio_evol) ? print $anio_evol : ""; ?></strong></div>
				<div class="row ml-0">Inicialmente fue considerado una DA:<strong class="mr-2 ml-3"><?php isset($grado_da)? print $grado_da :""; ?></strong></div>
				<h5 class="mt-2">Herramientas utilizadas para su clasificación</h5>
				<div class="mb-3 mt-3 ml-3">
					<div class="row ml-0">SCORAD:<strong class="mr-2 ml-3"><?php !empty($_POST["scorad_calculo"]) ? print $scorad_calculo :  print ""; ?></strong></div>
					<div class="row ml-0">Solo porcentaje de superficie corporal afectada (BSA):<strong class="mr-2 ml-3"><?php !empty($_POST["bsa_calculo"]) ? print $bsa_calculo : print ""; ?></strong></div>
					<div class="row ml-0">EASI:<strong class="mr-2 ml-3"><?php !empty($_POST["easi_calculo"]) ? print $easi_calculo : print "";  ?></strong></div>
					<div class="row ml-0">IGA:<strong class="mr-2 ml-3"><?php !empty($_POST["iga_calculo"]) ? print $iga_calculo : print "";  ?></strong></div>
					<div class="row ml-0">No utiliza, calculo de IGA modificado:<strong class="mr-2 ml-3"><?php !empty($_POST["iga_modificado_calculo"]) ? print $iga_modificado_calculo : print "";  ?></strong></div>
				</div>
			</div>
			<hr>
			<h4 class="ml-3">ESTUDIOS</h4>
			<div class="mb-3 mt-3 ml-4">
				Estudios de laboratorio:
				<div class="row ml-0">
					<?php if($estudiosLab !== null){ ?>
					<table class="table estudios mt-2 mb-2">
						<tr>
							<th class="col-sm-9">Nombre Estudio</th>
							<th class="col-sm-1">Núm de estudios</th>
						</tr>
						<tbody>
							<?php
								foreach( $estudiosLab as $index => $estudioLab ) {
									print '<tr><td>'.$estudioLab.'</td><td>'.$cantidadEstLab[$index] . '</td></tr>';
								}	
							?>
						</tbody>
					</table><?php } else{ echo '<strong class="mr-2 ml-3">Ninguno</strong>';}?>
				</div>
				Procedimientos:
				<div class="row ml-0">
					<?php if($procedimientos !== null){ ?>
					<table class="table estudios mt-2 mb-2">
						<tr>
							<th class="col-sm-9">Nombre Porcedimiento</th>
							<th class="col-sm-1">Núm de Porcedimiento</th>
							
						</tr>
						<tbody><?php
								foreach( $procedimientos as $key => $procedimiento ) {
									print '<tr><td>'.$procedimiento.'</td><td>'.$cantidadProced[$key] . '</td></tr>';
							}?>
						</tbody>
					</table><?php } else{ echo '<strong class="mr-2 ml-3">Ninguno</strong>';}?>
				</div>
				Estudios de Gabinete:
				<div class="row ml-0">
					<?php if($estudiosGab !== null){ ?>
					<table class="table estudios mt-2 mb-2">
						<tr>
							<th class="col-sm-9">Nombre Estudio</th>
							<th class="col-sm-1">Núm de Estudios</th>
						</tr>
						<tbody><?php
								foreach( $estudiosGab as $indice => $estudioGab ) {
									print '<tr><td>'.$estudioGab.'</td><td>'.$cantidadEstGab[$indice] . '</td></tr>';
							}?>
						</tbody>
					</table><?php } else{ echo '<strong class="mr-2 ml-3">Ninguna</strong>';}?>
				</div>
			</div>
			<hr>
			<h4 class="ml-3">CONSULTAS</h4>
			<div class="mb-3 mt-3">
				<div class="mb-3 mt-3">
					<?php if($especialidadesSet !== ""){ ?>
					<table class="table consultas">
						<thead>
							<tr>
								<th class="col-sm-1">Núm de consulta</th>
								<th class="col-sm-2">Tipo de consulta</th>
								<th class="col-sm-2">Especialidad</th>
								<th class="col-sm-1">Fecha</th>
								<th class="col-sm-2">Causa o diagnostico de la Urgencia</th>
								<th class="col-sm-1">Número de horas</th>
								<th class="col-sm-1">¿Requirio de hospitalización?</th>
								<th class="col-sm-1">Días en hospitalizacion</th>
								<th class="col-sm-6">Medicamentos</th>
								<th class="col-sm-1">Cantidad</th>
								<th class="col-sm-2">Medida</th>
								<th class="col-sm-2">Cada Horas</th>
								<th class="col-sm-2">Durante Días</th>

							</tr>
						</thead>
						<tbody><?php
							$i = 1;
								foreach( $especialidadesSet as $each => $especialidadSet ) {
									print '<tr>
											<td>'. $numConsultasSet[$each]  .'</td>
											<td>'. $tipo_consultaSet[$each] . '</td>
											<td>'. $especialidadSet .'</td>
											<td>'. $fechaConsultaSet[$each]  .'</td>
											<td>'. $causaConsulta[$each] .'</td>
											<td>'. $horasUrg[$each] .'</td>
											<td>'. $hospitalizacion[$each] .'</td>
											<td>'. $dias_enHospital[$each] .'</td>';
											print '<td>';
												if (!empty($medicamentos[$each]) ){
													foreach ($medicamentos[$each] as $medicamentoIdx => $medicamentoVal) {
														print '<p>'. $medicamentoVal.'</p>';
																}
												print '</td>';
												print '<td>';
													foreach ($medicamentos[$each] as $medicamentoIdx => $medicamentoVal) {
														print '<p>'. $cantidadMedicamentos[$each][$medicamentoIdx].'</p>';
																						}
												print '</td>';
												print '<td>';
													foreach ($medicamentos[$each] as $medicamentoIdx => $medicamentoVal) {
														print '<p>'. $medidasMedicamentos[$each][$medicamentoIdx].'</p>';
													}
												print '</td>';
												print '<td>';
													foreach ($medicamentos[$each] as $medicamentoIdx => $medicamentoVal) {
														print '<p>'. $porHorasUrgen[$each][$medicamentoIdx].'</p>';
																}
												print '</td>';
												print '<td>';
													foreach ($medicamentos[$each] as $medicamentoIdx => $medicamentoVal) {
														print '<p>'. $duranteDiasUrgen[$each][$medicamentoIdx].'</p>';
													}
												print '</td>';
											}
									print '</tr>';
							}?>
						</tbody>
					</table><?php } else{ echo 'Ninguna';}?>
				</div>		
			</div>
			<div class="row ml-0">Cantidad de exacerbaciones o brotes que tuvo en el ultimo año:<strong class="mr-2 ml-3"><?php !empty($_POST["exacerbaciones"]) ? print $cantExacerbaciones : print ""; ?></strong></div>
			<div class="row ml-0">¿El paciente presenta prurito que afecte el sueño y/o calidad de vida?:<strong class="mr-2 ml-3"><?php isset($prurito) ? print $prurito: ""; ?></strong></div>
			<div class="row ml-0">¿Su paciente presenta depresion?:<strong class="mr-2 ml-3"><?php isset($depresion) ? print $depresion: ""; ?></strong></div>
			<?php //var_dump($_POST);?>
			<?php endif; ?>
			<ul>
				<?php if(isset($errores)){
				foreach ($errores as $error){
				echo "<li> $error </li>";
				}
				}
				?>
			</ul>
		</main>
	</body>