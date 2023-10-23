<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>EDITAR CURSO</h1>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<h2>Curso: <?= $curso['nivel'] . '/' . $curso['seccion'] . ' - ' . $curso['periodo'] ?></h2>
<a href="<?= base_url("inscribir-cursos/".$curso['id']) ?>" class="btn btn-primary">Inscribir Estudiante</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Matricula ID</th>
      <th scope="col">Estudiante</th>
      <th scope="col">Estado</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    
    <?php foreach($inscripciones as $inscripcion){
        ?>
        <tr>
        <th scope="row"><?= $inscripcion['id'] ?></th>
        <td><?= $inscripcion['nombre_estudiante'] . ' ' . $inscripcion['apellidos_estudiante'] ?></td>
        <td><?= $inscripcion['estado'] ?></td>
        <td><div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Opciones
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url('edit_inscripcion/'.$inscripcion['id']) ?>">Editar</a></li>
                <li><a class="dropdown-item" href="#">Eliminar</a></li>
            </ul>
            </div>
        </td>
        </tr>
        <?php
    } ?>
    
  </tbody>
</table>
<?= $this->endsection() ?>