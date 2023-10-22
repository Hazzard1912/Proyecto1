<?php
include_once "../db/db.php";

function crearPago($numero_cliente, $codigo_contrato, $monto)
{

  $conexion = conectarDB();
  $sql = "INSERT INTO pagos (numero_cliente, codigo_contrato, monto) VALUES (?,?,?)";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([
      $numero_cliente, $codigo_contrato, $monto
    ]);
    return true;
  } catch (PDOException $e) {
    return false;
  }
}

function obtenerPagos($numero_cliente, $codigo_contrato)
{
  $conexion = conectarDB();
  $sql = "SELECT * FROM pagos WHERE numero_cliente = ? and codigo_contrato = ?";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$numero_cliente, $codigo_contrato]);
    $pagos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $pagos;
  } catch (PDOException $e) {
    return false;
  }
}

function eliminarPago($codigo)
{
  $conexion = conectarDB();
  $sql = "DELETE FROM pagos WHERE codigo = ?";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$codigo]);
    return true;
  } catch (PDOException $e) {
    return false;
  }
}
