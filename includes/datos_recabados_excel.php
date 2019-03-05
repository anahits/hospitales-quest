<!DOCTYPE html>
<html lang="es">
	<head>
		<?php
		include("head-contents.php");?>
		<meta charset="UTF-8"/>
		<title>Datos recabados</title>
	</head>
	<body>
		<header id="header" class="jumbotron">
			<h2 class="ml-3">DATOS RECABADOS</h2>
		</header><!-- /header -->
		<main class="container ml-2" id="main-content">			
			<h4 class="ml-3">DATOS PACIENTES</h4>
			<div class="form-group">
				<a href="excelFiles/DatosPaciente_toCSV.php">Descargar archivo Excel Datos Pacientes</a>
			</div>
			<hr>
			<h4 class="ml-3">CLASIFICACIÓN DE LA ENFERMEDAD</h4>
			<div class="form-group">
				<a href="excelFiles/ClasifEnferm_toCSV.php">Descargar archivo Excel Clasificacion de enfermedad</a>
			</div>
			<hr>
			<h4 class="ml-3">ESTUDIOS</h4>
			<div class="form-group">
				<div class="mb-3 mt-3 ml-4">
					<div class="ml-0">
						Estudios de laboratorio:
						<div class="ml-0">
							<a href="excelFiles/EstLab_toCSV.php">Descargar archivo Excel Estudios de Laboratorio</a>
						</div>
					</div>
					<div class="ml-0">
						Pruebas de Alergia:
						<div class="ml-0">
							<a href="excelFiles/PruebAlerg_toCSV.php">Descargar archivo Excel Pruebas de Alergia</a>
						</div>
					</div>
					<div class="ml-0">
						Estudios de Gabinete:
						<div class="ml-0">
							<a href="excelFiles/EstGab_toCSV.php">Descargar archivo Excel Estudios de Gabinete</a>
						</div>
					</div>
					<div class="ml-0">
						Procedimientos:
						<div class="ml-0">
							<a href="excelFiles/Proced_toCSV.php">Descargar archivo Excel Procediminietos</a>
						</div>
					</div>
				</div>
			</div>
			<h4 class="ml-3">CONSULTAS</h4>
			<div class="form-group">
				<a href="excelFiles/Consultas_toCSV.php">Descargar archivo Excel Consultas</a>
			</div>
			
		</main>
	</body>