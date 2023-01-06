<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
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

    /*Relacion
    Para crear relacion . 
    1.-ir a terminal 
    2.-php artisan tinker
    3.-$usuario = User::find(9); para ver los datos del usuario seleccionado
    4.-$usuario->posts; para ver los post del usuario 
    */
    public function posts()
    {
        //haaMany = One to many / Relacion de 1 a muchos si los modelos no son los predeginidos por laravel hay que cambiar el return
        //return $this->hasMany(Post::class, 'Aqui va FK de ambos modelos',);
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Almacena los seguidores de un usuario
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }


    //Almacenar los que seguimos
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }



    //Comprobar si un usuario sigue a otro 
    public function siguiendo(User $user)
    {
        return $this->followers->contains($user->id);
    }
}
