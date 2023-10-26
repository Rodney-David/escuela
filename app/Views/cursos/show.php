<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>ESTUDIANTES INSCRITOS</h1>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<?php if (session()->has('success')): ?>
    <div class="alert alert-success">
        <?= session('success') ?>
    </div>
<?php endif; ?>

<h2>Curso: <?= $curso['nivel'] . '/' . $curso['seccion'] . ' - ' . $curso['periodo'] ?></h2>
<a href="<?= base_url("inscribir-cursos/".$curso['id']) ?>" class="btn btn-primary">Inscribir Estudiante</a>
<a class="btn btn-success" href="<?= base_url("generarExcel_inscripciones/".$curso['id']) ?>">Generar Excel</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Matricula ID</th>
      <th scope="col">Estudiante</th>
      <th scope="col">Curso</th>
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
        <td><?= $inscripcion['nivel_curso'] . '/' . $inscripcion['seccion_curso'] ?></td>
        <td style="color:<?= $inscripcion['estado']== '1' ? 'Green' : 'Red' ?>"><?php echo $inscripcion['estado']== '1' ? 'Activo' : 'Inactivo' ?></td>
        <td><div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Opciones
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url('edit_inscripcion/'.$inscripcion['id']) ?>">Editar</a></li>
                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">Eliminar</a></li>
            </ul>
            </div>
        </td>
        </tr>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $inscripcion['nombre_estudiante'] . ' ' . $inscripcion['apellidos_estudiante'] ?></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Estás seguro de eliminar esta inscripción? 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="<?= base_url('eliminar_inscripcion/'.$inscripcion['id']) ?>" class="btn btn-danger">Eliminar</a>
          </div>
        </div>
      </div>
    </div>
        <?php
    } ?>
    
  </tbody>
</table>
<?php echo $paginador->links();?>
<?= $this->endsection() ?>