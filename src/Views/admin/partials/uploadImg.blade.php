<div class="col-md-4">
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Subir Imagen
                <small>Advanced and full of features</small>
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body pad">
            <!-- Anexar Foros -->
            <div class="form-group">
                <label>Anexar Fotos</label>
                <div class="file-loading">
                    <input id="file" class="file" type="file" name="images[]" multiple >
                </div>
                <span class="help-block">{!! $errors->first('images') !!} </span>
            </div>
        </div>
    </div>

</div>
