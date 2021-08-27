<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mine extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'minutos',
        'segundos',
        'centesimas'
    ];
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
