<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>AÑADIR MATERIA</h1>
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
<form method="post" action="<?= base_url()."registro_de_materias" ?>" >
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="nombre" id="nombre" value="<?= old('nombre')?>" required>
        <label for="floatingInput">Nombre</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="codigo" id="codigo" value="<?= old('nombre')?>" required>
        <label for="floatingInput">Codigo</label> 
    </div>
    <button type="submit" class="btn btn-primary">Añadir</button>
</form>

<?= $this->endsection() ?>