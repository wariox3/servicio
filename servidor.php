<?php

require_once "nusoap/lib/nusoap.php";

$server = new soap_server();
$server->configureWSDL("producto", "urn:producto");
$server->register("getInsertarEmpleado", array(
    "codigoIdentificacionTipo" => "xsd:string",
    "identificacionNumero" => "xsd:string",
    "nombre1" => "xsd:string",
    "nombre2" => "xsd:string",
    "apellido1" => "xsd:string",
    "apellido2" => "xsd:string",
    "nombreCorto" => "xsd:string"), array("return" => "xsd:string"), "urn:administracion", "urn:administracion#getInsertarEmpleado", "rpc", "encoded", "Insertar empleados");

$server->register("getInsertarPago", array(
    "codigoIdentificacionTipo" => "xsd:string",
    "identificacionNumero" => "xsd:string",
    "codigoEmpresa" => "xsd:integer",
    "codigoPagoTipo" => "xsd:integer",
    "fechaDesde" => "xsd:date",
    "fechaHasta" => "xsd:date",
    "numero" => "xsd:integer",
    "vrDeduccion" => "xsd:integer",
    "vrNeto" => "xsd:integer",
    "vrDevengado" => "xsd:integer",
    "centroCostos" => "xsd:string",
    "zona" => "xsd:string",
    "periodoPago" => "xsd:string",
    "cuenta" => "xsd:string",
    "banco" => "xsd:string",
    "pension" => "xsd:string",
    "salud" => "xsd:string",
    "salario" => "xsd:integer"), array("return" => "xsd:string"), "urn:administracion", "urn:administracion#getInsertarPago", "rpc", "encoded", "Insertar pago");

$server->register("getInsertarPagoDetalle", array(
    "codigoIdentificacionTipo" => "xsd:string",
    "identificacionNumero" => "xsd:string",
    "codigoEmpresa" => "xsd:integer",
    "codigoNumero" => "xsd:integer",
    "codigoConcepto" => "xsd:integer",
    "vrPago" => "xsd:integer",
    "operacion" => "xsd:integer",
    "vrPagoNeto" => "xsd:integer",
    "horas" => "xsd:integer",
    "porcentaje" => "xsd:integer",
    "dias" => "xsd:integer",
    "concepto" => "xsd:string",
    "vrhora" => "xsd:integer",
    "vrDevengado" => "xsd:integer",
    "vrDeducciones" => "xsd:integer"), array("return" => "xsd:string"), "urn:administracion", "urn:administracion#getInsertarPago", "rpc", "encoded", "Insertar pago");



    function getInsertarEmpleado($codigoIdentificacionTipo, $identificacionNumero, $nombre1, $nombre2, $apellido1, $apellido2, $nombreCorto) {
    $respuesta = "01";
    $servidor = new mysqli("localhost", "root", "1152689427", "bdardid");
    if ($servidor->connect_error) {
        die("Connection failed: " . $servidor->connect_error);
    }
    $strSql = "SELECT codigo_empleado_pk FROM empleado WHERE codigo_identificacion_tipo_fk = '" . $codigoIdentificacionTipo . "' AND identificacion_numero = '" . $identificacionNumero . "'";
    if ($sentencia = $servidor->prepare($strSql)) {
        $sentencia->execute();
        $sentencia->store_result();
        if ($sentencia->num_rows <= 0) {
            $strSql = "INSERT INTO empleado (codigo_identificacion_tipo_fk, identificacion_numero, nombre1, nombre2, apellido1, apellido2, nombre_corto) VALUES ('$codigoIdentificacionTipo', '$identificacionNumero', '$nombre1', '$nombre2', '$apellido1', '$apellido2', '$nombreCorto');";
            if ($servidor->query($strSql) === TRUE) {
                $respuesta = " inseto empelado";
            } else {
                $respuesta = "No inserto empleado";
            }
        } else {
            $respuesta = "Estos datos ya existen en el Empleado";
        }
        $sentencia->close();
    }
    return $respuesta;
}

