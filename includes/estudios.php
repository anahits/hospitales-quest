<?php 
include("bd_conection.php");

$idP = $_POST['idP'];
$action = $_POST['action'];

if (!isset($action)) {
    exit('404 - Not found');
}

switch ($action) {
    case 'estudios_lab':
        $estudios_laboratorio = @mysqli_query($con,"SELECT * FROM estudios_laboratorio WHERE id_paciente=$idP");
        if (count($estudios_laboratorio)>=1){
            while($row = $estudios_laboratorio->fetch_assoc()){
                 $json[] = array_map("utf8_encode", $row);
            }
            $data['data'] = $json;              

            $myJSON = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $myJSON;
        }
        break;
    case 'pruebas_alergia':
        $pruebas_alergia = @mysqli_query($con,"SELECT * FROM pruebas_alergia WHERE id_paciente=$idP");
        if (count($pruebas_alergia)>=1){
            while($row = $pruebas_alergia->fetch_assoc()){
                 $json[] = array_map("utf8_encode", $row);
            }
            $data['data'] = $json;              

            $myJSON = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $myJSON;
        }
        break;
    case 'estudios_gab':
        $estudios_gabinete = @mysqli_query($con,"SELECT * FROM estudios_gabinete WHERE id_paciente=$idP");
        if (count($estudios_gabinete)>=1){
            while($row = $estudios_gabinete->fetch_assoc()){
                 $json[] = array_map("utf8_encode", $row);
            }
            $data['data'] = $json;              

            $myJSON = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $myJSON;
        }
        break;
    case 'procedimientos':
        $procedimientos = @mysqli_query($con,"SELECT * FROM procedimientos WHERE id_paciente=$idP");
        if (count($procedimientos)>=1){
            while($row = $procedimientos->fetch_assoc()){
                 $json[] = array_map("utf8_encode", $row);
            }
            $data['data'] = $json;              

            $myJSON = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $myJSON;
        }
        break;     
    case 'consultas':
        $consultas = @mysqli_query($con,"SELECT * FROM consultas WHERE id_paciente=$idP");
        if (count($consultas)>=1){
            while($row = $consultas->fetch_assoc()){
                 $json[] = array_map("utf8_encode", $row);
            }
            $data['data'] = $json;              

            $myJSON = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $myJSON;
        }
        break;
    default :
        exit('404 - Not found');
        break;
}


?>