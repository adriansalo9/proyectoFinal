<?php

// Si nuestro ajax está enviando datos a este fichero
if (isset($_POST)) {
    $mysqli = new mysqli('localhost', 'root', '', 'proyectofinal');
    $query = 'INSERT INTO mines (minutos,segundos,centesimas) VALUES('. $_POST['minutos'].','.$_POST['segundos'].','.$_POST['centesimas'].')';
    $resultado = $mysqli->query($query);
    //$usuario = $resultado->fetch_assoc();
}
