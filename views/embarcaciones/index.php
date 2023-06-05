<div class="row text-center">
    <div class="col">
        <h1>Embarcaciones Disponibles</h1>
    </div>
</div>
<div class="row justify-content-center">
    <form id="formEmbarcaciones" class="col-lg-4 border rounded bg-light p-3">
        <input type="hidden" name="emb_id" id="emb_id">
        <div class="row mb-3">
            <div class="col-lg-5">
                <label for="nombre">Nombre de la Embarcación</label>
                <input type="text" name="emb_nombre" id="emb_nombre" class="form-control" placeholder="Ingrese nombre"
                    style="text-transform:uppercase">
            </div>
            <div class=col-lg-5>
                <label for="tipo">Tipo de la Embarcación</label>
                <select name="emb_tipo" id="emb_tipo" selected class="form-control">
                    <option value="">Seleccione...</option>
                    <?php foreach ($busqueda as $tipo) { ?>
                        <option value="<?= $tipo['tipo_id'] ?>"><?= $tipo['tipo_desc'] ?></option>
                    <?php } ?>
                </select>

            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <button id="btnGuardar" name="btnGuardar" type="submit"
                        class="btn btn-primary w-100">Guardar</button>
                </div>
                <div class="row mb-3">
                    <button id="btnModificar" name="btnModificar" type="button"
                        class="btn btn-info w-100">MODIFICAR</button>
                </div>
            </div>
    </form>
</div>
<div class="row justify-content-center" id="divTabla">
    <div class="col-lg-10">
        <table id="embarcacionesTabla" class="table table-bordered table-hover w-100">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>NOMBRE</th>
                    <th>Tipo</th>
                    <th>MODIFICAR</th>
                    <th>ELIMINAR</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script src="build/js/embarcaciones/index.js"></script>