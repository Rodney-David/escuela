<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>EDITAR MATERIA</h1>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<form method="post" action="<?= base_url('actualizar_materias/'.$materia['id']) ?>">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="nombre" id="nombre" value="<?= $materia['nombre']?>" required>
        <label for="floatingInput">Nombre</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="codigo" id="codigo" value="<?= $materia['codigo']?>" required>
        <label for="floatingInput">Codigo</label> 
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="estado" <?php echo  $materia['estado'] == "1" ? 'checked' : '' ?>>
        <label class="form-check-label" for="flexCheckDefault">
            Estado
        </label>
    </div>
    <input type="hidden" name="id" value="<?= $materia['id'] ?>">
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?= $this->endsection() ?>