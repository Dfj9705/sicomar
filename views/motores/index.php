<div class="container-fluid text-center pt-5">
         
         <div class="row justify-content-center mb-3">
             <form class="col-lg-6 p-5 border bg-light rounded" id="formMotores">
                 <div class="row justify-content-center">
                     <div class="col-12 mb-3">
                         <h1>Motores disponibles</h1>
                     </div>
                 </div>
                 <input type="hidden" name="codigo" id="codigo">
                 <div class="row justify-content-center mb-3">
                     <div class="col-lg-6">
                         <label for="serie">Número de serie</label>
                         <input type="text" name="serie" id="serie" class="form-control">
                     </div>
                     <div class="col-lg-6">
                         <label for="embarcacion">Embarcación</label>
                         <select name="embarcacion" id="embarcacion" class="form-control">
                             <?= select_embarcaciones_disponibles() ?>
                         </select>
                     </div>
                 </div>
                 <div class="row justify-content-center mb-3">
                     <div class="col-lg-3 d-grid mb-lg-0 mb-2">
                         <button type="submit" class="btn btn-success"><i class="bi bi-save me-2"></i>Guardar</button>
                     </div>
                     <div class="col-lg-3 d-grid mb-lg-0 mb-2">
                         <button type="button" class="btn btn-info"  id="btnBuscar"><i class="bi bi-search me-2"></i>Buscar</button>
                     </div>
                     <div class="col-lg-3 d-grid mb-lg-0 mb-2">
                         <button type="button" class="btn btn-warning" id="btnModificar"><i class="bi bi-pencil-square me-2"></i>Modificar</button>
                     </div>
                     <div class="col-lg-3 d-grid mb-lg-0 mb-2">
                         <button type="reset" class="btn btn-danger"><i class="bi bi-arrow-clockwise me-2"></i>Limpiar</button>
                     </div>
                 </div>
                 
             </form>
         </div>
         <div class="row mb-2 justify-content-center text-center" id="tabla" >
             <div class="col-sm-12 col-lg-6 table-responsive " >
                 <table id='dataTable' class='table table-hover table-condensed table-bordered w-100'>
                     <thead class='table-dark'>
                     <tr>
                     <th >No</th>
                     <th >EMBARCACION</th>
                     <th >NO. DE SERIE</th>
                     <th>MODIFICAR</th>
                     <th>ELIMINAR</th>
                     </tr>
                     </thead>
                     <tbody id="tabla_body">
                         
                     </tbody>
                 </table>
                
                 
             </div>
         </div>
         <!-- <script src="build/js/Motores/index.js"></script> -->
