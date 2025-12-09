<select name="departamento_id" class="form-control">
  <option value="">Seleccione un departamento</option>
  <?php
  $sql = "SELECT * FROM departamentos ORDER BY nombre";
  $res = $mysqli->query($sql);
  while ($row = $res->fetch_assoc()) { ?>
    <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['nombre']) ?></option>
  <?php } ?>
</select>