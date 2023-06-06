<div class="row text-center">
    <div class="col">
        <h1>Medidas</h1>
    </div>
</div>
<div class="row justify-content-center">
    <form id="formMedidas" class="col-lg-4 border rounded bg-light p-3">
        <input type="hidden" name="uni_id" id="uni_id">
        <div class="row mb-3">
            <div class="col-lg-12">
                <label for="nombre">Nombre de la medida</label>
                <input type="text" name="uni_desc" id="uni_desc" class="form-control" placeholder="Ingrese nombre de la medida" style="text-transform:uppercase">
            </div>
            </div>
            <div class="row mb-3">
            <div class="col">
                <button id="btnGuardar" type="submit" class="btn btn-primary w-100">Guardar Medida</button>
            </div>
            <div class="col">
                <button id="btnModificar" type="button" class="btn btn-warning w-100">Modificar</button>
            </div>
        </div>
    </form>
</div>
<div class="row" id="divTabla">
    <div class="col-lg-100">
        <table id="medidasTabla" class="table table-bordered table-hover w-100">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>NOMBRE</th>
                    <th>MODIFICAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<script src="build/js/unidadmedida/index.js"></script>