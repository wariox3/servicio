<?php
    require_once "nusoap/lib/nusoap.php";
    $cliente = new nusoap_client("http://localhost/servicio/servidor.php");
      
    $error = $cliente->getError();
    if ($error) {
        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
    }
      
    $result = $cliente->call("getInsertarEmpleado", 
            array("codigoTipoIdentificacion" => "CC",
                "identificacion" => "70143086"));
      
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