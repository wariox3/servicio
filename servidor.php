<?php

require_once "nusoap/lib/nusoap.php";
require_once "conexion.php";
$server = new soap_server();
$server->configureWSDL("funcionesArdid", "urn:funciones");

$server->register("getInsertarEmpleado", array(
    "codigoIdentificacionTipo" => "xsd:string",
    "identificacionNumero" => "xsd:string",
    "nombre1" => "xsd:string",
    "nombre2" => "xsd:string",
    "apellido1" => "xsd:string",
    "apellido2" => "xsd:string",
    "nombreCorto" => "xsd:string",
    "correo" => "xsd:string"), array("return" => "xsd:string"), "urn:administracion", "urn:administracion#getInsertarEmpleado", "rpc", "encoded", "Insertar empleados");

$server->register("getInsertarPago", array(
    "codigoIdentificacionTipo" => "xsd:string",
    "identificacionNumero" => "xsd:string",
    "codigoEmpresa" => "xsd:integer",
    "numero" => "xsd:integer",
    "codigoPagoTipo" => "xsd:integer",
    "codigoContrato" => "xsd:integer",
    "fechaDesde" => "xsd:string",
    "fechaHasta" => "xsd:string",
    "vrSalario" => "xsd:integer",
    "vrSalarioEmpleado" => "xsd:integer",
    "vrDeduccion" => "xsd:integer",
    "vrNeto" => "xsd:integer",
    "vrDevengado" => "xsd:integer",
    "cargo" => "xsd:string",
    "grupoDePago" => "xsd:string",
    "zona" => "xsd:string",
    "periodoPago" => "xsd:string",
    "cuenta" => "xsd:string",
    "banco" => "xsd:string",
    "pension" => "xsd:string",
    "salud" => "xsd:string"), array("return" => "xsd:string"), "urn:administracion", "urn:administracion#getInsertarPago", "rpc", "encoded", "Insertar pago");

$server->register("getInsertarPagoDetalle", array(
    "codigoEmpresa" => "xsd:integer",
    "numero" => "xsd:integer",
    "codigo" => "xsd:integer",
    "codigoConcepto" => "xsd:integer",
    "nombreConcepto" => "xsd:string",
    "operacion" => "xsd:integer",
    "horas" => "xsd:integer",
    "dias" => "xsd:integer",
    "porcentaje" => "xsd:integer",
    "vrHora" => "xsd:integer",
    "vrPago" => "xsd:integer"), array("return" => "xsd:string"), "urn:administracion", "urn:administracion#getInsertarPago", "rpc", "encoded", "Insertar pago detalle");

