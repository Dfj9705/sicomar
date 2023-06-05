<div class="row text-center">
    <div class="col">
        <h1>Embarcaciones Disponibles</h1>
    </div>
</div>
<div class="row justify-content-center">
    <form id="formEmbarcaciones" class="col-lg-4 border rounded bg-light p-3">
    <input type="hidden" name="id" id="id">
        <div class="row mb-3">
            <div class="col-lg-6">
                <label for="nombre">Nombre de la Embarcación</label> 
                <input type="text" name="desc" id="desc" class="form-control" placeholder="Ingrese nombre" style="text-transform:uppercase">
            </div>
            <div class=col-lg-6>
            <label for="tipo">Tipo de la Embarcación</label> 
            <select name="embarcacion" id="embarcacion" selected class="form-control">
                        <option value="">Seleccione...</option>
                                <?php foreach ($busqueda as $tipo) { ?>
                                <option value="<?= $tipo['tipo_id']  ?>"><?= $tipo['tipo_desc']?></option>
                                <?php  }  ?>
            </select>
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
                <button id="btnLimpiar" type="button" class="btn btn-danger w-100">Limpiar</button>
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
        <table id="embarcacionesTabla" class="table table-bordered table-hover w-100">
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