<?php

function conectarDB()
{

  $host = "localhost";
  $db = "empresa_telefonia";
  $username = "admin";
  $password = "admin";

  try {

    $conexion = new PDO("pgsql:host=$host;dbname=$db", $username, $password);

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $conexion;
  } catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
  }
}
