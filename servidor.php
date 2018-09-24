<?php

require_once "nusoap/lib/nusoap.php";
require_once "conexion.php";
$server = new soap_server();
$server->configureWSDL("funcionesArdid", "urn:funciones");

$server->register("getPrueba", array(
    "parametro" => "xsd:string"
), array("return" => "xsd:string"), "urn:administracion", "urn:administracion#getPrueba", "rpc", "encoded", "Prueba funcionamiento");

$server->register("getInsertarEmpleado", array(
    "codigoIdentificacionTipo" => "xsd:string",
    "identificacionNumero" => "xsd:string",
    "lugarExpedicionIdentificacion" => "xsd:string",
    "nombre1" => "xsd:string",
    "nombre2" => "xsd:string",
    "apellido1" => "xsd:string",
    "apellido2" => "xsd:string",
    "nombreCorto" => "xsd:string",
    "correo" => "xsd:string"
), array("return" => "xsd:string"), "urn:administracion", "urn:administracion#getInsertarEmpleado", "rpc", "encoded", "Insertar empleados");

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
    "salud" => "xsd:string",
    "codigoSoportePago" => "xsd:integer",
    "mensajePago" => "xsd:string"), array("return" => "xsd:string"), "urn:administracion", "urn:administracion#getInsertarPago", "rpc", "encoded", "Insertar pago");

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
    "codigo" => "xsd:integer",
    "tipo" => "xsd:string",
    "numero" => "xsd:string",
    "codigoClase" => "xsd:integer",
    "codigoIdentificacionTipo" => "xsd:string",
    "identificacionNumero" => "xsd:string",
    "fechaDesde" => "xsd:string",
    "fechaHasta" => "xsd:string",
    "cargo" => "xsd:string",
    "grupoPago" => "xsd:string",
    "vrSalario" => "xsd:integer",
    "vigente" => "xsd:integer",
    "auxilioTransporte" => "xsd:integer"), array("return" => "xsd:string"), "urn:administracion", "urn:administracion#getInsertarContrato", "rpc", "encoded", "Insertar contrato");

$server->register("getInsertarProgramacion", array(
    "codigoEmpresa" => "xsd:integer",
    "codigoSoportePago" => "xsd:integer",
    "dia1" => "xsd:string",
    "dia2" => "xsd:string",
    "dia3" => "xsd:string",
    "dia4" => "xsd:string",
    "dia5" => "xsd:string",
    "dia6" => "xsd:string",
    "dia7" => "xsd:string",
    "dia8" => "xsd:string",
    "dia9" => "xsd:string",
    "dia10" => "xsd:string",
    "dia11" => "xsd:string",
    "dia12" => "xsd:string",
    "dia13" => "xsd:string",
    "dia14" => "xsd:string",
    "dia15" => "xsd:string",
    "dia16" => "xsd:string",
    "dia17" => "xsd:string",
    "dia18" => "xsd:string",
    "dia19" => "xsd:string",
    "dia20" => "xsd:string",
    "dia21" => "xsd:string",
    "dia22" => "xsd:string",
    "dia23" => "xsd:string",
    "dia24" => "xsd:string",
    "dia25" => "xsd:string",
    "dia26" => "xsd:string",
    "dia27" => "xsd:string",
    "dia28" => "xsd:string",
    "dia29" => "xsd:string",
    "dia30" => "xsd:string",
    "dia31" => "xsd:string"), array("return" => "xsd:string"), "urn:administracion", "urn:administracion#getInsertarProgramacion", "rpc", "encoded", "Insertar programacion");

function getInsertarEmpleado($codigoIdentificacionTipo, $identificacionNumero, $lugarExpedicionIdentificacion, $nombre1, $nombre2, $apellido1, $apellido2, $nombreCorto, $correo)
{
    $respuesta = "01";
    $servidor = conectar();
    $strSql = "SELECT codigo_empleado_pk FROM empleado WHERE codigo_identificacion_tipo_fk = '" . $codigoIdentificacionTipo . "' AND identificacion_numero = '" . $identificacionNumero . "'";
    if ($sentencia = $servidor->prepare($strSql)) {
        $sentencia->execute();
        $sentencia->store_result();
        if ($sentencia->num_rows <= 0) {
            $strSql = "INSERT INTO empleado ("
                . "codigo_identificacion_tipo_fk, "
                . "identificacion_numero, "
                . "lugar_expedicion_identificacion, "
                . "nombre1, "
                . "nombre2, "
                . "apellido1, "
                . "apellido2, "
                . "nombre_corto, "
                . "correo) VALUES ("
                . "'$codigoIdentificacionTipo', "
                . "'$identificacionNumero', "
                . "'$lugarExpedicionIdentificacion', "
                . "'$nombre1', "
                . "'$nombre2', "
                . "'$apellido1', "
                . "'$apellido2', "
                . "'$nombreCorto', "
                . "'$correo'"
                . ");";
            if ($servidor->query($strSql) === TRUE) {
                $respuesta = "01";
            } else {
                $respuesta = "02" . $servidor->error;
            }
        } else {
            $strSql = "UPDATE empleado SET "
                . "codigo_identificacion_tipo_fk = '$codigoIdentificacionTipo', "
                . "identificacion_numero = '$identificacionNumero', "
                . "lugar_expedicion_identificacion = '$lugarExpedicionIdentificacion', "
                . "nombre1 = '$nombre1', "
                . "nombre2 = '$nombre2', "
                . "apellido1 = '$apellido1', "
                . "apellido2 = '$apellido2', "
                . "nombre_corto = '$nombreCorto', "
                . "correo = '$correo' WHERE identificacion_numero = '$identificacionNumero' AND codigo_identificacion_tipo_fk = '$codigoIdentificacionTipo';";
            if ($servidor->query($strSql) === TRUE) {
                $respuesta = "01";
            } else {
                $respuesta = "02" . $servidor->error . $strSql;
            }
        }
        $sentencia->close();
    }
    return $respuesta;
}

