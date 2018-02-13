<?php

namespace Ozparr\AdminBlog\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table='tags';
    protected $fillable=[
        'id',
        'nombre',
    ];

    public function entradas()
    {
        return $this->belongsToMany('Ozparr\AdminBlog\Models\Entrada')->withTimestamps();
    }
}
