<?php

function conectar()
{
    $servidor = new mysqli("localhost", "usrardisoga", "Fua43uWYVBdNfqB2", "bdardi");
    if ($servidor->connect_error) {
        die("Connection failed: " . $servidor->connect_error);
    }
    return $servidor;
}
