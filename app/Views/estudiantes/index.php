<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>

<h1>ESTUDIANTES</h1>
<?php if (!empty($estudiantes) && is_array($estudiantes)): ?>
  <table class="table">
    <tbody>
      <?php foreach ($estudiantes as $estudiante): ?>
        <tr>
          <th scope="row"><?= $estudiante['id'] ?></th>
          <td><?= $estudiante['nombres'] ?></td>
          <td><?= $estudiante['apellidos'] ?></td>
          <td><?= $estudiante['email'] ?></td>
          <td><?= $estudiante['fecha_nacimiento'] ?></td>
          <td><?= $estudiante['direccion'] ?></td>
          <!-- Agrega más columnas según tus datos -->
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No hay estudiantes registrados.</p>
<?php endif; ?>

<a class="btn btn-primary" href="<?= base_url("public/create") ?>">Añadir Estudiante</a>
<?= $this->endSection() ?>