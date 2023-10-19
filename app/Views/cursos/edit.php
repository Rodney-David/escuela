<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>EDITAR CURSO</h1>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<form method="post" action="<?= base_url('actualizar-cursos/'.$curso['id']) ?>">
    <div class="form-floating mb-3">
        <input type="number" class="form-control" name="nivel" id="nivel" value="<?= $curso['nivel'] ?>" required>
        <label for="floatingInput">Nivel</label>        
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="seccion" id="seccion" value="<?= $curso['seccion'] ?>" required>
        <label for="floatingInput">Seccion</label> 
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="periodo" id="periodo" value="<?= $curso['periodo'] ?>" required>
        <label for="floatingInput">Periodo</label>
    </div>
    <input type="hidden" name="id" value="<?= $curso['id'] ?>">
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?= $this->endsection() ?>