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
                "identificacionNumero" => "1152689427",
                "nombre1" => "MARIO",
                "nombre2" => "ANDRES",
                "apellido1" => "ESTRADA",
                "apellido2" => "ZULUAGA",
                "nombreCorto" => "MARIO ANDRES ESTRADA ZULUAGA",));
    
      $result = $cliente->call("getInsertarPago", 
            array(
                "codigoIdentificacionTipo" => "CC", 
                "identificacionNumero" => "1152689427",
                "codigoEmpresa" => "1",
                "codigoPagoTipo" => "2",
                "fechaDesde" => "2017-01-05",
                "fechaHasta" => "2017-01-06",
                "numero" => "111",
                "vrDeduccion" => "3",
                "vrNeto" => "2",
                "vrDevengado" => "1",
                "cargo" => "Aux bodega",
                "centroCostos" => "personal admin",
                "zona" => "bbbbb",
                "periodoPago" => "quincenal",
                "cuenta" => "45454545454",
                "banco" => "davivienda",
                "pension" => "porvenir",
                "salud" => "sura",
                "salario" => "10000000",));
      
      $result = $cliente->call("getInsertarPagoDetalle", 
            array(
                "codigoIdentificacionTipo" => "CC", 
                "identificacionNumero" => "70143085",
                "codigoEmpresa" => "1",
                "codigoNumero" => "111",
                "codigoConcepto" => "1",
                "vrPago" => "0000",
                "operacion" => "0000",
                "vrPagoNeto" => "0000",
                "horas" => "0000",
                "porcentaje" => "00000",
                "dias" => "00000",
                "concepto" => "Prima",
                "vrHora" => "00000",
                "vrDevengado" => "000000",
                "vrDeducciones" => "00000",));

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