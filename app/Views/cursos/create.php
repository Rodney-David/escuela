<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>AÑADIR CURSO</h1>
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
<form method="post" action="<?= base_url()."registro-de-cursos" ?>" >
    <div class="form-floating mb-3">
        <input type="number" class="form-control" onblur="validar('nivel')" name="nivel" id="nivel" value="<?= old('nivel')?>" required>
        <label id="lblerrornivel" for="floatingInput">Nivel</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" onblur="validar('seccion')" name="seccion" id="seccion" value="<?= old('seccion')?>" required>
        <label id="lblerrorseccion" for="floatingInput">Seccion</label> 
    </div>
    <div class="form-floating mb-3">
        <input type="date" class="form-control" onblur="validar('periodo')" name="periodo" id="periodo" value="<?= old('periodo')?>" required>
        <label id="lblerrorperiodo" for="floatingInput">Periodo</label>
    </div>
    <button type="submit" id="btnAnadir" class="btn btn-primary">Añadir</button>
</form>


<script>
    function validar(id) {
        var campo = document.getElementById(id);
        var lblerror = document.getElementById("lblerror" + id);
        var valor = campo.value.trim();
        lblerror.innerHTML = "";

        switch (id) {
            case "nivel":
                if (valor == "" || !valor.match(/^\d+$/)) {
                    lblerror.innerHTML = "El campo 'nivel' no cumple con los requisitos.";
                    campo.classList.remove("is-valid");
                }else{
                    campo.classList.add("is-valid");
                }
                break;
            case "seccion":
                if (valor == "" || valor.length > 4 || !/^[a-zA-Z]+$/.test(valor)) {
                    lblerror.innerHTML = "El campo 'seccion' no cumple con los requisitos.";
                    campo.classList.remove("is-valid");
                }else{
                    campo.classList.add("is-valid");
                }
                break;
            case "periodo":
                if (valor == "" || !valor.match(/^[\pL\sñÑáéíóúÁÉÍÓÚüÜ0-9\-]+$/) || valor.length > 50) {
                    lblerror.innerHTML = "El campo 'periodo' no cumple con los requisitos.";
                    campo.classList.remove("is-valid");
                }else{
                    campo.classList.add("is-valid");
                }
                break;
        }
        var btn = document.getElementById("btnAnadir");
        var camposValidos = document.querySelectorAll('.is-valid').length;

        if (camposValidos == 3) {
            btn.disabled = false;
        } else {
            btn.disabled = true;
        }
    }
</script>

<?= $this->endsection() ?>