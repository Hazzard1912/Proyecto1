<?php
include_once "../db/db.php";

function crearCliente($tipo_identificacion, $numero_cliente, $nombre, $telefono, $ciudad, $correo)
{

  $conexion = conectarDB();
  $sql = "INSERT INTO clientes (tipo_identificacion, numero_cliente, nombre, telefono, ciudad, correo) VALUES (?,?,?,?,?,?)";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([
      $tipo_identificacion, $numero_cliente, $nombre, $telefono, $ciudad, $correo
    ]);
    return true;
  } catch (PDOException $e) {
    return false;
  }
}

function obtenerCliente($id_cliente)
{
  $conexion = conectarDB();
  $sql = "SELECT * FROM clientes WHERE codigo = ?";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$id_cliente]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    return $cliente;
  } catch (PDOException $e) {
    return false;
  }
}

function obtenerClientes()
{
  $conexion = conectarDB();
  $sql = "SELECT * FROM clientes";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $clientes;
  } catch (PDOException $e) {
    return false;
  }
}

function actualizarCliente($id_cliente, $nombre, $telefono, $ciudad, $correo)
{
  $conexion = conectarDB();
  $sql = "UPDATE clientes SET nombre = ?, telefono = ?, ciudad = ?, correo = ? WHERE codigo = ?";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$nombre, $telefono, $ciudad, $correo, $id_cliente]);
    return true;
  } catch (PDOException $e) {
    return false;
  }
}

function eliminarCliente($id_cliente)
{
  $conexion = conectarDB();
  $sql = "DELETE FROM clientes WHERE codigo = ?";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$id_cliente]);
    return true;
  } catch (PDOException $e) {
    return false;
  }
}

