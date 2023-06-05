<div class="row text-center">
    <div class="col">
        <h1>INSUMOS</h1>
    </div>
</div>
<div class="row justify-content-center">
    <form id="formInsumos" class="col-lg-4 border rounded bg-light p-3">
        <input type="hidden" name="insumo_id" id="insumo_id">
        <div class="row mb-3">
            <div class="col-lg-5">
                <label for="nombre">Nombre del Insumo</label>
                <input type="text" name="insumo_desc" id="insumo_desc" class="form-control" placeholder="Ingrese nombre"
                    style="text-transform:uppercase">
            </div>
            <div class=col-lg-5>
                <label for="tipo">Unidad de Medida</label>
                <select name="insumo_unidad" id="insumo_unidad" selected class="form-control">
                    <option value="">Seleccione...</option>
                    <?php foreach ($busqueda as $ins) { ?>
                        <option value="<?= $ins['uni_id'] ?>"><?= $ins['uni_desc'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class=col-lg-2>
                <label for="color">Color</label>
                <input type="color" id="insumo_color" name="insumo_color">
            </div>

        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <button id="btnGuardar" name="btnGuardar" type="submit" class="btn btn-primary w-100">Guardar</button>
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
        <table id="insumosTabla" class="table table-bordered table-hover w-100">
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
<script src="build/js/insumos/index.js"></script>