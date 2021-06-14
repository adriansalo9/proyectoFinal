<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
class Snake extends Model
{
    use HasFactory;
    protected $fillable = [
        'score'
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
