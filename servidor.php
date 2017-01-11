<?php

require_once "nusoap/lib/nusoap.php";

$server = new soap_server();
$server->configureWSDL("producto", "urn:producto");
$server->register("getInsertarEmpleado", array(
    "tipoRegistro" => "xsd:integer",
    "codigoTipoIdentificacion" => "xsd:string",
    "identificacion" => "xsd:integer",
    "nombre1" => "xsd:string",
    "nombre2" => "xsd:string",
    "apellido1" => "xsd:string",
    "apellido2" => "xsd:string"), array("return" => "xsd:string"), "urn:administracion", "urn:administracion#getInsertarEmpleado", "rpc", "encoded", "Insertar empleados");

/*$server->register("getInsertarPago", array(
    "tipoRegistro" => "xsd:integer",
    "tipoPago" => "xsd:string",
    "fechaDesde" => "xsd:date",
    "fecahHasta" => "xsd:date",
    "numero" => "xsd:string",
    "vrDeduccion" => "xsd:integer",
    "vrNeto" => "xsd:integer",
    "vrDevengado" => "xsd:integer",
    "tipodocumento" => "xsd:string",
    "numeroDocumento" => "xsd:string"), array("return" => "xsd:string"), "urn:administracion", "urn:administracion#getInsertarPago", "rpc", "encoded", "Insertar pago");

$server->register("getInsertarPagoDetalle", array(
    "tipoRegistro" => "xsd:integer",
    "concepto" => "xsd:integer",
    "vrPago" => "xsd:integer",
    "operacion" => "xsd:integer",
    "horas" => "xsd:integer",
    "porcentaje" => "xsd:integer",
    "dias" => "xsd:integer",
    "vrNetoDetalle" => "xsd:integer",
    "numeroDetalleFk" => "xsd:integer"), array("return" => "xsd:string"), "urn:administracion", "urn:administracion#getInsertarPagoDetalle", "rpc", "encoded", "Insertar pago detalle");*/



 function getInsertarEmpleado($paramsEmpleado) {
    $servername = "localhost";
    $username = "root1";
    $password = "123456";
    $dbname = "bdardid";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($paramsEmpleado['tipoRegistro'] == "1") {
        $insert = "INSERT INTO empleado (codigo_identificacion_tipo_fk, numero_identifacion) VALUES ('1', '123456789')";
    if ($conn->query($insert) === TRUE) {
        $respuesta= "inserto";
    } else {
        $respuesta= "Error: " . $conn->error . $conn->connect_error;
    }
    }

       /* 
        * , $paramsEmpleado[nombre1],$paramsEmpleado[nombre2], $paramsEmpleado[apellido1], $paramsEmpleado[apellido2], $paramsEmpleado[nombrecorto] 
        *  nombre1, nombre2, apellido1, apellido2, nombrecorto
       */
 
   

   // var_dump($respuesta);
    return  $respuesta ;
}

/*function getInsertarPago($paramsPago) {
    $db = new db($_SESSION["host"], $_SESSION["usuario"], $_SESSION["pass"]);
    $db->conectar();
    if ($paramsPago[tipoRegistroPago] == "02") {
        $insert = "INSERT INTO pago (codigo_pago_tipo_fk, fecha_desde, fecha_hasta, numero, vr_deducciones, vr_neto, vr_devengado) VALUES ($paramsPago[tipoPago],$paramsPago[fechaDesde],$paramsPago[fecahHasta] ,$paramsPago[numero], $paramsPago[vrDeduccion], $paramsPago[vrNeto], $paramsPago[vrDevengado], $paramsPago[tipodocumento], $paramsPago[numeroDocumento] )";
        $db->query($insert);
        if (empty($db->error)) {
            $respuesta["Ok"] = true;
            $respuesta["Mensaje"] = "se ah guardado con exito el pago.";
        } else {
            $respuesta["Ok"] = false;
            $respuesta["Mensaje"] = $db->error;
        }
    }
    return new soapval('return', $respuesta);
}*/

/*function getInsertarPagoDetalle($paramsPagoDetalle) {
    $db = new db($_SESSION["host"], $_SESSION["usuario"], $_SESSION["pass"]);
    $db->conectar();
    if ($paramsPagoDetalle[tipoRegistroPagoDetalle] == "03") {
        $insert = "INSERT INTO pago_detalle (concepto, vr_pago, operacion, horas, porcentaje, dias, vr_pago_neto, codigo_numero_fk) VALUES ( $paramsPagoDetalle[concepto], $paramsPagoDetalle[vrPago],$paramsPagoDetalle[operacion], $paramsPagoDetalle[horas], $paramsPagoDetalle[porcentaje], $paramsPagoDetalle[dias], $paramsPagoDetalle[vrNetoDetalle],$paramsPagoDetalle[numeroDetalleFk] )";
        $db->query($insert);
        if (empty($db->error)) {
            $respuesta["Ok"] = true;
            $respuesta["Mensaje"] = "se ah guardado con exito el pago detalle.";
        } else {
            $respuesta["Ok"] = false;
            $respuesta["Mensaje"] = $db->error;
        }
    }
    return new soapval('return', $respuesta);
}*/


if (!isset($HTTP_RAW_POST_DATA))
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);
?>