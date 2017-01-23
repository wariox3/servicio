<?php

function conectar() {
    $servidor = new mysqli("localhost", "root", "70143086", "bdardid");
    if ($servidor->connect_error) {
        die("Connection failed: " . $servidor->connect_error);
    }
    return $servidor;
}
