<br>

<div class="form-group">
    @isset($entrada)
        @foreach($entrada->tags as $tag)
            <a href="{!! route('blog.detachTagas',['entradaId'=>$entrada->id,'tagId'=>$tag->id]) !!}" class="btn btn-xs btn-primary">
                {!! $tag->nombre !!}
                <i class="glyphicon glyphicon-remove"></i>
            </a>
        @endforeach
    @endisset
</div>

<div class="form-group">
    <label>Tags</label>
    <input name="tag" id="tags">
</div>
