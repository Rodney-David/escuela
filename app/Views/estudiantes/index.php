<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>

<h1>ESTUDIANTES</h1>
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
      <?php foreach ($estudiantes as $estudiante): ?>
        <tr>
          <th scope="row"><?= $estudiante['id'] ?></th>
          <td><?= $estudiante['nombres'] ?></td>
          <td><?= $estudiante['apellidos'] ?></td>
          <td><?= $estudiante['email'] ?></td>
          <td><?= $estudiante['fecha_nacimiento'] ?></td>
          <td><?= $estudiante['direccion'] ?></td>
          <td style="white-space: nowrap;">
            <a href="<?= base_url("public/editar/".$estudiante['id']) ?>">editar</a>
            <a href="<?= base_url("public/eliminar/".$estudiante['id']) ?>">eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No hay estudiantes registrados.</p>
<?php endif; ?>

<a class="btn btn-primary" href="<?= base_url("public/create") ?>">Añadir Estudiante</a>
<?= $this->endSection() ?>