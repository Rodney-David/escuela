<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>

<h1>MATERIAS</h1>
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
  <a class="btn btn-primary" href="<?= base_url("create_materias") ?>">Añadir Materia</a>
<?php if (!empty($materias) && is_array($materias)): ?>
  <table class="table">
  <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Codigo</th>
        <th>Estado</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($materias as $materia): ?>
        <tr>
          <th scope="row"><?= $materia['id'] ?></th>
          <td><?= $materia['nombre'] ?></td>
          <td><?= $materia['codigo'] ?></td>
          <td style= "color:<?= $materia['estado'] == '1' ? 'green' : 'red' ?> "><?= $materia['estado'] == '1' ? 'Activo' : 'Inactivo' ?></td>
          <td><div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Opciones
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url("editar_materias/".$materia['id']) ?>">Editar</a></li>
                <li><a class="dropdown-item" href="<?= base_url("eliminar_materias/".$materia['id']) ?>">Eliminar</a></li>
            </ul>
          </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No hay materias registrados.</p>
<?php endif; ?>
  <?php echo $paginador->links();?>
<?= $this->endSection() ?>