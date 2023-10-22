<?php
include_once "../db/db.php";

function crearSaldo($codigo_contrato, $saldo_pendiente)
{

  $conexion = conectarDB();
  $sql = "INSERT INTO saldos (codigo_contrato, saldo_pendiente) VALUES (?,?)";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([
      $codigo_contrato, $saldo_pendiente
    ]);
    return true;
  } catch (PDOException $e) {
    return false;
  }
}

function obtenerSaldo($codigo_contrato)
{
  $conexion = conectarDB();
  $sql = "SELECT saldo_pendiente FROM saldos WHERE codigo_contrato = ?";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$codigo_contrato]);
    $saldo_pendiente = $stmt->fetch(PDO::FETCH_ASSOC);
    return $saldo_pendiente;
  } catch (PDOException $e) {
    return false;
  }
}

function actualizarSaldo($codigo_contrato, $saldo_pendiente)
{
  $conexion = conectarDB();
  $sql = "UPDATE saldos SET saldo_pendiente = ? WHERE codigo_contrato = ?";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$saldo_pendiente, $codigo_contrato]);
    return true;
  } catch (PDOException $e) {
    return false;
  }
}

function eliminarSaldo($codigo_contrato)
{
  $conexion = conectarDB();
  $sql = "DELETE FROM saldos WHERE codigo_contrato = ?";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$codigo_contrato]);
    return true;
  } catch (PDOException $e) {
    return false;
  }
}
