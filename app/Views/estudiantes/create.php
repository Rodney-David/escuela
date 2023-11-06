<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>AÑADIR ESTUDIANTE</h1>
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
<form method="post" action="<?= base_url()."registro_de_estudiantes" ?>" >
    <div class="form-floating mb-3">
        <input type="text" class="form-control" onblur="validar('nombres')" name="nombres" id="nombres" required>
        <label for="floatingInput">Nombres</label>
        <small id="lblerrornombres" class="text-danger"></small>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" onblur="validar('apellidos')" name="apellidos" id="apellidos" required>
        <label for="floatingInput">Apellidos</label> 
        <small id="lblerrorapellidos" class="text-danger"></small>
    </div>
    <select class="form-select" aria-label="Default select example" onblur="validar('sexo')" name="sexo" id="sexo" required>
        <option selected>Seleccionar sexo:</option>
        <option value="M">Masculino</option>
        <option value="F">Femenino</option>
    </select>
        <small id="lblerrorsexo" class="text-danger"></small>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" onblur="validar('email')" name="email" id="email" required>
        <label for="floatingInput">Email</label>
        <small id="lblerroremail" class="text-danger"></small>
    </div>
    <div class="form-floating mb-3">
        <input type="date" class="form-control" onblur="validar('fecha_nacimiento')" name="fecha_nacimiento" id="fecha_nacimiento" required>
        <label for="floatingInput">Fecha de nacimiento</label>
        <small id="lblerrorfecha_nacimiento" class="text-danger"></small>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" onblur="validar('direccion')" name="direccion" id="direccion" required>
        <label for="floatingInput">Direccion</label>
        <small id="lblerrordireccion" class="text-danger"></small>
    </div>
    <button type="submit" class="btn btn-primary" id="btnAnadir" disabled>Añadir</button>
</form>
<script>
    function validar(id) {
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
                if (seleccionado == "Seleccionar sexo:") {
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
        var btn = document.getElementById("btnAnadir");
        var camposValidos = document.querySelectorAll('.is-valid').length;

        if (camposValidos == 6) {   
            btn.disabled = false;
        } else {
            btn.disabled = true;
        }
    }
</script>

<?= $this->endsection() ?>