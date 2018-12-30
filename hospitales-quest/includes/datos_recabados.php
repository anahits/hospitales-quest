<?php 

include("head-contents.php");
include("scripts.php");
require_once ('bd_conection.php');
include("funciones.php");
include("config.php");
include("querys.php");
	
if(isset($_POST["submitTodo"])): ?>
<main class="ml-2">
	<h2 class="ml-3">DATOS PACIENTES</h2>
	<div class="mb-3 mt-3 ml-4">
		<div class="row ml-0">Hospital:<strong class="mr-2 ml-3"><?php isset($hospital) ? print $hospital : ""; ?></strong></div>
			<div class="row ml-0">RFC:<strong class="mr-2 ml-3"><?php  !empty($rfc_paciente) ? print $rfc : "";
 ;?></strong></div>	
		<div class="row ml-0">Iniciales:<strong class="mr-2 ml-3"><?php (empty($_POST["iniciales_paciente"]) || strlen($_POST["iniciales_paciente"]) < 2) ? print $tamañoIniciales = '<p class="warning mb-0">Las iniciales deben tener más de 2 letras</p>' : print $iniciales; ?></strong></div>	
		<div class="row ml-0">Genero:<strong class="mr-2 ml-3"><?php ($id_genero == '0' ) ? print $campoVacio : print $genero; ?></strong></div>
		<div class="row ml-0">Edad:<strong class="mr-2 ml-3"><?php isset($edad) ? print $edad : ""; ?></strong></div>
		<div class="row ml-0">Ocupación:<strong class="mr-2 ml-3"><?php ($ocupacion !== '0' )  ?  print $ocupacion: print $otra_ocupacion; ?></strong></div>
		<div class="row ml-0">Escolaridad:<strong class="mr-2 ml-3"><?php ($escolaridad !== '0' ) ? print $escolaridad: print $otra_escolaridad; ?></strong></div>
		<div class="row ml-0">Lugar de residencia<strong class="mr-2 ml-3"><?php isset($lugar_residencia) ? print $lugar_residencia: print $campoVacio ; ?></strong></div>
	</div>
	<h4 class="ml-3">CLASIFICACIÓN DE LA ENFERMEDAD</h4>	
	<div class="mb-3 mt-3 ml-4">
		<div class="row ml-0">Años de evolución:<strong class="mr-2 ml-3"><?php isset($anio_evol) ? print $anio_evol : ""; ?></strong></div>
		<div class="row ml-0">Inicialmente fue considerado una DA:<strong class="mr-2 ml-3"><?php isset($grado_da)? print $grado_da :""; ?></strong></div>
		<h5 class="mt-2">Herramientas utilizadas para su clasificación</h5>
		<div class="mb-3 mt-3 ml-3">
			<div class="row ml-0">SCORAD:<strong class="mr-2 ml-3"><?php !empty($_POST["scorad_calculo"]) ? print $scorad_calculo : ""?></strong></div>
			<div class="row ml-0">Solo porcentaje de superficie corporal afectada (BSA):<strong class="mr-2 ml-3"><?php !empty($_POST["bsa_calculo"]) ? print $bsa_calculo :""; ?></strong></div>
			<div class="row ml-0">EASI:<strong class="mr-2 ml-3"><?php !empty($_POST["easi_calculo"]) ? print $easi_calculo :""; ?></strong></div>
			<div class="row ml-0">IGA:<strong class="mr-2 ml-3"><?php !empty($_POST["iga_calculo"]) ? print $iga_calculo :""; ?></strong></div>
			<div class="row ml-0">No utiliza, calculo de IGA modificado:<strong class="mr-2 ml-3"><?php !empty($_POST["iga_modificado_calculo"]) ? print $iga_modificado_calculo :""; ?></strong></div>
		</div>
	</div>
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
					}	?> 
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
	<h4 class="ml-3">CONSULTAS</h4>	
	<div class=" mb-3 mt-3 ml-4">
		<div class="mb-3 mt-3">
			<?php if($especialidadesSet !== null){ ?>
				<table class="table consultas">
					<tr>
		    			<th class="col-sm-1">Tipo de consulta</th>
						<th class="col-sm-4">Especialidad</th>
						<th class="col-sm-1">Núm de consulta</th>
						<th class="col-sm-1">Fecha</th>
						<th class="col-sm-6">Medicamentos</th>		
						<th class="col-sm-1">Cantidad</th>
						<th class="col-sm-2">Medida</th>
		  			</tr>
		  			<tbody><?php
						foreach( $especialidadesSet as $each => $especialidadSet ) {
		  					print '<tr>
		  					<td>'. $tipo_consultaSet[$each] . '</td>
		  					<td>'. $especialidadSet .'</td>
		  					<td>'. $numConsultasSet[$each]  .'</td>
		  					<td>'. $fechaConsultaSet[$each]  .'</td>';
		  					print '<td>'; 
		  					foreach ($medicamentos as $key => $medicamento) {
		print '<p>dos'. $medicamento.'</p>'; } 			
		  					print '</td></tr>';
		  					var_dump($_POST);
						}?> 	
					</tbody>
				</table><?php } else{ echo 'Ninguna';}?>
		</div>
		<div class="row ml-0">Cantidad de exacerbaciones o brotes que tuvo en el ultimo año:<strong class="mr-2 ml-3"><?php isset($cantExacerbaciones) ? print $cantExacerbaciones : ""; ?></strong></div>
		<div class="row ml-0">¿El paciente presenta prurito que afecte el sueño y/o calidad de vida?:<strong class="mr-2 ml-3"><?php isset($prurito) ? print $prurito: print $campoVacio = '<p class="warning mb-0">Sin información</p>' ; ?></strong></div>
		<div class="row ml-0">¿Su paciente presenta depresion?:<strong class="mr-2 ml-3"><?php isset($depresion) ? print $depresion: print $campoVacio = '<p class="warning mb-0">Sin información</p>';?></strong></div>
		<h5 class="mt-2">Días perdidos</h5>
			<div class="mb-3 mt-3 ml-3">
				<div class="row ml-0">Días de consulta:<strong class="mr-2 ml-3"><?php !empty($_POST["dias_consul"]) ? print $dias_consul : ""?></strong></div>
				<div class="row ml-0">Días escolares:<strong class="mr-2 ml-3"><?php !empty($_POST["dias_escol"]) ? print $dias_escol :""; ?></strong></div>
				<div class="row ml-0">Días del acompañante:<strong class="mr-2 ml-3"><?php !empty($_POST["dias_acomp"]) ? print $dias_acomp :""; ?></strong></div>
				<div class="row ml-0">Días asistencia urgencias:<strong class="mr-2 ml-3"><?php !empty($_POST["dias_urgen"]) ? print $dias_urgen :""; ?></strong></div>
				<div class="row ml-0">Días de incapacidad:<strong class="mr-2 ml-3"><?php !empty($_POST["dias_incap"]) ? print $dias_incap :""; ?></strong></div>
			</div>
			<div class="row ml-0">Causa Visita de urgencia:<strong class="mr-2 ml-3"><?php !empty($_POST["causaVisitUrgen"]) ? print $causa : ""; ?></strong></div>
			<div class="row ml-0">¿Requirio de hospitalización?:<strong class="mr-2 ml-3"><?php !empty($_POST["hospitalizacion"]) ? print $hospitalizacion : ""; ?></strong></div>
			<?php if ($hospitalizacion == "SI") {
				echo '<div class="row ml-0">Días en hospitalizacion:<strong class="mr-2 ml-3">';?><?php !empty($_POST["num_dias"]) ? print $dias_enHospital :  ""?> <?php echo '</strong></div>'; ?>	
			<?php } ?>
	</div>

	<?php //var_dump($_POST['ocupaciones']);?>
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