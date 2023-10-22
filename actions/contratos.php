<?php
include_once "../db/db.php";

function crearContrato($numero_cliente, $numero_linea, $fecha_activacion, $valor_plan, $estado)
{

  $conexion = conectarDB();
  $sql = "INSERT INTO contratos (numero_cliente, numero_linea, fecha_activacion, valor_plan, estado) VALUES (?,?,?,?,?)";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([
      $numero_cliente, $numero_linea, $fecha_activacion, $valor_plan, $estado
    ]);
    return true;
  } catch (PDOException $e) {
    return false;
  }
}

function obtenerContrato($codigo_contrato)
{
  $conexion = conectarDB();
  $sql = "SELECT * FROM contratos WHERE codigo_contrato = ?";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$codigo_contrato]);
    $contrato = $stmt->fetch(PDO::FETCH_ASSOC);
    return $contrato;
  } catch (PDOException $e) {
    return false;
  }
}

function obtenerContratoNumeroLinea($numero_linea)
{
  $conexion = conectarDB();
  $sql = "SELECT * FROM contratos WHERE numero_linea = ?";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$numero_linea]);
    $contrato = $stmt->fetch(PDO::FETCH_ASSOC);
    return $contrato;
  } catch (PDOException $e) {
    return false;
  }
}

function obtenerTodosContratos()
{
  $conexion = conectarDB();
  $sql = "SELECT * FROM contratos";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $contratos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $contratos;
  } catch (PDOException $e) {
    return false;
  }
}


if (isset($_GET['numero_cliente'])) {
  $numero_cliente = $_GET['numero_cliente'];
  $contratos = obtenerContratos($numero_cliente);
  header('Content-Type: application/json');
  echo json_encode($contratos);
}

function obtenerContratos($numero_cliente)
{
  $conexion = conectarDB();
  $sql = "SELECT codigo_contrato FROM contratos WHERE numero_cliente = ?";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$numero_cliente]);
    $contratos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $contratos;
  } catch (PDOException $e) {
    return false;
  }
}

function actualizarContrato($codigo_contrato, $numero_cliente, $numero_linea, $fecha_activacion, $valor_plan, $estado)
{
  $conexion = conectarDB();
  $sql = "UPDATE contratos SET numero_cliente = ?, numero_linea = ?, fecha_activacion = ?, valor_plan = ?, estado = ? WHERE codigo_contrato = ?";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$numero_cliente, $numero_linea, $fecha_activacion, $valor_plan, $estado, $codigo_contrato]);
    return true;
  } catch (PDOException $e) {
    return false;
  }
}

function eliminarContrato($codigo_contrato)
{
  $conexion = conectarDB();
  $sql = "DELETE FROM contratos WHERE codigo_contrato = ?";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$codigo_contrato]);
    return true;
  } catch (PDOException $e) {
    return false;
  }
}
