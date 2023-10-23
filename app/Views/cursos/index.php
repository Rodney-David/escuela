<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>

<h1>CURSOS</h1>
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
<?php if (!empty($cursos) && is_array($cursos)): ?>
  <table class="table">
  <thead>
      <tr>
        <th>ID</th>
        <th>Nivel</th>
        <th>Seccion</th>
        <th>Periodo</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cursos as $curso): ?>
        <tr>
          <th scope="row"><?= $curso['id'] ?></th>
          <td><?= $curso['nivel'] ?></td>
          <td><?= $curso['seccion'] ?></td>
          <td><?= $curso['periodo'] ?></td>
          <td style="white-space: nowrap;">
            <a href="<?= base_url("ver-cursos/".$curso['id']) ?>">ver</a>
            <a href="<?= base_url("editar-cursos/".$curso['id']) ?>">editar</a>
            <a href="<?= base_url("eliminar-cursos/".$curso['id']) ?>">eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No hay cursos registrados.</p>
<?php endif; ?>

<a class="btn btn-primary" href="<?= base_url("create-cursos") ?>">Añadir Curso</a>
<?= $this->endSection() ?>