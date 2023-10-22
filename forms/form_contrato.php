<?php
include '../actions/clientes.php';
include '../actions/contratos.php';
include '../actions/saldos.php';
?>
<div class="col-sm-8 mx-auto">
  <form action="" method="post">
    <div class="form-group">

      <label for="numero_cliente">
        Cliente
      </label>
      <!-- Select para clientes -->
      <select id="numero_cliente" name="numero_cliente" class="form-control mt-2" required>
        <option></option>
        <?php
        $clientes = obtenerClientes();
        foreach ($clientes as $cliente) {
        ?>

          <option value="<?php echo $cliente['numero_cliente']; ?>">
            <?php echo $cliente['numero_cliente']; ?>
          </option>
        <?php
        }
        ?>
      </select>

      <label for="numero_linea">
        Línea
      </label>
      <input type="number" id="numero_linea" name="numero_linea" class="form-control mt-2" required>

      <label for="fecha_activacion">Fecha de Activación</label>
      <input type="date" name="fecha_activacion" id="fecha_activacion" class="form-control mt-2" required>

      <label for="valor_plan">Valor del Plan</label>
      <input type="number" id="valor_plan" name="valor_plan" class="form-control mt-2" required>

      <label for="estado">Estado</label>
      <select id="estado" name="estado" class="form-control mt-2">
        <option value="Activo">Activo</option>
        <option value="Inactivo">Inactivo</option>
      </select>

      <input type="submit" value="Crear Contrato" class="btn btn-primary my-2">
    </div>
  </form>
</div>


<script src="../js/evitar-repost.js"></script>



<?php

if (isset($_POST['numero_cliente'])  && isset($_POST['numero_linea']) && isset($_POST['fecha_activacion']) && isset($_POST['valor_plan']) && isset($_POST['estado'])) {

  $numero_cliente = $_POST['numero_cliente'];
  $numero_linea = $_POST['numero_linea'];
  $fecha_activacion = $_POST['fecha_activacion'];
  $valor_plan = $_POST['valor_plan'];
  $estado = $_POST['estado'];

  crearContrato($numero_cliente, $numero_linea, $fecha_activacion, $valor_plan, $estado);

  $resp = obtenerContratoNumeroLinea($numero_linea);
  $codigo_contrato = $resp['codigo_contrato'];

  crearSaldo($codigo_contrato, $valor_plan);

  echo "<script>";
  echo "alert('¡Registro exitoso!');";
  echo "</script>";
}
