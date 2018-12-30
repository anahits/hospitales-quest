<?php include("includes/session.php");?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("includes/head-contents.php");?>
        <?php include("includes/scripts.php");?>
        <?php require_once ('includes/bd_conection.php');?>
        <?php include("includes/funciones.php");?>
        <meta charset="UTF-8"/>
        <title>Personas</title>
    </head>
    <body>
        <header id="header" class="jumbotron">
            <h2>HOJA DE RECOLECCIÓN DE DATOS EXPEDIENTES</h2>
            </header><!-- /header -->
            <main class="container" id="main-content">                
                <form action="includes/datos_recabados.php" method="post">
                    <?php echo '<input type="number" name="id_paciente" min="0" step="1" value="'.$id_paciente.'"hidden>' ?>
                    <div class="main-form-group">                    
                        <?php
                            $codigoMenu= generarHospitales($consulHosp);
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
                                echo '<input type="text" name="rfc_paciente" class="form-control" placeholder="Ingrese RFC" >';
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="iniciales"><strong>2.2.</strong> Iniciales del paciente</label>
                            <div class="col-sm-3">
                                <?php
                                echo '<input type="text" name="iniciales_paciente" class="form-control" placeholder="Ingrese sus iniciales" pattern="[a-zA-Z]*" >';
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="generos"><strong>2.3.</strong> Género del paciente</label>
                            <div class="col-sm-3">
                                <select class="form-control" id="generos" name="generos">                           
                                    <?php foreach( $generos as $id_genero => $genero): ?>
                                    <?php echo '<option value="'.$id_genero.'">'. $genero.'</option>';
                                    ?>
                                    <?php endforeach; ?>
                                </select></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="edades"><strong>2.4.</strong> Edad</label>
                                <div class="col-sm-2">
                                    <select class="form-control" id="edades" name="edades">
                                        <?php
                                            $edad='1 a 11 meses';
                                            echo '<option value="0">'.$edad.'</option>';
                                            for ($edad=1;$edad<=120;$edad++){
                                                echo'<option value="'.$edad.'">'.$edad.' años </option>';   
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">                                        
                                <?php
                                    $labelName = "Ocupación";
                                    $selectName = "ocupaciones";
                                    $codigoMenu= generarOcupaciones($consulOcup,$selectName,$labelName);
                                    echo $codigoMenu;
                                ?>      
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="otra_ocupacion" name="otra_ocupacion" placeholder="Especifique" hidden="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <?php
                                    $labelName = "Escolaridad";
                                    $selectName = "escolaridad";
                                    $codigoMenu= generarEscolaridades($consulEscol,$selectName,$labelName);
                                    echo $codigoMenu;
                                ?>      
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="otra_escolaridad" name="otra_escolaridad" placeholder="Especifique" hidden="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="residencias" ><strong>2.7.</strong> Lugar de residencia</label>
                                <div class="radios col-sm-6">
                                    <?php foreach($residencias as $key => $residencia):
                                    echo '<div class="form-check form-check-inline">';
                                        echo '<input class="form-check-input" type="radio" name="residencia" value="'.$residencia.'">'.$key;
                                    echo '</div>';?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <label for="clasificacion_enfermedad"><strong>3.</strong> CLASIFICACIÓN DE LA ENFERMEDAD</label>
                        <div class="form-group">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="anios_evol"><strong>3.1.</strong> Años de evolución</label>
                                <div class="col-sm-2">
                                    <select class="form-control" id="anios_evol" name="anios_evol">
                                        <?php
                                            $anio_evol='1 a 11 meses';
                                            echo '<option value="0">'.$anio_evol.'</option>';
                                            for ($anio_evol=1;$anio_evol<=120;$anio_evol++){
                                                echo'<option value="'.$anio_evol.'">'.$anio_evol.' años </option>';   
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="DA"><strong>3.2.</strong> Inicialmente fue considerado una DA</label>
                                <div class="col-sm-3">                              
                                    <select class="form-control" id="grados_da" name="grados_da">                           
                                        <?php foreach( $grados_da as $id_grado_da => $grado_da): ?>
                                        <?php echo '<option value="'.$id_grado_da.'">'. $grado_da.'</option>';
                                        ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label" for="Herramientas"><strong>3.3.</strong> ¿Qué herramienta se utilizó para su clasificación?</label>
                                <?php foreach( $herramientas as $herramienta => $valor): ?>
                                    <?php echo '<div class="input-group">
                                            <div class="col-sm-5">
                                                <label class="col-form-label">'.$herramienta.'</label>
                                                    </div>
                                                <div class="col-sm-2">
                                                    <input type="number" step=".01" class="form-control" name="'. $valor .'" placeholder="Calculo" >
                                                </div>
                                    </div>';
                                    ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <hr>
                        <label for="Estudios"><strong>4.</strong> ESTUDIOS</label>
                        <div class="form-group">
                            <?php include("includes/labs_table.php");?>
                            <?php include("includes/proced_table.php");?>
                            <?php include("includes/gabinete_table.php");?>
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
                                echo '<input type="number" min="0" name="exacerbaciones" class="form-control" placeholder="Cantidad" >';
                                ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row onerow">
                            <label class="col-sm-6 col-form-label" for="prurito"><strong>7.</strong> ¿El paciente presenta prurito que afecte el sueño y/o calidad de vida?</label>
                            <div class="radios col-sm-4">
                                <?php foreach($optsPrurito as $key => $optPrurito):
                                    echo '<div class="form-check form-check-inline">';
                                        echo '<input class="form-check-input" type="radio" name="prurito" value="'.$optPrurito.'">'.$key;
                                    echo '</div>';?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row onerow">
                            <label class="col-sm-6 col-form-label" for="depresion"><strong>8.</strong> ¿Su paciente presenta depresion?</label>
                            <div class="radios col-sm-4">
                                <?php foreach($optsDepre as $key => $optDepre):
                                    echo '<div class="form-check form-check-inline">';
                                        echo '<input class="form-check-input" type="radio" name="depresion" value="'.$optDepre.'">'.$key;
                                    echo '</div>';?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <hr>
                        <label for="dias_perdidos"><strong>9.</strong> Días perdidos</label>
                        <?php foreach( $dias_perdidos as $index => $dia_perdido): ?>
                                    <?php echo '<div class="input-group">
                                            <div class="col-sm-5">
                                                <label class="col-form-label">'.$index.'</label>
                                                    </div>
                                                <div class="col-sm-2">
                                                    <input type="number" min="0" step="1" class="form-control" name="'. $dia_perdido .'" placeholder="Cantidad" >
                                                </div>
                                    </div>';
                                    ?>
                        <?php endforeach; ?>
                        <hr>
                        <label for="exampleFormControlInput1"><strong>10.</strong> Visitas a urgencia</label>
                        <div class="form-group">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="causaVisitUrgen"><strong>10.1.</strong> Causa</label>
                                <div class="col">
                                <?php
                                echo '<input type="text" name="causaVisitUrgen" class="form-control" placeholder="Ingrese el motivo">';
                                ?>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="Hospitalizacion"><strong>10.2.</strong> ¿Requirio de hospitalización?</label>
                                <div class="col-sm-2">
                                    <select class="form-control" id="grados_da" name="hospitalizacion">                           
                                        <?php foreach( $optsHospi as $index => $optHospi): ?>
                                        <?php echo '<option value="'.$index.'">'. $optHospi.'</option>';?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label" for="num_dias">¿Cúantos días?</label>
                                <div class="col">
                                    <?php
                                        echo '<input type="number" min="0" step="1" name="num_dias" class="form-control" placeholder="Núm días">';
                                    ?> 
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="guardar">
                            <input type="submit" class="btn btn-success" style="text-align:center" name="submitTodo" value="Guardar Encuesta" data-toggle="modal" data-target="#myModal">
                        </div>
                    </form>
           

                </main>
                <footer class="footer">
                    &copy; <?php print date("Y");?>
                </footer>

             

            </body>
        </html>