<div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form-contact" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
        {{ csrf_field() }} {{ method_field('POST') }}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"> &times; </span>
          </button>
          <h3 class="modal-title"></h3>
        </div>

        <div class="modal-body">
          <input type="hidden" id="id" name="id">

          <div class="form-group">
            <label for="ci" class="col-md-3 control-label">Ci</label>
            <div class="col-md-6">
              <input type="text" id="ci" name="ci" class="form-control" autofocus required>
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="nombre" class="col-md-3 control-label">Nombre</label>
            <div class="col-md-6">
              <input type="text" id="nombre" name="nombre" class="form-control" required>
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="ap_paterno" class="col-md-3 control-label">Ap. Paterno</label>
            <div class="col-md-6">
              <input type="text" id="ap_paterno" name="ap_paterno" class="form-control" required>
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="ap_materno" class="col-md-3 control-label">Ap. Materno</label>
            <div class="col-md-6">
              <input type="text" id="ap_materno" name="ap_materno" class="form-control" required>
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="ap_casada" class="col-md-3 control-label">Ap. Casada</label>
            <div class="col-md-6">
              <input type="text" id="ap_casada" name="ap_casada" class="form-control" required>
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="fec_nac" class="col-md-3 control-label">Fecha Nacimiento</label>
            <div class="col-md-6">
              <input type="date" id="fec_nac" name="fec_nac" class="form-control" required>
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="genero" class="col-md-3 control-label">Sexo</label>
            <div class="col-md-6">
              <label for="genero">Hombre</label>
              <input name = "genero" type = "radio" value = "hombre" >
              <label for="genero">Mujer</label>
              <input name = "genero" type = "radio" value = "mujer" >
              <label for="genero">Otro</label>
              <input name = "genero" type = "radio" value = "otro" >    
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="celular" class="col-md-3 control-label">Celular</label>
            <div class="col-md-6">
              <input type="text" id="celular" name="celular" class="form-control" required>
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="dependientes" class="col-md-3 control-label">Dependientes</label>
            <div class="col-md-6">
              <input type="number" id="dependientes" name="dependientes" class="form-control" required>
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="dependientes" class="col-md-3 control-label">Estado civil</label>
            <div class="col-md-6">
             <select name="estado_civil">
               <option value="Casado">Casado</option>
               <option value="Soltero">Soltero</option>
               <option value="Divorciado">Divorciado</option>
               <option value="Concuvino(a)">Concuvino(a)</option>
             </select>
             <span class="help-block with-errors"></span>
           </div>
         </div>

         <div class="form-group">
            <label for="id_profesion" class="col-md-3 control-label">profesion</label>
            <div class="col-md-6">
              <input type="number" id="id_profesion" name="id_profesion" class="form-control" required>
              <span class="help-block with-errors"></span>
            </div>
          </div>

       </div>

       <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-save">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>

    </form>
  </div>
</div>
</div>
