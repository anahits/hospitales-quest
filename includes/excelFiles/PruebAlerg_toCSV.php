<?PHP
  namespace Pruebas_alergia;
  require_once ('../bd_conection.php');
    $result=@mysqli_query($con, "SELECT * FROM pruebas_alergia ORDER BY id_paciente ASC;");
    $result2=@mysqli_query($con, "SELECT * FROM pruebas_alergia_tipos ORDER BY tipo_prueba_alergia ASC;"); 
    
    $prueba_tipo = array();
    $num_pruebasTotales=array(); 
    $idsPaciente = array();
    $pruebasPacnt = array();  
    $pruebas=array();  
    $pacientePruebas = array();
    $data = array();   

  while ($PA = @mysqli_fetch_array($result))
  {
    $idPaciente = isset($PA["id_paciente"]) ? $PA["id_paciente"] : '';
    $tipo_prueba_paciente = isset($PA["pruebas_alergia"]) ? $PA["pruebas_alergia"] : '';
    $num_pruebas = isset($PA["num_prueba_alerg"]) ? $PA["num_prueba_alerg"] : '';
       
    $pacientePruebas[$PA["id_paciente"]][$PA["tipo_consulta"]][$PA["pruebas_alergia"]] = $PA["num_prueba_alerg"];

    array_push($prueba_tipo , $tipo_prueba_paciente);
    array_push($num_pruebasTotales , $num_pruebas);
    array_push($idsPaciente , $idPaciente);

    $estynum = array($tipo_prueba_paciente => $num_pruebas);
    array_push($pruebasPacnt , $estynum);    
  }

  while ($TP = @mysqli_fetch_array($result2) )
  {
    $tipo_est = isset($TP["tipo_prueba_alergia"]) ?  $TP["tipo_prueba_alergia"] : '';
    array_push($pruebas , $tipo_est);
  } 

  $pruebsTotales = array_merge($pruebas, $prueba_tipo);      
  $cantPruebas = sizeof($pruebsTotales);       
  $ceros = array(); 
  for ($i=0; $i<$cantPruebas;$i++){
    array_push($ceros , '0');
  }

  $totalEst=array_combine($pruebsTotales, $ceros);     
  foreach ($pacientePruebas as $key => $value) {
    foreach ($value as $k => $v) {
        $pruebasCombinadas = array_merge($totalEst, $v); 
        $pacientePruebas[$key][$k] = $pruebasCombinadas;
    }
  }     

  foreach ($pacientePruebas as $key => &$value) {
    $codigoPaciente = '#'. str_pad($key,5,"0",STR_PAD_LEFT);  
    foreach ($value as $k => $v) {
      $pruebasPorPaciente = array('TIPO DE CONSULTA' => $k)+$v;
      $pruebasPorPaciente = array('CODIGO PACIENTE' => $codigoPaciente)+$pruebasPorPaciente;
      array_push($data , $pruebasPorPaciente);
    }
  }

  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.

  function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  // file name for download
  $filename = "pruebas_alergia_" . date('Ymd') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: text/html;charset=UTF-8");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;

  foreach($data as $row) {
    if(!$flag) {
      // display field/column names as first row
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }

    array_walk($row, __NAMESPACE__ . '\cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }

  exit;

?>