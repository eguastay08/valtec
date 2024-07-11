<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    public $timestamps = false;

    protected $fillable = [
        'nombres',
        'apellidos',
        'usuario',
        'email',
        'direccion',
        'telefono',
        'foto',
        'foto_name',
        'foto_size',
        'password',
        'estado',  
        'oculto',
        'usuario_registro',
        'fecha_registro',
        'usuario_modifica',
        'fecha_modifica',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function getUsers($nusuario = '', $estado = '_all_')
    {
        $usuarios= User::select('users.*');

        if (isset($nusuario) && $nusuario != ''):
            $usuarios->where('users.nombres','LIKE','%'.$nusuario.'%')
                     ->orWhere('users.apellidos','LIKE','%'.$nusuario.'%');
        endif;  

        if (isset($estado) && $estado != '_all_'):
            $usuarios->where('users.estado',$estado);
        endif;  

        $usuarios = $usuarios->where('users.oculto',0)
                    ->orderBy('users.apellidos', 'ASC')
                    ->paginate(10);

        return $usuarios;
    }

}
