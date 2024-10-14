@php
    $arrayRutasBlog = [
          'blog.index',
          'blog.store',
          'blog.create',
          'blog.imgUpload',
          'blog.update',
          'blog.destroy',
          'blog.edit',
          'blog.destroy'
    ]
@endphp

<li class="{{ areActiveRoutes($arrayRutasBlog) }}">
    <a href="{!! route('blog.index') !!}">
        <i class="fa fa-list-ul"></i> <span>Blog</span>
        <span class="pull-right-container"></span>
    </a>
</li>