<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>ASIGNAR MATERIA</h1>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<form method="post" action="<?= base_url('guardar_inscripcion_materia/'.$curso['id']) ?>">
<select class="form-select" aria-label="Default select example" name="materias_id">
  <option selected>Seleccionar Materia</option>
  <?php foreach($materias as $materia){
    ?>
        <option value="<?= $materia['id'] ?>" ><?= $materia['nombre'] ?></option>
    <?php
  } ?>
</select>
<select class="form-select" aria-label="Default select example" name="docentes_id">
  <option selected>Seleccionar Docente</option>
  <?php foreach($docentes as $docente){
    ?>
        <option value="<?= $docente['id'] ?>" ><?= $docente['nombres'] . ' ' . $docente['apellidos']?></option>
    <?php
  } ?>
</select>
    <button type="submit" class="btn btn-primary">Inscribir Materia</button>
</form>

<?= $this->endsection() ?>