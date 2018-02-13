<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Entradas</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <a href="{!! route('blog.create') !!}" class="btn btn-warning btn-sm" id="publicar">
                        <i class="fa fa-plus-circle"></i>  Nueva entrada
                    </a>
                    <button type="button" class="btn btn-info btn-sm" id="guardar">
                        <i class="fa fa-save"></i>  Buscar
                    </button>

                    <input type="text" name="data" id="meta-data" style="display: none" multiple>
                    <button style="display: none" type="submit" id="submit"></button>
                </div>
                <!-- /. tools -->
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Titulo</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Op</th>
                    </tr>
                    @if(isset($entradas))
                        @foreach($entradas as $entrada)
                            <tr>
                                <td>{!! $entrada->id !!}</td>
                                <td>{!! $entrada->titulo !!}</td>
                                <td>
                                    @if($entrada->status == 'published')
                                        Publicada
                                    @else
                                        Borrador
                                    @endif
                                </td>
                                <td>{!! $entrada->updated_at !!}</td>
                                <td>
                                    <a href="{!! route('blog.edit',['id'=>$entrada->id]) !!}" class="btn btn-xs btn-warning">
                                        <span class="fa fa-edit" aria-hidden="true"></span>
                                    </a>

                                    <a href="{!! route('blog.destroy',['id'=>$entrada->id]) !!}" class="btn btn-xs btn-danger">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                @if(isset($entradas))
                    {!! $entradas->render() !!}
                @endif
            </div>
        </div>
    </div>
</div>