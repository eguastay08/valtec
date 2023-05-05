<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;

    protected $table = 'opiniones';

    protected $primaryKey = 'opinion_id';

    public $timestamps = false;

    protected $fillable = ['nombre','apellido','calificacion','facebook_id','comentario','auth','fecha_registro','estado','oculto'];

}
