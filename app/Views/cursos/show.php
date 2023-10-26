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

<div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
          Filtrar
        </button>
      </h2>
      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
          <form class="row g-3" action="" >
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre_estudiante" name="nombre_estudiante">
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Apellido</label>
              <input type="text" class="form-control" id="apellidos_estudiante" name="apellidos_estudiante">
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Nivel del curso</label>
              <input type="text" class="form-control" id="nivel_curso" name="nivel_curso">
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Seccion del Curso</label>
              <input type="text" class="form-control" id="seccion_curso" name="seccion_curso">
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

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