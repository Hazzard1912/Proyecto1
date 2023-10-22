<?php
include '../actions/clientes.php';
include '../actions/contratos.php';
include '../actions/pagos.php';
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
        var_dump($clientes);

        foreach ($clientes as $cliente) {
        ?>

          <option value="<?php echo $cliente['numero_cliente']; ?>">
            <?php echo $cliente['numero_cliente']; ?>
          </option>
        <?php
        }
        ?>
      </select>

      <label for="codigo_contrato">
        Contrato
      </label>
      <select name="codigo_contrato" id="codigo_contrato" class="form-control mt-2" required></select>
      <label for="monto">Monto a Pagar</label>
      <input type="number" name="monto" id="monto" class="form-control mt-2" required>
      <input type="submit" value="Pagar Contrato" class="btn btn-primary my-2">
    </div>
  </form>
</div>

<script src="../js/evitar-repost.js"></script>

<script>
  document.getElementById("numero_cliente").addEventListener("change", function() {
    var numeroCliente = this.value;
    var codigoContrato = document.getElementById("codigo_contrato");

    // Limpia las opciones actuales
    codigoContrato.innerHTML = "";

    var url = "../actions/contratos.php?numero_cliente=" + numeroCliente;

    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var contratos = JSON.parse(xhr.responseText);

        for (var i = 0; i < contratos.length; i++) {
          var option = document.createElement("option");
          option.value = contratos[i]['codigo_contrato'];
          option.textContent = contratos[i]['codigo_contrato'];
          codigoContrato.appendChild(option);
        }
      }
    };
    xhr.send();
  });
</script>

<?php

if (isset($_POST['numero_cliente'])  && isset($_POST['codigo_contrato']) && isset($_POST['monto'])) {

  $numero_cliente = $_POST['numero_cliente'];
  $codigo_contrato = $_POST['codigo_contrato'];
  $monto = $_POST['monto'];

  $resp = obtenerSaldo($codigo_contrato);
  $saldo_pendiente = $resp['saldo_pendiente'];

  if ($saldo_pendiente - $monto < 0) {
    echo "El monto supera el saldo pendiente";
    return;
  }

  $nuevo_saldo = $saldo_pendiente - $monto;

  actualizarSaldo($codigo_contrato, $nuevo_saldo);

  crearPago($numero_cliente, $codigo_contrato, $monto);

  echo "<script>";
  echo "alert('¡Registro exitoso!');";
  echo "</script>";
}
