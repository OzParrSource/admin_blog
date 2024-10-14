@extends('admin_templeta::templetas.admin.index')

@section('titulo', 'Blog')

@section('direccion')
    Blog/<a href="">Entradas</a>
@endsection

@section('contenido')

    <!-- Aqui va to-do el contenido -->
    @include('admin_blog::admin.blog.partials.tableEntradas')

@endsection

@section('scripts')
    <!-- Aqui van otros scripts -->
@endsection