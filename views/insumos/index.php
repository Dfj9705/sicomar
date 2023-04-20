<div class="row justify-content-center mb-3">
    <form class="col-lg-6 p-5 border bg-light rounded " name="forminsumos" id="forminsumos">
        <div class="row text-center">
            <div class="col-12 mb-3">
                <h1>Tipo de Insumos</h1>
            </div>
        </div>
        <div class="row justify-content-center mb-3">
            <div class="col-lg-6">
                <label for="nombre">Nombre del Insumo </label>
                <input type="text" name="desc" id="desc" class="form-control" placeholder="Ingrese tipo de insumo"
                    style="text-transform:uppercase">
            </div>
            <div class="col-lg-5">
                <label for="nombre">Unidad de Medida </label>

                <input type="text" name="desc" id="desc" class="form-control" placeholder="Ingrese tipo de Unidad"
                    style="text-transform:uppercase">
            </div>
            <div class="col-lg-1 text-start">
                <label for="nombre">color </label>

                <input type="color" name="color" id="color" class="form-control form-control-color">
            </div>
        </div>
        <div class="row justify-content-center mb-3">
            <div class="col-lg-3 d-grid mb-lg-0 mb-2">
                <button id="btnGuardar" type="submit" class="btn btn-primary w-100">Guardar</button>
            </div>
            <div class="col-lg-3 d-grid mb-lg-0 mb-2">
                <button id="btnModificar" type="button" class="btn btn-warning w-100">Modificar</button>
            </div>
            <div class="col-lg-3 d-grid mb-lg-0 mb-2">
                <a id="btnbuscar" type="button" class="btn btn-warning w-100" href="/sicomar/insumos">buscar</a>
            </div>
        </div>
    </form>
</div>
<div class="row mb-2 justify-content-center text-center" id="divTabla">
    <div class="col-lg-100">
        <table id="divTabla" class="table table-hover table-condensed table-bordered">
            <thead class='table-dark'>
                <tr>
                    <th>No</th>
                    <th>NOMBRE</th>
                    <th>UNIDAD</th>
                    <th>COLOR</th>
                    <th>MODIFICAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<script src="build/js/insumo/index.js"></script>