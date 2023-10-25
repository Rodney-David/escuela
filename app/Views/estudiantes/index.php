<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>

<h1>ESTUDIANTES</h1>
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
  <a class="btn btn-primary" href="<?= base_url("create-estudiantes") ?>">Añadir Estudiante</a>
  <a class="btn btn-success" href="<?= base_url("generarExcel_estudiantes") ?>">General Excel</a>
<?php if (!empty($estudiantes) && is_array($estudiantes)): ?>
  <table class="table">
  <thead>
      <tr>
        <th>ID</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Email</th>
        <th>Fecha de Nacimiento</th>
        <th>Dirección</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
    <?php //$contador = 1; 
       foreach ($estudiantes as $estudiante): ?>
        <tr>
          <th scope="row"><?= $estudiante['id'] //$contador ?></th>
          <td><?= $estudiante['nombres'] ?></td>
          <td><?= $estudiante['apellidos'] ?></td>
          <td><?= $estudiante['email'] ?></td>
          <td><?= $estudiante['fecha_nacimiento'] ?></td>
          <td><?= $estudiante['direccion'] ?></td>
          <td> 
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Opciones
              </button>
              <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= base_url("editar-estudiantes/".$estudiante['id']) ?>">Editar</a></li>
                    <li><a class="dropdown-item" href="<?= base_url("eliminar-estudiantes/".$estudiante['id']) ?>">Eliminar</a></li>
              </ul>
            </div>
          </td>
        </tr>
      <?php 
      //$contador++;
      endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No hay estudiantes registrados.</p>
<?php endif; ?>
<?php echo $paginador->links();?>

<?= $this->endSection() ?>