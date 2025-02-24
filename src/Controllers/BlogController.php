<?php

namespace Ozparr\AdminBlog\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Ozparr\AdminBlog\Models\Entrada;
use Ozparr\AdminBlog\Models\Imagen;
use Ozparr\AdminBlog\Models\Tag;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entradas = Entrada::orderBy('id', 'DESC')->paginate();

        return view('admin_blog::admin.blog.index', compact('entradas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin_blog::admin.blog.new', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $entrada = new Entrada($request->all());
        $entrada->slug = $request->titulo;
        $entrada->status = self::statusPublished($request->data);

        $entrada->user_id = Auth::user()->id;

        $tituloNoRepetido = $entrada->saveEntrada();

        self::tags($request->tag, $entrada->id);

        return self::redirecs($request,$tituloNoRepetido,$entrada);

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entrada = Entrada::find($id);
        $tags = Tag::all();
        return view('admin_blog::admin.blog.new', compact('entrada','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        self::tags($request->tag, $id);
        $entrada = Entrada::find($id);
        $entrada->fill($request->all());
        $entrada->slug = $request->titulo;
        $entrada->status = self::statusPublished($request->data);

        $tituloNoRepetido = $entrada->saveEntrada();

        return self::redirecs($request,$tituloNoRepetido,$entrada);

    }

    private function tags($requestTag, $entradaId){
        if($requestTag != null){
            $tag = Tag::where('nombre','=',$requestTag)->first();

            if($tag == null){
                $tag = new Tag(['nombre'=>$requestTag]);
                $tag->save();
            }

            $entrada = Entrada::find($entradaId);

            $entrada->tags()->attach($tag);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entrada = Entrada::find($id);
        $entrada->delete();
        flash('La entrada "'.$entrada->titulo.'" fue eliminada')->warning();

        return redirect()->route('blog.index');
    }


    public function statusPublished($val){
        //1 publicado
        //0 No publicado
        //1875 Subida de imagenes (No publicado)
        if($val == 1){
            return Entrada::PUBLICADO;
        }else{
            return Entrada::NO_PUBLICADO;
        }
    }

    public function detachTagas(Request $request){
        $entrada = Entrada::find($request->entradaId);
        $entrada->tags()->detach($request->tagId);

        return redirect()->route('blog.edit',['id'=>$entrada->id]);
    }

    private function uploadImges($request,$entrada){
        if($request->hasFile('images')){
            $imagen = new Imagen();
            $imagen->saveImg($request->file('images'), $entrada,'blog');
            return true;
        }
        return false;
    }

    private function redirecs($request,$tituloNoRepetido,$entrada){
        switch ($request->data){
            //No publicada
            case 0:
                if($tituloNoRepetido){
                    flash('La entrada "'.$entrada->titulo.'" se ha guardado correctamente.')->warning();
                }else{
                    flash('El titulo de la entrada ya existe')->error();
                }
                return redirect()->route('blog.index');
            //1 publicado
            case 1:
                if($tituloNoRepetido){
                    flash('La entrada "'.$entrada->titulo.'" se ha publicado correctamente.')->success();
                }else{
                    flash('El titulo de la entrada ya existe')->error();
                }
                return redirect()->route('blog.index');
                break;
            //1875 Subida de imagenes (No publicado)
            case 1875:
                if(!$tituloNoRepetido)
                    flash('El titulo de la entrada ya existe')->error();
                if(self::uploadImges($request,$entrada))
                    flash('Se han guardado correctamente las imagenes');
                return redirect()->route('blog.edit',['id'=>$entrada->id]);
                break;
            default:
                flash('hoooo! A pasado algo inesperado :o')->info();
                return redirect()->route('blog.edit',['id'=>$entrada->id]);
        }
    }

}
