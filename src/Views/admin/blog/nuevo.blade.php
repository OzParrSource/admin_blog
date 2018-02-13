@extends('admin_templeta::templetas.admin.index')

@section('css')
    {!! Html::style('assets/kartik-v/bootstrap-fileinput/css/fileinput.min.css') !!}
@endsection

@section('titulo', 'Nueva Entrada')

@section('direccion')
    Blog/<a href="">Nueva Entrada</a>
@endsection

@section('contenido')

    <!-- Aqui va todo el contenido -->
    <div class="row">
        @if(!isset($entrada))
            @include('admin_blog::admin.blog.partials_nuevo.html')
        @else
            @include('admin_blog::admin.blog.partials_nuevo.editar')
        @endif
        {!!	Form::open([ 'route'=>'blog.imgUpload', 'method'=>'POST', 'files'=>true, 'enctype'=>"multipart/form-data"]) !!}
            @if(isset($entrada))
                <input type="hidden" name="id" value="{!! $entrada->id !!}">
            @else
                <input type="hidden" name="id" value="0">
            @endif


        {!! Form::close() !!}
    </div>

@endsection

@section('scripts')
    <!-- Aqui van otros scripts -->
    <!-- CK EDITOR -->
    <script src="{!! url('assets/adminLTE/bower_components/ckeditor/ckeditor.js') !!}"></script>
    <script type="text/javascript">
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'editor1' );
    </script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#publicar').click(function () {
                $('#meta-data').val('1')
                $('#submit').trigger('click');
            });
            $('#guardar').click(function () {
                $('#meta-data').val('0')
                $('#submit').trigger('click');
            });

            $('#file').fileinput({
                initialPreviewAsData: true,
                initialPreview: [
                    @if(isset($entrada))
                        @foreach($entrada->imagenes as $img)
                            "{!! url($img->url) !!}",
                        @endforeach
                    @endif
                ]
            });
        })
    </script>

    <!--Scripts de galeria-->
    {!! Html::script('assets/kartik-v/bootstrap-fileinput/js/plugins/piexif.min.js') !!}
    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
        This must be loaded before fileinput.min.js -->
    {!! Html::script('assets/kartik-v/bootstrap-fileinput/js/plugins/sortable.min.js') !!}
    <!-- purify.min.js is only needed if you wish to purify HTML content in your preview for
        HTML files. This must be loaded before fileinput.min.js -->
    {!! Html::script('assets/kartik-v/bootstrap-fileinput/js/plugins/purify.min.js') !!}
    <!-- the main fileinput plugin file -->
    {!! Html::script('assets/kartik-v/bootstrap-fileinput/js/fileinput.min.js') !!}
    <!-- optionally if you need translation for your language then include  locale file as mentioned below -->
    {!! Html::script('assets/kartik-v/bootstrap-fileinput/js/locales/ja.js') !!}


@endsection