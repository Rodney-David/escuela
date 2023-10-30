<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>MATERIAS ASIGNADAS</h1>
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
<a href="<?= base_url("inscribir_cursos_materia/".$curso['id']) ?>" class="btn btn-primary">Asignar Materia</a>
<a class="btn btn-success" href="#">Generar Excel</a>

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
              <label for="inputEmail4" class="form-label">Nombre Materia</label>
              <input type="text" class="form-control" id="nombre_materias" name="nombre_materias">
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Codigo Materia</label>
              <input type="text" class="form-control" id="codigo_materias" name="codigo_materias">
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Nombre Docente</label>
              <input type="text" class="form-control" id="nombre_docentes" name="nombre_docentes">
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Apellido Docente</label>
              <input type="text" class="form-control" id="apellido_docentes" name="apellido_docentes">
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
      <th scope="col">Asignacion ID</th>
      <th scope="col">Materia</th>
      <th scope="col">Codigo</th>
      <th scope="col">Docente</th>
      <th scope="col">Estado</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    
    <?php foreach($materias_cursos as $materias_c){
        ?>
        <tr>
        <th scope="row"><?= $materias_c['id'] ?></th>
        <td><?= $materias_c['nombre_materias']?></td>
        <td><?= $materias_c['codigo_materias'] ?></td>
        <td><?= $materias_c['nombre_docentes'] . ' ' . $materias_c['apellido_docentes'] ?></td>
        <td style="color:<?= $materias_c['estado']== '1' ? 'Green' : 'Red' ?>"><?php echo $materias_c['estado']== '1' ? 'Activo' : 'Inactivo' ?></td>
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