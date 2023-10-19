<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>AÑADIR CURSO</h1>
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
<form method="post" action="<?= base_url()."registro-de-cursos" ?>" >
    <div class="form-floating mb-3">
        <input type="number" class="form-control" name="nivel" id="nivel" value="<?= old('nivel')?>" required>
        <label for="floatingInput">Nivel</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="seccion" id="seccion" value="<?= old('seccion')?>" required>
        <label for="floatingInput">Seccion</label> 
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="periodo" id="periodo" value="<?= old('periodo')?>" required>
        <label for="floatingInput">Periodo</label>
    </div>
    <button type="submit" class="btn btn-primary">Añadir</button>
</form>

<?= $this->endsection() ?>