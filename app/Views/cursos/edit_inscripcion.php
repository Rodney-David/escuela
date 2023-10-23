<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>ACTUALIZAR INSCRIPCION</h1>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<form method="post" action="<?= base_url('actualizar_inscripcion/'.$inscripcion['id']) ?>">
<select class="form-select" aria-label="Default select example" name="estudiantes_id" disabled>
  <option>Seleccionar Estudiante</option>
  <?php foreach($estudiantes as $estudiante){
    ?>
        <option value="<?= $estudiante['id'] ?>" <?php echo  $estudiante['id'] == $inscripcion['estudiantes_id'] ? 'selected' : '' ?> ><?= $estudiante['nombres'] . ' ' . $estudiante['apellidos']?></option>
    <?php
  } ?>
</select>
<div class="form-check">
  <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="estado" <?php echo  $inscripcion['estado'] == "1" ? 'checked' : '' ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Estado
  </label>
</div>
    <button type="submit" class="btn btn-primary">Inscribir Estudiante</button>
</form>

<?= $this->endsection() ?>