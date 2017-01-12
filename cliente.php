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