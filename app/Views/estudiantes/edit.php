<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>EDITAR ESTUDIANTE</h1>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<form method="post" action="<?= base_url('actualizar-estudiantes/'.$estudiante['id']) ?>">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="nombres" id="nombres" value="<?= $estudiante['nombres'] ?>" required>
        <label for="floatingInput">Nombres</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="apellidos" id="apellidos" value="<?= $estudiante['apellidos'] ?>" required>
        <label for="floatingInput">Apellidos</label> 
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" name="email" id="email" value="<?= $estudiante['email'] ?>" required>
        <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating mb-3">
        <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="<?= $estudiante['fecha_nacimiento'] ?>" required>
        <label for="floatingInput">Fecha de nacimiento</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="direccion" id="direccion" value="<?= $estudiante['direccion'] ?>" required>
        <label for="floatingInput">Direccion</label>
    </div>
    <input type="hidden" name="id" value="<?= $estudiante['id'] ?>">
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?= $this->endsection() ?>