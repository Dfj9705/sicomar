<div class="row text-center">
    <div class="col">
        <h1>MOTORES</h1>
    </div>
</div>
<div class="row justify-content-center">
    <form id="formMotores" class="col-lg-4 border rounded bg-light p-3">
    <input type="hidden" name="id" id="id">
        <div class="row mb-3">
            <div class="col-lg-12">
                <label for="nombre">Numero de Serie</label> 
                <input type="text" name="mot_serie" id="mot_serie" class="form-control" placeholder="Ingrese nombre" style="text-transform:uppercase">
            </div>
            <div class="col-lg-12">
                <label for="nombre">Embarción</label>
                <select name="embarcacion" id="embarcacion" selected class="form-control">
                                  <option value="">Seleccione...</option>
                            <?php foreach ($busqueda as $emba) { ?>
                                   <option value="<?= $emba['emb_id']  ?>"><?= $emba['emb_nombre']?></option>
                            <?php  }  ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button id="btnGuardar" type="submit" class="btn btn-primary w-100">Guardar</button>
            </div>
            <div class="col">
                <button id="btnModificar" type="button" class="btn btn-warning w-100">Modificar</button>
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
        <table id="motoresTabla" class="table table-bordered table-hover w-100">
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
<script src="build/js/motores/index.js"></script>