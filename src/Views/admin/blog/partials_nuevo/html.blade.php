{!!	Form::open([ 'route'=>'blog.store', 'method'=>'POST', 'files'=>true, 'enctype'=>"multipart/form-data"]) !!}
<div class="col-md-8">
    <input type="hidden" name="imgenes" class="imagenes">
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">CK Editor
                <small>Advanced and full of features</small>
            </h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-warning btn-sm" id="publicar">
                    <i class="fa fa-bullhorn"></i>  Publicar
                </button>
                <button type="button" class="btn btn-info btn-sm" id="guardar">
                    <i class="fa fa-save"></i>  Guardar
                </button>

                <input type="hidden" name="data" id="meta-data" value="1875">

                <button style="display: none" type="submit" id="submit"></button>
            </div>
            <!-- /. tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body pad">
            <div class="form-group">
                <label>Titulo</label>
                <input class="form-control" type="text" name="titulo" placeholder="Titulo">
            </div>

            <div class="form-group">
                <label>Descripcion</label>
                <textarea maxlength="191" class="form-control" rows="3" name="descripcion" placeholder="Descripción"></textarea>

            </div>

            <div class="form-group">
                <label>Imagen de portada</label>
                <input class="form-control" type="text" name="img" placeholder="Imagen De Cabecera" >
            </div>

            <div class="form-group">
                <label>Contenido</label>
                <textarea id="editor1" rows="10" cols="80" name="contenido">
                    This is my textarea to be replaced with CKEditor.
                </textarea>
            </div>
            @include('admin_blog::admin.blog.partials_nuevo.tags')
        </div>
    </div>

</div>
@include('admin_blog::admin.partials.uploadImg')

{!! Form::close() !!}
