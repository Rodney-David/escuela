<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>INSCRIBIR ESTUDIANTE</h1>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<form method="post" action="<?= base_url('guardar-inscripcion/'.$curso['id']) ?>">
<select class="form-select" aria-label="Default select example" name="estudiantes_id">
  <option selected>Seleccionar Estudiante</option>
  <?php foreach($estudiantes as $estudiante){
    ?>
        <option value="<?= $estudiante['id'] ?>" ><?= $estudiante['nombres'] . ' ' . $estudiante['apellidos']?></option>
    <?php
  } ?>
</select>
    <button type="submit" class="btn btn-primary">Inscribir Estudiante</button>
</form>

<?= $this->endsection() ?>