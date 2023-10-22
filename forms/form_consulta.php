<?php
include '../actions/contratos.php';
include '../actions/saldos.php';
?>
<div class="col-sm-8 mx-auto">

  <form action="" method="post" class="mt-4">
    <div class="form-group">
      <label for="codigo_contrato">Contrato</label>
      <select name="codigo_contrato" id="codigo_contrato" class="form-control" required>
        <option></option>
        <?php
        $contratos = obtenerTodosContratos();
        foreach ($contratos as $contrato) {
        ?>

          <option value="<?php echo $contrato['codigo_contrato']; ?>">
            <?php echo $contrato['codigo_contrato']; ?>
          </option>
        <?php
        }
        ?>
      </select>
      <input type="submit" value="Consultar" class="btn btn-primary my-2">
    </div>
  </form>
  
</div>

<script src="../js/evitar-repost.js"></script>



<?php
if (isset($_POST['codigo_contrato'])) {

  $codigo_contrato = $_POST['codigo_contrato'];

  $resp = obtenerSaldo($codigo_contrato);
  $saldo_pendiente = $resp['saldo_pendiente'];

  echo "<h2>Saldo Pendiente: $saldo_pendiente</h2>";
}
