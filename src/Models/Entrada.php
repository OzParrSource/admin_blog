<?php

namespace Ozparr\AdminBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Entrada extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    const PUBLICADO = 'published';
    const NO_PUBLICADO = '!published';

    protected $table = 'entradas';
    protected $fillable=[
        'id',
        'contenido',
        'user_id',
        'descripcion',
        'titulo',
        'img',
        'status',
        'slug',
        'updated_at'
    ];

    public function tags()
    {
        return $this->belongsToMany('Ozparr\AdminBlog\Models\Tag')->withTimestamps();//->withPivot('cantidad');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function imagenes(){
        return $this->morphMany('Ozparr\AdminBlog\Models\Imagen', 'imgtable');
    }

    //INICIA MUTADORES

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);;
    }

    //FIN MUTADORES

    public function saveEntrada($ban = true){
        try{
            $this->save();
            return $ban;
        }
        catch(\Exception $e){
            // do task when error
            if($e->getCode() == 23000){
                $this->slug = $this->titulo . rand(1000000000, 9999999999);
                $this->titulo = $this->slug;
                $this->status = self::NO_PUBLICADO;
                $this->saveEntrada(false);
            }
        }
    }
}