function getInsertarPago($codigoIdentificacionTipo, $identificacionNumero, $codigoEmpresa, $numero, $codigoPagoTipo, $codigoContrato, $fechaDesde, $fechaHasta, $vrSalario, $vrSalarioEmpleado, $vrDeduccion, $vrNeto, $vrDevengado, $cargo, $grupoPago, $zona, $periodoPago, $cuenta, $banco, $pension, $salud, $codigoSoportePago, $mensajePago)
{
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
                $strSql = "INSERT INTO pago (codigo_empresa_fk, codigo_pago_tipo_fk, codigo_contrato, codigo_empleado_fk, fecha_desde, fecha_hasta, numero, vr_deducciones, vr_neto, vr_devengado, cargo, grupo_pago, zona, periodo_pago, cuenta, banco, pension, salud, vr_salario, vr_salario_empleado, codigo_soporte_pago_fk, mensaje_pago) VALUES ('$codigoEmpresa', '$codigoPagoTipo', '$codigoContrato', '$codigoEmpleado','$fechaDesde','$fechaHasta' , '$numero', '$vrDeduccion', '$vrNeto', '$vrDevengado', '$cargo', '$grupoPago', '$zona', '$periodoPago', '$cuenta', '$banco', '$pension', '$salud', '$vrSalario','$vrSalarioEmpleado', '$codigoSoportePago', '$mensajePago');";
                if ($servidor->query($strSql) === TRUE) {
                    $respuesta = "01";
                } else {
                    $respuesta = "02" . $servidor->error;
                }
            } else {
                $respuesta = '02' . $servidor->error;
            }
        } else {
            $respuesta = "01";
        }
        $sentencia->close();
    }
    return $respuesta;
}

function getInsertarPagoDetalle($codigoEmpresa, $numero, $codigo, $codigoConcepto, $nombreConcepto, $operacion, $horas, $dias, $porcentaje, $vrHora, $vrPago)
{
    $respuesta = "02No se ejecuta ninguna sentencia";
    $servidor = conectar();
    $strSql = "SELECT codigo_pago_detalle_pk FROM pago_detalle WHERE codigo_empresa_fk = $codigoEmpresa AND codigo = " . $codigo;
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
                    $respuesta = "02" . $servidor->error . " " . $strSql;
                }
            } else {
                $respuesta = "02" . $servidor->error;
            }
        } else {
            $respuesta = "01";
        }
        $sentencia->close();
    } else {
        $respuesta = "02" . $servidor->error;
    }
    return $respuesta;
}

