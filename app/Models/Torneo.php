<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'dia',
        'mes',
    ];

    public function Torneo(){
        return $this->hasMany(userTorneo::class,  'torneo_id');
    }
    public function user(){
        return $this->belongsToMany(User::class,  'participantes_id');
    }
}
