<div class="row text-center">
    <div class="col">
        <h1>Receptores de Comunicación</h1>
    </div>
</div>
<div class="row justify-content-center">
    <form id="formReceptores" class="col-lg-4 border rounded bg-light p-3">
    <input type="hidden" name="rec_id" id="rec_id">
        <div class="row mb-3">
            <div class="col-lg-12">
                <label for="nombre">Nombre del receptor</label> 
                <input type="text" name="rec_desc" id="rec_desc" class="form-control" placeholder="Ingrese nombre" style="text-transform:uppercase">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button id="btnGuardar" type="submit" class="btn btn-primary w-100">Guardar</button>
            </div>
            <div class="col">
                <button id="btnModificar" type="reset" class="btn btn-warning w-100">Modificar</button>
            </div>
        </div>
    </form>
</div>
<div class="row justify-content-center" id="divTabla">
    <div class="col-lg-10">
        <table id="receptoresTabla" class="table table-bordered table-hover w-100">
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
<script src="build/js/receptores/index.js"></script>