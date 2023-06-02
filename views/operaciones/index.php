<h1 class="text-center">Ingreso de Operaciones</h1>
<div class="row justify-content-center">
    <form class="col-lg-6 bg-light border p-3 rounded" id="formOperaciones" name="formOperaciones">
        <input type="hidden" name="tipo_id" id="tipo_id">
        <div class="row mb-3">
            <div class="col">
                <label for="ope_nombre">Nombre de la embarcación</label>
                <input type="text" name="tipo_desc" id="tipo_desc" class="form-control">
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <div class="mb-2 mb-lg-0 col-lg-4">
                <button type="submit" id="btnGuardar"  class="btn w-100 btn-primary">Guardar</button>
            </div>
            <div class="mb-2 mb-lg-0 col-lg-4">
                <button type="button" id="btnModificar" class="btn w-100 btn-warning">Modificar</button>
            </div>
        </div>
    </form>
</div>
<div class="row justify-content-center" id="divTabla">
    <div class="col-lg-10">
        <table id="operacionesTabla" class="table table-bordered table-hover w-100">
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

<script src="build/js/operaciones/index.js"></script>
