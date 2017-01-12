<?php

require_once "nusoap/lib/nusoap.php";
$cliente = new nusoap_client("http://localhost/servicio/servidor.php");

$error = $cliente->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
}      

    $result = $cliente->call("getInsertarEmpleado", 
            array(
                "codigoIdentificacionTipo" => "CC", 
                "identificacionNumero" => "70143086",
                "nombre1" => "MARIO",
                "nombre2" => "ANDRES",
                "apellido1" => "ESTRADA",
                "apellido2" => "ZULUAGA",
                "nombreCorto" => "MARIO ANDRES ESTRADA ZULUAGA",));
    
      $result = $cliente->call("getInsertarPago", 
            array(
                "codigoIdentificacionTipo" => "CC", 
                "identificacionNumero" => "70143086",
                "codigoEmpresa" => "1",
                "fechaDesde" => "2016-01-05",
                "fechaHasta" => "2016-01-06",
                "numero" => "987654321",
                "vrDeduccion" => "3",
                "vrNeto" => "2",
                "vrDevengado" => "1",));

if ($cliente->fault) {
  echo "<h2>Fault</h2><pre>";
  print_r($result);
  echo "</pre>";
  }
  else {
  $error = $cliente->getError();
  if ($error) {
  echo "<h2>Error</h2><pre>" . $error . "</pre>";
  }
  else {
  echo "<h2>Libros</h2><pre>";
  echo $result;
  echo "</pre>";
  }
  }
?>