function getInsertarContrato($codigoEmpresa, $codigo, $tipo, $numero, $codigoClase, $codigoIdentificacionTipo, $identificacionNumero, $fechaDesde, $fechaHasta, $cargo, $grupoPago, $vrSalario, $vigente, $auxilioTransporte)
{
    $respuesta = "02No se ejecuto ninguna sentencia";
    $servidor = conectar();
    $strSql = "SELECT codigo_contrato_pk FROM contrato WHERE codigo_empresa_fk = " . $codigoEmpresa . " AND codigo = '" . $codigo . "'";
    if ($sentencia = $servidor->prepare($strSql)) {
        $sentencia->execute();
        $sentencia->store_result();
        if ($sentencia->num_rows <= 0) {
            $strSql = "SELECT codigo_empleado_pk FROM empleado WHERE codigo_identificacion_tipo_fk = '$codigoIdentificacionTipo' AND identificacion_numero = '$identificacionNumero';";
            if ($arEmpleados = $servidor->query($strSql, MYSQLI_USE_RESULT)) {
                $arEmpleado = $arEmpleados->fetch_assoc();
                $codigoEmpleado = $arEmpleado['codigo_empleado_pk'];
                $arEmpleados->close();
                $strSql = "INSERT INTO contrato ("
                    . "codigo_empresa_fk, "
                    . "codigo, "
                    . "tipo, "
                    . "numero, "
                    . "codigo_clase_fk, "
                    . "codigo_empleado_fk, "
                    . "fecha_desde, "
                    . "fecha_hasta, "
                    . "cargo, "
                    . "grupo_pago, "
                    . "vr_salario, "
                    . "vigente, "
                    . "auxilio_transporte) VALUES ("
                    . "'$codigoEmpresa', "
                    . "'$codigo', "
                    . "'$tipo', "
                    . "'$numero', "
                    . "'$codigoClase', "
                    . "'$codigoEmpleado',"
                    . "'$fechaDesde',"
                    . "'$fechaHasta' , "
                    . "'$cargo', "
                    . "'$grupoPago', "
                    . "'$vrSalario', "
                    . "'$vigente', "
                    . "'$auxilioTransporte');";
                if ($servidor->query($strSql) === TRUE) {
                    $respuesta = "01";
                } else {
                    $respuesta = "02" . $servidor->error . $strSql;
                }
            } else {
                $respuesta = '02' . $servidor->error;
            }
        } else {
            $strSql = "UPDATE contrato SET "
                . "vigente = '$vigente', "
                . "vr_salario = '$vrSalario', "
                . "cargo = '$cargo', "
                . "tipo = '$tipo', "
                . "auxilio_transporte = '$auxilioTransporte'"
                . " WHERE codigo_empresa_fk = " . $codigoEmpresa . " AND codigo = '" . $codigo . "';";
            if ($servidor->query($strSql) === TRUE) {
                $respuesta = "01";
            } else {
                $respuesta = "02" . $servidor->error . $strSql;
            }
        }
        $sentencia->close();
    }
    return $respuesta;
}

function getInsertarProgramacion($codigoEmpresa, $codigoSoportePago, $dia1, $dia2, $dia3, $dia4, $dia5, $dia6, $dia7, $dia8, $dia9, $dia10, $dia11, $dia12, $dia13, $dia14, $dia15, $dia16, $dia17, $dia18, $dia19, $dia20, $dia21, $dia22, $dia23, $dia24, $dia25, $dia26, $dia27, $dia28, $dia29, $dia30, $dia31)
{
    $respuesta = "02No se ejecuto ninguna sentencia";
    $servidor = conectar();
    $strSql = "SELECT codigo_programacion_pk FROM programacion WHERE codigo_empresa_fk = " . $codigoEmpresa . " AND codigo_soporte_pago_fk = '" . $codigoSoportePago . "'";
    if ($sentencia = $servidor->prepare($strSql)) {
        $sentencia->execute();
        $sentencia->store_result();
        if ($sentencia->num_rows <= 0) {
            $strSql = "INSERT INTO programacion ("
                . "codigo_empresa_fk, "
                . "codigo_soporte_pago_fk, "
                . "dia_1, "
                . "dia_2, "
                . "dia_3, "
                . "dia_4, "
                . "dia_5, "
                . "dia_6, "
                . "dia_7, "
                . "dia_8, "
                . "dia_9, "
                . "dia_10, "
                . "dia_11, "
                . "dia_12, "
                . "dia_13, "
                . "dia_14, "
                . "dia_15, "
                . "dia_16, "
                . "dia_17, "
                . "dia_18, "
                . "dia_19, "
                . "dia_20, "
                . "dia_21, "
                . "dia_22, "
                . "dia_23, "
                . "dia_24, "
                . "dia_25, "
                . "dia_26, "
                . "dia_27, "
                . "dia_28, "
                . "dia_29, "
                . "dia_30, "
                . "dia_31) VALUES ("
                . "'$codigoEmpresa', "
                . "'$codigoSoportePago', "
                . "'$dia1', "
                . "'$dia2', "
                . "'$dia3', "
                . "'$dia4', "
                . "'$dia5', "
                . "'$dia6', "
                . "'$dia7', "
                . "'$dia8', "
                . "'$dia9', "
                . "'$dia10', "
                . "'$dia11', "
                . "'$dia12', "
                . "'$dia13', "
                . "'$dia14', "
                . "'$dia15', "
                . "'$dia16', "
                . "'$dia17', "
                . "'$dia18', "
                . "'$dia19', "
                . "'$dia20', "
                . "'$dia21', "
                . "'$dia22', "
                . "'$dia23', "
                . "'$dia24', "
                . "'$dia25', "
                . "'$dia26', "
                . "'$dia27', "
                . "'$dia28', "
                . "'$dia29', "
                . "'$dia30', "
                . "'$dia31');";
            if ($servidor->query($strSql) === TRUE) {
                $respuesta = "01";
            } else {
                $respuesta = "02" . $servidor->error . $strSql;
            }
        } else {
            $respuesta = "01";
        }
        $sentencia->close();
    }
    return $respuesta;
}

function getPrueba($parametro)
{
    $respuesta = "Hola mundo";
    return $respuesta;
}

if (!isset($HTTP_RAW_POST_DATA))
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');

$server->service($HTTP_RAW_POST_DATA);
?>