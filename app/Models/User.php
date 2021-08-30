<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Route;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function snake()
    {
        $nombreRuta = Route::currentRouteName();
        if ($nombreRuta == 'score.index'){
            return $this->hasMany(Snake::class)->orderBy('score','DESC')->take(1);
        }
        return $this->hasMany(Snake::class)->orderBy('score','DESC')->take(5);
    }
    public function mine()
    {
        $nombreRuta = Route::currentRouteName();
        if ($nombreRuta == 'score.index'){
            return $this->hasMany(Mine::class)->orderBy('minutos')->orderBy('segundos')->orderBy('centesimas')->take(1);
        }
        return $this->hasMany(Mine::class)->orderBy('minutos')->orderBy('segundos')->orderBy('centesimas')->take(5);
    }
    public function role()
        {
            return $this->belongsTo(Role::class);
        } 
}
