<div class="row text-center">
    <div class="col">
        <h1>INSUMOS</h1>
    </div>
</div>
<div class="row justify-content-center">
    <form id="formInsumos" class="col-lg-4 border rounded bg-light p-3">
    <input type="hidden" name="id" id="id">
        <div class="row mb-3">
            <div class="col-lg-5">
                <label for="nombre">Nombre del Insumo</label> 
                <input type="text" name="desc" id="desc" class="form-control" placeholder="Ingrese nombre" style="text-transform:uppercase">
            </div>
            <div class=col-lg-5>
            <label for="tipo">Unidad de Medida</label> 
            <select name="medida" id="medida" selected class="form-control">
                        <option value="">Seleccione...</option>
                                <?php foreach ($busqueda as $ins) { ?>
                                <option value="<?= $ins['uni_id']  ?>"><?= $ins['uni_desc']?></option>
                                <?php  }  ?>
            </select>
            </div>
            <div class=col-lg-2>
                    <label for="color">Color</label>
                    <input type="color">
            </div>
            
        </div>
        <div class="row mb-3">
            <div class="col-lg-4">
                <button id="btnGuardar" type="submit" class="btn btn-primary w-100">Guardar</button>
            </div>
            <div class="col-lg-4">
                <button id="btnBuscar" type="button" class="btn btn-info w-100">Buscar</button>
            </div>
            <div class="col-lg-4">
                <button id="btnLimpiar" type="reset" class="btn btn-danger w-100">Limpiar</button>
            </div>
            <!-- <div class="col">
                <button id="btnSituacion" type="button" class="btn btn-warning w-100">Limpiar</button>
            </div> -->
            <!-- <div class="col">
                <button id="btnCancelar" class="btn btn-warning w-100" href="/medios-comunicacion/usuarios">Cancelar</button>
            </div> 
             -->
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
                    <!-- <th>SITUACION</th> -->
                    <th>MODIFICAR</th>
                    <th>ELIMINAR</th>
                    <!-- <th>ESTADO</th> -->
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>