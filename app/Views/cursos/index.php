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
  <a class="btn btn-primary" href="<?= base_url("create_cursos") ?>">Añadir Curso</a>
<?php if (!empty($cursos) && is_array($cursos)): ?>
  <table class="table">
  <thead>
      <tr>
        <th>ID</th>
        <th>Nivel</th>
        <th>Seccion</th>
        <th>Periodo</th>
        <th>Estado</th>
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
          <td style="color:<?= $curso['estado']== '1' ? 'Green' : 'Red' ?>"><?php echo $curso['estado']== '1' ? 'Activo' : 'Inactivo' ?></td>
          <td><div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Opciones
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url("ver_inscripciones/".$curso['id']) ?>">Ver</a></li>
                <li><a class="dropdown-item" href="<?= base_url("ver_materias/".$curso['id']) ?>">Materias</a></li>
                <li><a class="dropdown-item" href="<?= base_url("editar_cursos/".$curso['id']) ?>">Editar</a></li>
                <li><a class="dropdown-item" href="<?= base_url("eliminar_cursos/".$curso['id']) ?>">Eliminar</a></li>
            </ul>
          </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No hay cursos registrados.</p>
<?php endif; ?>
  <?php echo $paginador->links();?>
<?= $this->endSection() ?>