$server->register("getInsertarContrato", array(
    "codigoEmpresa" => "xsd:integer",
    "numero" => "xsd:string",
    "codigo" => "xsd:integer",
    "codigoClase" => "xsd:integer",
    "codigoIdentificacionTipo" => "xsd:string",
    "identificacionNumero" => "xsd:string",
    "fechaDesde" => "xsd:string",
    "fechaHasta" => "xsd:string", 
    "cargo" => "xsd:string",
    "grupoPago" => "xsd:string",
    "vrSalario" => "xsd:integer",
    "vigente" => "xsd:integer"), array("return" => "xsd:string"), "urn:administracion", "urn:administracion#getInsertarContrato", "rpc", "encoded", "Insertar contrato");


    function getInsertarEmpleado($codigoIdentificacionTipo, $identificacionNumero, $nombre1, $nombre2, $apellido1, $apellido2, $nombreCorto, $correo) {
    $respuesta = "01";
    $servidor = conectar();
    $strSql = "SELECT codigo_empleado_pk FROM empleado WHERE codigo_identificacion_tipo_fk = '" . $codigoIdentificacionTipo . "' AND identificacion_numero = '" . $identificacionNumero . "'";
    if ($sentencia = $servidor->prepare($strSql)) {
        $sentencia->execute();
        $sentencia->store_result();
        if ($sentencia->num_rows <= 0) {
            $strSql = "INSERT INTO empleado (codigo_identificacion_tipo_fk, identificacion_numero, nombre1, nombre2, apellido1, apellido2, nombre_corto, correo) VALUES ('$codigoIdentificacionTipo', '$identificacionNumero', '$nombre1', '$nombre2', '$apellido1', '$apellido2', '$nombreCorto', '$correo');";
            if ($servidor->query($strSql) === TRUE) {
                $respuesta = "01";
            } else {
                $respuesta = "02" . $servidor->error;
            }
        } else {
            $respuesta = "01";
        }
        $sentencia->close();
    }
    return $respuesta;
}

    function getInsertarPago($codigoIdentificacionTipo, $identificacionNumero, $codigoEmpresa, $numero, $codigoPagoTipo, $codigoContrato, $fechaDesde, $fechaHasta, $vrSalario, $vrSalarioEmpleado, $vrDeduccion, $vrNeto, $vrDevengado, $cargo, $grupoPago, $zona, $periodoPago, $cuenta, $banco, $pension, $salud ) {    
    $respuesta = "02No se ejecuto ninguna sentencia";
    $servidor = conectar();    
    $strSql = "SELECT codigo_pago_pk FROM pago WHERE codigo_empresa_fk = " . $codigoEmpresa . " AND numero = '" . $numero . "'";
    if ($sentencia = $servidor->prepare($strSql)) {
        $sentencia->execute();
        $sentencia->store_result();
        if ($sentencia->num_rows <= 0) {
            $strSql = "SELECT codigo_empleado_pk FROM empleado WHERE codigo_identificacion_tipo_fk = '$codigoIdentificacionTipo' AND identificacion_numero = '$identificacionNumero';";
            if ($arEmpleados = $servidor->query($strSql, MYSQLI_USE_RESULT)) {
                $arEmpleado = $arEmpleados->fetch_assoc();
                $codigoEmpleado = $arEmpleado['codigo_empleado_pk'];
                $arEmpleados->close();
                $strSql = "INSERT INTO pago (codigo_empresa_fk, codigo_pago_tipo_fk, codigo_contrato, codigo_empleado_fk, fecha_desde, fecha_hasta, numero, vr_deducciones, vr_neto, vr_devengado, cargo, grupo_pago, zona, periodo_pago, cuenta, banco, pension, salud, vr_salario, vr_salario_empleado) VALUES ('$codigoEmpresa', '$codigoPagoTipo', '$codigoContrato', '$codigoEmpleado','$fechaDesde','$fechaHasta' , '$numero', '$vrDeduccion', '$vrNeto', '$vrDevengado', '$cargo', '$grupoPago', '$zona', '$periodoPago', '$cuenta', '$banco', '$pension', '$salud', '$vrSalario','$vrSalarioEmpleado');";
                if ($servidor->query($strSql) === TRUE) {
                    $respuesta = "01";
                } else {
                    $respuesta = "02" . $servidor->error;
                }                   
            } else {
                $respuesta = '02'.$servidor->error;
            }           
        } else {
            $respuesta = "01";
        }
        $sentencia->close();
    }
    return $respuesta;
}                                                                                                                                                           
                                                                                                                                  
    function getInsertarPagoDetalle($codigoEmpresa, $numero, $codigo, $codigoConcepto, $nombreConcepto, $operacion, $horas, $dias, $porcentaje, $vrHora, $vrPago) {
    $respuesta = "02No se ejecuta ninguna sentencia";
    $servidor = conectar();
    $strSql = "SELECT codigo_pago_detalle_pk FROM pago_detalle WHERE codigo = " . $codigo;
    if ($sentencia = $servidor->prepare($strSql)) {
        $sentencia->execute();
        $sentencia->store_result();
        if ($sentencia->num_rows <= 0) {
            $strSql = "SELECT codigo_pago_pk FROM pago WHERE codigo_empresa_fk = '$codigoEmpresa' AND numero = '$numero';";
            if ($arPagos = $servidor->query($strSql, MYSQLI_USE_RESULT)) {
                $arPago = $arPagos->fetch_assoc();
                $codigoPago = $arPago['codigo_pago_pk'];
                $arPagos->close();
                
                $strSql = "INSERT INTO pago_detalle (codigo, codigo_pago_fk, codigo_empresa_fk, numero, codigo_concepto_fk, nombre_concepto, operacion, horas, dias, porcentaje, vr_hora, vr_pago ) VALUES ('$codigo', '$codigoPago', '$codigoEmpresa', '$numero','$codigoConcepto', '$nombreConcepto', '$operacion', '$horas', '$dias', '$porcentaje', '$vrHora', '$vrPago');";
                if ($servidor->query($strSql) === TRUE) {
                    $respuesta = "01";
                } else {
                    $respuesta = "02" .$servidor->error;
                }                
            } else {
                $respuesta = "02".$servidor->error;
            }
        } else {
            $respuesta = "01";
        }
        $sentencia->close();
    } else {
        $respuesta = "02".$servidor->error;
    }
    return $respuesta;
}

    function getInsertarContrato($codigoEmpresa, $numero, $codigo, $codigoClase, $codigoIdentificacionTipo, $identificacionNumero, $fechaDesde, $fechaHasta, $cargo, $grupoPago, $vrSalario, $vigente) {    
    $respuesta = "02No se ejecuto ninguna sentencia";
    $servidor = conectar();    
    $strSql = "SELECT codigo_pago_pk FROM pago WHERE codigo_empresa_fk = " . $codigoEmpresa . " AND numero = '" . $numero . "'";
    if ($sentencia = $servidor->prepare($strSql)) {
        $sentencia->execute();
        $sentencia->store_result();
        if ($sentencia->num_rows <= 0) {
            $strSql = "SELECT codigo_empleado_pk FROM empleado WHERE codigo_identificacion_tipo_fk = '$codigoIdentificacionTipo' AND identificacion_numero = '$identificacionNumero';";
            if ($arEmpleados = $servidor->query($strSql, MYSQLI_USE_RESULT)) {
                $arEmpleado = $arEmpleados->fetch_assoc();
                $codigoEmpleado = $arEmpleado['codigo_empleado_pk'];
                $arEmpleados->close();                
                $strSql = "INSERT INTO contrato (codigo_empresa_fk, numero, codigo, codigo_clase_fk, codigo_empleado_fk, fecha_desde, fecha_hasta, cargo, grupo_pago, vr_salario, vigente) VALUES ('$codigoEmpresa', '$numero', '$codigo', '$codigoClase', '$codigoEmpleado','$fechaDesde','$fechaHasta' , '$cargo', '$grupoPago', '$vrSalario', '$vigente');";
                if ($servidor->query($strSql) === TRUE) {
                    $respuesta = "01";
                } else {
                    $respuesta = "02" . $servidor->error . $strSql;
                }                   
            } else {
                $respuesta = '02'.$servidor->error;
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