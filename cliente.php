<?php

require_once "nusoap/lib/nusoap.php";
$cliente = new nusoap_client("http://localhost/servicio/servidor.php");

$error = $cliente->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
}      

//   $result = $cliente->call("getInsertarEmpleado", 
//            array(
//                "codigoIdentificacionTipo" => "CC", 
//                "identificacionNumero" => "1152689427",
//                "nombre1" => "MARIO",
//                "nombre2" => "ANDRES",
//                "apellido1" => "ESTRADA",
//                "apellido2" => "ZULUAGA",
//                "nombreCorto" => "MARIO ANDRES ESTRADA ZULUAGA",
//                "correo" => "d@d.com"));
    

     /* $result = $cliente->call("getInsertarPago", 
            array(
                "codigoIdentificacionTipo" => "CC", 
                "identificacionNumero" => "1152689427",
                "codigoEmpresa" => "1",
                "numero" => "111",
                "codigoPagoTipo" => "2",
                "fechaDesde" => "2017-01-05",
                "fechaHasta" => "2017-01-06",
                "vrSalario" => "10000000",
                "vrSalarioEmpleado" => "10000000",
                "vrDeduccion" => "3",
                "vrNeto" => "2",
                "vrDevengado" => "1",
                "cargo" => "Aux bodega",
                "grupoDePago" => "personal admin",
                "zona" => "bbbbb",
                "periodoPago" => "quincenal",
                "cuenta" => "45454545454",
                "banco" => "davivienda",
                "pension" => "porvenir",
                "salud" => "sura"
                ));*/
      
      $result = $cliente->call("getInsertarPagoDetalle", 
            array(
                "codigoEmpresa" => "1",
                "numero" => "111",
                "codigoConcepto" => "1",
                "codigo" => "999",
                "nombreConcepto" => "Prima",
                "operacion" => "1",                
                "horas" => "0",
                "dias" => "0",
                "porcentaje" => "0",                
                "vrHora" => "0",
                "vrPago" => "0"));

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