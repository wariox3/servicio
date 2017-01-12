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
    "codigoEmpresa" => "xsd:integer",
    "numero" => "xsd:integer",
    "nombre1" => "xsd:string"), array("return" => "xsd:string"), "urn:administracion", "urn:administracion#getInsertarPago", "rpc", "encoded", "Insertar pago");

function getInsertarEmpleado($codigoIdentificacionTipo, $identificacionNumero, $nombre1, $nombre2, $apellido1, $apellido2, $nombreCorto) {
    $respuesta = "01";
    $servidor = new mysqli("localhost", "root", "70143086", "bdardid");
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
                $respuesta = "01";
            } else {
                $respuesta = "02";
            }
        } else {
            $respuesta = "01";
        }
        $sentencia->close();
    }
    return $respuesta;
}

function getInsertarPago($codigoEmpresa, $numero) {
    $respuesta = "01";
    $servidor = new mysqli("localhost", "root", "70143086", "bdardid");
    if ($servidor->connect_error) {
        die("Connection failed: " . $servidor->connect_error);
    }
    $strSql = "SELECT codigo_pago_pk FROM pago WHERE codigo_empresa_fk = " . $codigoEmpresa . " AND numero = '" . $numero . "'";
    if ($sentencia = $servidor->prepare($strSql)) {
        $sentencia->execute();
        $sentencia->store_result();
        if ($sentencia->num_rows <= 0) {
            $strSql = "INSERT INTO pago (codigo_empresa_fk, numero) VALUES ($codigoEmpresa, $numero);";
            if ($servidor->query($strSql) === TRUE) {
                $respuesta = "01";
            } else {
                $respuesta = "02";
            }
        } else {
            $respuesta = "01";
        }
        $sentencia->close();
    }
    return $respuesta;
}


if (!isset($HTTP_RAW_POST_DATA))
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);
?>