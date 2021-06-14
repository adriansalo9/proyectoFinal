<?php

// Si nuestro ajax está enviando datos a este fichero
if (isset($_GET)) {
    $mysqli = new mysqli('localhost', 'root', '', 'proyectofinal');
    $query = 'INSERT INTO snakes (score) VALUES('. $_POST['score'].')';
    $resultado = $mysqli->query($query);
    //$usuario = $resultado->fetch_assoc();
}