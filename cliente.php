<?php
    require_once "nusoap/lib/nusoap.php";
    $cliente = new nusoap_client("http://localhost/servicio/servidor.php");

    if ($error) {
        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
    }
    
    
    //datos empleado__________________________________
    $tipoRegistro = 1;
    $codigoTipoIdentificacion = 1;
    $identificacion = 70143086;
    $nombre1 = "jonathan";
    $nombre2 = "alexander";
    $apellido1 = "moncada";
    $apellido2 = "duque";
    $nombrecorto = $nombre1 . $nombre2 . $apellido1 . $apellido2;
    
    $paramsEmpleado = array(
    'tipoRegistro' => $tipoRegistro,
    'codigoTipoIdentificacion' => $codigoTipoIdentificacion,
    'identificacion' => $identificacion,
    'nombre1' => $nombre1,
    'nombre2' => $nombre2,
    'apellido1' => $apellido1,
    'apellido2' => $apellido2,
    'nombrecorto' => $nombrecorto);

    //datos pago________________________________________
   /* $tipoRegistroPago = 02;
    $tipoPago = 1;
    $fechaDesde = 2016-01-04;
    $fechaHasta = 2016-01-08;
    $numero = 23456789;
    $vrDeduccion = 98;
    $vrNeto = 87;
    $vrDevengado = 76;
    $tipodocumento = 1;
    $numeroDocumento = 1234567;
    
    $paramsPago = array(
    'tipoRegistroPago' => $tipoRegistroPago,
    'tipoPago' => $tipoPago,
    'fechaDesde' => date_create($fechaDesde),
    'fechaHasta' => date_create($fechaHasta),
    'numero' => $numero,
    'vrDeduccion' => $vrDeduccion,
    'vrNeto' => $vrNeto,
    'vrDevengado' => $vrDevengado,
    'tipodocumento' => $tipodocumento,
    'numeroDocumento' => $numeroDocumento);*/

    //datos pagoDetalle_____________________________________
    /*$tipoRegistroPagoDetalle = 03;
    $concepto = " concepto de pago por prestacion de servicios";
    $vrPago = 12;
    $operacion = 10;
    $horas = 5;
    $porcentaje = 8;
    $dias = 7;
    $vrNetoDetalle = 78987;
    $numeroDetalleFk = 88888855;
    
    $paramsPagoDetalle = array(
    'tipoRegistroPagoDetalle' => $tipoRegistroPagoDetalle,
    'concepto' => $concepto,
    'vrPago' => $vrPago,
    'operacion' => $operacion,
    'horas' => $horas,
    'porcentaje' => $porcentaje,
    'dias' => $dias,
    'vrNetoDetalle' => $vrNetoDetalle,
    'numeroDetalleFk' => $numeroDetalleFk);*/
     
    $result = $cliente->call("getInsertarEmpleado", $paramsEmpleado );
    
    //$result = $cliente->call("getInsertarPago", $paramsPago);

   // $result = $cliente->call("getInsertarPagoDetalle", $paramsPagoDetalle);

    if ($cliente->fault) {
        echo "<h2>Fault</h2><pre>";
           print_r($respuesta);
        echo "</pre>";
    }
    else {
    print_r($respuesta);
        $error = $cliente->getError(); 
       $client->request;
        var_dump($cliente); // prints "test"
        if ($error) {
            echo "<h2>Error</h2><pre>" . $error . "</pre>";
        }
        else {
            echo "<h2>Cargar Datos</h2><pre>";
            echo $result;
            echo "</pre>";
        }
    }
?>