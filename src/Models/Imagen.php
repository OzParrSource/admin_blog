<?php

namespace Ozparr\AdminBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Imagen extends Model
{
    protected $table='imagenes';
    protected $fillable = [
        'id',
        'user_id',
        'url'
    ];

    public function imgtable(){
        return $this->morphTo();
    }

    public function getUrlAttribute($value)
    {
        return 'storage/img/' . $value;
    }

    //---------Scopes--------------------

    //
    public function saveImg($imges,Model $modelo, $folder = ''){
        foreach ($imges as $img ){
            //Guarda imagen en
            $url = explode("/", $img->store('public/img/'.$folder));
            $url = $url[3];

            //Guarda imagen en base de datos
            $imagen = new Imagen(['user_id'=>1,'url'=>$folder.'/'.$url]);
            $modelo->imagenes()->save($imagen);
        }
    }
}
