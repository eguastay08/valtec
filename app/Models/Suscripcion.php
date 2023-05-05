<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    use HasFactory;

    protected $table = 'suscripcions';

    protected $primaryKey = 'suscripcion_id';

    public $timestamps = false;

    protected $fillable = ['email','oculto','fecha_registro'];
}
