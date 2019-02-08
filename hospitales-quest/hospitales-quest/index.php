<!DOCTYPE html>
<html lang="es">
    <head>
        <?php 
            include("includes/head-contents.php");
            include("includes/scripts.php");
            require_once ('includes/bd_conection.php');
            include("includes/funciones.php");
            include("includes/editar.php");
        ?>
        <meta charset="UTF-8"/>
        <title>Recolección de Datos Expedientes</title>
    </head>
    <body>
        <header id="header" class="jumbotron">
            <h2>HOJA DE RECOLECCIÓN DE DATOS EXPEDIENTES</h2>
            <a href="includes/datos_recabados_excel.php">Descargar archivo Excel Datos Pacientes</a>
            </header><!-- /header -->
            <main class="container" id="main-content">
                <form action="includes/datos_recabados.php" id="form" method="post">
                    <input id="pacienteId" type="text" name="pacienteId" value="<?php echo (isset($id)) ? $id: $id = false;?>" hidden>
                    <div class="main-form-group">
                        <?php
                        $codigoMenu= generarHospitales($consulHosp,$hospital);
                        echo $codigoMenu;
                        ?>
                    </div>
                    <hr>

                    <label for="datos_pacientes"><strong>2.</strong> DATOS PACIENTES</label>
                    <div class="form-group">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="rfc"><strong>2.1.</strong> RFC paciente</label>
                            <div class="col-sm-3">
                                <?php
                                echo '<input type="text" name="rfc_paciente" class="form-control" placeholder="Ingrese RFC" value="'.$rfc.'">';
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="iniciales"><strong>2.2.</strong> Iniciales del paciente</label>
                            <div class="col-sm-3">
                                <?php
                                echo '<input type="text" name="iniciales_paciente" class="form-control" placeholder="Ingrese sus iniciales" pattern="[a-zA-Z]*" value="'.$iniciales.'" >';
                                ?>
                                <div id="iniciales_null" class="warning">
                                    <p>Las inciales no pueden contener menos de 3 letras</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="generos"><strong>2.3.</strong> Género del paciente</label>
                            <div class="col-sm-3">
                                <select class="form-control" id="generos" name="generos">
                                    <?php foreach( $generos as $id_genero => $genero): ?>
                                    <?php echo '<option value="'.$id_genero.'"', ($id_genero == @$genero_id) ? 'selected' : '', '>'. $genero .'</option>';
                                    ?>
                                    <?php endforeach; ?>
                                </select>
                                <div id="genero_null" class="warning">
                                    <p>No has elegido un genero</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="edades"><strong>2.4.</strong> Edad</label>
                            <div class="col-sm-2" style="display: inline-flex;">
                                <input class="form-control" id="edades" type="number" name="edades" min="0.1" step="0.1" value="<?php echo substr($edad,0,-6);?>">
                                <label class="col-sm-3 col-form-label" for="edades">Años</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <?php
                            $codigoMenu= generarOcupaciones($consulOcup,$ocupacion);
                            echo $codigoMenu;
                            ?>
                        </div>
                        <div class="form-group row">
                            <?php
                            $codigoMenu= generarEscolaridades($consulEscol,$escolaridad);
                            echo $codigoMenu;
                            ?>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="otra_escolaridad" name="otra_escolaridad" placeholder="Especifique" hidden="true">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="residencias" ><strong>2.7.</strong> Lugar de residencia</label>
                            <div class="radios col-sm-6 row">
                                <?php foreach($residencias as $key => $residencia):
                                echo '<div class="form-check form-check-inline">';
                                    echo '<input class="form-check-input" type="radio" name="residencia" value="'.$residencia.'"', ($residencia == @$lugar_residencia) ? 'checked' : '', '>'.$key;
                                echo '</div>';?>
                                <?php endforeach; ?>
                                <div id="residencia_null" class="warning">
                                    <p>No has elegido un lugar de residencia</p>
                                </div>
                                <select id="estados" class="form-control col-sm-6" name="estados" size="1">                                    
                                    <?php foreach( $estados as $id_edo => $estado): ?>
                                    <?php echo '<option value="'.$id_edo.'"', ($id_edo == @$edo_id) ? 'selected' : '', '>'. $estado .'</option>';
                                    ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <label for="exampleFormControlSelect1">PERIODO</label>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="inicio_consultas">De</label>
                        <div class="col-sm-2">
                            <input id="inicio_consultas" class="form-control" type="date" name="inicio_consultas" max="" onchange="setInicioPeriodLimit()" value="<?php echo $inicio_consultas;?>">
                        </div>
                        <label class="col-sm-2 col-form-label" for="fin_consultas">a</label>
                        <div class="col-sm-2">
                            <input id="fin_consultas" class="form-control" type="date" name="fin_consultas" min="" onchange="setFinPeriodLimit()" value="<?php echo $fin_consultas;?>">
                        </div>
                    </div>
                    <label for="dias_perdidos"><strong>9.</strong> Días perdidos</label>                    
                    <div class="input-group">
                        <div class="col-sm-5">
                            <label class="col-form-label">9.1. Días escolares</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="number" min="0" step="1" class="form-control" name="dias_escol" placeholder="Cantidad" value="<?php echo $dias_escol_perdidos;?>">
                        </div>
                    </div>                    
                    <div class="input-group">
                        <div class="col-sm-5">
                            <label class="col-form-label">9.2. Días del acompañante</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="number" min="0" step="1" class="form-control" name="dias_acomp" placeholder="Cantidad" value="<?php echo $dias_acomp_perdidos;?>">
                        </div>
                    </div>                    
                    <div class="input-group">
                        <div class="col-sm-5">
                            <label class="col-form-label">9.3. Días de incapacidad</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="number" min="0" step="1" class="form-control" name="dias_incap" placeholder="Cantidad" value="<?php echo $dias_incap_perdidos;?>">
                        </div>
                    </div>
                    <hr>
                    <label for="clasificacion_enfermedad"><strong>3.</strong> CLASIFICACIÓN DE LA ENFERMEDAD</label>
                    <div class="form-group">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="anios_evol"><strong>3.1.</strong> Años de evolución</label>
                            <div class="col-sm-2" style="display: inline-flex;">
                                <input class="form-control" id="anios_evol" type="number" name="anios_evol" min="0.1" step="0.1" placeholder="Número" value="<?php echo substr($anios_evolucion,0,-5);?>">
                                <label class="col-sm-3 col-form-label" for="edades">Años</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="DA"><strong>3.2.</strong> Inicialmente fue considerado una DA</label>
                            <div class="col-sm-3">
                                <select class="form-control" id="grados_da" name="grados_da">
                                    <option value="noOption" <?php echo ($tipo_da == "") ? 'selected' : ''?>>-Selecciona una opción-</option>
                                    <?php foreach( $grados_da as $id_grado_da => $grado_da): ?>
                                    <?php echo '<option value="'.$id_grado_da.'"', ($grado_da == @$tipo_da) ? 'selected' : '', '>'. $grado_da.'</option>';
                                    ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label" for="Herramientas"><strong>3.3.</strong> ¿Qué herramienta se utilizó para su clasificación?</label><div class="input-group">
                                <div class="col-sm-5">
                                    <label class="col-form-label">3.3.1. SCORAD</label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" min="0" step="0.1" class="form-control" name="scorad_calculo" placeholder="Calculo" value="<?php echo $scorad_calculo;?>">
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="col-sm-5">
                                    <label class="col-form-label">3.3.2 Solo porcentaje de superficie corporal afectada (BSA)</label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" min="0" step="0.1" class="form-control" name="bsa_calculo" placeholder="Calculo" value="<?php echo $bsa_calculo;?>">
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="col-sm-5">
                                    <label class="col-form-label">3.3.3. EASI</label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" min="0" step="0.1" class="form-control" name="easi_calculo" placeholder="Calculo" value="<?php echo $easi_calculo;?>">
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="col-sm-5">
                                    <label class="col-form-label">3.3.4. IGA</label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" min="0" step="0.1" class="form-control" name="iga_calculo" placeholder="Calculo" value="<?php echo $iga_calculo;?>">
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="col-sm-5">
                                    <label class="col-form-label">3.3.5. No utiliza 3.3.5.1. Calculo de IGA modificado</label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" min="0" step="0.1" class="form-control" name="iga_modificado_calculo" placeholder="Calculo" value="<?php echo $iga_modificado_calculo;?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <label for="Estudios"><strong>4.</strong> ESTUDIOS</label>
                    <div class="form-group">
                        <?php include("includes/labs_table.php");?>
                        <?php include("includes/pruebalergia_table.php");?>
                        <?php include("includes/gabinete_table.php");?>
                        <?php include("includes/proced_table.php");?>
                    </div>
                    <hr>
                    <label for="exampleFormControlSelect1"><strong>5.</strong> CONSULTAS</label>
                    <div class="form-group">
                        <?php include("includes/consult_table.php");?>
                        <hr>
                        <div class="row onerow">
                            <label class="col-sm-6 col-form-label" for="exacerbaciones"><strong>6.</strong> Cantidad de exacerbaciones o brotes que tuvo en el ultimo año</label>
                            <div class="col-sm-3">
                                <?php
                                echo '<input type="number" min="0" name="exacerbaciones" class="form-control" placeholder="Cantidad" value="'.$canti_exacerb.'">';
                                ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row onerow">
                            <label class="col-sm-6 col-form-label" for="prurito"><strong>7.</strong> ¿El paciente presenta prurito que afecte el sueño y/o calidad de vida?</label>
                            <div class="radios col-sm-4">
                                <div class="radios col-sm-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="prurito" value="SI" <?php echo (@$prurito == 'SI') ? 'checked' : '';?>>SI
                                        <input class="form-check-input ml-3" type="radio" name="prurito" value="NO" <?php echo (@$prurito !== 'SI') ? 'checked' : '';?>>NO
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row onerow">
                            <label class="col-sm-6 col-form-label" for="depresion"><strong>8.</strong> ¿Su paciente presenta depresion?</label>
                            <div class="radios col-sm-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="depresion" value="SI" <?php echo (@$depresion == 'SI') ? 'checked' : '';?>>SI
                                    <input class="form-check-input ml-3" type="radio" name="depresion" value="NO" <?php echo (@$depresion !== 'SI') ? 'checked' : ''?>>NO
                                </div>
                            </div>
                        </div>
                        <hr>
                        <?php if ($update == true): ?>                            
                        <div class="guardar">
                            <input type="submit"  id="update" class="btn btn-success" style="text-align:center" name="updateTodo" value="Actualizar Datos de Paciente">
                        </div>
                        <?php else: ?>
                        <div class="guardar">
                            <input type="submit"  id="saveAll" class="btn btn-success" style="text-align:center" name="submitTodo" value="Guardar Encuesta">
                        </div>
                        <?php endif; ?>                        
                    </form>
                </main>
                <footer class="footer">
                    &copy; <?php print date("Y");?>
                </footer>
                <script src="includes/validation.js" type="text/javascript" charset="utf-8" async defer></script>
            </body>
        </html>