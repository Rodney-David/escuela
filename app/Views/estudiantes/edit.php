<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>EDITAR ESTUDIANTE</h1>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<form method="post" action="<?= base_url('actualizar_estudiantes/'.$estudiante['id']) ?>" onSubmit="">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" onblur="nombre(this)" name="nombres" id="nombres" value="<?= $estudiante['nombres'] ?>" required>
        <label for="floatingInput">Nombres</label>
        <small id="lblerrornombres" class="text-danger"></small>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" onblur="validar('apellidos')" name="apellidos" id="apellidos" value="<?= $estudiante['apellidos'] ?>" required>
        <label for="floatingInput">Apellidos</label> 
        <small id="lblerrorapellidos" class="text-danger"></small>
    </div>
    <select class="form-select" aria-label="Default select example" onblur="validar('sexo')" name="sexo" id="sexo" required>
        <option >Seleccionar sexo:</option>
        <option value="M"  <?= $estudiante['sexo'] == 'M' ? 'selected' : '' ?>>Masculino</option>
        <option value="F" <?= $estudiante['sexo'] == 'F' ? 'selected' : '' ?>>Femenino</option>
    </select>
        <small id="lblerrorsexo" class="text-danger"></small>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" onblur="validar('email')" name="email" id="email" value="<?= $estudiante['email'] ?>" required>
        <label for="floatingInput">Email</label>
        <small id="lblerroremail" class="text-danger"></small>
    </div>
    <div class="form-floating mb-3">
        <input type="date" class="form-control" onblur="validar('fecha_nacimiento')" name="fecha_nacimiento" id="fecha_nacimiento" value="<?= $estudiante['fecha_nacimiento'] ?>" required>
        <label for="floatingInput">Fecha de nacimiento</label>
        <small id="lblerrorfecha_nacimiento" class="text-danger"></small>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" onblur="validar('direccion')" name="direccion" id="direccion" value="<?= $estudiante['direccion'] ?>" required>
        <label for="floatingInput">Direccion</label>
        <small id="lblerrordireccion" class="text-danger"></small>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="estado" <?php echo  $estudiante['estado'] == "1" ? 'checked' : '' ?>>
        <label class="form-check-label" for="flexCheckDefault">
            Estado
        </label>
    </div>
    <input type="hidden" name="id" value="<?= $estudiante['id'] ?>">
    <button type="submit" id="btnGuardar" class="btn btn-primary" disabled>Guardar</button>
    <button type="button" class="btn btn-primary" >Guardando <i class="fa fa-spin fa-spinner" ></i></button>
</form>

<script>
    var nombres = false;
    var apellidos = true;

    function nombre(e){
        if(e.length <= 3){
            return false;
        }
        nombres = true;
        console.log(nombres);

        validar();
    }

    function validar(){
        if(nombres && apellidos){
            var btn = document.getElementById("btnGuardar");
            btn.disabled = true;
        }
        btn.disabled = false;
    }

    function validar1(id) {
        var campo = document.getElementById(id);
        var lblerror = document.getElementById("lblerror" + id);
        var valor = campo.value.trim();
        lblerror.innerHTML = "";

        switch (id) {
            case "nombres":
            case "apellidos":
                if (valor == "" || valor.length < 3 || valor.length > 50 || !/^[a-zA-Z\sáéíóúÁÉÍÓÚüÜñÑ]+$/.test(valor)) {
                    lblerror.innerHTML = "El campo '" + (id == "nombres" ? "Nombres" : "Apellidos") + "' no cumple con los requisitos.";
                    campo.classList.remove("is-valid");
                }else{
                    campo.classList.add("is-valid");
                }
                break;
            case "sexo":
                var seleccionado = campo.value;
                if (!seleccionado == "Seleccionar sexo:") {
                    lblerror.innerHTML = "Por favor, seleccione un sexo.";
                    campo.classList.remove("is-valid");
                }else{
                    campo.classList.add("is-valid");
                }
                break;
            case "email":
                if (valor == "" || !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(valor)) {
                    lblerror.innerHTML = "El campo 'Email' no cumple con los requisitos.";
                    campo.classList.remove("is-valid");
                }else{
                    campo.classList.add("is-valid");
                }
                break;
            case "fecha_nacimiento":
                if (valor == "" || !/^\d{4}-\d{2}-\d{2}$/.test(valor)) {
                    lblerror.innerHTML = "El campo 'Fecha de nacimiento' no cumple con los requisitos.";
                    campo.classList.remove("is-valid");
                }else{
                    campo.classList.add("is-valid");
                }
                break;
            case "direccion":
                if (valor == "" || valor.length < 5 || valor.length > 100 || !/^[a-zA-Z\sáéíóúÁÉÍÓÚüÜñÑ0-9\-]+$/.test(valor)) {
                    lblerror.innerHTML = "El campo 'Dirección' no cumple con los requisitos.";
                    campo.classList.remove("is-valid");
                }else{
                    campo.classList.add("is-valid");
                }
                break;
        }
        var btn = document.getElementById("btnGuardar");
        var camposValidos = document.querySelectorAll('.is-valid').length;

        if (camposValidos == 6) { 
            btn.disabled = false;
        } else {
            btn.disabled = true;
        }
    }
</script>

<?= $this->endsection() ?>