function getInsertarPago( $codigoIdentificacionTipo, $identificacionNumero, $codigoEmpresa, $codigoPagoTipo, $fechaDesde, $fechaHasta, $numero, $vrDeduccion, $vrNeto, $vrDevengado, $cargo, $centroCostos, $zona, $periodoPago, $cuenta, $banco, $pension, $salud, $salario) {
    $respuesta = "00";
    $date1 = date_create("$fechaDesde");
    $fecha1= date_format($date1, "Y-m-d");
    $date2 = date_create("$fechaHasta");
    $fecha2= date_format($date2, "Y-m-d");
    $servidor = new mysqli("localhost", "root", "1152689427", "bdardid");
    if ($servidor->connect_error) {
        die("Connection failed: " . $servidor->connect_error);
    }
    $strSql = "SELECT codigo_pago_pk FROM pago WHERE codigo_empresa_fk = " . $codigoEmpresa . " AND numero = '" . $numero . "'";
    if ($sentencia = $servidor->prepare($strSql)) {
        $sentencia->execute();
        $sentencia->store_result();
        if ($sentencia->num_rows <= 0) {
            $strSql = "INSERT INTO pago (codigo_empresa_fk, codigo_pago_tipo_fk, fecha_desde, fecha_hasta, numero, vr_deducciones, vr_neto, vr_devengado, cargo, centro_costos, zona, periodo_pago, cuenta, banco, pension, salud, salario) VALUES ('$codigoEmpresa', '$codigoPagoTipo','$fecha1','$fecha2' , '$numero', '$vrDeduccion', '$vrNeto', '$vrDevengado', '$cargo', '$centroCostos', '$zona', '$periodoPago', '$cuenta', '$banco', '$pension', '$salud', '$salario');";
            if ($servidor->query($strSql) === TRUE) {
                $respuesta = "inserto pago";
            } else {
                $respuesta = "No ingreso el pago ".$codigoPagoTipo;
            }
        } else {
            $respuesta = "estos datos ya existen en el pago";
        }
        $sentencia->close();
    }
    return $respuesta;
}

                                                                                                                                                           
                                                                                                                                  
function getInsertarPagoDetalle($codigoIdentificacionTipo, $identificacionNumero, $codigoEmpresa, $codigoNumero, $codigoConcepto, $vrPago, $operacion, $vrPagoNeto, $horas, $porcentaje, $dias, $concepto, $vrHora, $vrDevengado, $vrDeducciones) {
    $respuesta = "00";
    $servidor = new mysqli("localhost", "root", "1152689427", "bdardid");
    if ($servidor->connect_error) {
        die("Connection failed: " . $servidor->connect_error);
    }
    $strSql = "SELECT codigo_pago_pk FROM pago WHERE codigo_empresa_fk = " . $codigoEmpresa . " AND numero = '" . $numero . "'";
    if ($sentencia = $servidor->prepare($strSql)) {
        $sentencia->execute();
        $sentencia->store_result();
        if ($sentencia->num_rows <= 0) {
            $strSql = "INSERT INTO pago_detalle (codigo_empresa_fk,  codigo_numero_fk, codigo_concepto_fk, vr_pago, operacion, vr_pago_neto, horas, porcentaje, dias, concepto, vr_hora, vr_devengado, vr_deduccion ) VALUES ('$codigoEmpresa', '$codigoNumero', '$codigoConcepto', '$vrPago', '$operacion', '$vrPagoNeto', '$horas', '$porcentaje', '$dias', '$concepto', '$vrHora', '$vrDevengado', '$vrDeducciones');";
            if ($servidor->query($strSql) === TRUE) {
                $respuesta = "inserto pago DETALLE";
            } else {
                $respuesta = "no inserto pago  DETALLE";
            }
        } else {
            $respuesta = "estos datos ya existen en el pago DETALLE";
        }
        $sentencia->close();
    }
    return $respuesta;
}


if (!isset($HTTP_RAW_POST_DATA))
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);
?>