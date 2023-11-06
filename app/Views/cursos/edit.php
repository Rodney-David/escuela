<?= $this->extend('template/index') ?>
<?= $this->section('content') ?>
<h1>EDITAR CURSO</h1>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<form method="post" action="<?= base_url('actualizar_cursos/'.$curso['id']) ?>">
    <div class="form-floating mb-3">
        <input type="number" class="form-control" onblur="validar('nivel')" name="nivel" id="nivel" value="<?= $curso['nivel'] ?>" required>
        <label id="lblerrornivel" for="floatingInput">Nivel</label>        
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" onblur="validar('seccion')"name="seccion" id="seccion" value="<?= $curso['seccion'] ?>" required>
        <label id="lblerrorseccion" for="floatingInput">Seccion</label> 
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" onblur="validar('periodo')" name="periodo" id="periodo" value="<?= $curso['periodo'] ?>" required>
        <label id="lblerrorperiodo" for="floatingInput">Periodo</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="estado" <?php echo  $curso['estado'] == "1" ? 'checked' : '' ?>>
        <label class="form-check-label" for="flexCheckDefault">
            Estado
        </label>
    </div>
    <input type="hidden" name="id" value="<?= $curso['id'] ?>">
    <button id="btnGuardar" type="submit" class="btn btn-primary" disabled>Guardar</button>
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
        var btn = document.getElementById("btnGuardar");
        var camposValidos = document.querySelectorAll('.is-valid').length;

        if (camposValidos == 3) {
            btn.disabled = false;
        } else {
            btn.disabled = true;
        }
    }
</script>

<?= $this->endsection() ?>