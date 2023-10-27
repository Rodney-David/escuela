<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>

<h1>DOCENTES</h1>
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
  <a class="btn btn-primary" href="<?= base_url("create_docentes") ?>">Añadir docente</a>
  <a class="btn btn-success" href="<?= base_url("generarExcel_docentes") ?>">Generar Excel</a>

  <div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
          Filtrar
        </button>
      </h2>
      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
          <form class="row g-3" action="docentes">
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombres" name="nombres">
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Apellido</label>
              <input type="text" class="form-control" id="apellidos" name="apellidos">
            </div>
            <div class="col-md-6">
              <label for="inputState" class="form-label">Sexo</label>
              <select id="inputState" class="form-select" name="sexo">
                <option value="" selected>Seleccionar Sexo</option>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="col-12">
              <label for="inputAddress" class="form-label">Dirección</label>
              <input type="text" class="form-control" id="direccion" name="direccion">
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php if (!empty($docentes) && is_array($docentes)): ?>
  <div class="table-responsive">
    <table class="table">
    <thead>
        <tr>
          <th>ID</th>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>Sexo</th>
          <th>Email</th>
          <th>Fecha de Nacimiento</th>
          <th>Dirección</th>
          <th>Estado</th>
          <th>Opciones</th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($docentes as $docente): ?>
          <tr>
            <th scope="row"><?= $docente['id']?></th>
            <td><?= $docente['nombres'] ?></td>
            <td><?= $docente['apellidos'] ?></td>
            <td><?php echo $docente['sexo']== 'M' ? 'Masculino' : 'Femenino' ?></td>
            <td><?= $docente['email'] ?></td>
            <td><?= $docente['fecha_nacimiento'] ?></td>
            <td><?= $docente['direccion'] ?></td>
            <td style="color:<?= $docente['estado']== '1' ? 'Green' : 'Red' ?>"><?php echo $docente['estado']== '1' ? 'Activo' : 'Inactivo' ?></td>
            <td> 
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Opciones
                </button>
                <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="<?= base_url("editar_docentes/".$docente['id']) ?>">Editar</a></li>
                      <li><a class="dropdown-item" href="<?= base_url("eliminar_docentes/".$docente['id']) ?>">Eliminar</a></li>
                </ul>
              </div>
            </td>
          </tr>
        <?php 
        endforeach; ?>
      </tbody>
    </table>
  </div>
<?php else: ?>
  <p>No hay docentes registrados.</p>
<?php endif; ?>
<?php echo $paginador->links();?>

<?= $this->endSection() ?>