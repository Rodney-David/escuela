<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>ACTUALIZAR ASIGNACION</h1>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<form method="post" action="<?= base_url('actualizar_inscripcion_materia/'.$materias_cursos['id']) ?>">
<select class="form-select" aria-label="Default select example" name="materias_id">
  <option selected>Seleccionar Materia</option>
  <?php foreach($materias as $materia){
    ?>
        <option value="<?= $materia['id'] ?>" <?php echo  $materia['id'] == $materias_cursos['materias_id'] ? 'selected' : '' ?> ><?= $materia['nombre'] ?></option>
    <?php
  } ?>
</select>
<select class="form-select" aria-label="Default select example" name="docentes_id">
  <option selected>Seleccionar Docente</option>
  <?php foreach($docentes as $docente){
    ?>
        <option value="<?= $docente['id'] ?>" <?php echo  $docente['id'] == $materias_cursos['docentes_id'] ? 'selected' : '' ?> ><?= $docente['nombres'] . ' ' . $docente['apellidos']?></option>
    <?php
  } ?>
</select>
<div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="estado" <?php echo  $materias_cursos['estado'] == "1" ? 'checked' : '' ?>>
        <label class="form-check-label" for="flexCheckDefault">
            Estado
        </label>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>

<?= $this->endsection() ?>