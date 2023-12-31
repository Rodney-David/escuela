<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>AÑADIR DOCENTE</h1>
<?php if (session()->has('success')): ?>
    <div class="alert alert-success">
        <?= session('success') ?>
    </div>
<?php endif; ?>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<form method="post" action="<?= base_url()."registro_de_docentes" ?>" >
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="nombres" id="nombres" value="<?= old("nombres") ?>" required>
        <label for="floatingInput">Nombres</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="apellidos" id="apellidos" required>
        <label for="floatingInput">Apellidos</label> 
    </div>
    <select class="form-select" aria-label="Default select example" name="sexo" id="sexo" required>
        <option selected>Seleccionar sexo:</option>
        <option value="M">Masculino</option>
        <option value="F">Femenino</option>
    </select>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" name="email" id="email" required>
        <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating mb-3">
        <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" required>
        <label for="floatingInput">Fecha de nacimiento</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="direccion" id="direccion" required>
        <label for="floatingInput">Direccion</label>
    </div>
    <button type="submit" class="btn btn-primary">Añadir</button>
</form>

<?= $this->endsection() ?>