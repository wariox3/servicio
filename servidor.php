<?php
    require_once "nusoap/lib/nusoap.php";
      
    function getInsertarEmpleado($codigoTipoIdentificacion, $identificacion) {
        return "Se inserto el empleado";
        /*if ($categoria == "libros") {
            return join(",", array(
                "El señor de los anillos",
                "Los límites de la Fundación",
                "The Rails Way"));
        }
        else {
            return "No hay productos de esta categoria";
        }*/
    }
    function getInsertarPago($codigoTipoIdentificacion, $identificacion) {
        return "Se inserto el empleado";
        /*if ($categoria == "libros") {
            return join(",", array(
                "El señor de los anillos",
                "Los límites de la Fundación",
                "The Rails Way"));
        }
        else {
            return "No hay productos de esta categoria";
        }*/
    }      
    $server = new soap_server();
    $server->configureWSDL("producto", "urn:producto");
      
    $server->register("getInsertarEmpleado",
        array("codigoTipoIdentificacion" => "xsd:string", "identificacion" => "xsd:string"),
        array("return" => "xsd:string"),
        "urn:administracion",
        "urn:administracion#getInsertarEmpleado",
        "rpc",
        "encoded",
        "Insertar empleados");
    if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );      
    $server->service($HTTP_RAW_POST_DATA);
?>