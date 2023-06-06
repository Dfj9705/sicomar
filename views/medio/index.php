<div class="row text-center">
    <div class="col">
        <h1>Medios de Comunicación</h1>
    </div>
</div>
<div class="row justify-content-center">
    <form id="formMedio" class="col-lg-4 border rounded bg-light p-3">
        <input type="hidden" name="medio_id" id="medio_id">
        <div class="row mb-3">
            <div class="col-lg-12">
                <label for="nombre">Nombre del Medio</label>
                <input type="text" name="medio_desc" id="medio_desc" class="form-control" placeholder="Ingrese nombre"
                    style="text-transform:uppercase">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button id="btnGuardar" type="submit" class="btn btn-primary w-100">Guardar</button>
            </div>
            <div class="col">
                <button id="btnModificar" type="Submit" class="btn btn-warning w-100">Modificar</button>
            </div>
        </div>
    </form>
</div>
<div class="row justify-content-center" id="divTabla">
    <div class="col-lg-10">
        <table id="medioTabla" class="table table-bordered table-hover w-100">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>NOMBRE</th>
                    <th>MODIFICAR</th>
                    <th>ELIMINAR</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script src="build/js/medios/index.js"></script>