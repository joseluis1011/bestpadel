<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userTorneo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'torneo_id',
    ];
    public function user(){
        return $this->belongsTo(User::class,  'user_id');
    }
    public function torneos(){
        return $this->belongsTo(Torneo::class,  'torneo_id');
    }
}
