<div class="row text-center">
    <div class="col">
        <h1>Ingreso de Embarcaciones</h1>
    </div>
</div>
<div class="row justify-content-center">
    <form id="formTipo" class="col-lg-4 border rounded bg-light p-3">
    <input type="hidden" name="tipo_id" id="tipo_id">
        <div class="row mb-3">
            <div class="col-lg-12">
                <label for="nombre">Nombre de la Embarcación</label> 
                <input type="text" name="tipo_desc" id="tipo_desc" class="form-control" placeholder="Ingrese nombre" style="text-transform:uppercase">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button id="btnGuardar" type="submit" class="btn btn-primary w-100">Guardar Embarcacion</button>
            </div>
            <div class="col">
                <button id="btnModificar" type="button" class="btn btn-warning w-100">Modificar</button>
            </div>
        </div>
    </form>
</div>
<div class="row justify-content-center" id="divTabla">
    <div class="col-lg-10">
        <table id="tipoTabla" class="table table-bordered table-hover w-100">
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
<script src="build/js/tipo/index.js"></script>