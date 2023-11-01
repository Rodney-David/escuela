<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>NOTAS ESTUDIANTES</h1>
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
<h2>Materia: <?= $materia['nombre'] ?></h2>
<a class="btn btn-success" href="<?= base_url("#/".$materia['id']) ?>">Generar Excel</a>

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
      <th scope="col">ID</th>
      <th scope="col">Estudiante</th>
      <th scope="col">Notas</th>
      <th scope="col">Estado</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    
    <?php foreach($notas_materias as $notas_m){
        ?>
        <tr>
        <th scope="row"><?= $notas_m['estudiantes_id'] ?></th>
        <td><?= $notas_m['nombre_estudiante'] . ' ' . $notas_m['apellidos_estudiante'] ?></td>
        <td><?= $notas_m['notas'] ?></td>
        <td style="color:<?= $notas_m['estado']== '1' ? 'Green' : 'Red' ?>"><?php echo $notas_m['estado']== '1' ? 'Activo' : 'Inactivo' ?></td>
        <td><div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Opciones
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url('#/'.$notas_m['id']) ?>">Guardar</a></li>
            </ul>
            </div>
        </td>
        </tr>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $notas_m['nombre_estudiante'] . ' ' . $notas_m['apellidos_estudiante'] . '/' . $notas_m['notas'] ?></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Estás seguro de eliminar esta nota? 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="<?= base_url('#/'.$notas_m['id']) ?>" class="btn btn-danger">Eliminar</a>
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