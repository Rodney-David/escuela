<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>AÑADIR ESTUDIANTE</h1>
<form method="post" action="<?= base_url()."public/registro-de-estudiantes" ?>">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="nombres" id="floatingInput" required>
        <label for="floatingInput">Nombres</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="apellidos" id="floatingInput" required>
        <label for="floatingInput">Apellidos</label> 
    </div>
    <div class="form-floating mb-3">
        <input type="enail" class="form-control" name="email" id="floatingInput" required>
        <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating mb-3">
        <input type="date" class="form-control" name="fecha_nacimiento" id="floatingInput" required>
        <label for="floatingInput">Fecha de nacimiento</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="direccion" id="floatingInput" required>
        <label for="floatingInput">Direccion</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?= $this->endsection() ?>