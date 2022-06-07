<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Registros extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'pista',
        'dia',
        'mes',
        'hora',
        'user_id',
    ];
    
    public function user(){
        return $this->belongsTo(User::class,  'user_id');

    }

}
